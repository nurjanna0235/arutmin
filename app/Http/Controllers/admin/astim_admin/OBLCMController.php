<?php

namespace App\Http\Controllers\admin\astim_admin;

use App\Models\ob_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class OBLCMController extends Controller
{

    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown
    
        // Query dasar untuk mengambil data
        $query = ob_lcm::query();
    
        // Filter berdasarkan rentang tahun jika tahun awal dan tahun akhir diberikan
        if ($tahunAwal && $tahunAkhir) {
            $query->whereYear('created_at', '>=', $tahunAwal)
                  ->whereYear('created_at', '<=', $tahunAkhir);
        } elseif ($tahunAwal) {
            // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
            $query->whereYear('created_at', '>=', $tahunAwal);
        } elseif ($tahunAkhir) {
            // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
            $query->whereYear('created_at', '<=', $tahunAkhir);
        }
    
        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }
    
        // Ambil data hasil query dan format bulan/tahun
        $dokumenob_lcm = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });
    
        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = ob_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
    
        // Kirim data ke view
        return view('rate-contract/astim/oblcm/index', compact('dokumenob_lcm', 'tahunList'));
    }
    
    public function detail($id)
    {
        $dokumenob_lcm = ob_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/oblcm/detail', compact('dokumenob_lcm'));
    }
    public function tambah()
    {
        return view('rate-contract/astim/oblcm/tambah');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = ob_lcm::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/astim/ob-lcm')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan ke database
        DB::table('ob_lcm')->insert([
            'load_and_haul_lcm_base_rate_lebih_dari' => $request->load_and_haul_lcm_base_rate_lebih_dari,
            'load_and_haul_lcm_base_rate_kurang_dari' => $request->load_and_haul_lcm_base_rate_kurang_dari,
            'pit_support_lebih_dari' => $request->pit_support_lebih_dari,
            'pit_support_kurang_dari' => $request->pit_support_kurang_dari,
            'pit_lighting_lebih_dari' => $request->pit_lighting_lebih_dari,
            'pit_lighting_kurang_dari' => $request->pit_lighting_kurang_dari,
            'haul_road_maintenance_lebih_dari' => $request->haul_road_maintenance_lebih_dari,
            'haul_road_maintenance_kurang_dari' => $request->haul_road_maintenance_kurang_dari,
            'dewatering_sediment_pit_active_lebih_dari' => $request->dewatering_sediment_pit_active_lebih_dari,
            'dewatering_sediment_pit_active_kurang_dari' => $request->dewatering_sediment_pit_active_kurang_dari,
            'water_treatment_lebih_dari'=> $request->water_treatment_lebih_dari,
            'water_treatment_kurang_dari' => $request->water_treatment_kurang_dari,
            'total_rate_ob_actual_kurang_dari' => $request->total_rate_ob_actual_kurang_dari,
            'total_rate_ob_actual_lebih_dari' => $request->total_rate_ob_actual_lebih_dari,
            'name_contract' => $request->name_contract,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);


        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/ob-lcm')->with('success', 'Data berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumenob_lcm = ob_lcm::findOrFail($id);
        $dokumenob_lcm->delete();

        $path = $dokumenob_lcm->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->to('rate-contract/astim/ob-lcm');
    }

    public function edit($id)
    {
        $dokumenob_lcm = ob_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/oblcm/edit', compact('dokumenob_lcm'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('ob_lcm')->where('id', $id)->first();

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

        // Proses data input sebagai teks
        $load_and_haul_lcm_base_rate_lebih_dari = $request->load_and_haul_lcm_base_rate_lebih_dari;
        $load_and_haul_lcm_base_rate_kurang_dari = $request->load_and_haul_lcm_base_rate_kurang_dari;
        $pit_support_lebih_dari = $request->pit_support_lebih_dari;
        $pit_support_kurang_dari = $request->pit_support_kurang_dari;
        $pit_lighting_lebih_dari = $request->pit_lighting_lebih_dari;
        $pit_lighting_kurang_dari = $request->pit_lighting_kurang_dari;
        $haul_road_maintenance_lebih_dari = $request->haul_road_maintenance_lebih_dari;
        $haul_road_maintenance_kurang_dari = $request->haul_road_maintenance_kurang_dari;
        $dewatering_sediment_pit_active_lebih_dari = $request->dewatering_sediment_pit_active_lebih_dari;
        $dewatering_sediment_pit_active_kurang_dari = $request->dewatering_sediment_pit_active_kurang_dari;
        $water_treatment_lebih_dari = $request->water_treatment_lebih_dari;
        $water_treatment_kurang_dari = $request->water_treatment_kurang_dari;
        $total_rate_ob_actual_kurang_dari = $request->total_rate_ob_actual_kurang_dari;
        $total_rate_ob_actual_lebih_dari = $request->total_rate_ob_actual_lebih_dari;
        $name_contract = $request->name_contract;


        // Update data ke database
        DB::table('ob_lcm')->where('id', $id)->update([
            'load_and_haul_lcm_base_rate_lebih_dari' => $load_and_haul_lcm_base_rate_lebih_dari,
            'load_and_haul_lcm_base_rate_kurang_dari' => $load_and_haul_lcm_base_rate_kurang_dari,
            'pit_support_lebih_dari' => $pit_support_lebih_dari,
            'pit_support_kurang_dari' => $pit_support_kurang_dari,
            'pit_lighting_lebih_dari' => $pit_lighting_lebih_dari,
            'pit_lighting_kurang_dari' => $pit_lighting_kurang_dari,
            'haul_road_maintenance_lebih_dari' => $haul_road_maintenance_lebih_dari,
            'haul_road_maintenance_kurang_dari' => $haul_road_maintenance_kurang_dari,
            'dewatering_sediment_pit_active_lebih_dari' => $dewatering_sediment_pit_active_lebih_dari,
            'dewatering_sediment_pit_active_kurang_dari' => $dewatering_sediment_pit_active_kurang_dari,
            'water_treatment_lebih_dari' => $water_treatment_lebih_dari,
            'water_treatment_kurang_dari' => $water_treatment_kurang_dari,
            'total_rate_ob_actual_kurang_dari' => $total_rate_ob_actual_kurang_dari,
            'total_rate_ob_actual_lebih_dari' => $total_rate_ob_actual_lebih_dari,
            'name_contract' => $name_contract,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/ob-lcm')->with('success', 'Data berhasil diperbarui');
    }
    public function view($id){
        $dokumenob_lcm = ob_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/oblcm/view', compact('dokumenob_lcm'));
    }
}
