<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // login as customer
        auth()->guard('customer')->loginUsingId(1);
        $nota = auth()->guard('customer')->user()->notaBeli()->get();
        $notaJual = auth()->guard('customer')->user()->notajual()->get();

        return view('customer.index', [
            'notaBeli' => $nota,
            'notaJual' => $notaJual,
        ]);
    }
}
