<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WirausahaController extends Controller
{
    public function index()
    {
        return view('wirausaha.index');
    }
}
