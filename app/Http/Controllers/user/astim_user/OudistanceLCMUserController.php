<?php

namespace App\Http\Controllers\user\astim_user;
use App\Models\oudistance;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OudistanceLCMUserController extends Controller
{
    public function index(Request $request)
    {
        public function index()
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


    public function detail($id)
    {
        $dokumenoudistance = oudistance::where('id', $id)->get()->first();
        return view('userrate-contract/asteng/oudistance/detail', compact('dokumenoudistance'));
    }
  
}
