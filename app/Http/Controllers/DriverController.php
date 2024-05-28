<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(){
        // login as driver
        auth()->loginUsingId(2);
        return view('Driver.tugas');
    }
}
