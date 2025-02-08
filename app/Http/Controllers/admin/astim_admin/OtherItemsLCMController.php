<?php

namespace App\Http\Controllers\admin\astim_admin;
use App\Models\other_items_lcm;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OtherItemsLCMController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = other_items_lcm::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenother_items_lcm = $query->get()->map(function ($item) {
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
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan ke database
        DB::table('other_items_lcm')->insert([
            'rate_actual_hrm_lcm_base_rate_lebih_dari' => $request->rate_actual_hrm_lcm_base_rate_lebih_dari,
            'rate_actual_hrm_lcm_base_rate_kurang_dari' => $request->rate_actual_hrm_lcm_base_rate_kurang_dari,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
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

        // Update data ke database
        DB::table('other_items_lcm')->where('id', $id)->update([
            'rate_actual_hrm_lcm_base_rate_lebih_dari' => $rate_actual_hrm_lcm_base_rate_lebih_dari,
            'rate_actual_hrm_lcm_base_rate_kurang_dari' => $rate_actual_hrm_lcm_base_rate_kurang_dari,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/other-items-lcm')->with('success', 'Data berhasil diperbarui');
    }
}
