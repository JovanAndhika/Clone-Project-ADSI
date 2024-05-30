<?php

use App\Http\Controllers\NotaBeliController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CustomerController;
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
Route::get('/customer', [CustomerController::class, 'index']);
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::resource('beli', NotaBeliController::class)->only(['index', 'create', 'store']);
});

// Driver
Route::get('/driver', [DriverController::class, 'index']);

// Wirausaha
Route::get('/wirausaha', [WirausahaController::class, 'index']);