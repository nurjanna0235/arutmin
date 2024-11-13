<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Models\top_soil;
use App\Http\Controllers\Controller;


class TopSoilController extends Controller
{
    public function index()
    {
        $dokumentop_soil = top_soil::all();
       
        return view('dokumen/asteng/topsoil/index',compact('dokumentop_soil'));
    }
    public function detail($id)
    {
            $dokumentop_soil = top_soil::where('id',$id)->get()->first();
        return view('dokumen/asteng/topsoil/detail',compact('dokumentop_soil'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/topsoil/tambah');
    }
    public function simpan(Request $request)
    {
        top_soil::create([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'contract_reference' => $request->contract_reference,
            
      
        ]);
    }
    public function hapus($id){
        $dokumentop_soil = top_soil::findOrFail($id);
        $dokumentop_soil->delete();

        return redirect()->to('dokumen/asteng/top-soil');
    }
    };