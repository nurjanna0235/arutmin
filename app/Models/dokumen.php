<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dokumen extends Model
{
    public function up()
{
    Schema::create('dokumen', function (Blueprint $table) {
        $table->id();
        $table->string('nama_dokumen');
        $table->string('path');
        $table->timestamps();
    });
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'no_hp' => 'nullable',
        'alamat' => 'nullable',
        'nik' => 'nullable',
        'level' => 'required',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
        'nik' => $request->nik,
        'level' => $request->level,
    ]);

    return redirect()->route('penggunas.index')->with('success', 'Pengguna berhasil ditambahkan');
}

}
