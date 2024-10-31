<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ob;
class OBController extends Controller

{
    public function index()
    {
        $dokumenob = ob::all();
       
        return view('dokumen/asteng/ob/index',compact('dokumenob'));
    }
}

