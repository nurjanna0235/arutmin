<?php

namespace App\Http\Controllers\admin\astim_admin;

use App\Models\pit_clearing_lcm;
use App\Http\Controllers\Controller;
use App\Models\pit_clearing;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PitClearingLCMController extends Controller
{

    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown

        // Query dasar untuk mengambil data
        $query = pit_clearing_lcm::query();

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
        $dokumenpit_clearing_lcm = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = pit_clearing_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/astim/pitclearinglcm/index', compact('dokumenpit_clearing_lcm', 'tahunList'));
    }


    public function detail($id)
    {
        $dokumenpit_clearing_lcm = pit_clearing_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/pitclearinglcm/detail', compact('dokumenpit_clearing_lcm'));
    }
    public function tambah()
    {
        return view('rate-contract/astim/pitclearinglcm/tambah');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = pit_clearing_lcm::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/astim/pit-clearing-lcm')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan ke database
        DB::table('pit_clearing_lcm')->insert([
            'rate_actual_base_rate_lebih_dari' => $request->rate_actual_base_rate_lebih_dari,
            'rate_actual_base_rate_kurang_dari' => $request->rate_actual_base_rate_kurang_dari,
            'name_contract' => $request->name_contract,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);
        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/pit-clearing-lcm')->with('success', 'Data berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumenpit_clearing_lcm = pit_clearing_lcm::findOrFail($id);
        $dokumenpit_clearing_lcm->delete();

        $path = $dokumenpit_clearing_lcm->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->to('rate-contract/astim/pit-clearing-lcm');
    }

    public function edit($id)
    {
        $dokumenpit_clearing_lcm = pit_clearing_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/pitclearinglcm/edit', compact('dokumenpit_clearing_lcm'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('pit_clearing_lcm')->where('id', $id)->first();

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
        $name_contract = $request->name_contract;


        // Update data ke database
        DB::table('pit_clearing_lcm')->where('id', $id)->update([
            'rate_actual_base_rate_lebih_dari' => $rate_actual_base_rate_lebih_dari,
            'rate_actual_base_rate_kurang_dari' => $rate_actual_base_rate_kurang_dari,
            'name_contract' => $name_contract,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/pit-clearing-lcm')->with('success', 'Data berhasil diperbarui');
    }

    public function view($id)
    {
        $dokumenpit_clearing_lcm = pit_clearing_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/pitclearinglcm/view', compact('dokumenpit_clearing_lcm'));
    }
}
