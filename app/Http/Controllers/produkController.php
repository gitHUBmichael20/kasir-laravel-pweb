<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class produkController extends Controller
{
    //

    public function index()
    {
        $produks = produk::all();
        return view('pages.produk.list', compact('produks'));
    }

    public function show($id)
    {
        $produkDetail = Produk::findOrFail($id);
        return view('pages.produk.detail', compact('produkDetail'));
    }

    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $produk->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Produk deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete produk: ' . $e->getMessage()
            ], 404);
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
