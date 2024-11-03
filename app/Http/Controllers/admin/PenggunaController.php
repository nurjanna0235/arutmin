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

    public function simpan(Request $request)
    {
    pengguna::create([
'username'=> $request->username,
'nik'=> $request->nik,
'email'=> $request->email,
'alamat'=> $request->alamat,
'no_hp'=> $request->no_hp,
'level'=> $request->level,
'password'=> $request->password,
    ]);
    return redirect()->to('admin/pengguna');
        // $pengguna = pengguna::all();
        
       //  return view('admin/pengguna/simpan');
     
    }
};
