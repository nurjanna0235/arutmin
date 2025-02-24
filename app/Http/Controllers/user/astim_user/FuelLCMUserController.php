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
         // Ambil input tahun dari request
    $tahun = $request->input('tahun');
    $filterTahun = $request->input('filter_tahun');

    // Query dasar dengan join ke tabel contract
    $query = fuel_lcm::join('contract', 'fuel_lcm.id_contract', '=', 'contract.id_contract');

    // Filter berdasarkan pencarian tahun
    if ($tahun) {
        $query->whereYear('fuel_lcm.created_at', $tahun);
    }

    // Filter berdasarkan dropdown filter_tahun
    if ($filterTahun) {
        $query->whereYear('fuel_lcm.created_at', $filterTahun);
    }

    // Ambil data hasil query, group by id_contract, dan format created_at
    $dokument = $query->get()
        ->groupBy('id_contract')
        ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
        ->map(function ($item) {
            $item->created_at = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        return view('user.rate-contract.astim.fuellcm.index', compact('dokument'));
    }

    public function detail($id)
    {
        $dokument = fuel_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user.rate-contract.astim.fuellcm.detail', compact('dokument', 'rate_contract'));
    }



}
