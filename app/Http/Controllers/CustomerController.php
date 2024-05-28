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

        return view('customer.index', [
            'notaBeli' => $nota,
        ]);
    }
}
