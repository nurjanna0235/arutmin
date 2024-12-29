<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fuel;

class FuelController extends Controller
{
    public function index()
    {
        $dokumenfuel = fuel::all();

        return view('rate-contract/asteng/fuel/index', compact('dokumenfuel'));
    }
    public function detail($id)
    {
        $dokumenfuel = fuel::where('id', $id)->get()->first();
        return view('rate-contract/asteng/fuel/detail', compact('dokumenfuel'));
    }
    public function tambah()
    {
        return view('rate-contract/asteng/fuel/tambah');
    }
    public function simpan(Request $requet)
    {
        $path = $request->file('contract_reference')->store('img', 'public');

        // Update data ke database
        fuel::table('fuel')->insert([
            'activity' => $request->activity,
            'item' => $request->item,
            'fuel_index' => $request->fuel_index,
            'contractual_distance_km' => $request->contractual_distance_km,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asteng/fuel')->with('success', 'Data berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumenfuel = fuel::findOrFail($id);
        $dokumenfuel->delete();

        return redirect()->to('rate-contract/asteng/fuel');
    }
}
