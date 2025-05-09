<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\top_soil;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class TopSoilController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input Tahun Awal dan Tahun Akhir dari request
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');

        // Query dasar untuk mengambil data
        $query = top_soil::query();

        // Filter berdasarkan rentang tahun jika tersedia
        if ($startYear && $endYear) {
            $query->whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"]);
        } elseif ($startYear) {
            $query->whereYear('created_at', '>=', $startYear);
        } elseif ($endYear) {
            $query->whereYear('created_at', '<=', $endYear);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumentop_soil = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = top_soil::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/asteng/topsoil/index', compact('dokumentop_soil', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumentop_soil = top_soil::where('id', $id)->get()->first();

        return view('rate-contract/asteng/topsoil/detail', compact('dokumentop_soil'));
    }

    public function tambah()
    {
        return view('rate-contract/asteng/topsoil/tambah');
    }
    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = top_soil::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/top-soil')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;
        $name_contract = $request->name_contract;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;
        $name_contract =  $name_contract;
        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);
        // Simpan ke database
        DB::table('top_soil')->insert([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'name_contract' => $name_contract,
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asteng/top-soil')->with('success', 'Data berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $dokumentop_soil = top_soil::findOrFail($id);
        $dokumentop_soil->delete();

        return redirect()->to('rate-contract/asteng/top-soil');
    }

    public function edit($id)
    {
        $dokumentop_soil = top_soil::where('id', $id)->get()->first();

        return view('rate-contract/asteng/topsoil/edit', compact('dokumentop_soil'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'base_rate' => 'required',
            'currency_adjustment' => 'required',
            'premium_rate' => 'nullable',
            'general_escalation' => 'nullable',
            'name_contract' => 'nullable',
            // 'contract_reference' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('top_soil')->where('id', $id)->first();

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
        $name_contract =  $request->name_contract;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;
        $name_contract = (float) $name_contract;
        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Update data ke database
        DB::table('top_soil')->where('id', $id)->update([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'name_contract' => $request->name_contract,
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
            'updated_at' => now(),
        ]);
        // Redirect dengan pesan sukses
        return redirect()->to('rate-contract/asteng/top-soil')->with('success', 'Data berhasil diperbarui');
    }
}
