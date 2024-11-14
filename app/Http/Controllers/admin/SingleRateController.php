<?php

namespace App\Http\Controllers\admin;

use App\Models\single_rate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SingleRateController extends Controller
{
    public function index()
    {
        $dokumensingle_rate = single_rate::all();

        return view('dokumen/asteng/singlerate/index', compact('dokumensingle_rate'));
    }
    public function detail($id)
    {
        $dokumensingle_rate = single_rate::where('id', $id)->get()->first();
        return view('dokumen/asteng/singlerate/detail', compact('dokumensingle_rate'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/singlerate/tambah');
    }
    public function simpan(Request $request)
    {



        // $rate_actual= $request->base_rate * $request->currency_adjustment *  $request->premium_rate * $request->general_escalation;


        single_rate::create([
            'total_base_rate_ob' => $request->total_base_rate_ob,
            'total_base_rate_coal' => $request->total_base_rate_coal,
            'sr' => $request->sr,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'total_single_rate_actual' => $request->total_single_rate_actual,
            'contract_reference' => $request->contract_reference,


        ]);
        return redirect()->to('dokumen/asteng/single-rate')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumensingle_rate = single_rate::findOrFail($id);
        $dokumensingle_rate->delete();

        return redirect()->to('dokumen/asteng/single-rate');
    }
}
