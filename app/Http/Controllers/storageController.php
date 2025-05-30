<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Pelanggan;

class StorageController extends Controller
{
    public function pelangganImage(Request $request, $filename)
    {
        $path = 'public/pelanggan/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'Image not found');
        }

        return response(Storage::get($path))
            ->header('Content-Type', Storage::mimeType($path));
    }

    public function produkImage(Request $request, $filename)
    {
        $path = 'public/produk/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'Image not found');
        }

        return response(Storage::get($path))
            ->header('Content-Type', Storage::mimeType($path));
    }


    public function index()
    {
        try {
            $penjualans = Penjualan::simplePaginate(15);
            $totalTransaksi = Penjualan::count();
            $totalPendapatan = Penjualan::sum('TotalHarga') ?? 0;
            $totalProduk = Produk::count();
            $totalPelanggan = Pelanggan::count();
            return view('pages.dashboard', compact('penjualans', 'totalTransaksi', 'totalPendapatan', 'totalProduk', 'totalPelanggan'));
        } catch (\Exception $e) {
            abort(500, 'Gagal mengambil data kasir: ' . $e->getMessage());
        }
    }
}
