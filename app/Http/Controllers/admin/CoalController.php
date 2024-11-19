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

        // Konversi input ke tipe data numerik
$clean_coal = (float) $request->clean_coal; // Data tambahan
$loading_and_ripping = (float) $request->loading_and_ripping;
$coal_hauling = (float) $request->coal_hauling;
$hrm = (float) $request->hrm;
$pit_support = (float) $request->pit_support;

// Hitung Sub Total Base Rate Coal (menambahkan $clean_coal di perhitungan)
$sub_total_base_rate_coal = $clean_coal // Ditambahkan ke Sub Total
    + $loading_and_ripping 
    + $coal_hauling 
    + $hrm 
    + $pit_support;

// Variabel tambahan
$currency_adjustment = (float) $request->currency_adjustment;
$premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
$general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal;

// Hitung Total Rate Coal Actual
$total_rate_coal_actual = $sub_total_base_rate_coal 
    * $currency_adjustment 
    * (1 + $premium_rate) 
    * (1 + $general_escalation);

// Simpan hasil ke database
coal::create([
    'clean_coal' => $clean_coal, // Data tambahan disimpan
    'loading_and_ripping' => $loading_and_ripping,
    'coal_hauling' => $coal_hauling,
    'hrm' => $hrm,
    'pit_support' => $pit_support,
    'sub_total_base_rate_coal' => $sub_total_base_rate_coal,
    'currency_adjustment' => $currency_adjustment,
    'premium_rate' => $request->premium_rate, // Tetap dalam persen untuk disimpan
    'general_escalation' => $request->general_escalation, // Tetap dalam persen untuk disimpan
    'total_rate_coal_actual' => $total_rate_coal_actual,
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
