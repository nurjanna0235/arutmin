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

        return view('dokumen/asteng/ob/index', compact('dokumenob'));
    }
    public function detail($id)
    {
        $dokumenob = ob::where('id', $id)->get()->first();
        return view('dokumen/asteng/ob/detail', compact('dokumenob'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/ob/tambah');
    }

    public function simpan(Request $request)
    {
     // Konversi input ke tipe data numerik
$load_and_haul = (float) $request->load_and_haul;
$drill_and_blast = (float) $request->drill_and_blast;
$pit_support = (float) $request->pit_support;
$pit_lighting = (float) $request->pit_lighting;
$hrm = (float) $request->hrm;
$dump_maintenance = (float) $request->dump_maintenance;
$dewatering_sediment = (float) $request->dewatering_sediment;

// Hitung Sub Total Base Rate OB
$sub_total_base_rate_ob = $load_and_haul 
    + $drill_and_blast 
    + $pit_support 
    + $pit_lighting 
    + $hrm 
    + $dump_maintenance 
    + $dewatering_sediment;

// Variabel tambahan
$sr = (float) $request->sr;
$currency_adjustment = (float) $request->currency_adjustment;
$premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
$general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal;

// Hitung Total Rate OB Actual
$total_rate_ob_actual = $sub_total_base_rate_ob 
    * $sr 
    * $currency_adjustment 
    * (1 + $premium_rate) 
    * (1 + $general_escalation);

// Simpan hasil ke database
ob::create([
    'load_and_haul' => $load_and_haul,
    'drill_and_blast' => $drill_and_blast,
    'pit_support' => $pit_support,
    'pit_lighting' => $pit_lighting,
    'hrm' => $hrm,
    'dump_maintenance' => $dump_maintenance,
    'dewatering_sediment' => $dewatering_sediment,
    'sub_total_base_rate_ob' => $sub_total_base_rate_ob,
    'sr' => $sr,
    'currency_adjustment' => $currency_adjustment,
    'premium_rate' => $request->premium_rate, // Tetap dalam persen untuk disimpan
    'general_escalation' => $request->general_escalation, // Tetap dalam persen untuk disimpan
    'total_rate_ob_actual' => $total_rate_ob_actual,
    'contract_reference' => $request->contract_reference,
]);
        return redirect()->to('dokumen/asteng/ob')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumenob = ob::findOrFail($id);
        $dokumenob->delete();

        return redirect()->to('dokumen/asteng/ob');
    }
}
