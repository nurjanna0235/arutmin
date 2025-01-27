<?php

namespace App\Http\Controllers\admin\astim_admin;
use App\Models\pit_clearing_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PitClearingLCMController extends Controller
{

    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = pit_clearing_lcm::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenpit_clearing_lcm = $query->get()->map(function ($item) {
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
        $path = $request->file('contract_reference')->store('img', 'public');
        
        // Simpan ke database
        DB::table('pit_clearing')->insert([
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asteng/pit-clearing')->with('success', 'Data berhasil ditambahkan');
    }



    public function hapus($id)
    {
        $dokumenpit_clearing = pit_clearing_lcm::findOrFail($id);
        $dokumenpit_clearing->delete();

        return redirect()->to('rate-contract/asteng/pit-clearing');
    }

    public function edit($id)
    {
        $dokumenpit_clearing = pit_clearing_lcm::where('id', $id)->get()->first();

        return view('rate-contract/asteng/pitclearing/edit', compact('dokumenpit_clearing'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
         
        ]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('pit_clearing')->where('id', $id)->first();

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

        // Proses data input
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Update data ke database
        DB::table('pit_clearing')->where('id', $id)->update([
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asteng/pit-clearing')->with('success', 'Data berhasil diperbarui');
    }
}