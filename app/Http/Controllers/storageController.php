<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}