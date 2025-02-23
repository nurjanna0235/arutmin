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
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');
        $item = $request->input('item'); // Input filter item

        // Query dasar untuk mengambil data
        $query = fuel_asbar::query();

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
        $dokumenfuelasbar = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = fuel_asbar::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        return view('rate-contract/asbar/fuelasbar/index', compact('dokumenfuelasbar', 'tahunList'));
    }

    public function tambah()
    {
        return view('rate-contract/asbar/fuelasbar/tambah');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = now(); // Ambil waktu saat ini
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
            'contract_reference' => $path,
            'updated_at' => now(),
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
