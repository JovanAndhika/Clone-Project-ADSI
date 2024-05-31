<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TugasController extends Controller
{
    public function index(){
        // login as driver
        auth()->guard('driver')->loginUsingId(1);
        $list_tugas_beli = Tugas::with('notabeli')->where('status', 'belum_diambil')->get();
        // $list_tugas_jual = Tugas::with('notajual')->where('status', 'belum diambil')->get();
        return view('driver.tugas', ['list_tugas_beli' => $list_tugas_beli]);
    }
}
