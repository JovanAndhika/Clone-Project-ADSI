<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NotaBeli;

class TugasController extends Controller
{
    public function test()
    {
        return view('test');
    }


    public function index()
    {
        // login as kurir
        auth()->guard('kurir')->loginUsingId(1);

        try {
            // proses logic

            // FUNCTION UNTUK AMBIL MODEL
            // 1.Tugas delivery/pengantaran menuju customer
            $list_tugas_beli_berlangsung = Tugas::with('nota_beli.barang')
                ->where('status', 'berlangsung')
                ->whereHas('nota_beli', function ($query) {
                    $query->where('status', 0);
                })
                ->get();


            $list_tugas_beli = Tugas::with('nota_beli.barang')
                ->where('status', 'belum_diambil')
                ->whereHas('nota_beli', fn($query) => $query->where('status', 0))
                ->get();




            // 2. Tugas take/penjemputan barang menuju wirausaha
            $listTugasJualBerlangsung = Tugas::with('nota_jual')
                ->where('status', 'berlangsung')
                ->whereHas(
                    'nota_jual',
                    fn($query) =>
                    $query->where('status', 1)
                )
                ->get();


            $listTugasJual = Tugas::with('nota_jual')
                ->where('status', 'belum_diambil')
                ->whereHas(
                    'nota_jual',
                    fn($query) =>
                    $query->where('status', 1)
                )
                ->get();


            return view('kurir.tugas', [
                'list_tugas_beli_berlangsung' => $list_tugas_beli_berlangsung,
                'list_tugas_beli' => $list_tugas_beli,
                'list_tugas_jual_berlangsung' => $listTugasJualBerlangsung,
                'list_tugas_jual' => $listTugasJual,
            ]);
            // return view('test');
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
