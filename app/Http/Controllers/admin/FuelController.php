<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fuel;
use carbon\carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FuelController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $item = $request->input('item'); // Input filter item

        // Query dasar untuk mengambil data
        $query = fuel::query();

        // Filter berdasarkan rentang tahun jika tahun awal dan tahun akhir diberikan
        if ($tahunAwal && $tahunAkhir) {
            $query->whereYear('created_at', '>=', $tahunAwal)
                ->whereYear('created_at', '<=', $tahunAkhir);
        } elseif ($tahunAwal) {
            // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
            $query->whereYear('created_at', '>=', $tahunAwal);
        } elseif ($tahunAkhir) {
            // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
            $query->whereYear('created_at', '<=', $tahunAkhir);
        }

        // Filter berdasarkan item
        if ($item) {
            $query->where('item', $item);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenfuel = $query->orderByDesc('id')->get()->map(function ($item) {
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
    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = fuel::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/fuel')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');



        // simpan data ke database
        fuel::insert([
            'activity' => $request->activity,
            'item' => $request->item,
            'fuel_index' => $request->fuel_index,
            'contractual_distance_km' => $request->contractual_distance_km,
            'name_contract' => $request->name_contract,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
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

        $path = $dokumenfuel->contract_reference;
        if ($request->hasFile('contract_reference')) {

            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }

        // Update data
        $dokumenfuel->update([
            'activity' => $request->activity,
            'item' => $request->item,
            'fuel_index' => $request->fuel_index,
            'contractual_distance_km' => $request->contractual_distance_km,
            'name_contract' => $request->name_contract,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asteng/fuel')->with('success', 'Data berhasil diperbarui');
    }

    public function hapus($id)
    {
        $dokumenfuel = fuel::findOrFail($id);

        $path = $dokumenfuel->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        $dokumenfuel->delete();

        return redirect()->to('rate-contract/asteng/fuel');
    }
}
