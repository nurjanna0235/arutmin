<?php

namespace App\Http\Controllers\admin\astim_admin;
use App\Models\mud_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MudLCMController extends Controller
{

    public function index(Request $request)
    {
         // Ambil input tahun dari request
         $tahun = $request->input('tahun');
         $filterTahun = $request->input('filter_tahun');
 
         // Query dasar untuk mengambil data
         $query = mud_lcm::query();
 
         // Filter berdasarkan pencarian tahun
         if ($tahun) {
             $query->whereYear('created_at', $tahun);
         }
 
         // Filter berdasarkan dropdown filter_tahun
         if ($filterTahun) {
             $query->whereYear('created_at', $filterTahun);
         }
 
         // Ambil data hasil query dan format bulan/tahun
         $dokumenmud_lcm = $query->get()->map(function ($item) {
             $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
             return $item;
         });
 
         // Ambil daftar tahun unik untuk dropdown filter
         $tahunList = mud_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
 
         // Kirim data ke view
         return view('rate-contract/astim/mudlcm/index', compact('dokumenmud_lcm', 'tahunList'));
     }
 

    public function detail($id)
    {
        $dokumenmud_lcm = mud_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/mudlcm/detail', compact('dokumenmud_lcm'));
    }
    public function tambah()
    {
        return view('rate-contract/astim/mudlcm/tambah');
    }

    public function simpan(Request $request)
    {
        $path = $request->file('contract_reference')->store('img', 'public');

        // Simpan ke database
        DB::table('mud_lcm')->insert([
            'mud_removal_lebih_dari' => $request->mud_removal_lebih_dari,
            'mud_removal_kurang_dari' => $request->mud_removal_kurang_dari,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/mud-lcm')->with('success', 'Data berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumenmud_lcm = mud_lcm::findOrFail($id);
        $dokumenmud_lcm->delete();

        $path = $dokumenmud_lcm->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->to('rate-contract/astim/mud-lcm');
    }

    public function edit($id)
    {
        $dokumenmud_lcm = mud_lcm::where('id', $id)->get()->first();

        return view('rate-contract/astim/mudlcm/edit', compact('dokumenmud_lcm'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('mud_lcm')->where('id', $id)->first();

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
        $mud_removal_lebih_dari = $request->mud_removal_lebih_dari;
        $mud_removal_kurang_dari = $request->mud_removal_kurang_dari;

        // Update data ke database
        DB::table('mud_lcm')->where('id', $id)->update([
            'mud_removal_lebih_dari' => $mud_removal_lebih_dari,
            'mud_removal_kurang_dari' => $mud_removal_kurang_dari,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/astim/mud-lcm')->with('success', 'Data berhasil diperbarui');
    }
}

