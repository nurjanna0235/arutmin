<?php

namespace App\Http\Controllers\admin;
use App\Models\other;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class OtherController extends Controller
{
    public function index(Request $request)
{
    // Ambil input Tahun Awal dan Tahun Akhir dari request
    $startYear = $request->input('start_year');
    $endYear = $request->input('end_year');

    // Query dasar untuk mengambil data
    $query = other::query();

    // Filter berdasarkan rentang tahun jika tersedia
    if ($startYear && $endYear) {
        $query->whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"]);
    } elseif ($startYear) {
        $query->whereYear('created_at', '>=', $startYear);
    } elseif ($endYear) {
        $query->whereYear('created_at', '<=', $endYear);
    }

    // Ambil data hasil query dan format bulan/tahun
    $dokumenother = $query->get()->map(function ($item) {
        $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
        return $item;
    });

    // Ambil daftar tahun unik untuk dropdown filter
    $tahunList = other::selectRaw('YEAR(created_at) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    // Kirim data ke view
    return view('rate-contract/asteng/other/index', compact('dokumenother', 'tahunList'));

}  
  public function detail($id)
    {
        $dokumenother = other::where('id', $id)->get()->first();

        return view('rate-contract/asteng/other/detail', compact('dokumenother'));
    }
    public function tambah()
    {
        return view('rate-contract/asteng/other/tambah');
    }
    public function simpan(Request $request)
    {
        $tanggalInput = now(); // Ambil waktu saat ini
        $dokument = other::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/other')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

            // Ganti koma dengan titik pada inputan untuk keperluan perhitungan
            $base_rate = str_replace([','], ['.'], $request->base_rate_hrm_lcm);
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

            // Simpan data ke dalam database
            DB::table('other')->insert([
                'base_rate_hrm_lcm' => $request->base_rate_hrm_lcm,
                'currency_adjustment' => $request->currency_adjustment,
                'premium_rate' => $request->premium_rate,
                'general_escalation' => $request->general_escalation,
                'rate_actual_hrm_lcm' => $rate_actual,
                'contract_reference' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Redirect dengan pesan sukses
            return redirect()->to('rate-contract/asteng/other')->with('success', 'Data berhasil ditambahkan');
        }
        public function edit($id)
        {
            $dokumenother = other::findOrFail($id);
            return view('rate-contract/asteng/other/edit', compact('dokumenother'));
        }
        public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'base_rate_hrm_lcm' => 'required',
            'currency_adjustment' => 'required',
            'premium_rate' => 'nullable',
            'general_escalation' => 'nullable',
            // 'contract_reference' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $dokumenother = other::findOrFail($id);

        // Proses upload file jika ada file baru
        $path = $dokumenother->contract_reference; // Gunakan file lama jika tidak ada file baru
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }

        // Proses data input
        $base_rate_hrm_lcm = str_replace([','], ['.'], $request->base_rate_hrm_lcm);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate_hrm_lcm = (float) $base_rate_hrm_lcm;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate_hrm_lcm * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Simpan ke database
        $dokumenother->update([
            'base_rate_hrm_lcm' => $request->base_rate_hrm_lcm,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
            'updated_at' => now(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asteng/other')->with('success', 'Data berhasil diperbarui');
    }



    public function hapus($id)
    {
        $dokumenother = other::findOrFail($id);
        $dokumenother->delete();

        return redirect()->to('rate-contract/asteng/other');
    }
}
