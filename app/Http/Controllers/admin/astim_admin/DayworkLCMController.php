<?php

namespace App\Http\Controllers\admin\astim_admin;

use App\Models\daywork_lcm;
use App\Http\Controllers\Controller;
use App\Models\contract;
use App\Models\daywork;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class DayworkLCMController extends Controller
{
    public function index(Request $request)
    {
        $dokument = daywork_lcm::join('contract', 'daywork_lcm.id_contract', '=', 'contract.id_contract')
            ->get()
            ->groupBy('id_contract')
            ->map(fn($group) => $group->first()); // Ambil item pertama dari setiap grup

        return view('rate-contract/astim/dayworklcm/index', compact('dokument'));
    }


    public function tambah()
    {
        $item_daywork_lcm = [
            [
                'item' => 'Excavator 80 Ton',
                'model' => 'R850LC-9'
            ],
            [
                'item' => 'Excavator 80 Ton',
                'model' => 'CLG975E'
            ],
            [
                'item' => 'Excavator 80 Ton',
                'model' => 'DX800LC-5B'
            ],
            [
                'item' => 'Excavator 30 Ton',
                'model' => 'XZ350'
            ],
            [
                'item' => 'Excavator 30 Ton',
                'model' => 'DX300LCA'
            ],
            [
                'item' => 'Excavator 20 Ton',
                'model' => 'DX200A-7M'
            ],
            [
                'item' => 'Dump Truck OB 55 Ton',
                'model' => '875KR'
            ],
            [
                'item' => 'Dump Truck OB 55 Ton',
                'model' => 'DW90A'
            ],
            [
                'item' => 'Dump Truck Coal 30 Ton',
                'model' => 'TRAKER 380'
            ],
            [
                'item' => 'Dump Truck Coal 30 Ton',
                'model' => 'HINO 500'
            ],
            [
                'item' => 'Dump Truck Coal 20 Ton',
                'model' => 'FM260'
            ],
            [
                'item' => 'Dump Truck Coal 20 Ton',
                'model' => 'FUSO'
            ],
            [
                'item' => 'Dozer 20 Ton',
                'model' => 'ZD220-3'
            ],
            [
                'item' => 'Dozer 20 Ton',
                'model' => 'B230'
            ],
            [
                'item' => 'Dozer 30 Ton',
                'model' => 'SD32'
            ],
            [
                'item' => 'Grader 13 Ton',
                'model' => 'G9220F'
            ],
            [
                'item' => 'Grader 13 Ton',
                'model' => 'G4260-R'
            ],
            [
                'item' => 'Tower Lamp',
                'model' => 'LSW6Y'
            ]
        ];

        return view('rate-contract/astim/dayworklcm/tambah', compact('item_daywork_lcm'));
    }

    public function detail($id){
        $dokumen = daywork_lcm::where('id_contract', $id)->get(); // Ambil semua data dengan id_contract yang sama
        return view('rate-contract/astim/dayworklcm/detail', compact('dokumen'));
    }

    public function simpan(Request $request)
    {
        // Simpan file dan ambil path-nya
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan contract dan ambil ID-nya
        $id_contract = contract::insertGetId([
            'contract_refren' => $path, // Pastikan nama kolom sesuai dengan di database
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Loop untuk menyimpan data daywork_lcm
        foreach ($request->input('actual_rate', []) as $key => $itemActual) {
            $itemFbr = $request->input('fbr')[$key] ?? null; // Ambil nilai `fbr` sesuai indeks atau null jika tidak ada

            daywork_lcm::create([
                'item' => $request->input('item')[$key],
                'model' => $request->input('model')[$key],
                'rate_per_hour' => $itemActual,
                'fuel_burn_rate' => $itemFbr,
                'id_contract' => $id_contract, // Pastikan nama kolom di database benar
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/daywork-lcm')->with('success', 'Data berhasil ditambahkan');
    }
}
