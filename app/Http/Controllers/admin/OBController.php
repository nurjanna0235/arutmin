<?php

namespace App\Http\Controllers\admin;

use App\Models\ob;
use App\Http\Controllers\Controller;
use App\Models\pit_clearing;
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
        // Pastikan inputan dikonversi ke float
        $load_and_haul = (float) str_replace(',', '.', $request->load_and_haul);
        $drill_and_blast = (float) str_replace(',', '.', $request->drill_and_blast);
        $pit_support = (float) str_replace(',', '.', $request->pit_support);
        $pit_lighting = (float) str_replace(',', '.', $request->pit_lighting);
        $hrm = (float) str_replace(',', '.', $request->hrm);
        $dump_maintenance = (float) str_replace(',', '.', $request->dump_maintenance);
        $dewatering_sediment = (float) str_replace(',', '.', $request->dewatering_sediment);
        $sr = (float) str_replace(',', '.', $request->sr);
        $currency_adjustment = (float) str_replace(',', '.', $request->currency_adjustment);
        $premium_rate = (float) str_replace(',', '.', $request->premium_rate) / 100;
        $general_escalation = (float) str_replace(',', '.', $request->general_escalation) / 100;

        // Perhitungan subtotal dan total
        $sub_total_base_rate_ob = $load_and_haul + $drill_and_blast + $pit_support + $pit_lighting + $hrm + $dump_maintenance + $dewatering_sediment;
        $total_rate_ob_actual = $sub_total_base_rate_ob * $sr * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Simpan data ke database
        $ob = new ob();
        $ob->load_and_haul = $load_and_haul;
        $ob->drill_and_blast = $drill_and_blast;
        $ob->pit_support = $pit_support;
        $ob->pit_lighting = $pit_lighting;
        $ob->hrm = $hrm;
        $ob->dump_maintenance = $dump_maintenance;
        $ob->dewatering_sediment = $dewatering_sediment;
        $ob->sub_total_base_rate_ob = $sub_total_base_rate_ob;
        $ob->sr = $sr;
        $ob->currency_adjustment = $currency_adjustment;
        $ob->premium_rate = $premium_rate;
        $ob->general_escalation = $general_escalation;
        $ob->total_rate_ob_actual = $total_rate_ob_actual;
        $ob->contract_reference = $request->contract_reference; // Data tambahan
        $ob->save();

        // Redirect atau tampilkan view dengan pesan sukses
        return redirect()->to('dokumen/asteng/ob')->with('success', 'Dokumen berhasil ditambahkan');
    }

public function hapus($id)
    {
        $dokumenob = ob::findOrFail($id);
        $dokumenob->delete();

        return redirect()->to('dokumen/asteng/ob');
    }
}
