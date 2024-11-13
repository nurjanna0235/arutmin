<?php

namespace App\Http\Controllers\admin;
use App\Models\daywork;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Class DayworkController extends Controller
{
    public function index()
    {
        $dokumendaywork = daywork::all();
       
        return view('dokumen/asteng/daywork/index',compact('dokumendaywork'));
    }
public function detail($id)
    {
            $dokumendaywork = daywork::where('id',$id)->get()->first();
        return view('dokumen/asteng/daywork/detail',compact('dokumendaywork'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/daywork/tambah');
    }
}
