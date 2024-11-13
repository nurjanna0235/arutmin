<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fuel;
class FuelController extends Controller
{
    public function index()
    {
        $dokumenfuel = fuel::all();
       
        return view('dokumen/asteng/fuel/index',compact('dokumenfuel'));
    }
    public function detail($id)
    {
            $dokumenfuel = fuel::where('id',$id)->get()->first();
        return view('dokumen/asteng/fuel/detail',compact('dokumenfuel'));
    }
    public function tambah()
{
    return view('dokumen/asteng/fuel/tambah');
}
}