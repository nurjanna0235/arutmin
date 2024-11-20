<?php

namespace App\Http\Controllers\admin;

use App\Models\ob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;

class OBController extends Controller
{
    public function index()
    {
        $dokumenob = ob::all();

        return view('dokumen/asteng/ob/index', compact('dokumenob'));
    }
    public function detail($id)
    {
        $dokumenob = ob::where('id', $id)->get()->first();
        return view('dokumen/asteng/ob/detail', compact('dokumenob'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/ob/tambah');
    }

    public function simpan(Request $request)
{
    // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
    $load_and_haul = str_replace([','], ['.'], $request->load_and_haul);
    $drill_and_blast = str_replace([','], ['.'], $request->drill_and_blast ?? 0);
    $pit_support = str_replace([','], ['.'], $request->pit_support);
    $pit_lighting = str_replace([','], ['.'], $request->pit_lighting);
    $hrm = str_replace([','], ['.'], $request->hrm);
    $dump_maintenance = str_replace([','], ['.'], $request->dump_maintenance);
    $dewatering_sediment = str_replace([','], ['.'], $request->dewatering_sediment);
    $sr = str_replace([','], ['.'], $request->sr);
    $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
    $premium_rate = str_replace(['%'], [''], $request->premium_rate) / 100;
    $general_escalation = str_replace(['%'], [''], $request->general_escalation) / 100;

    // Konversi menjadi float untuk perhitungan
    $load_and_haul = (float) $load_and_haul;
    $drill_and_blast = (float) $drill_and_blast;
    $pit_support = (float) $pit_support;
    $pit_lighting = (float) $pit_lighting;
    $hrm = (float) $hrm;
    $dump_maintenance = (float) $dump_maintenance;
    $dewatering_sediment = (float) $dewatering_sediment;
    $sr = (float) $sr;
    $currency_adjustment = (float) $currency_adjustment;

    // Hitung Base Rate
    $base_rate = $load_and_haul + $drill_and_blast + $pit_support + $pit_lighting + $hrm + $dump_maintenance + $dewatering_sediment;

    // Hitung Rate Actual sesuai rumus
    $rate_actual = $base_rate * $sr * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

    // Simpan ke database
    DB::table('ob')->insert([
        'load_and_haul' => $request->load_and_haul,
        'drill_and_blast' => $request->drill_and_blast,
        'pit_support' => $request->pit_support,
        'pit_lighting' => $request->pit_lighting,
        'hrm' => $request->hrm,
        'dump_maintenance' => $request->dump_maintenance,
        'dewatering_sediment' => $request->dewatering_sediment,
        'sub_total_base_rate_ob' => $request->base_rate,
        'sr' => $request->sr,
        'currency_adjustment' => $request->currency_adjustment,
        'premium_rate' => $request->premium_rate,
        'general_escalation' => $request->general_escalation,
        'total_rate_ob_actual' => $rate_actual,
        'contract_reference' => $request->contract_reference,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

        return redirect()->to('dokumen/asteng/ob')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumenob = ob::findOrFail($id);
        $dokumenob->delete();

        return redirect()->to('dokumen/asteng/ob');
    }
}
