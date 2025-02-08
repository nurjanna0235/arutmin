<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('admin.profil.index');
    }

    public function edit()
    {
        return view('admin.profil.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    }
}
