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

        return view('dokumen/asteng/oudistance/index', compact('dokumenoudistance'));
    }

    public function detail($id)
    {
        $dokumenoudistance = oudistance::where('id', $id)->get()->first();
        return view('dokumen/asteng/oudistance/detail', compact('dokumenoudistance'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/oudistance/tambah');
    }
    public function simpan(Request $request)
    {



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
        return redirect()->to('dokumen/asteng/oudistance')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumenoudistance = oudistance::findOrFail($id);
        $dokumenoudistance->delete();

        return redirect()->to('dokumen/asteng/oudistance');
    }
}
