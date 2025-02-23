<?php

namespace App\Http\Controllers\user\astim_user;

namespace App\Http\Controllers\user\astim_user;

use App\Models\daywork_lcm;
use App\Models\contract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DayworkLCMUserController extends Controller
{
    public function index(Request $request)
    {
        $dokument = daywork_lcm::join('contract', 'daywork_lcm.id_contract', '=', 'contract.id_contract')
            ->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()); // Ambil item pertama dari setiap grup

        return view('user/rate-contract/astim/dayworklcm/index', compact('dokument'));
    }
    public function detail($id)
    {
        $dokumen = daywork_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        $rate_contract = contract::where('id_contract', $id)->first();
        return view('user/rate-contract/astim/dayworklcm/detail', compact('dokumen', 'rate_contract'));
    }

}
