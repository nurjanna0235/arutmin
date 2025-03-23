<?php

namespace App\Http\Controllers\admin;

use App\Models\mud;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MudController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input Tahun Awal dan Tahun Akhir dari request
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
    
        // Query dasar untuk mengambil data
        $query = mud::query();
    
        // Filter berdasarkan rentang tahun jika tersedia
        if ($startYear && $endYear) {
            $query->whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"]);
        } elseif ($startYear) {
            $query->whereYear('created_at', '>=', $startYear);
        } elseif ($endYear) {
            $query->whereYear('created_at', '<=', $endYear);
        }
    
        // Ambil data hasil query dan format bulan/tahun
        $dokumenmud = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });
    
        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = mud::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
    
        // Kirim data ke view
        return view('rate-contract/asteng/mud/index', compact('dokumenmud', 'tahunList'));
    }

        public function detail($id)
        {
            $dokumenmud = mud::where('id', $id)->get()->first();

            return view('rate-contract/asteng/mud/detail', compact('dokumenmud'));
        }
    public function tambah()
    {
        return view('rate-contract/asteng/mud/tambah');
    }
    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = mud::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/mud')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Konversi input ke tipe data numerik
        $mud_removal_load_and_haul = (float) $request->mud_removal_load_and_haul;
        $currency_adjustment = (float) $request->currency_adjustment;
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal
        $name_contract =  $request->name_contract;
        // Perhitungan rate_actual
        $rate_actual = $mud_removal_load_and_haul
            * $currency_adjustment
            * (1 + $premium_rate)
            * (1 + $general_escalation);


        // Simpan data ke tabel mud
        mud::create([
            'mud_removal_load_and_haul' => $mud_removal_load_and_haul,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
            'name_contract' => $name_contract,
            'rate_actual' => $rate_actual,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);

        return redirect()->to('rate-contract/asteng/mud')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $dokumenmud = mud::findOrFail($id);
        return view('rate-contract/asteng/mud/edit', compact('dokumenmud'));
    }

    public function update(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'mud_removal_load_and_haul' => 'required|numeric',
            'currency_adjustment' => 'required|numeric',
            'premium_rate' => 'required|numeric',
            'general_escalation' => 'required|numeric',
            'name_contract' => 'required',
        ]);

        // Konversi input ke tipe data numerik
        $mud_removal_load_and_haul = (float) $request->mud_removal_load_and_haul;
        $currency_adjustment = (float) $request->currency_adjustment;
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal
        $name_contract =  $request->name_contract;

        $dokumenmud = mud::findOrFail($id);
        $path = $dokumenmud->contract_reference;
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }


        // Perhitungan rate_actual
        $rate_actual = $mud_removal_load_and_haul
            * $currency_adjustment
            * (1 + $premium_rate)
            * (1 + $general_escalation);

        $dokumenmud->mud_removal_load_and_haul = $mud_removal_load_and_haul;
        $dokumenmud->currency_adjustment = $currency_adjustment;
        $dokumenmud->premium_rate = $request->premium_rate; // Nilai asli dalam persen
        $dokumenmud->general_escalation = $request->general_escalation; // Nilai asli dalam persen
        $dokumenmud->name_contract = $name_contract;
        $dokumenmud->rate_actual = $rate_actual;
        $dokumenmud->contract_reference = $path;
        $dokumenmud->save();


        return redirect()->to('rate-contract/asteng/mud')->with('success', 'Data berhasil diperbarui');
    }
    public function hapus($id)
    {
        $dokumenmud = mud::findOrFail($id);

        $path = $dokumenmud->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        $dokumenmud->delete();

        return redirect()->to('rate-contract/asteng/mud');
    }
}
