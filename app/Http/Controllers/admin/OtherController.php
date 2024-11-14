<?php

namespace App\Http\Controllers\admin;

use App\Models\other;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function index()
    {
        $dokumenother = other::all();

        return view('dokumen/asteng/other/index', compact('dokumenother'));
    }
    public function detail($id)
    {
        $dokumenother = other::where('id', $id)->get()->first();
        return view('dokumen/asteng/other/detail', compact('dokumenother'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/other/tambah');
    }
    public function simpan(Request $request)
    {
        // $rate_actual= $request->base_rate * $request->currency_adjustment *  $request->premium_rate * $request->general_escalation;


        other::create([
            'base_rate_hrm_lcm' => $request->base_rate_hrm_lcm,
            'currency_adjustment	' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'rate_actual_hrm_lcm' => $request->rate_actual_hrm_lcm,
            'contract_reference' => $request->contract_reference,
        ]);
        return redirect()->to('dokumen/asteng/other')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumenother = other::findOrFail($id);
        $dokumenother->delete();

        return redirect()->to('dokumen/asteng/other');
    }
}
