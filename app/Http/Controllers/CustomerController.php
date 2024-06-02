<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // login as customer
        auth()->guard('customer')->loginUsingId(1);
        $notaBeli = auth()->guard('customer')->user()->notaBeli()->with(['barang', 'tugas'])->get();
        $notaJual = auth()->guard('customer')->user()->notajual()->with('tugas')->get();
        
        // remove nota yang sudah selesai
        foreach ($notaBeli as $key => $value) {
            if ($value->tugas && $value->tugas->status == 'selesai') {
            unset($notaBeli[$key]);
            }
        }
        foreach ($notaJual as $key => $value) {
            if ($value->tugas && $value->tugas->status == 'selesai') {
            unset($notaJual[$key]);
            }
        }
        
        return view('customer.index', [
            'notaBeli' => $notaBeli,
            'notaJual' => $notaJual,
        ]);
    }

    public function history()
    {
        $nota = auth()->guard('customer')->user()->notaBeli()->with(['barang', 'tugas'])->get();
        $notaJual = auth()->guard('customer')->user()->notajual()->get();
        return view('customer.history', [
            'notaBeli' => $nota,
            'notaJual' => $notaJual,
        ]);
    }
}
