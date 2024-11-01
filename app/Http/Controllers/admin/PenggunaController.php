<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pengguna;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = pengguna::all();
       
        return view('admin/pengguna/index',compact('pengguna'));
    }
    public function tambah()
    {
       // $pengguna = pengguna::all();
       
        return view('admin/pengguna/tambah');
    }
}

