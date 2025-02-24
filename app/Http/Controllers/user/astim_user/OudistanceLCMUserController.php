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

        $dokument = oudistance_lcm::join('contract', 'oudistance_lcm.id_contract', '=', 'contract.id_contract')
            ->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()) // Ambil item pertama dari setiap grup
            ->map(function ($item) {
                // Pastikan created_at adalah objek Carbon dan format ke "Month Year"
                $item->created_at = Carbon::parse($item->created_at)->format('F Y');
                return $item;
            });

        return view('user/rate-contract.astim.oudistancelcm.index', compact('dokument'));
    }


    public function detail($id){
        $dokument = oudistance_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user.rate-contract.astim.oudistancelcm.detail', compact('dokument', 'rate_contract'));
    }
  
}
