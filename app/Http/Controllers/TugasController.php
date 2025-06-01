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


        try {
            // proses logic

            //FUNCTION UNTUK AMBIL MODEL
            // 1.Tugas delivery/pengantaran menuju customer
            $list_tugas_beli_berlangsung = Tugas::where('status', 'berlangsung')
                ->whereHas('nota_beli', function ($query) {
                    $query->where('status', 0);
                })
                ->with('nota_beli.barang')
                ->get();

            $list_tugas_beli = Tugas::where('status', 'belum_diambil')
                ->whereHas('nota_beli', function ($query) {
                    $query->where('status', 0);
                })
                ->with('nota_beli.barang')
                ->get();


            // 2. Tugas take/penjemputan barang menuju wirausaha
            $list_tugas_jual_berlangsung = Tugas::where('status', 'berlangsung')
                ->whereHas('nota_jual', function ($query) {
                    $query->where('status', 1);
                })
                ->with('nota_jual')
                ->get();

            $list_tugas_jual = Tugas::where('status', 'belum_diambil')
                ->whereHas('nota_jual', function ($query) {
                    $query->where('status', 1);
                })
                ->with('nota_jual')
                ->get();

            return view('driver.tugas', [
                'list_tugas_beli_berlangsung' => $list_tugas_beli_berlangsung,
                'list_tugas_beli' => $list_tugas_beli,
                'list_tugas_jual_berlangsung' => $list_tugas_jual_berlangsung,
                'list_tugas_jual' => $list_tugas_jual,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
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

    public function tugasSelesaiAntar($idTugas, Request $request)
    {
        Tugas::where('id', $idTugas)
            ->update(['status' => 'selesai']);
        NotaBeli::where('id', $request->notaBeliId)
            ->first()->setStatusPembayaran();
        return back();
    }
}
