<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class penjualanController extends Controller
{


    public function index()
    {
        $penjualans = Penjualan::all();
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
        DB::beginTransaction();

        try {

            $request->validate([
                'TanggalPenjualan' => 'required|date',
                'PelangganID' => 'required|exists:pelanggan,PelangganID',
                'products' => 'required|array|min:1',
                'products.*.ProdukID' => 'required|exists:produk,ProdukID',
                'products.*.JumlahProduk' => 'required|integer|min:1',
            ]);

            $totalHargaPenjualan = 0;
            $detailPenjualanData = [];


            foreach ($request->products as $item) {
                $produk = Produk::find($item['ProdukID']);


                if (!$produk) {
                    throw new \Exception("Produk dengan ID {$item['ProdukID']} tidak ditemukan.");
                }
                if ($produk->Stok < $item['JumlahProduk']) {
                    throw new \Exception("Stok {$produk->NamaProduk} tidak mencukupi. Stok tersedia: {$produk->Stok}, Diminta: {$item['JumlahProduk']}.");
                }

                $subtotal = $item['JumlahProduk'] * $produk->Harga;
                $totalHargaPenjualan += $subtotal;

                $detailPenjualanData[] = [
                    'ProdukID' => $item['ProdukID'],
                    'JumlahProduk' => $item['JumlahProduk'],
                    'Subtotal' => $subtotal,
                ];
            }


            $penjualan = Penjualan::create([
                'TanggalPenjualan' => $request->TanggalPenjualan,
                'TotalHarga' => $totalHargaPenjualan,
                'PelangganID' => $request->PelangganID,
            ]);


            foreach ($detailPenjualanData as $detail) {
                $penjualan->detailpenjualans()->create($detail);


                $produk = Produk::find($detail['ProdukID']);
                $produk->Stok -= $detail['JumlahProduk'];
                $produk->save();
            }

            DB::commit();


            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Penjualan berhasil ditambahkan!',
                    'data' => $penjualan->load('detailpenjualans.produk', 'pelanggan')
                ], 201);
            }


            Session::flash('success', 'Penjualan berhasil ditambahkan!');
            return redirect()->route('penjualan.all');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menambahkan penjualan: ' . $e->getMessage()
                ], 400);
            }
            Session::flash('error', 'Gagal menambahkan penjualan: ' . $e->getMessage());
            return redirect()->back();
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
