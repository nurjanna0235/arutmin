<?php

namespace App\Http\Controllers\user\astim_user;
use App\Models\contract;
use App\Models\fuel_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FuelLCMUserController extends Controller
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
    $dokument = $query->get()
        ->groupBy('fuel_lcm.id_contract') // Grouping berdasarkan id_contract
        ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
        ->map(function ($item) {
            // Pastikan menggunakan created_at dari tabel yang benar
            $item->created_at = Carbon::parse($item->fuel_lcm_created_at)->format('F Y');
            return $item;
        });

    // Kirim data ke view
    return view('/user/rate-contract.astim.fuellcm.index', compact('dokument'));
}

    public function detail($id)
    {
        $dokument = fuel_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user.rate-contract.astim.fuellcm.detail', compact('dokument', 'rate_contract'));
    }
    public function view($id){
        $dokumen = fuel_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();

        return view('user/rate-contract/astim/fuellcm/view',compact('dokumen', 'rate_contract'));
    }


}
