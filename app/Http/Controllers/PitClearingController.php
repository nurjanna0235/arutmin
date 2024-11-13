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
    public function tambah()
    {
        return view('dokumen/asteng/pitclearing/tambah');
    }
    
        public function simpan(Request $request)
    {
       


    $rate_actual= $request->base_rate * $request->currency_adjustment *  $request->premium_rate * $request->general_escalation;
    dd($rate_actual);
    
        pit_clearing::create([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'rate_actual' => $request->rate_actual,
            'contract_reference' => $request-> contract_reference,
           
      
        ]);
        return redirect()->to('dokumen/asteng/pit-clearing')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id){
        $dokumenpit_clearing = pit_clearing::findOrFail($id);
        $dokumenpit_clearing->delete();

        return redirect()->to('dokumen/asteng/pit-clearing');
    }
    }
