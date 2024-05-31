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
        $barang = auth()->guard('wirausaha')->user()->barang();
        $jenis = JenisBarang::all();
        return view('wirausaha.index', [
            'barang' => $barang,
            'jenis' => $jenis
        ]);
        
    }
    
}
