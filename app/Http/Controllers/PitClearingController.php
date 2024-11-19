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
        // Pastikan nilai yang diterima adalah float sebelum diformat
        $base_rate = number_format((float)$request->base_rate, 2, '.', '');
        $currency_adjustment = number_format((float)$request->currency_adjustment, 2, '.', '');
        $premium_rate = number_format((float)$request->premium_rate, 2, '.', '');
        $general_escalation = number_format((float)$request->general_escalation, 2, '.', '');
        $rate_actual = number_format((float)$request->rate_actual, 2, '.', '');  // Pastikan format 2 angka desimal

        // Simpan data ke tabel pit_clearing
        pit_clearing::create([
            'base_rate' => $base_rate,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $premium_rate,
            'general_escalation' => $general_escalation,
            'rate_actual' => $rate_actual,  // Simpan hasil yang sudah dihitung
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
