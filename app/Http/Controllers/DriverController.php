<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(){
        // login as driver
        auth()->guard('driver')->loginUsingId(1);
        return view('Driver.tugas');
    }
}
