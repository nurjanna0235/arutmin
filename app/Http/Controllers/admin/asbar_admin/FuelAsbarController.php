<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FuelAsbarController extends Controller
{
    public function index(Request $request)
    {
        return view('rate-contract/asbar/fuelasbar/index');
    }
    public function tambah()   
    {
        return view('rate-contract/asbar/fuelasbar/tambah');
    }
    public function simpan(Request $request)
    {
        return view('rate-contract/asbar/fuelasbar/simpan');
    }
    public function edit($id)
    {
        return view('rate-contract/asbar/fuelasbar/edit');
    }
    public function update(Request $request, $id)
    {
        return view('rate-contract/asbar/fuelasbar/update');
    }
    public function detail($id)
    {
        return view('rate-contract/asbar/fuelasbar/detail');
    }

    public function hapus($id)
    {
        return view('rate-contract/asbar/fuelasbar/delete');
    }
    
}
