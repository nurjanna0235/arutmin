<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    function tampil() {
        return view('akun.tampil');
    }
}
