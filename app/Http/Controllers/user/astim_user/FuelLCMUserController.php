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

        
        $dokument = fuel_lcm::join('contract', 'fuel_lcm.id_contract', '=', 'contract.id_contract')
            ->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()); 

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $dokument = fuel_lcm::join('contract', 'fuel_lcm.id_contract', '=', 'contract.id_contract')
            ->whereYear('created_at', $tahun)
            ->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()); 
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $dokument = fuel_lcm::join('contract', 'fuel_lcm.id_contract', '=', 'contract.id_contract')
            ->whereYear('created_at', $filterTahun)
            ->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()); 
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenmud_lcm = fuel_lcm::join('contract', 'fuel_lcm.id_contract', '=', 'contract.id_contract')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = fuel_lcm::join('contract', 'fuel_lcm.id_contract', '=', 'contract.id_contract')->selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');


        return view('user/rate-contract.astim.fuellcm.index', compact('dokument'));
    }

    public function detail($id)
    {
        $dokument = fuel_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user/rate-contract.astim.fuellcm.detail', compact('dokument', 'rate_contract'));
    }

}
