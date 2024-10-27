<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PitClearingController extends Controller
{
    public function index()
    {

        return view('dokumen/asteng/pitclearing/index');
    }

    public function detail()
    {

        return view('dokumen/asteng/pitclearing/detail');
    }
}
