<?php

namespace App\Http\Controllers\user\astim_user;

use App\Models\oudistance_lcm;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contract;

class OudistanceLCMUserController extends Controller
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
        $dokument = $query->get()
            ->groupBy('oudistance_lcm.id_contract') // Grouping berdasarkan id_contract
            ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
            ->map(function ($item) {
                // Format created_at menjadi bulan dan tahun
                $item->created_at = Carbon::parse($item->oudistance_lcm_created_at)->format('F Y'); // Pastikan kolom yang dipilih benar
                return $item;
            });

        // Kirim data ke view
        return view('/user/rate-contract.astim.oudistancelcm.index', compact('dokument'));
    }


    public function detail($id)
    {
        $dokument = oudistance_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user.rate-contract.astim.oudistancelcm.detail', compact('dokument', 'rate_contract'));
    }
    public function view($id){
        $dokumen = oudistance_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();

        return view('user/rate-contract/astim/oudistancelcm/view',compact('dokumen', 'rate_contract'));
    }
}
