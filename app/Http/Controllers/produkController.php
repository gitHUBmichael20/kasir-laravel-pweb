<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Detailpenjualan;

class produkController extends Controller
{
    //

    public function index()
    {
        $produks = produk::all();
        return view('pages.produk.list', compact('produks'));
    }

    public function showProduct($id)
    {
        $produkDetail = Produk::findOrFail($id);

        $transaksiProduk = Detailpenjualan::where('ProdukID', $id)
            ->with(['penjualan.pelanggan', 'produk'])
            ->simplePaginate(10);

        return view('pages.produk.detail', compact('produkDetail', 'transaksiProduk'));
    }

    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $produk->delete();
            Session::flash('success', 'Produk berhasil dihapus!');
            return redirect()->route('produk.all');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal menghapus produk: ' . $e->getMessage());
            return redirect()->route('produk.all');
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'NamaProduk' => 'required|string|max:255',
                'Harga' => 'required|numeric',
                'Stok' => 'required|integer',
                'foto_produk' => 'nullable|image|max:2048',
            ]);

            // Handle file upload if present
            if ($request->hasFile('foto_produk')) {
                $file = $request->file('foto_produk');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/produk', $filename);
                $validatedData['foto_produk'] = $filename;
            }

            $produk = Produk::create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Produk created successfully',
                'data' => $produk
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create produk: ' . $e->getMessage()
            ], 400);
        }
    }

    public function sendDatatoEdit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('pages.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        try {
            $produk = Produk::findOrFail($id);

            $validatedData = $request->validate([
                'NamaProduk' => 'required|string|max:255',
                'Harga' => 'required|numeric',
                'Stok' => 'required|integer',
                'foto_produk' => 'nullable|image|max:2048',
            ]);

            // Handle file upload if present
            if ($request->hasFile('foto_produk')) {
                $file = $request->file('foto_produk');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/produk', $filename);
                $validatedData['foto_produk'] = $filename;
            }

            $produk->update($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Produk updated successfully',
                'data' => $produk
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update produk: ' . $e->getMessage()
            ], 404);
        }
    }
}
