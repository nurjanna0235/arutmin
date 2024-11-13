<?php

namespace App\Http\Controllers\admin;
use App\Models\single_rate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleRateController extends Controller
{
    public function index()
    {
        $dokumensingle_rate = single_rate::all();
       
        return view('dokumen/asteng/singlerate/index',compact('dokumensingle_rate'));
    }
    public function detail($id)
{
        $dokumensingle_rate = single_rate::where('id',$id)->get()->first();
    return view('dokumen/asteng/singlerate/detail',compact('dokumensingle_rate'));
}
public function tambah()
{
    return view('dokumen/asteng/singlerate/tambah');
}
}
