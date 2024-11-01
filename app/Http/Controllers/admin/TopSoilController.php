<?php

namespace App\Http\Controllers\admin;
use App\Models\top_soil;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopSoilController extends Controller
{
    public function index()
    {
        $dokumentop_soil = top_soil::all();
       
        return view('dokumen/asteng/topsoil/index',compact('dokumentop_soil'));
    }
    public function detail($id)
    {
            $dokumenpit_clearing = top_soil::where('id',$id)->get()->first();
        return view('dokumen/asteng/topsoil/detail',compact('dokumentop_soil'));
    }
}
