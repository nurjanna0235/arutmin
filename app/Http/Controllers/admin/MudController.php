<?php

namespace App\Http\Controllers\admin;
use App\Models\mud;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MudController extends Controller
{
    public function index()
    {
        $dokumenmud = mud::all();
       
        return view('dokumen/asteng/mud/index',compact('dokumenmud'));
    }
    public function detail($id)
    {
            $dokumenmud = mud::where('id',$id)->get()->first();
        return view('dokumen/asteng/mud/detail',compact('dokumenmud'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/mud/tambah');
    }
    public function simpan(Request $request)
    {
       


   // $rate_actual= $request->base_rate * $request->currency_adjustment *  $request->premium_rate * $request->general_escalation;
  
    
        mud::create([
            'mud_removal_load_and_haul' => $request->mud_removal_load_and_haul,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'rate_actual' => $request->rate_actual,
            'contract_reference' => $request-> contract_reference,
      
        ]);
        return redirect()->to('dokumen/asteng/mud')->with('success', 'Dokumen berhasil ditambahkan');
}
public function hapus($id){
    $dokumenmud = mud::findOrFail($id);
    $dokumenmud->delete();

    return redirect()->to('dokumen/asteng/mud');
}
}
