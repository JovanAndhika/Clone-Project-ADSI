<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // login as customer
        auth()->loginUsingId(1);
        return view('customer.index');
    }
}
