<?php

namespace App\Http\Controllers\admin\astim_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fuel_lcm;
use App\Models\contract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FuelLCMController extends Controller
{
    public function index(Request $request)
{
    $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
    $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
    $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown

    // Query dasar dengan join ke tabel contract
    $query = fuel_lcm::join('contract', 'fuel_lcm.id_contract', '=', 'contract.id_contract');

    // Filter berdasarkan tahun yang dimasukkan melalui input pencarian 'tahun'
    if ($tahunAwal && $tahunAkhir) {
        $query->whereYear('fuel_lcm.created_at', '>=', $tahunAwal)
            ->whereYear('fuel_lcm.created_at', '<=', $tahunAkhir);
    } elseif ($tahunAwal) {
        // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
        $query->whereYear('fuel_lcm.created_at', '>=', $tahunAwal);
    } elseif ($tahunAkhir) {
        // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
        $query->whereYear('fuel_lcm.created_at', '<=', $tahunAkhir);
    }

    // Filter berdasarkan dropdown filter_tahun
    if ($filterTahun) {
        $query->whereYear('fuel_lcm.created_at', $filterTahun);
    }

    // Ambil data hasil query, group by id_contract, dan format created_at
    $dokument = $query->orderByDesc('id')->get()
        ->groupBy('fuel_lcm.id_contract') // Grouping berdasarkan id_contract
        ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
        ->map(function ($item) {
            // Pastikan menggunakan created_at dari tabel yang benar
            $item->created_at = Carbon::parse($item->fuel_lcm_created_at)->format('F Y');
            return $item;
        });

    // Kirim data ke view
    return view('rate-contract.astim.fuellcm.index', compact('dokument'));
}


    public function detail($id)
    {
        $dokument = fuel_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('rate-contract.astim.fuellcm.detail', compact('dokument', 'rate_contract'));
    }

    public function tambah()
    {
        $item_fuel_lcm = [
            ['activity' => 'OB', 'item' => 'Overburden @1.5 KM (liter/BCM)'],
            ['activity' => 'OB', 'item' => 'Overhaul distance OB (liter/BCM/KM)'],
            ['activity' => 'OB', 'item' => 'Underhaul distance OB (liter/BCM/KM)'],
            ['activity' => 'Coal', 'item' => 'Coal Mine @10 KM (liter/ton)'],
            ['activity' => 'Coal', 'item' => 'Overhaul distance Coal Mine (liter/ton/KM)'],
            ['activity' => 'Coal', 'item' => 'Underhaul distance Coal Mine (liter/ton/KM)'],
            ['activity' => 'Top Soil', 'item' => 'Top Soil @1.5 KM (liter/BCM)'],
            ['activity' => 'Top Soil', 'item' => 'Overhaul distance Top Soil (liter/BCM/KM)'],
            ['activity' => 'Top Soil', 'item' => 'Underhaul distance Top Soil (liter/BCM/KM)'],
            ['activity' => 'Mud Premining', 'item' => 'Mud Premining @1.5 KM (liter/BCM)'],
            ['activity' => 'Mud Premining', 'item' => 'Overhaul distance Mud Premining (liter/BCM/KM)'],
            ['activity' => 'Mud Premining', 'item' => 'Underhaul distance Mud Premining (liter/BCM/KM)'],
        ];

        return view('rate-contract.astim.fuellcm.tambah', compact('item_fuel_lcm'));
    }

    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = fuel_lcm::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/astim/fuel-lcm')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan contract dan ambil ID-nya
        $id_contract = contract::insertGetId([
            'contract_refren' => $path, // Pastikan nama kolom sesuai dengan di database
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Loop untuk menyimpan data fuel_lcm
        foreach ($request->input('fuel_index', []) as $key => $fuelIndex) {

            $contractual_distance = $request->input('contractual_distance')[$key] ?? null;
            fuel_lcm::create([
                'activity' => $request->input('activity')[$key],
                'item' => $request->input('item')[$key],
                'fuel_index' => $fuelIndex,
                'contractual_distance' => $contractual_distance,
                'id_contract' => $id_contract, // Pastikan nama kolom di database benar
                'created_at' => $request->bulan,
                'updated_at' => $request->bulan,
            ]);
        }
        return redirect()->to('rate-contract/astim/fuel-lcm')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dokument = fuel_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('rate-contract.astim.fuellcm.edit', compact('dokument', 'rate_contract'));
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

        // Loop untuk menyimpan data fuel_lcm
        foreach ($request->input('fuel_index', []) as $key => $fuelIndex) {
            $contractual_distance = $request->input('contractual_distance')[$key] ?? null;
            fuel_lcm::where('id', $request->input('id_dokumen')[$key])->update([
                'activity' => $request->input('activity')[$key],
                'item' => $request->input('item')[$key],
                'fuel_index' => $fuelIndex,
                'contractual_distance' => $contractual_distance,
                'id_contract' => $id_contract, // Pastikan nama kolom di database benar
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/fuel-lcm')->with('success', 'Data berhasil diupdate');
    }

    public function hapus($id)
    {
        fuel_lcm::where('id_contract', $id)->delete();
        contract::where('id_contract', $id)->delete();
        return redirect()->to('rate-contract/astim/fuel-lcm')->with('success', 'Data berhasil dihapus');
    }
    public function view($id){
        $dokumen = fuel_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();

        return view('rate-contract/astim/fuellcm/view',compact('dokumen', 'rate_contract'));
    }
}
