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

        //FUNCTION UNTUK AMBIL MODEL
        // 1.Tugas delivery/pengantaran menuju customer
        $list_tugas_berlangsung = Tugas::where('status', 'berlangsung')->with('notabeli.barang')->get();
        $list_tugas_beli = Tugas::where('status', 'belum_diambil')->with('notabeli.barang')->get();

        // 2. Tugas take/penjemputan barang menuju wirausaha
        // $list_tugas_jual = Tugas::where('status', 'belum diambil')->get();


        return view('driver.tugas', [
            'list_tugas_berlangsung' => $list_tugas_berlangsung,
            'list_tugas_beli' => $list_tugas_beli,
        ]);
    }

    public function ambilTugas($idTugas)
    {
        Tugas::where('id', $idTugas)
            ->update(['status' => 'berlangsung']);
        return back();
    }

    public function tugasSelesai($idTugas)
    {
        Tugas::where('id', $idTugas)
            ->update(['status' => 'selesai']);
            return back();
    }
}
