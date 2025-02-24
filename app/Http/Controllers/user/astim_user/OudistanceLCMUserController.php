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
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar dengan join ke tabel contract
        $query = oudistance_lcm::join('contract', 'oudistance_lcm.id_contract', '=', 'contract.id_contract');

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('oudistance_lcm.created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('oudistance_lcm.created_at', $filterTahun);
        }

        // Ambil data hasil query, group by id_contract, dan format created_at
        $dokument = $query->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
            ->map(function ($item) {
                $item->created_at = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
                return $item;
            });

        return view('user.rate-contract.astim.oudistancelcm.index', compact('dokument'));
    }

    public function detail($id)
    {
        $dokument = oudistance_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user.rate-contract.astim.oudistancelcm.detail', compact('dokument', 'rate_contract'));
    }
}
