<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function index(){
        // login as driver
        auth()->guard('driver')->loginUsingId(1);
        $list_tugas = Tugas::where('status', 'belum_diambil')->get();

        return view('driver.tugas', ['list_tugas' => $list_tugas]);
    }
}
