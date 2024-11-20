<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pit_clearing;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;

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
        // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ??0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ??0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);
        // Simpan ke database
        DB::table('pit_clearing')->insert([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'rate_actual' => $rate_actual,
            'contract_reference' => $request->contract_reference,
            'created_at' => now(),
            'updated_at' => now(),
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
