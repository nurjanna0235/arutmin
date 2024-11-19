<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pit_clearing;
use Generator;
use PhpParser\Node\Expr\Cast\Double;

class PitClearingController extends Controller
{

    public function index()
    {
        $dokumenpit_clearing = pit_clearing::all();
        return view('dokumen/asteng/pitclearing/index', compact('dokumenpit_clearing'));
    }

    public function detail($id)
    {
        $dokumenpit_clearing = pit_clearing::where('id', $id)->get()->first();

        return view('dokumen/asteng/pitclearing/detail', compact('dokumenpit_clearing'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/pitclearing/tambah');
    }

    public function simpan(Request $request)
    {
        $base_rate = (double) $request->base_rate;
        $currency_adjustment = (double) $request->currency_adjustment;
        $premium_rate = (double) $request->premium_rate;
        $general_escalation = (Double) $request->general_escalation;

        // Perhitungan rate_actual
        if($general_escalation == 0.0){
            $rate_actual = $base_rate
            * $currency_adjustment
            * $premium_rate;
        }else if($premium_rate == 0.0){
            $rate_actual = $base_rate
            * $currency_adjustment
            * $general_escalation;
        }else if($currency_adjustment == 0.0){
            $rate_actual = $base_rate
            * $premium_rate
            * $general_escalation;
        }else if($base_rate == 0.0){
            $rate_actual =  $currency_adjustment
            * $premium_rate
            * $general_escalation;
        } else {
            $rate_actual = $base_rate
            * $currency_adjustment
            * $premium_rate
            * $general_escalation;
        }

        // Simpan data ke tabel pit_clearing
        pit_clearing::create([
            'base_rate' => $base_rate,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $general_escalation,
            'rate_actual' => $rate_actual,
            'contract_reference' => $request->contract_reference,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('dokumen/asteng/pit-clearing')->with('success', 'Dokumen berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumenpit_clearing = pit_clearing::findOrFail($id);
        $dokumenpit_clearing->delete();

        return redirect()->to('dokumen/asteng/pit-clearing');
    }
}
