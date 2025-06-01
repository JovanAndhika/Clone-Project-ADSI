<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotaJualController;
use App\Http\Controllers\NotaBeliController;
use App\Http\Controllers\WirausahaController;

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

Route::get('/test', [TugasController::class, 'test']);

// Customer
Route::group(['as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('history', [CustomerController::class, 'history'])->name('history');
    Route::resource('beli', NotaBeliController::class)->only(['index', 'create', 'store']);
    // Route::post('/beli/create', [NotaBeliController::class, 'create'])->name('beli.create');
    Route::resource('jual', NotaJualController::class)->only(['index', 'create', 'store']);
});

// Driver
Route::get('/kurir', [TugasController::class, 'index'])->name('kurir.index');
Route::post('/kurir/ambilTugas/{idTugas}', [TugasController::class, 'ambilTugas'])->name('ambilTugas');
Route::post('/kurir/tugasSelesai/{idTugas}', [TugasController::class, 'tugasSelesai'])->name('tugasSelesai');
Route::post('/kurir/tugasSelesaiAntar/{idTugas}', [TugasController::class, 'tugasSelesaiAntar'])->name('tugasSelesaiAntar');


// Wirausaha
Route::group(['prefix' => 'wirausaha', 'as' => 'wirausaha.'], function () {
    Route::get('/', [WirausahaController::class, 'index'])->name('index');
    
    Route::get('barang', [BarangController::class, 'lihatBarang'])->name('barang');
    Route::post('barang/add', [BarangController::class, 'tambahBarang'])->name('add');
    Route::post('barang/update', [BarangController::class, 'editBarang'])->name('update');
    Route::delete('barang/delete', [BarangController::class, 'hapusBarang'])->name('delete');
    Route::get('offer', [NotaJualController::class, 'indexAdmin'])->name('offer');
    Route::post('offer/konfirmasiHarga', [NotaJualController::class, 'konfirmasiHarga'])->name('offer.konfirmasiHarga');

    // Route::resource('/', BarangController::class)->only(['index', 'create', 'delete', 'update']);
});

// Route::get('wirausaha', [WirausahaController::class, 'index']);
// Route::group(['prefix' => 'wirausaha', 'as' => 'wirausaha.'], function(){
//     Route::get('/', [WirausahaController::class, 'index'])->name('index');
    
// });