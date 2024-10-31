<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleRateController extends Controller
{
    public function index()
    {
        $dokumensingle_rate = single_rate::all();
       
        return view('dokumen/asteng/singlerate/index',compact('dokumensingle_rate'));
    }
}
