<?php

namespace App\Http\Controllers\admin;
use App\Models\oudistance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class oudistanceController extends Controller
{
    public function index()
    {
        $dokumenoudistance = oudistance::all();
       
        return view('dokumen/asteng/oudistance/index',compact('dokumenoudistance'));
    }

    public function detail($id)
    {
            $dokumenoudistance = oudistance::where('id',$id)->get()->first();
        return view('dokumen/asteng/oudistance/detail',compact('dokumenoudistance'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/oudistance/tambah');
    }
}

