<?php

namespace App\Http\Controllers\admin;

use App\Models\coal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoalController extends Controller
{
    public function index()
    {
        $dokumencoal = coal::all();

        return view('dokumen/asteng/coal/index', compact('dokumencoal'));
    }
    public function detail($id)
    {
        $dokumencoal = coal::where('id', $id)->get()->first();
        return view('dokumen/asteng/coal/detail', compact('dokumencoal'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/coal/tambah');
    }
    public function simpan(Request $request)
    {
        // $rate_actual= $request->base_rate * $request->currency_adjustment *  $request->premium_rate * $request->general_escalation;


        coal::create([
            'clean_coal' => $request->clean_coal,
            'loading_and_ripping' => $request->loading_and_ripping,
            'coal_hauling' => $request->premium_rate,
            'hrm' => $request->hrm,
            'rate_actual' => $request->rate_actual,
            'pit_support' => $request->pit_support,
            'sub_total_base_rate_coal' => $request->sub_total_base_rate_coal,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'total_rate_coal_actual' => $request->total_rate_coal_actual,
            'contract_reference' => $request->contract_reference,


        ]);
        return redirect()->to('dokumen/asteng/coal')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumencoal = coal::findOrFail($id);
        $dokumencoal->delete();

        return redirect()->to('dokumen/asteng/coal');
    }
}
