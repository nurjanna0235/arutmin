<?php

namespace App\Http\Controllers\admin;

use App\Models\mud;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MudController extends Controller
{
    public function index()
    {
        $dokumenmud = mud::all();

        return view('rate-contract/asteng/mud/index', compact('dokumenmud'));
    }
    public function detail($id)
    {
        $dokumenmud = mud::where('id', $id)->get()->first();
        return view('rate-contract/asteng/mud/detail', compact('dokumenmud'));
    }
    public function tambah()
    {
        return view('rate-contract/asteng/mud/tambah');
    }
    public function simpan(Request $request)
    {
        $path = $request->file('contract_reference')->store('img', 'public');

        // Konversi input ke tipe data numerik
        $mud_removal_load_and_haul = (float) $request->mud_removal_load_and_haul;
        $currency_adjustment = (float) $request->currency_adjustment;
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

        // Perhitungan rate_actual
        $rate_actual = $mud_removal_load_and_haul
            * $currency_adjustment
            * (1 + $premium_rate)
            * (1 + $general_escalation);

        // Simpan data ke tabel mud
        mud::create([
            'mud_removal_load_and_haul' => $mud_removal_load_and_haul,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
        ]);

        return redirect()->to('rate-contract/asteng/mud')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $dokumenmud = mud::findOrFail($id);
        return view('rate-contract/asteng/mud/edit', compact('dokumenmud'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'mud_removal_load_and_haul' => 'required|numeric',
            'currency_adjustment' => 'required|numeric',
            'premium_rate' => 'required|numeric',
            'general_escalation' => 'required|numeric',
        ]);

        // Konversi input ke tipe data numerik
        $mud_removal_load_and_haul = (float) $request->mud_removal_load_and_haul;
        $currency_adjustment = (float) $request->currency_adjustment;
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

        // Perhitungan rate_actual
        $rate_actual = $mud_removal_load_and_haul
            * $currency_adjustment
            * (1 + $premium_rate)
            * (1 + $general_escalation);        
        $dokumenmud = mud::findOrFail($id);
        $dokumenmud->mud_removal_load_and_haul = $mud_removal_load_and_haul;
        $dokumenmud->currency_adjustment = $currency_adjustment;
        $dokumenmud->premium_rate = $request->premium_rate; // Nilai asli dalam persen
        $dokumenmud->general_escalation = $request->general_escalation; // Nilai asli dalam persen
        $dokumenmud->rate_actual = $rate_actual;
        $dokumenmud->save();

        return redirect()->to('rate-contract/asteng/mud')->with('success', 'Data berhasil diperbarui');
    }
    public function hapus($id)
    {
        $dokumenmud = mud::findOrFail($id);
        $dokumenmud->delete();

        return redirect()->to('rate-contract/asteng/mud');
    }
}
