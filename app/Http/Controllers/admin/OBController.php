<?php

namespace App\Http\Controllers\admin;
use App\Models\ob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OBController extends Controller
{
    public function index()
    {
        $dokumenob = ob::all();
       
        return view('dokumen/asteng/ob/index',compact('dokumenob'));
    }
    public function detail($id)
    {
            $dokumenob = ob::where('id',$id)->get()->first();
        return view('dokumen/asteng/ob/detail',compact('dokumenob'));
    }
}
