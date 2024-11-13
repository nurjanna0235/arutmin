<?php

namespace App\Http\Controllers\admin;
use App\Models\other;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function index()
    {
        $dokumenother = other::all();
       
        return view('dokumen/asteng/other/index',compact('dokumenother'));
    }
    public function detail($id)
    {
            $dokumenother = other::where('id',$id)->get()->first();
        return view('dokumen/asteng/other/detail',compact('dokumenother'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/other/tambah');
    }
}
