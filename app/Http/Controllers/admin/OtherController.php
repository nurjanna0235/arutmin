<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\other;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;

class OtherController extends Controller
{
    public function index()
    {
        $dokumenother = other::all();

        return view('dokumen/asteng/other/index', compact('dokumenother'));
    }
    public function detail($id)
    {
        $dokumenother = other::where('id', $id)->get()->first();
        return view('dokumen/asteng/other/detail', compact('dokumenother'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/other/tambah');
    }
    public function simpan(Request $request)
    {
            // Ganti koma dengan titik pada inputan untuk keperluan perhitungan
            $base_rate = str_replace([','], ['.'], $request->base_rate);
            $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
            $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
            $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;
        
            // Konversi menjadi float untuk perhitungan
            $base_rate = (float) $base_rate;
            $currency_adjustment = (float) $currency_adjustment;
            $premium_rate = (float) $premium_rate;
            $general_escalation = (float) $general_escalation;
        
            // Hitung Rate Actual sesuai rumus
            $rate_actual = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);
        
            // Simpan data ke dalam database
            DB::table('other')->insert([
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
            return redirect()->to('dokumen/asteng/other')->with('success', 'Dokumen berhasil ditambahkan');
        }
    public function hapus($id)
    {
        $dokumenother = other::findOrFail($id);
        $dokumenother->delete();

        return redirect()->to('dokumen/asteng/other');
    }
}
