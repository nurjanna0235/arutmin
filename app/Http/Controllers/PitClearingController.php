<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pit_clearing;
class PitClearingController extends Controller
{
    public function index()
    {
        $dokumenpit_clearing = pit_clearing::all();
       
        return view('dokumen/asteng/pitclearing/index',compact('dokumenpit_clearing'));
    }

    public function detail($id)
    {
            $dokumenpit_clearing = pit_clearing::where('id',$id)->get()->first();
        return view('dokumen/asteng/pitclearing/detail',compact('dokumenpit_clearing'));
    }
}
