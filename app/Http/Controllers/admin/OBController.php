<?php

namespace App\Http\Controllers\admin;

use App\Models\ob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class OBController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = ob::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenob = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = ob::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/asteng/ob/index', compact('dokumenob', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumenob = ob::where('id', $id)->get()->first();

        return view('rate-contract/asteng/ob/detail', compact('dokumenob'));
    }

    public function tambah()
    {
        return view('rate-contract/asteng/ob/tambah');
    }

    public function simpan(Request $request)
    {
        $path = $request->file('contract_reference')->store('img', 'public');

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
        $ob->contract_reference = $path; // Data tambahan
        $ob->save();

        // Redirect atau tampilkan view dengan pesan sukses
        return redirect()->to('rate-contract/asteng/ob')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dokumenob = ob::where('id', $id)->get()->first();

        return view('rate-contract/asteng/ob/edit', compact('dokumenob'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'load_and_haul' => 'nullable',
            'drill_and_blast' => 'nullable',
            'pit_support' => 'nullable',
            'pit_lighting' => 'nullable',
            'hrm' => 'nullable',
            'dump_maintenance' => 'nullable',
            'dewatering_sediment' => 'nullable',
            'sub_total_base_rate_ob' => 'nullable',
            'sr' => 'nullable',
            'currency_adjustment' => 'nullable',
            'premium_rate' => 'nullable',
            'total_rate_ob_actual' => 'nullable',
            'contract_reference' => 'nullable',
            
            // 'contract_reference' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('ob')->where('id', $id)->first();

        // Perhitungan subtotal dan total
        $load_and_haul = $request->load_and_haul ?? $dokumen->load_and_haul;
        $drill_and_blast = $request->drill_and_blast ?? $dokumen->drill_and_blast;
        $pit_support = $request->pit_support ?? $dokumen->pit_support;
        $pit_lighting = $request->pit_lighting ?? $dokumen->pit_lighting;
        $hrm = $request->hrm ?? $dokumen->hrm;
        $dump_maintenance = $request->dump_maintenance ?? $dokumen->dump_maintenance;
        $dewatering_sediment = $request->dewatering_sediment ?? $dokumen->dewatering_sediment;
        $sub_total_base_rate_ob = $load_and_haul + $drill_and_blast + $pit_support + $pit_lighting + $hrm + $dump_maintenance + $dewatering_sediment;
        $sr = $request->sr ?? $dokumen->sr;
        $currency_adjustment = $request->currency_adjustment ?? $dokumen->currency_adjustment;
 
        $premium_rate = $request->premium_rate ?? $dokumen->premium_rate;
        $general_escalation = $request->general_escalation ?? $dokumen->general_escalation;
        $total_rate_ob_actual = $sub_total_base_rate_ob * $sr * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Proses upload file jika ada file baru
        $path = $dokumen->contract_reference; // Gunakan file lama jika tidak ada file baru
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }

        // Proses data input
        $dokumenob = ob::findOrFail($id);
        $dokumenob->load_and_haul = $load_and_haul;
        $dokumenob->drill_and_blast = $drill_and_blast;
        $dokumenob->pit_support = $pit_support;
        $dokumenob->pit_lighting = $pit_lighting;
        $dokumenob->hrm = $hrm;
        $dokumenob->dump_maintenance = $dump_maintenance;
        $dokumenob->dewatering_sediment = $dewatering_sediment;
        $dokumenob->sub_total_base_rate_ob = $sub_total_base_rate_ob;
        $dokumenob->sr = $sr;
        $dokumenob->currency_adjustment = $currency_adjustment;
        $dokumenob->premium_rate = $premium_rate;
        $dokumenob->general_escalation = $general_escalation;
        $dokumenob->total_rate_ob_actual = $total_rate_ob_actual;
        $dokumenob->contract_reference = $path; // Data tambahan
        $dokumenob->save();

        // Redirect atau tampilkan view dengan pesan sukses
        return redirect()->to('rate-contract/asteng/ob')->with('success', 'Data berhasil diupdate');
    }
    public function hapus($id)
    {
        $dokumenob = ob::findOrFail($id);
        $dokumenob->delete();

        return redirect()->to('rate-contract/asteng/ob');
    }
}
