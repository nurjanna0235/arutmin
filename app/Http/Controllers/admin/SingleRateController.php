<?php

namespace App\Http\Controllers\admin;

use App\Models\single_rate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;

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
 // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
 $base_rate_ob = str_replace([','], ['.'], $request->base_rate_ob); // Total Base Rate OB (Rp/BCM)
 $base_rate_coal = str_replace([','], ['.'], $request->base_rate_coal); // Total Base Rate Coal (Rp/ton)
 $sr = str_replace([','], ['.'], $request->sr); // SR (Stripping Ratio)
 $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment); // Currency Adjustment
 $premium_rate = str_replace(['%'], [''], $request->premium_rate) / 100; // Premium Rate (%)
 $general_escalation = str_replace(['%'], [''], $request->general_escalation) / 100; // General Escalation (%)

 // Konversi menjadi float untuk perhitungan
 $base_rate_ob = (float) $base_rate_ob;
 $base_rate_coal = (float) $base_rate_coal;
 $sr = (float) $sr;
 $currency_adjustment = (float) $currency_adjustment;
 $premium_rate = (float) $premium_rate;
 $general_escalation = (float) $general_escalation;

 // Hitung Rate Actual sesuai rumus
 $rate_actual = ($base_rate_ob * $sr + $base_rate_coal) * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

 // Simpan ke database
 DB::table('singlerate')->insert([
     'base_rate_ob' => $request->base_rate_ob,
     'base_rate_coal' => $request->base_rate_coal,
     'sr' => $request->sr,
     'currency_adjustment' => $request->currency_adjustment,
     'premium_rate' => $request->premium_rate,
     'general_escalation' => $request->general_escalation,
     'rate_actual' => $rate_actual,
     'contract_reference' => $request->contract_reference,
     'created_at' => now(),
     'updated_at' => now(),
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
