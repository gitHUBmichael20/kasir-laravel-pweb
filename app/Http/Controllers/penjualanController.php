<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Produk;

class penjualanController extends Controller
{
    //

    public function index ()
    {
        $penjualans = Penjualan::all();
        return view('pages.dashboard', compact('penjualans'));
    }

    public function detailProduk()
    {
        $produks = produk::all();
        return view('pages.penjualan.tambah', compact('produks'));
    }
}
