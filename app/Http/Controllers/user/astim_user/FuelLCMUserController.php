<?php

namespace App\Http\Controllers\user\astim_user;
use App\Models\contract;
use App\Models\fuel_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FuelLCMUserController extends Controller
{
    public function index()
    {
        $dokument = fuel_lcm::join('contract', 'fuel_lcm.id_contract', '=', 'contract.id_contract')
            ->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
            ->map(function ($item) {
                // Pastikan created_at adalah objek Carbon dan format ke "Month Year"
                $item->created_at = Carbon::parse($item->created_at)->format('F Y');
                return $item;
            });

        return view('user/rate-contract.astim.fuellcm.index', compact('dokument'));
    }

    public function detail($id)
    {
        $dokument = fuel_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user/rate-contract.astim.fuellcm.detail', compact('dokument', 'rate_contract'));
    }


}
