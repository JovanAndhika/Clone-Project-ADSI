<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CustomerController;
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

Route::get('/', function () {
    return view('welcome');
});

// Customer
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::resource('beli', NotaBeliController::class)->only(['index', 'create', 'store']);
});

// Driver
Route::get('driver', [DriverController::class, 'index']);

// Wirausaha
Route::group(['prefix' => 'wirausaha', 'as' => 'wirausaha.'], function () {
    Route::get('/', [BarangController::class, 'lihatBarang'])->name('index');
    Route::post('add', [BarangController::class, 'tambahBarang'])->name('add');
    Route::post('update', [BarangController::class, 'editBarang'])->name('update');
    Route::delete('delete', [BarangController::class, 'hapusBarang'])->name('delete');

    // Route::resource('/', BarangController::class)->only(['index', 'create', 'delete', 'update']);
});

// Route::get('wirausaha', [WirausahaController::class, 'index']);