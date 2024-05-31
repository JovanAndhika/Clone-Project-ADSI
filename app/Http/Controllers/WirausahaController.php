<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class WirausahaController extends Controller
{
    public function index()
    {
        // login as wirausaha
        auth()->guard('wirausaha')->loginUsingId(1);
        $wirausaha = auth()->guard('wirausaha')->user();
        $barang = $wirausaha->barang;
        $jenis = JenisBarang::all();
        return view('wirausaha.index', [
            'wirausaha' => $wirausaha,
            'barang' => $barang,
            'jenis' => $jenis
        ]);
        
    }
    
}
