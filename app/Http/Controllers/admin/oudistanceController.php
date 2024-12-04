<?php

namespace App\Http\Controllers\admin;

use App\Models\oudistance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class oudistanceController extends Controller
{
    public function index()
    {
        $dokumenoudistance = oudistance::all();

        return view('rate-contract/asteng/oudistance/index', compact('dokumenoudistance'));
    }

    public function detail($id)
    {
        $dokumenoudistance = oudistance::where('id', $id)->get()->first();
        return view('rate-contract/asteng/oudistance/detail', compact('dokumenoudistance'));
    }
    public function tambah()
    {
        return view('rate-contract/asteng/oudistance/tambah');
    }
    public function simpan(Request $request)
    {
        $path = $request->file('contract_reference')->store('img', 'public');


        // $rate_actual= $request->base_rate * $request->currency_adjustment *  $request->premium_rate * $request->general_escalation;


        oudistance::create([
            'activity' => $request->activity,
            'item' => $request->item,
            'base_rate' => $request->base_rate,
            'actual_rate' => $request->actual_rate,
            'contractual_distance_km' => $request->contractual_distance_km,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'contract_reference' => $request->contract_reference,

        ]);
        $dokumenoudistance = oudistance::findOrFail($id);
        return redirect()->to('rate-contract/asteng/oudistance')->with('success', 'Rate contract berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dokumenoudistance = oudistance::where('id', $id)->get()->first();
        return view('rate-contract/asteng/oudistance/edit', compact('dokumenoudistance'));
    }
    

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            activity => 'required',
            item => 'required',
            base_rate => 'required',
            contractual_distance_km => 'required',
            currency_adjustment => 'required',
            premium_rate => 'required',
            general_escalation => 'required', 
        ]);
        $dokumenother = other::findOrFail($id);

        // Proses upload file jika ada file baru
        $path = $dokumenoudistance->contract_reference; // Gunakan file lama jika tidak ada file baru
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }
      // Proses data input
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;
        $contract_reference = str_replace(['%'], [''], $request->contract_reference ?? 0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;
        $contract_reference = (float) $contract_reference;

         // Simpan ke database
         $dokumenother->update([
            'activity' => $request->activity,
            'item' => $request->item,
            'base_rate' => $base_rate,
            'actual_rate' => $request->actual_rate,
            'contractual_distance_km' => $request->contractual_distance_km,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $premium_rate,
            'general_escalation' => $general_escalation,
            'contract_reference' => $path,
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asteng/oudistance')->with('success', 'Rate contract berhasil diupdate');
    }
    
    public function hapus($id)
    {
        $dokumenoudistance = oudistance::findOrFail($id);
        $dokumenoudistance->delete();

        return redirect()->to('rate-contract/asteng/oudistance');
    }
}
