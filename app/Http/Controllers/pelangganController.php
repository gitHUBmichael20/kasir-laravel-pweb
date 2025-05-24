<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    //

    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('pages.pelanggan.list', compact('pelanggans'));
    }

    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Pelanggan deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete pelanggan: ' . $e->getMessage()
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'NamaPelanggan' => 'required|string|max:255',
                'Alamat' => 'required|string|max:255',
                'NomorTelepon' => 'required|string|max:20',
                'foto_pelanggan' => 'nullable|image|max:2048',
            ]);

            $pelanggan = Pelanggan::create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Pelanggan created successfully',
                'data' => $pelanggan
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create pelanggan: ' . $e->getMessage()
            ], 400);
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
                'foto_pelanggan' => 'nullable|image|max:2048', // Optional, for image upload
            ]);

            $pelanggan->update($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Pelanggan updated successfully',
                'data' => $pelanggan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update pelanggan: ' . $e->getMessage()
            ], 404);
        }
    }
}
