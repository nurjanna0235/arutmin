<?php

namespace App\Http\Controllers\admin\astim_admin;

use App\Models\other_items_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OtherItemsLCMController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown

        // Query dasar untuk mengambil data
        $query = other_items_lcm::query();

        // Filter berdasarkan rentang tahun jika tahun awal dan tahun akhir diberikan
        if ($tahunAwal && $tahunAkhir) {
            $query->whereYear('other_items_lcm.created_at', '>=', $tahunAwal)
                ->whereYear('other_items_lcm.created_at', '<=', $tahunAkhir);
        } elseif ($tahunAwal) {
            // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
            $query->whereYear('other_items_lcm.created_at', '>=', $tahunAwal);
        } elseif ($tahunAkhir) {
            // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
            $query->whereYear('other_items_lcm.created_at', '<=', $tahunAkhir);
        }


        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenother_items_lcm = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = other_items_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/astim/otheritemslcm/index', compact('dokumenother_items_lcm', 'tahunList'));
    }


    public function detail($id)
    {
        $dokumenother_items_lcm = other_items_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/otheritemslcm/detail', compact('dokumenother_items_lcm'));
    }
    public function tambah()
    {
        return view('rate-contract/astim/otheritemslcm/tambah');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = other_items_lcm::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/astim/other-items-lcm')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');


        // Simpan ke database
        DB::table('other_items_lcm')->insert([
            'rate_actual_hrm_lcm_base_rate_lebih_dari' => $request->rate_actual_hrm_lcm_base_rate_lebih_dari,
            'rate_actual_hrm_lcm_base_rate_kurang_dari' => $request->rate_actual_hrm_lcm_base_rate_kurang_dari,
            'name_contract' => $request->name_contract,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);
        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/other-items-lcm')->with('success', 'Data berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumenother_items_lcm = other_items_lcm::findOrFail($id);
        $dokumenother_items_lcm->delete();

        $path = $dokumenother_items_lcm->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->to('rate-contract/astim/other-items-lcm');
    }

    public function edit($id)
    {
        $dokumenother_items_lcm = other_items_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/otheritemslcm/edit', compact('dokumenother_items_lcm'));
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('other_items_lcm')->where('id', $id)->first();

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
        $rate_actual_hrm_lcm_base_rate_lebih_dari = $request->rate_actual_hrm_lcm_base_rate_lebih_dari;
        $rate_actual_hrm_lcm_base_rate_kurang_dari = $request->rate_actual_hrm_lcm_base_rate_kurang_dari;
        $name_contract = $request->name_contract;


        // Update data ke database
        DB::table('other_items_lcm')->where('id', $id)->update([
            'rate_actual_hrm_lcm_base_rate_lebih_dari' => $rate_actual_hrm_lcm_base_rate_lebih_dari,
            'rate_actual_hrm_lcm_base_rate_kurang_dari' => $rate_actual_hrm_lcm_base_rate_kurang_dari,
            'name_contract' => $name_contract,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/other-items-lcm')->with('success', 'Data berhasil diperbarui');
    }
    public function view($id)
    {
        $dokumenother_items_lcm = other_items_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/otheritemslcm/view', compact('dokumenother_items_lcm'));
    }
}
