<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pengguna;

class ProfilController extends Controller{
   
    public function index()
    {
        $pengguna = pengguna::where('id', session('id'))->first();
        return view('admin.profil.index',compact('pengguna'));
    }

    public function edit()
    {
        return view('admin.profil.edit');
    }

    public function update(Request $request)
    {
        $pengguna = pengguna::where('id', session('id'))->first();

        $pengguna->update([
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
        ]);

        return redirect()->to('admin/profile');
    }
}
