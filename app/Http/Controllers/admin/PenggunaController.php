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

        return view('admin/pengguna/index', compact('pengguna'));
    }
    public function tambah()
    {
        return view('admin/pengguna/tambah');
    }

    public function simpan(Request $request)
    {
        pengguna::create([
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'level' => $request->level,
            'password' => $request->password,
        ]);
        return redirect()->to('admin/pengguna');
        // $pengguna = pengguna::all();

        //  return view('admin/pengguna/simpan');

    }

    public function edit($id)
    {
        $dataPengguna = pengguna::findOrFail($id);
        return view('admin/pengguna/edit', compact('dataPengguna'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'username' => 'required|string|max:255',
        //     'nik' => 'required|string|max:20',
        //     'email' => 'required|email|max:255',
        //     'password' => 'nullable|string|min:8', // null berarti password tidak perlu diubah jika kosong
        //     'no_hp' => 'required|string',
        //     'level' => 'required|integer',
        // ]);

        $dataPengguna = pengguna::findOrFail($id);

        $dataPengguna->update([
            'username' => $request->username,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $dataPengguna->password,
            'no_hp' => $request->no_hp,
            'level' => $request->level,
        ]);

        return redirect()->to('admin/pengguna');
    }

    public function delete($id)
    {
        $dataPengguna = pengguna::findOrFail($id);
        $dataPengguna->delete();

        return redirect()->to('admin/pengguna');
    }
};
