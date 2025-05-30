<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class penjualanController extends Controller
{

    public function detailData()
    {
        $produks = Produk::all();
        $pelanggans = Pelanggan::all();
        return view('pages.penjualan.tambah', compact('produks', 'pelanggans'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'PelangganID' => 'required|string',
                'items' => 'required|array',
                'items.*.ProdukID' => 'required|string',
                'items.*.JumlahProduk' => 'required|integer|min:1'
            ]);

            Log::info('Penjualan request data:', $request->all());

            $pelangganID = $request->input('PelangganID');
            $items = $request->input('items');

            // TAMBAHAN: Hitung total harga
            $totalHarga = 0;
            foreach ($items as $item) {
                // Ambil harga produk dari database
                $produk = \App\Models\Produk::find($item['ProdukID']);
                if ($produk) {
                    $totalHarga += $produk->Harga * $item['JumlahProduk'];
                }
            }

            // TAMBAHAN: Simpan data penjualan
            $penjualan = \App\Models\Penjualan::create([
                'PelangganID' => $pelangganID,
                'TanggalPenjualan' => now()->toDateString(),
                'TotalHarga' => $totalHarga
            ]);

            // TAMBAHAN: Simpan detail penjualan
            foreach ($items as $item) {
                $produk = \App\Models\Produk::find($item['ProdukID']);
                if ($produk) {
                    \App\Models\Detailpenjualan::create([
                        'PenjualanID' => $penjualan->PenjualanID,
                        'ProdukID' => $item['ProdukID'],
                        'JumlahProduk' => $item['JumlahProduk'],
                        'Subtotal' => $produk->Harga * $item['JumlahProduk']
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan!',
                'data' => [
                    'penjualan_id' => $penjualan->PenjualanID,
                    'pelanggan_id' => $pelangganID,
                    'total_items' => count($items),
                    'total_harga' => $totalHarga
                ]
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error in penjualan store: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
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
