<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HaulRoadMaintenancePLTUController extends Controller
{
    public function index(Request $request)
    {
        return view('rate-contract/asbar/haul-road-maintenance-pltu/index');
    }
    public function tambah()
    {
        return view('rate-contract/asbar/haul-road-maintenance-pltu/tambah');
    }   
    public function simpan(Request $request)
    {
        return view('rate-contract/asbar/haul-road-maintenance-pltu/simpan');
    }
    public function detail($id)
    {
        return view('rate-contract/asbar/haul-road-maintenance-pltu/detail');
    }
    public function edit($id)
    {
        return view('rate-contract/asbar/haul-road-maintenance-pltu/edit');
    }
    public function update(Request $request, $id)
    {
        return view('rate-contract/asbar/haul-road-maintenance-pltu/update');
    }
    public function hapus($id)
    {
        return view('rate-contract/asbar/haul-road-maintenance-pltu/delete');
    }

}
