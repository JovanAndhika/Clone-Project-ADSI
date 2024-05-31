<?php

use App\Http\Controllers\NotaBeliController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NotaJualController;
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

Route::get('/', function () {
    return view('welcome');
});

// Customer
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::resource('beli', NotaBeliController::class)->only(['index', 'create', 'store']);
    Route::resource('jual', NotaJualController::class)->only(['index', 'create', 'store']);
});

// Driver
Route::get('driver', [DriverController::class, 'index']);

// Wirausaha
Route::group(['prefix' => 'wirausaha', 'as' => 'wirausaha.'], function(){
    Route::get('/', [WirausahaController::class, 'index'])->name('index');
    Route::get('offer', [NotaJualController::class, 'indexAdmin'])->name('offer');
    Route::post('offer/konfirmasiHarga', [NotaJualController::class, 'konfirmasiHarga'])->name('offer.konfirmasiHarga');
});