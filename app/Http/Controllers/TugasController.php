<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TugasController extends Controller
{
    public function index()
    {
        // login as driver
        auth()->guard('driver')->loginUsingId(1);

        //Function ambil model
        $list_tugas_berlangsung = Tugas::where('status', 'berlangsung')->get();
        $list_tugas_beli = Tugas::where('status', 'belum_diambil')->with('notabeli.barang')->get();
        // $list_tugas_jual = Tugas::where('status', 'belum diambil')->get();

        return view('driver.tugas', [
            'list_tugas_beli' => $list_tugas_beli,
            'list_tugas_berlangsung' => $list_tugas_berlangsung,
        ]);
    }

    public function ambilTugas()
    {
        
    }
}
