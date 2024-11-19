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
       // Konversi input ke tipe data numerik
$base_rate_hrm_lcm = (float) $request->base_rate_hrm_lcm;
$currency_adjustment = (float) $request->currency_adjustment;
$premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
$general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

// Perhitungan rate_actual_hrm_lcm
$rate_actual_hrm_lcm = $base_rate_hrm_lcm
    * $currency_adjustment
    * (1 + $premium_rate)
    * (1 + $general_escalation);

// Simpan ke database
other::create([
    'base_rate_hrm_lcm' => $base_rate_hrm_lcm,
    'currency_adjustment' => $currency_adjustment,
    'premium_rate' => $request->premium_rate, // Tetap simpan dalam persen
    'general_escalation' => $request->general_escalation, // Tetap simpan dalam persen
    'rate_actual_hrm_lcm' => $rate_actual_hrm_lcm,
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
