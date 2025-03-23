<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fuel_asbar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class FuelAsbarController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown
        $item = $request->input('item'); // Input filter item
    
        // Query dasar untuk mengambil data
        $query = fuel_asbar::query();
    
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
    
        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }
    
        // Filter berdasarkan item
        if ($item) {
            $query->where('item', $item);
        }
    
        // Ambil data hasil query dan format bulan/tahun
        $dokumenfuelasbar = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });
    
        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = fuel_asbar::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
    
        // Kirim data ke view
        return view('rate-contract/asbar/fuelasbar/index', compact('dokumenfuelasbar', 'tahunList'));
    }
    
    public function tambah()
    {
        return view('rate-contract/asbar/fuelasbar/tambah');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = fuel_asbar::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asbar/fuel-asbar')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // simpan data ke database
        fuel_asbar::insert([
            'activity' => $request->activity,
            'item' => $request->item,
            'fuel_index' => $request->fuel_index,
            'distance' => $request->distance,
            'name_contract' => $request->name_contract,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asbar/fuel-asbar')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        // Ambil data berdasarkan ID
        $dokumenfuelasbar = fuel_asbar::findOrFail($id);

        // Kirim data ke view
        return view('rate-contract/asbar/fuelasbar/edit', compact('dokumenfuelasbar'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data berdasarkan ID
        $dokumenfuelasbar = fuel_asbar::findOrFail($id);
        // Proses upload file jika ada file baru
        $path = $dokumenfuelasbar->contract_reference;
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');

        }

        DB::table('fuel_asbar')->where('id', $id)->update([
            'activity' => $request->activity,
            'item' => $request->item,
            'fuel_index' => $request->fuel_index,
            'distance' => $request->distance,
            'name_contract' => $request->name_contract,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);

        return redirect()->to('rate-contract/asbar/fuel-asbar')->with('success', 'Data berhasil diperbarui');
    }

    public function detail($id)
    {
        $dokumenfuelasbar = fuel_asbar::where('id', $id)->get()->first();
        return view('rate-contract/asbar/fuelasbar/detail', compact('dokumenfuelasbar'));
    }

    public function hapus($id)
    {
        $dokumenfuelasbar = fuel_asbar::findOrFail($id);

        $path = $dokumenfuelasbar->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        $dokumenfuelasbar->delete();

        return redirect()->to('rate-contract/asbar/fuel-asbar');
    }
}
