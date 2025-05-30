<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Detailpenjualan;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class penjualanController extends Controller
{


    public function index()
    {
        $penjualans = Penjualan::simplePaginate(15);
        return view('pages.dashboard', compact('penjualans'));
    }

    public function detailData()
    {
        $produks = Produk::all();
        $pelanggans = Pelanggan::all();
        return view('pages.penjualan.tambah', compact('produks', 'pelanggans'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'PelangganID' => 'required|exists:pelanggan,PelangganID',
            'items' => 'required|array|min:1',
            'items.*.ProdukID' => 'required|exists:produk,ProdukID',
            'items.*.JumlahProduk' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Mulai transaksi database
            DB::beginTransaction();

            // Buat penjualan baru
            $penjualan = new Penjualan();
            $penjualan->PelangganID = $request->PelangganID;
            $penjualan->TanggalPenjualan = now();
            $penjualan->TotalHarga = 0; // Akan dihitung setelah detail
            $penjualan->save();

            $totalHarga = 0;
            $items = $request->items;

            // Proses setiap item di keranjang
            foreach ($items as $item) {
                $produk = Produk::find($item['ProdukID']);

                // Validasi stok
                if ($produk->Stok < $item['JumlahProduk']) {
                    DB::rollBack();
                    return response()->json([
                        'status' => 'error',
                        'message' => "Stok tidak cukup untuk produk {$produk->NamaProduk}",
                    ], 400);
                }

                // Buat detail penjualan
                $detail = new Detailpenjualan();
                $detail->PenjualanID = $penjualan->PenjualanID;
                $detail->ProdukID = $item['ProdukID'];
                $detail->JumlahProduk = $item['JumlahProduk'];
                $detail->Subtotal = $produk->Harga * $item['JumlahProduk'];
                $detail->save();

                // Kurangi stok produk
                $produk->Stok -= $item['JumlahProduk'];
                $produk->save();

                $totalHarga += $detail->Subtotal;
            }

            // Update total harga penjualan
            $penjualan->TotalHarga = $totalHarga;
            $penjualan->save();

            // Commit transaksi
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Penjualan berhasil dibuat',
                'data' => [
                    'PenjualanID' => $penjualan->PenjualanID,
                    'PelangganID' => $penjualan->PelangganID,
                    'TotalHarga' => $penjualan->TotalHarga,
                    'TanggalPenjualan' => $penjualan->TanggalPenjualan,
                ],
            ], 201);
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat membuat penjualan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function showReceipt($id)
    {
        try {
            $penjualan = Penjualan::with(['pelanggan', 'detailpenjualans.produk'])
                ->findOrFail($id);

            $data = [
                'penjualan' => $penjualan,
            ];

            $pdf = Pdf::loadView('pages.penjualan.receipt', $data);

            return $pdf->download('struk_penjualan_' . $penjualan->PenjualanID . '.pdf');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Penjualan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat struk PDF: ' . $e->getMessage());
        }
    }
}
