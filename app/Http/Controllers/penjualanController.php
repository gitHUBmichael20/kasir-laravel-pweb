<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Pelanggan;

class penjualanController extends Controller
{
    //

    public function index ()
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
}
