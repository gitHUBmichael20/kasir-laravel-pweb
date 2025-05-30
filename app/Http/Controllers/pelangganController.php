<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;
use App\Models\Detailpenjualan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Pelanggan::query();
        
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('NamaPelanggan', 'like', '%' . $searchTerm . '%')
                ->orWhere('Alamat', 'like', '%' . $searchTerm . '%')
                ->orWhere('NomorTelepon', 'like', '%' . $searchTerm . '%');
        }
        
        $pelanggans = $query->paginate(5);
        
        return view('pages.pelanggan.list', compact('pelanggans'));
    }

    public function showPelanggan($id)
    {
        $pelangganDetail = Pelanggan::findOrFail($id);
        $transaksiPelanggan = Detailpenjualan::query()
            ->select(
                'detailpenjualan.PenjualanID',
                'penjualan.TanggalPenjualan',
                'penjualan.TotalHarga',
                DB::raw('SUM(detailpenjualan.JumlahProduk) AS total_jumlah_produk_dari_detail'), // Ganti Jumlahpelanggan jadi JumlahProduk
                DB::raw('SUM(detailpenjualan.Subtotal) AS total_subtotal_dari_detail')
            )
            ->join('penjualan', 'detailpenjualan.PenjualanID', '=', 'penjualan.PenjualanID')
            ->where('penjualan.PelangganID', $id)
            ->groupBy(
                'detailpenjualan.PenjualanID',
                'penjualan.TanggalPenjualan',
                'penjualan.TotalHarga'
            )
            ->simplePaginate(5);

        return view('pages.pelanggan.detail', compact('pelangganDetail', 'transaksiPelanggan'));
    }

    public function destroy(Request $request, $id)
    {
        try {
            $pelanggan = pelanggan::findOrFail($id);
            $pelanggan->delete();


            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'pelanggan berhasil dihapus!'
                ], 200);
            }


            Session::flash('success', 'pelanggan berhasil dihapus!');
            return redirect()->route('pelanggan.all');
        } catch (\Exception $e) {

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menghapus pelanggan: ' . $e->getMessage()
                ], 400);
            }


            Session::flash('error', 'Gagal menghapus pelanggan: ' . $e->getMessage());
            return redirect()->route('pelanggan.all');
        }
    }

    public function sendDatatoEdit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pages.pelanggan.edit', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'NamaPelanggan' => 'required|string|max:255',
                'Alamat' => 'required|string|max:255',
                'NomorTelepon' => 'required|string|max:20',
                'foto_pelanggan' => 'nullable|image|max:10240',
            ]);

            $filename = null;
            if ($request->hasFile('foto_pelanggan')) {
                $file = $request->file('foto_pelanggan');
                $filename = uniqid() . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/pelanggan', $filename);
                $validatedData['foto_pelanggan'] = $filename;
            }

            $pelanggan = pelanggan::create($validatedData);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'pelanggan berhasil ditambahkan!',
                    'data' => $pelanggan
                ], 201);
            }

            Session::flash('success', 'pelanggan berhasil ditambahkan!');
            return redirect()->route('pelanggan.all');
        } catch (\Exception $e) {

            if (isset($filename) && Storage::disk('public')->exists('pelanggan/' . $filename)) {
                Storage::disk('public')->delete('pelanggan/' . $filename);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menambahkan pelanggan: ' . $e->getMessage()
                ], 400);
            }


            Session::flash('error', 'Gagal menambahkan pelanggan: ' . $e->getMessage());
            return redirect()->route('pelanggan.all');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);

            $validatedData = $request->validate([
                'NamaPelanggan' => 'required|string|max:255',
                'Alamat' => 'required|string|max:255',
                'NomorTelepon' => 'required|string|max:20',
                'foto_pelanggan' => 'nullable|image|max:10240',
            ]);

            $filename = $pelanggan->foto_pelanggan;

            if ($request->hasFile('foto_pelanggan')) {
                // Delete old image if exists
                if ($pelanggan->foto_pelanggan && Storage::disk('public')->exists('pelanggan/' . $pelanggan->foto_pelanggan)) {
                    Storage::disk('public')->delete('pelanggan/' . $pelanggan->foto_pelanggan);
                }

                $file = $request->file('foto_pelanggan');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/pelanggan', $filename);
                $validatedData['foto_pelanggan'] = $filename;
            } else {
                // If no new file uploaded, keep the existing filename
                if (!$request->has('foto_pelanggan') || $request->input('foto_pelanggan') === null) {
                    unset($validatedData['foto_pelanggan']);
                }
            }

            $pelanggan->update($validatedData);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Pelanggan berhasil diperbarui!',
                    'data' => $pelanggan
                ], 200);
            }

            Session::flash('success', 'Pelanggan berhasil diperbarui!');
            return redirect()->route('pelanggan.all');
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
            if (isset($filename) && $filename !== $pelanggan->getOriginal('foto_pelanggan') && Storage::disk('public')->exists('pelanggan/' . $filename)) {
                Storage::disk('public')->delete('pelanggan/' . $filename);
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal memperbarui pelanggan: ' . $e->getMessage()
                ], 500);
            }

            Session::flash('error', 'Gagal memperbarui pelanggan: ' . $e->getMessage());
            return redirect()->route('pelanggan.all');
        }
    }
}
