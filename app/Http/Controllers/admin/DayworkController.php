<?php

namespace App\Http\Controllers\admin;

use App\Models\daywork;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DayworkController extends Controller
{
    public function index()
    {
        $dokumendaywork = daywork::all();
        dd($dokumendaywork);

        return view('dokumen/asteng/daywork/index', compact('dokumendaywork'));
    }
    public function detail($id)
    {
        $dokumendaywork = daywork::where('id', $id)->get()->first();
        return view('dokumen/asteng/daywork/detail', compact('dokumendaywork'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/daywork/tambah');
    }
    public function simpan(Request $request)
    {



        // $rate_actual= $request->base_rate * $request->currency_adjustment *  $request->premium_rate * $request->general_escalation;


        daywork::create([
            'item' => $request->item,
            'base_rate_exc_fuel' => $request->base_rate_exc_fuel,
            'actual_rate_exc_fuel' => $request->actual_rate_exc_fuel,
            'fbr' => $request->fbr,
        ]);
        return redirect()->to('dokumen/asteng/daywork')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumensdaywork = daywork::findOrFail($id);
        $dokumensdaywork->delete();

        return redirect()->to('dokumen/asteng/daywork');
    }
}
