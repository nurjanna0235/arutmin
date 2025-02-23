<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pengguna;

class ProfilUserController extends Controller
{
    public function index()
    {
        $pengguna = pengguna::where('id', session('id'))->first();
        return view('user.profil.index',compact('pengguna'));
    }

    public function edit()
    {
        return view('user.profil.edit');
    }

    public function update(Request $request)
    {
        $pengguna = pengguna::where('id', session('id'))->first();

        $pengguna->update([
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
        ]);

        return redirect()->to('user/profile');
    }
}
