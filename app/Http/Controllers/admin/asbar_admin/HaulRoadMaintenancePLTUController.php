<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\haul_road_maintenance_pltu;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HaulRoadMaintenancePLTUController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown

        // Query dasar untuk mengambil data
        $query = haul_road_maintenance_pltu::query();

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
        $dokumenhaulroadmaintenancepltu = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = haul_road_maintenance_pltu::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/asbar/haul-road-maintenance-pltu/index', compact('dokumenhaulroadmaintenancepltu', 'tahunList'));
    }
    public function tambah()
    {
        return view('rate-contract/asbar/haul-road-maintenance-pltu/tambah');
    }
    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = haul_road_maintenance_pltu::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();
        if ($dokument) {
            return redirect()->to('rate-contract/asbar/haul-road-maintenance-pltu')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;
        $name_contract = $request->name_contract;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;
        $name_contract =  $name_contract;

        // Hitung Actual Rate sesuai rumus
        $actual_rate_hauling_pltu = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);
        // Simpan ke database
        DB::table('haul_road_maintenance_pltu')->insert([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'actual_rate_hauling_pltu' => $actual_rate_hauling_pltu,
            'name_contract' => $name_contract,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asbar/haul-road-maintenance-pltu')->with('success', 'Data berhasil ditambahkan');
    }
    public function detail($id)
    {
        $dokumenhaulroadmaintenancepltu = haul_road_maintenance_pltu::where('id', $id)->get()->first();

        return view('rate-contract/asbar/haul-road-maintenance-pltu/detail', compact('dokumenhaulroadmaintenancepltu'));
    }

    public function edit($id)
    {
        $dokumenhaulroadmaintenancepltu = haul_road_maintenance_pltu::where('id', $id)->get()->first();
        return view('rate-contract/asbar/haul-road-maintenance-pltu/edit', compact('dokumenhaulroadmaintenancepltu'));
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'base_rate' => 'required',
            'currency_adjustment' => 'required',
            'premium_rate' => 'nullable',
            'general_escalation' => 'nullable',
            'name_contract' => 'required',
            // 'contract_reference' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('haul_road_maintenance_pltu')->where('id', $id)->first();

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
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;
        $name_contract =  $request->name_contract;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;
        $name_contract =  $name_contract;

        // Hitung Rate Actual sesuai rumus
        $actual_rate_hauling_pltu = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Update data ke database
        DB::table('haul_road_maintenance_pltu')->where('id', $id)->update([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'actual_rate_hauling_pltu' => $actual_rate_hauling_pltu,
            'name_contract' => $name_contract,
            'contract_reference' => $path,
            'updated_at' => now(),
        ]);
        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asbar/haul-road-maintenance-pltu')->with('success', 'Data berhasil diperbarui');
    }

    public function hapus($id)
    {
        $dokumenhaulroadmaintenancepltu = haul_road_maintenance_pltu::findOrFail($id);
        $dokumenhaulroadmaintenancepltu->delete();

        return redirect()->to('rate-contract/asbar/haul-road-maintenance-pltu');
    }
}
