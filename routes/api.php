<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\penjualanController;
use App\Http\Controllers\StorageController;
use Illuminate\Container\Attributes\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('pelanggan')->group(function () {
    Route::get('/all', [PelangganController::class, 'index'])->name('pelanggan.all');
    Route::get('/images/{filename}', [StorageController::class, 'pelangganImage'])->name('pelanggan.gambar');
    Route::post('/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/delete/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
});

Route::prefix('produk')->group(function () {
    Route::get('/all', [produkController::class, 'index'])->name('produk.all');
    Route::get('/detail', function () { return view('pages.produk.detail'); })->name('produk.detail');
    Route::get('/images/{filename}', [StorageController::class, 'produkImage'])->name('produk.gambar');
    Route::post('/store', [produkController::class, 'store'])->name('produk.store');
    Route::put('/update/{id}', [produkController::class, 'update'])->name('produk.update');
    Route::delete('/delete/{id}', [produkController::class, 'destroy'])->name('produk.destroy');
});

Route::prefix('penjualan')->group(function () {
    Route::get('/', [PenjualanController::class, 'detailData'])->name('penjualan.all');
    // Route::get('/', function () { return view('pages.penjualan.tambah'); })->name('penjualan.all');
    // Route::get('/images/{filename}', [StorageController::class, 'penjualanImage'])->name('penjualan.gambar');
    // Route::post('/store', [PenjualanController::class, 'store'])->name('penjualan.store');
    // Route::put('/update/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');
    // Route::delete('/delete/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');
});

