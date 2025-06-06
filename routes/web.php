<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\penjualanController;
use App\Http\Controllers\StorageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('pages.dashboard');
// });

Route::get('/', [StorageController::class, 'index'])->name('pages.dashboard');

Route::get('/penjualan/struk-belanja/{id}', [PenjualanController::class, 'showReceipt'])->name('penjualan.receipt.pdf');


