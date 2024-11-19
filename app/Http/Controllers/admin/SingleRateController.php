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
// Konversi input ke tipe data numerik
$total_base_rate_ob = (float) $request->total_base_rate_ob;
$total_base_rate_coal = (float) $request->total_base_rate_coal;
$sr = (float) $request->sr;
$currency_adjustment = (float) $request->currency_adjustment;
$premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
$general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

// Perhitungan total_single_rate_actual
$total_single_rate_actual = ($total_base_rate_ob + $total_base_rate_coal)
    * $sr
    * $currency_adjustment
    * (1 + $premium_rate)
    * (1 + $general_escalation);

// Simpan data ke tabel single_rate
single_rate::create([
    'total_base_rate_ob' => $total_base_rate_ob,
    'total_base_rate_coal' => $total_base_rate_coal,
    'sr' => $sr,
    'currency_adjustment' => $currency_adjustment,
    'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
    'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
    'total_single_rate_actual' => $total_single_rate_actual,
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
