<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NotaBeli;

class TugasController extends Controller
{
    public function index()
    {
        // login as driver
        auth()->guard('driver')->loginUsingId(1);

        //FUNCTION UNTUK AMBIL MODEL
        // 1.Tugas delivery/pengantaran menuju customer
        $list_tugas_beli_berlangsung = Tugas::where('status', 'berlangsung')
            ->whereHas('notabeli', function ($query) {
                $query->where('status', 0);
            })
            ->with('notabeli.barang')
            ->get();

        $list_tugas_beli = Tugas::where('status', 'belum_diambil')
            ->whereHas('notabeli', function ($query) {
                $query->where('status', 0);
            })
            ->with('notabeli.barang')
            ->get();


        // 2. Tugas take/penjemputan barang menuju wirausaha
        $list_tugas_jual_berlangsung = Tugas::where('status', 'berlangsung')
            ->whereHas('notajual', function ($query) {
                $query->where('status', 1);
            })
            ->with('notajual')
            ->get();
            
        $list_tugas_jual = Tugas::where('status', 'belum_diambil')
            ->whereHas('notajual', function ($query) {
                $query->where('status', 1);
            })
            ->with('notajual')
            ->get();



        return view('driver.tugas', [
            'list_tugas_beli_berlangsung' => $list_tugas_beli_berlangsung,
            'list_tugas_beli' => $list_tugas_beli,
            'list_tugas_jual_berlangsung' => $list_tugas_jual_berlangsung,
            'list_tugas_jual' => $list_tugas_jual,
        ]);
    }

    public function ambilTugas($idTugas)
    {
        Tugas::where('id', $idTugas)
            ->update(['status' => 'berlangsung']);
        return back();
    }

    public function tugasSelesai($idTugas, Request $request)
    {
        Tugas::where('id', $idTugas)
            ->update(['status' => 'selesai']);
        NotaBeli::where('id', $request->notaBeliId)
            ->update(['status' => 1]);
        return back();
    }
}
