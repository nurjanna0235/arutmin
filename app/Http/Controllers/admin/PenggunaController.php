<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
       // $dokumenpit_clearing = pit_clearing::all();
       
        return view('admin/pengguna/index');
    }
}
