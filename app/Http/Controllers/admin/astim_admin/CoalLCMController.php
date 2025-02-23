<?php

namespace App\Http\Controllers\admin\astim_admin;
use App\Models\coal_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class CoalLCMController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = coal_lcm::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumencoal_lcm = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = coal_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/astim/coallcm/index', compact('dokumencoal_lcm', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumencoal_lcm = coal_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/coallcm/detail', compact('dokumencoal_lcm'));
    }
    public function tambah()
    {
        return view('rate-contract/astim/coallcm/tambah');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = now(); // Ambil waktu saat ini
        $dokument = coal_lcm::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/astim/coal-lcm')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan ke database
        DB::table('coal_lcm')->insert([
            'coal_getting_lebih_dari' => $request->coal_getting_lebih_dari,
            'coal_getting_kurang_dari' => $request->coal_getting_kurang_dari,
            'coal_hauling_lebih_dari' => $request->coal_hauling_lebih_dari,
            'coal_hauling_kurang_dari' => $request->coal_hauling_kurang_dari,
            'coal_cleaning_lebih_dari' => $request->coal_cleaning_lebih_dari,
            'coal_cleaning_kurang_dari' => $request->coal_cleaning_kurang_dari,
            'pit_support_lebih_dari' => $request->pit_support_lebih_dari,
            'pit_support_kurang_dari' => $request->pit_support_kurang_dari,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/coal-lcm')->with('success', 'Data berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumencoal_lcm = coal_lcm::findOrFail($id);
        $dokumencoal_lcm->delete();

        $path = $dokumencoal_lcm->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->to('rate-contract/astim/coal-lcm');
    }

    public function edit($id)
    {
        $dokumencoal_lcm = coal_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/coallcm/edit', compact('dokumencoal_lcm'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('coal_lcm')->where('id', $id)->first();

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
        $coal_getting_lebih_dari = $request->coal_getting_lebih_dari;
        $coal_getting_kurang_dari = $request->coal_getting_kurang_dari;
        $coal_hauling_lebih_dari = $request->coal_hauling_lebih_dari;
        $coal_hauling_kurang_dari = $request->coal_hauling_kurang_dari;
        $coal_cleaning_lebih_dari = $request->coal_cleaning_lebih_dari;
        $coal_cleaning_kurang_dari = $request->coal_cleaning_kurang_dari;
        $pit_support_lebih_dari = $request->pit_support_lebih_dari;
        $pit_support_kurang_dari = $request->pit_support_kurang_dari;

        // Update data ke database
        DB::table('coal_lcm')->where('id', $id)->update([
            'coal_getting_lebih_dari' => $coal_getting_lebih_dari,
            'coal_getting_kurang_dari' => $coal_getting_kurang_dari,
            'coal_hauling_lebih_dari' => $coal_hauling_lebih_dari,
            'coal_hauling_kurang_dari' => $coal_hauling_kurang_dari,
            'coal_cleaning_lebih_dari' => $coal_cleaning_lebih_dari,
            'coal_cleaning_kurang_dari' => $coal_cleaning_kurang_dari,
            'pit_support_lebih_dari' => $pit_support_lebih_dari,
            'pit_support_kurang_dari' => $pit_support_kurang_dari,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/coal-lcm')->with('success', 'Data berhasil diperbarui');
    }
}
