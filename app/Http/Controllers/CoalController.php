<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoalController extends Controller
{
    public function index()
    {
        $dokumencoal = coal::all();
       
        return view('dokumen/asteng/coal/index',compact('dokumencoal'));
    }
}
