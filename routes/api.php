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
    Route::get('/tambah', function () { return view('pages.pelanggan.tambah'); })->name('pelanggan.tambah');
    Route::get('/images/{filename}', [StorageController::class, 'pelangganImage'])->name('pelanggan.gambar');
    Route::get('/detail/{id}', [PelangganController::class, 'showPelanggan'])->name('pelanggan.detail');
    Route::get('/edit-pelanggan/{id}', [pelangganController::class, 'sendDatatoEdit'])->name('pelanggan.edit');
    Route::post('/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/delete/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.delete');
});

Route::prefix('produk')->group(function () {
    Route::get('/all', [produkController::class, 'index'])->name('produk.all');
    Route::get('/tambah', function () { return view('pages.produk.tambah'); })->name('produk.tambah');
    Route::get('/detail/{id}', [produkController::class, 'showProduct'])->name('produk.detail');
    Route::get('/images/{filename}', [StorageController::class, 'produkImage'])->name('produk.gambar');
    Route::get('/edit-product/{id}', [produkController::class, 'sendDatatoEdit'])->name('produk.edit');
    Route::post('/store', [produkController::class, 'store'])->name('produk.store');
    Route::put('/update/{id}', [produkController::class, 'update'])->name('produk.update');
    Route::delete('/delete/{id}', [produkController::class, 'destroy'])->name('produk.delete');
});

Route::prefix('penjualan')->group(function () {
    Route::get('/', [PenjualanController::class, 'detailData'])->name('penjualan.all');
    Route::post('/store', [PenjualanController::class, 'store'])->name('penjualan.store');
});

