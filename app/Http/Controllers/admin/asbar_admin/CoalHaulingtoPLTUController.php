<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoalHaulingtoPLTUController extends Controller
{
    public function index(Request $request)
    {
        return view('rate-contract/asbar/coal-hauling/index');
    }

    public function tambah()
    {
        return view('rate-contract/asbar/coal-hauling/tambah');
    }

    public function detail($id)
    {
        return view('rate-contract/asbar/coal-hauling/detail');
    }
    public function edit($id) 
    {  
        return view('rate-contract/asbar/coal-hauling/edit');
    }
    public function simpan(Request $request)
    {
        return view('rate-contract/asbar/coal-hauling/simpan');
    }
    public function update(Request $request, $id)
    {
        return view('rate-contract/asbar/coal-hauling/update');
    }
    public function hapus($id)
    {
        return view('rate-contract/asbar/coal-hauling/delete');
    }
};

     
