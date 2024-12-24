<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CoalHaulingController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = DB::table('coal_hauling');

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenCoalHauling = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = DB::table('coal_hauling')->selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/asbar/coalhauling/index', compact('dokumenCoalHauling', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumenCoalHauling = DB::table('coal_hauling')->where('id', $id)->first();

        return view('rate-contract/asbar/coal-hauling/detail', compact('dokumenCoalHauling'));
    }

    public function tambah()
    {
        return view('rate-contract/asbar/coal-hauling/tambah');
    }

    public function simpan(Request $request)
    {
        $path = $request->file('contract_reference')->store('img', 'public');

        // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $general_escalation = (float) $general_escalation;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $general_escalation);

        // Simpan ke database
        DB::table('coal_hauling')->insert([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'general_escalation' => $request->general_escalation,
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asbar/coal-hauling')->with('success', 'Data berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumenCoalHauling = DB::table('coal_hauling')->where('id', $id)->first();

        if ($dokumenCoalHauling->contract_reference) {
            Storage::disk('public')->delete($dokumenCoalHauling->contract_reference);
        }

        DB::table('coal_hauling')->where('id', $id)->delete();

        return redirect()->to('rate-contract/asbar/coal-hauling');
    }

    public function edit($id)
    {
        $dokumenCoalHauling = DB::table('coal_hauling')->where('id', $id)->first();

        return view('rate-contract/asbar/coal-hauling/edit', compact('dokumenCoal_Hauling'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'base_rate' => 'required',
            'currency_adjustment' => 'required',
            'general_escalation' => 'nullable',
        ]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('coal_hauling')->where('id', $id)->first();

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
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $general_escalation = (float) $general_escalation;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $general_escalation);

        // Update data ke database
        DB::table('coal_hauling')->where('id', $id)->update([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'general_escalation' => $request->general_escalation,
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asbar/coal-hauling')->with('success', 'Data berhasil diperbarui');
    }
}
