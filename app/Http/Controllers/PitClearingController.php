<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pit_clearing;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class PitClearingController extends Controller
{

    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = pit_clearing::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenpit_clearing = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = pit_clearing::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/asteng/pitclearing/index', compact('dokumenpit_clearing', 'tahunList'));
    }



    public function detail($id)
    {
        $dokumenpit_clearing = pit_clearing::where('id', $id)->get()->first();

        return view('rate-contract/asteng/pitclearing/detail', compact('dokumenpit_clearing'));
    }
    public function tambah()
    {
        return view('rate-contract/asteng/pitclearing/tambah');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = now(); // Ambil waktu saat ini
        $dokument = pit_clearing::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/pit-clearing')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = (float) str_replace(',', '.', $request->premium_rate) / 100;
        $general_escalation = (float) str_replace(',', '.', $request->general_escalation) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);
        // Simpan ke database

        DB::table('pit_clearing')->insert([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asteng/pit-clearing')->with('success', 'Data berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumenpit_clearing = pit_clearing::findOrFail($id);
        $dokumenpit_clearing->delete();

        $path = $dokumenpit_clearing->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        return redirect()->to('rate-contract/asteng/pit-clearing');
    }

    public function edit($id)
    {
        $dokumenpit_clearing = pit_clearing::where('id', $id)->get()->first();

        return view('rate-contract/asteng/pitclearing/edit', compact('dokumenpit_clearing'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'base_rate' => 'required',
            'currency_adjustment' => 'required',
            'premium_rate' => 'nullable',
            'general_escalation' => 'nullable',
            // 'contract_reference' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
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
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asteng/pit-clearing')->with('success', 'Data berhasil diperbarui');
    }
}
