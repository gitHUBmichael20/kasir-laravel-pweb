<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Detailpenjualan;

class produkController extends Controller
{


    public function index(Request $request)
    {
        $query = Produk::query();


        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('NamaProduk', 'like', '%' . $searchTerm . '%')
                ->orWhere('Harga', 'like', '%' . $searchTerm . '%');
                
        }

        $produks = $query->paginate(5);

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

    public function destroy(Request $request, $id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $produk->delete();


            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produk berhasil dihapus!'
                ], 200);
            }


            Session::flash('success', 'Produk berhasil dihapus!');
            return redirect()->route('produk.all');
        } catch (\Exception $e) {

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menghapus produk: ' . $e->getMessage()
                ], 400);
            }


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
                'foto_produk' => 'nullable|image|max:102400',
            ]);

            $filename = uniqid() . time() . '.' . $request->file('foto_produk')->getClientOriginalExtension();
            if ($request->hasFile('foto_produk')) {
                $file = $request->file('foto_produk');
                $file->storeAs('public/produk', $filename);
                $validatedData['foto_produk'] = $filename;
            }

            $produk = Produk::create($validatedData);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produk berhasil ditambahkan!',
                    'data' => $produk
                ], 201);
            }

            Session::flash('success', 'Produk berhasil ditambahkan!');
            return redirect()->route('produk.all');
        } catch (\Exception $e) {

            if (isset($filename) && Storage::disk('public')->exists('produk/' . $filename)) {
                Storage::disk('public')->delete('produk/' . $filename);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menambahkan produk: ' . $e->getMessage()
                ], 400);
            }


            Session::flash('error', 'Gagal menambahkan produk: ' . $e->getMessage());
            return redirect()->route('produk.all');
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
                'foto_produk' => 'nullable|image|max:10240',
            ]);

            $filename = $produk->foto_produk;

            if ($request->hasFile('foto_produk')) {
                // Delete old image if exists
                if ($produk->foto_produk && Storage::disk('public')->exists('produk/' . $produk->foto_produk)) {
                    Storage::disk('public')->delete('produk/' . $produk->foto_produk);
                }

                $file = $request->file('foto_produk');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/produk', $filename);
                $validatedData['foto_produk'] = $filename;
            } else {
                // If no new file uploaded, keep the existing filename
                if (!$request->has('foto_produk') || $request->input('foto_produk') === null) {
                    unset($validatedData['foto_produk']);
                }
            }

            $produk->update($validatedData);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produk berhasil diperbarui!',
                    'data' => $produk
                ], 200);
            }

            Session::flash('success', 'Produk berhasil diperbarui!');
            return redirect()->route('produk.all');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal!',
                    'errors' => $e->errors()
                ], 422);
            }

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Clean up uploaded file if it exists and operation failed
            if (isset($filename) && $filename !== $produk->getOriginal('foto_produk') && Storage::disk('public')->exists('produk/' . $filename)) {
                Storage::disk('public')->delete('produk/' . $filename);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal memperbarui produk: ' . $e->getMessage()
                ], 500);
            }

            Session::flash('error', 'Gagal memperbarui produk: ' . $e->getMessage());
            return redirect()->route('produk.all');
        }
    }
}
