<?php

namespace App\Http\Controllers\admin;

use App\Models\item_fuel;
use App\Models\value_fuel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fuel;
use carbon\carbon;

class FuelController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');
        $item = $request->input('item'); // Input filter item

        // Query dasar untuk mengambil data
        $query = fuel::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        // Filter berdasarkan item
        if ($item) {
            $query->where('item', $item);
        }
        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenfuel = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = fuel::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/asteng/fuel/index', compact('dokumenfuel', 'tahunList'));
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

        // simpan data ke database
        fuel::insert([
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

    public function edit($id)
    {
        // Ambil data berdasarkan ID
        $dokumenfuel = fuel::findOrFail($id);

        // Kirim data ke view
        return view('rate-contract/asteng/fuel/edit', compact('dokumenfuel'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data berdasarkan ID
        $dokumenfuel = fuel::findOrFail($id);

        // Update data
        $dokumenfuel->update([
            'activity' => $request->activity,
            'item' => $request->item,
            'fuel_index' => $request->fuel_index,
            'contractual_distance_km' => $request->contractual_distance_km,
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asteng/fuel')->with('success', 'Data berhasil diperbarui');
    }

    public function hapus($id)
    {
        $dokumenfuel = fuel::findOrFail($id);
        $dokumenfuel->delete();

        return redirect()->to('rate-contract/asteng/fuel');
    }
}
