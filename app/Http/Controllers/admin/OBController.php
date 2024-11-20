<?php

namespace App\Http\Controllers\admin;

use App\Models\ob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        // Pastikan nilai inputan berbentuk float dengan mengganti koma dengan titik
        $load_and_haul = str_replace([','], ['.'], $request->load_and_haul); // Ganti koma dengan titik
        $drill_and_blast = str_replace([','], ['.'], $request->drill_and_blast); // Ganti koma dengan titik
        $pit_support = str_replace([','], ['.'], $request->pit_support); // Ganti koma dengan titik
        $pit_lighting = str_replace([','], ['.'], $request->pit_lighting); // Ganti koma dengan titik
        $hrm = str_replace([','], ['.'], $request->hrm); // Ganti koma dengan titik
        $dump_maintenance = str_replace([','], ['.'], $request->dump_maintenance); // Ganti koma dengan titik
        $dewatering_sediment = str_replace([','], ['.'], $request->dewatering_sediment); // Ganti koma dengan titik
        $sr = str_replace([','], ['.'], $request->sr); // Ganti koma dengan titik
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment); // Ganti koma dengan titik
        $premium_rate = str_replace([','], ['.'], $request->premium_rate); // Ganti koma dengan titik
        $general_escalation = str_replace([','], ['.'], $request->general_escalation); // Ganti koma dengan titik

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
        $premium_rate = (float) $premium_rate / 100; // Pastikan Premium Rate dalam bentuk desimal
        $general_escalation = (float) $general_escalation / 100; // Pastikan General Escalation dalam bentuk desimal

        // Debugging: Cek nilai inputan
        Log::info("Load and Haul: {$load_and_haul}");
        Log::info("Drill and Blast: {$drill_and_blast}");
        Log::info("Pit Support: {$pit_support}");
        Log::info("Pit Lighting: {$pit_lighting}");
        Log::info("HRM: {$hrm}");
        Log::info("Dump Maintenance: {$dump_maintenance}");
        Log::info("Dewatering Sediment: {$dewatering_sediment}");
        Log::info("SR: {$sr}");
        Log::info("Currency Adjustment: {$currency_adjustment}");
        Log::info("Premium Rate: {$premium_rate}");
        Log::info("General Escalation: {$general_escalation}");

        // Hitung Base Rate
        $base_rate = $load_and_haul + $drill_and_blast + $pit_support + $pit_lighting + $hrm + $dump_maintenance + $dewatering_sediment;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $sr * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Debugging: Cek hasil perhitungan sebelum format
        Log::info("Rate Actual before formatting: {$rate_actual}");

        // Format hasil perhitungan ke dalam dua angka desimal dengan koma sebagai pemisah desimal
        $formatted_rate_actual = number_format($rate_actual, 2, ',', '.');

        // Debugging: Cek hasil setelah format
        Log::info("Formatted Rate Actual: {$formatted_rate_actual}");

        // Simpan data ke database atau lakukan hal lain sesuai kebutuhan
        return redirect()->to('dokumen/asteng/ob')->with('success', 'Dokumen berhasil ditambahkan');
    }

public function hapus($id)
    {
        $dokumenob = ob::findOrFail($id);
        $dokumenob->delete();

        return redirect()->to('dokumen/asteng/ob');
    }
}
