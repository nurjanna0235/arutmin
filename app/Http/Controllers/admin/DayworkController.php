<?php

namespace App\Http\Controllers\admin;

use App\Models\daywork;
use App\Models\value;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayworkController extends Controller
{
    public function index()
    {
        $dokumendaywork = daywork::join('item','item.id_item','=','daywork.id_item')->join('value','value.id_item','=','item.id_item')->get();

        return view('rate-contract/asteng/daywork/index', compact('dokumendaywork'));
    }
/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/******  c2050109-2648-44df-9e55-77319239632e  *******/    public function detail($id)
    {
        $dokumendaywork = daywork::where('id', $id)->get()->first();
        return view('rate-contract/asteng/daywork/detail', compact('dokumendaywork'));
    }
    public function tambah()
    {
        $item = DB::table('item')->get();
        return view('rate-contract/asteng/daywork/tambah', compact('item'));
    }

    public function edit($id)
    {
        $dokumendaywork = daywork::where('id', $id)->get()->first();
        return view('rate-contract/asteng/daywork/edit', compact('dokumendaywork'));
    }

    public function update(Request $request, $id)
    {
        $path = $request->file('contract_reference')->store('img', 'public');
        $dokumen_daywork = daywork::where('id', $id)->get()->first(); // Ambil data sebelumnya

        // Konversi input ke tipe numerik
        $base_rate_exc_fuel = floatval(str_replace(',', '.', $request->base_rate_exc_fuel));
        $actual_rate_exc_fuel = floatval(str_replace(',', '.', $request->actual_rate_exc_fuel));
        $fbr = floatval(str_replace(',', '.', $request->fbr));

        // Hitung Actual Rate Exc. Fuel (Rp/Hrs)
        $actual_rate_exc_fuel = $base_rate_exc_fuel * $fbr;

        // Simpan ke database
        $dokumen_daywork->base_rate_exc_fuel = $base_rate_exc_fuel;
        $dokumen_daywork->actual_rate_exc_fuel = $actual_rate_exc_fuel;
        $dokumen_daywork->fbr = $fbr;
        $dokumen_daywork->save();

        return redirect()->to('rate-contract/asteng/daywork')->with('success', 'Data berhasil diupdate');
    }

    public function simpan(Request $request)
    {
        $path = $request->file('contract_reference')->store('img', 'public');

        // Konversi input ke tipe data numerik
        $base_rate_exc_fuel = (float) $request->base_rate_exc_fuel;
        $actual_rate_exc_fuel = (float) $request->actual_rate_exc_fuel;
        $fbr = (float) $request->fbr;
        $currency_adjustment = (float) $request->currency_adjustment;
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

        // Perhitungan rate_actual
        $actual_rate_exc_fuel = $base_rate_exc_fuel * $fbr;

        // Simpan data ke tabel daywork
        daywork::create([
            'item' => $request->item,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
            'contract_reference' => $path,
        ]);

        value::create([
            'base_rate_exc_fuel' => $base_rate_exc_fuel,
            'actual_rate_exc_fuel' => $actual_rate_exc_fuel,
            'fbr' => $actual_rate_exc_fuel,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
            'contract_reference' => $path,
        ]);

        return redirect()->to('rate-contract/asteng/daywork')->with('success', 'Data berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumensdaywork = daywork::findOrFail($id);
        $dokumensdaywork->delete();

        return redirect()->to('rate-contract/asteng/daywork');
    }
}
