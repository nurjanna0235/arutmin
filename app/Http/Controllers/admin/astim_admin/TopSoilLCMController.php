<?php

namespace App\Http\Controllers\admin\astim_admin;

use App\Models\top_soil_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class TopSoilLCMController extends Controller
{

    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown
    
        // Query dasar untuk mengambil data
        $query = top_soil_lcm::query();
    
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
    
        // Ambil data hasil query dan format bulan/tahun
        $dokumentop_soil_lcm = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });
    
        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = top_soil_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
    
        // Kirim data ke view
        return view('rate-contract/astim/topsoillcm/index', compact('dokumentop_soil_lcm', 'tahunList'));
    }
        public function detail($id)
    {
        $dokumentop_soil_lcm = top_soil_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/topsoillcm/detail', compact('dokumentop_soil_lcm'));
    }
    public function tambah()
    {
        return view('rate-contract/astim/topsoillcm/tambah');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = now(); // Ambil waktu saat ini
        $dokument = top_soil_lcm::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/astim/top-soil-lcm')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan ke database
        DB::table('top_soil_lcm')->insert([
            'rate_actual_base_rate_lebih_dari' => $request->rate_actual_base_rate_lebih_dari,
            'rate_actual_base_rate_kurang_dari' => $request->rate_actual_base_rate_kurang_dari,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/top-soil-lcm')->with('success', 'Data berhasil ditambahkan');
    }



    public function hapus($id)
    {
        $dokumentop_soil_lcm = top_soil_lcm::findOrFail($id);
        $dokumentop_soil_lcm->delete();

        $path = $dokumentop_soil_lcm->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->to('rate-contract/astim/top-soil-lcm');
    }

    public function edit($id)
    {
        $dokumentop_soil_lcm = top_soil_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/topsoillcm/edit', compact('dokumentop_soil_lcm'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('top_soil_lcm')->where('id', $id)->first();

        // Proses upload file jika ada file baru
        $path = $dokumen->contract_reference; // Gunakan file lama jika tidak ada file baru
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru

            $path = $request->file('contract_reference')->store('img', 'public');
        }

        // Proses data input sebagai teks
        $rate_actual_base_rate_lebih_dari = $request->rate_actual_base_rate_lebih_dari;
        $rate_actual_base_rate_kurang_dari = $request->rate_actual_base_rate_kurang_dari;

        // Update data ke database
        DB::table('top_soil_lcm')->where('id', $id)->update([
            'rate_actual_base_rate_lebih_dari' => $rate_actual_base_rate_lebih_dari,
            'rate_actual_base_rate_kurang_dari' => $rate_actual_base_rate_kurang_dari,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/top-soil-lcm')->with('success', 'Data berhasil diperbarui');
    }
    public function view($id){
        $dokumentop_soil_lcm = top_soil_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/topsoillcm/view', compact('dokumentop_soil_lcm'));
    }
}
