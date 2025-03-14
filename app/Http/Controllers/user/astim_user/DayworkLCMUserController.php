<?php

namespace App\Http\Controllers\user\astim_user;

namespace App\Http\Controllers\user\astim_user;

use App\Models\daywork_lcm;
use App\Models\contract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DayworkLCMUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown
    
        // Query dasar dengan join ke tabel contract
        $query = daywork_lcm::join('contract', 'daywork_lcm.id_contract', '=', 'contract.id_contract');
    
        // Filter berdasarkan rentang tahun jika tahun awal dan tahun akhir diberikan
        if ($tahunAwal && $tahunAkhir) {
            $query->whereYear('daywork_lcm.created_at', '>=', $tahunAwal)
                  ->whereYear('daywork_lcm.created_at', '<=', $tahunAkhir);
        } elseif ($tahunAwal) {
            // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
            $query->whereYear('daywork_lcm.created_at', '>=', $tahunAwal);
        } elseif ($tahunAkhir) {
            // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
            $query->whereYear('daywork_lcm.created_at', '<=', $tahunAkhir);
        }
    
        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('daywork_lcm.created_at', $filterTahun);
        }
    
        // Ambil data hasil query, group by id_contract, dan format created_at
        $dokument = $query->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
            ->map(function ($item) {
                $item->created_at = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
                return $item;
            });
    
        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = daywork_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
    
        // Kirim data ke view
        return view('/user/rate-contract/astim/dayworklcm/index', compact('dokument', 'tahunList'));
    }
        public function detail($id)
    {
        $dokumen = daywork_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user/rate-contract/astim/dayworklcm/detail', compact('dokumen', 'rate_contract'));
    }
    public function view($id){
        $dokumen = daywork_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();

        return view('user/rate-contract/astim/dayworklcm/view',compact('dokumen', 'rate_contract'));
    }

}
