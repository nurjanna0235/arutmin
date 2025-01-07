<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DayworkAsbarController extends Controller
{
    public function index(Request $request)
    {
        return view('rate-contract/asbar/dayworkasbar/index');
    }
    public function tambah()
    {
        return view('rate-contract/asbar/dayworkasbar/tambah');
    }
    public function simpan(Request $request)
    {
        return view('rate-contract/asbar/dayworkasbar/simpan');
    }
    public function detail($id)
    {
        return view('rate-contract/asbar/dayworkasbar/detail');
    }
    public function update(Request $request, $id)
    {
        return view('rate-contract/asbar/dayworkasbar/update');
    }
    public function edit($id)   
    {
        return view('rate-contract/asbar/dayworkasbar/edit');
    }
    public function hapus($id)
    {
        return view('rate-contract/asbar/dayworkasbar/delete');
    }
}
