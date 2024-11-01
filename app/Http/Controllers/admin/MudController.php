<?php

namespace App\Http\Controllers\admin;
use App\Models\mud;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MudController extends Controller
{
    public function index()
    {
        $dokumentop_soil = mud::all();
       
        return view('dokumen/asteng/mud/index',compact('dokumenmud'));
    }
    public function detail($id)
    {
            $dokumenpit_clearing = top_soil::where('id',$id)->get()->first();
        return view('dokumen/asteng/mud/detail',compact('dokumenmud'));
    }
}
