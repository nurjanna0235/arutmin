<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\top_soil;
use App\Http\Controllers\Controller;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;


class TopSoilController extends Controller
{
    public function index()
    {
        $dokumentop_soil = top_soil::all();

        return view('dokumen/asteng/topsoil/index', compact('dokumentop_soil'));
    }
    public function detail($id)
    {
        $dokumentop_soil = top_soil::where('id', $id)->get()->first();
        return view('dokumen/asteng/topsoil/detail', compact('dokumentop_soil'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/topsoil/tambah');
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
            DB::table('top_soil')->insert([
                'base_rate' => $request->base_rate,
                'currency_adjustment' => $request->currency_adjustment,
                'premium_rate' => $request->premium_rate,
                'general_escalation' => $request->general_escalation,
                'rate_actual' => $rate_actual,
                'contract_reference' => $request->contract_reference,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        return redirect()->to('dokumen/asteng/top-soil')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumentop_soil = top_soil::findOrFail($id);
        $dokumentop_soil->delete();

        return redirect()->to('dokumen/asteng/top-soil');
    }
}
