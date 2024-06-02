<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotaJualController;
use App\Http\Controllers\NotaBeliController;
use App\Http\Controllers\WirausahaController;
use App\Models\NotaJual;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Customer
Route::group(['as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('history', [CustomerController::class, 'history'])->name('history');
    Route::resource('beli', NotaBeliController::class)->only(['index', 'create', 'store']);
    Route::resource('jual', NotaJualController::class)->only(['index', 'create', 'store']);
});

// Driver
Route::get('/driver', [TugasController::class, 'index']);
Route::post('/driver/ambilTugas/{idTugas}', [TugasController::class, 'ambilTugas'])->name('ambilTugas');
Route::post('/driver/tugasSelesai/{idTugas}', [TugasController::class, 'tugasSelesai'])->name('tugasSelesai');


// Wirausaha
Route::group(['prefix' => 'wirausaha', 'as' => 'wirausaha.'], function () {
    Route::get('/', [BarangController::class, 'lihatBarang'])->name('index');
    Route::post('add', [BarangController::class, 'tambahBarang'])->name('add');
    Route::post('update', [BarangController::class, 'editBarang'])->name('update');
    Route::delete('delete', [BarangController::class, 'hapusBarang'])->name('delete');
    Route::get('offer', [NotaJualController::class, 'indexAdmin'])->name('offer');
    Route::post('offer/konfirmasiHarga', [NotaJualController::class, 'konfirmasiHarga'])->name('offer.konfirmasiHarga');

    // Route::resource('/', BarangController::class)->only(['index', 'create', 'delete', 'update']);
});

// Route::get('wirausaha', [WirausahaController::class, 'index']);
// Route::group(['prefix' => 'wirausaha', 'as' => 'wirausaha.'], function(){
//     Route::get('/', [WirausahaController::class, 'index'])->name('index');
    
// });