<?php

namespace App\Http\Controllers\admin\astim_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\oudistance_lcm;
use App\Models\contract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OudistanceLCMController extends Controller
{
    public function index(Request $request)
    {
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown

        // Query dasar dengan join ke tabel contract
        $query = oudistance_lcm::join('contract', 'oudistance_lcm.id_contract', '=', 'contract.id_contract');

        
        // Filter berdasarkan rentang tahun jika tahun awal dan tahun akhir diberikan
        if ($tahunAwal && $tahunAkhir) {
            $query->whereYear('oudistance_lcm.created_at', '>=', $tahunAwal)
                ->whereYear('oudistance_lcm.created_at', '<=', $tahunAkhir);
        } elseif ($tahunAwal) {
            // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
            $query->whereYear('oudistance_lcm.created_at', '>=', $tahunAwal);
        } elseif ($tahunAkhir) {
            // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
            $query->whereYear('oudistance_lcm.created_at', '<=', $tahunAkhir);
        }

        // Ambil data hasil query, group by id_contract, dan format created_at
        $dokument = $query->orderByDesc('id')->get()
            ->groupBy('oudistance_lcm.id_contract') // Grouping berdasarkan id_contract
            ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
            ->map(function ($item) {
                // Format created_at menjadi bulan dan tahun
                $item->created_at = Carbon::parse($item->oudistance_lcm_created_at)->format('F Y'); // Pastikan kolom yang dipilih benar
                return $item;
            });

        // Kirim data ke view
        return view('rate-contract.astim.oudistancelcm.index', compact('dokument'));
    }



    public function tambah()
    {
        $item_oudistance_lcm = [
            ['activity' => 'OB', 'item' => 'OB Overhaul Distance (Rp/BCM/100 m)'],
            ['activity' => 'OB', 'item' => 'OB Underhaul Distance (Rp/BCM/100 m)'],
            ['activity' => 'Top Soil', 'item' => 'Top Soil Overhaul Distance (Rp/BCM/100 m)'],
            ['activity' => 'Top Soil', 'item' => 'Top Soil Underhaul Distance (Rp/BCM/100 m)'],
            ['activity' => 'Mud Removal', 'item' => 'Overhaul Mud Removal (Rp/BCM/100 m)'],
            ['activity' => 'Mud Removal', 'item' => 'Underhaul Mud Removal (Rp/BCM/100 m)'],
        ];
        return view('rate-contract/astim/oudistancelcm/tambah', compact('item_oudistance_lcm'));
    }

    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = oudistance_lcm::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/astim/oudistance-lcm')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan contract dan ambil ID-nya
        $id_contract = contract::insertGetId([
            'contract_refren' => $path, // Pastikan nama kolom sesuai dengan di database
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);

        // Loop untuk menyimpan data oudistance_lcm
        foreach ($request->input('base_rate_high', []) as $key => $BaseRateHigh) {

            $BaseRateLow = $request->input('base_rate_low')[$key] ?? null;
            $contractual_distance = $request->input('contractual_distance')[$key] ?? null;

            oudistance_lcm::create([
                'activity' => $request->input('activity')[$key],
                'item' => $request->input('item')[$key],
                'base_rate_high' => $BaseRateHigh,
                'base_rate_low' => $BaseRateLow,
                'contractual_distance' => $contractual_distance,
                'id_contract' => $id_contract, // Pastikan nama kolom di database benar
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->to('rate-contract/astim/oudistance-lcm')->with('success', 'Data berhasil ditambahkan');
    }

    public function detail($id)
    {
        $dokument = oudistance_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('rate-contract.astim.oudistancelcm.detail', compact('dokument', 'rate_contract'));
    }

    public function edit($id)
    {
        $dokument = oudistance_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('rate-contract.astim.oudistancelcm.edit', compact('dokument', 'rate_contract'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data berdasarkan ID
        $rate_contract = DB::table('contract')->where('id_contract', $id)->first();
        $id_contract = $id;
        // Proses upload file jika ada file baru
        $path = $rate_contract->contract_refren; // Gunakan file lama jika tidak ada file baru
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru

            $path = $request->file('contract_reference')->store('img', 'public');
            // Simpan contract dan ambil ID-nya
            contract::where('id_contract', $id)->update([
                'contract_refren' => $path, // Pastikan nama kolom sesuai dengan di database
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Loop untuk menyimpan data oudistance_lcm
        foreach ($request->input('base_rate_high', []) as $key => $BaseRateHigh) {
            $BaseRateLow = $request->input('base_rate_low')[$key] ?? null;
            $contractual_distance = $request->input('contractual_distance')[$key] ?? null;

            oudistance_lcm::where('id', $request->input('id_dokumen')[$key])->update([
                'activity' => $request->input('activity')[$key],
                'item' => $request->input('item')[$key],
                'base_rate_high' => $BaseRateHigh,
                'base_rate_low' => $BaseRateLow,
                'contractual_distance' => $contractual_distance,
                'id_contract' => $id_contract,  // Pastikan nama kolom di database benar
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/oudistance-lcm')->with('success', 'Data berhasil diupdate');
    }

    public function hapus($id)
    {
        oudistance_lcm::where('id_contract', $id)->delete();
        contract::where('id_contract', $id)->delete();
        return redirect()->to('rate-contract/astim/oudistance-lcm')->with('success', 'Data berhasil dihapus');
    }
    public function view($id)
    {
        $dokumen = oudistance_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();

        return view('rate-contract/astim/oudistancelcm/view', compact('dokumen', 'rate_contract'));
    }
}
