<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WirausahaController extends Controller
{
    public function index()
    {
        // login as wirausaha
        auth()->loginUsingId(3);
        return view('wirausaha.index');
    }
}
