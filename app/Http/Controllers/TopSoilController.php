<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\top_soil;
class TopSoilController extends Controller
{
    public function index()
    {
        $dokumentop_soil = top_soil::all();
       
        return view('dokumen/asteng/topsoil/index',compact('dokumentop_soil'));
    }

    public function detail($id)
    {
            $dokumentop_soil = top_soil::where('id',$id)->get()->first();
        return view('dokumen/asteng/topsoil/detail',compact('dokumentop_soil'));
    }
}
