<?php

namespace App\Http\Controllers\admin;
use App\Models\coal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoalController extends Controller
{
        public function index()
        {
            $dokumencoal = coal::all();
           
            return view('dokumen/asteng/coal/index',compact('dokumencoal'));
        }
        public function detail($id)
    {
            $dokumencoal = coal::where('id',$id)->get()->first();
        return view('dokumen/asteng/coal/detail',compact('dokumencoal'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/coal/tambah');
    }
}
