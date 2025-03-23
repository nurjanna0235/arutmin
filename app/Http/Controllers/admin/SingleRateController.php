<?php

namespace App\Http\Controllers\admin;

use App\Models\single_rate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SingleRateController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input Tahun Awal dan Tahun Akhir dari request
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
    
        // Query dasar untuk mengambil data
        $query = single_rate::query();
    
        // Filter berdasarkan rentang tahun jika tersedia
        if ($startYear && $endYear) {
            $query->whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"]);
        } elseif ($startYear) {
            $query->whereYear('created_at', '>=', $startYear);
        } elseif ($endYear) {
            $query->whereYear('created_at', '<=', $endYear);
        }
    
        // Ambil data hasil query dan format bulan/tahun
        $dokumensingle_rate = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });
    
        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = single_rate::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');
    
        // Kirim data ke view
        return view('rate-contract/asteng/singlerate/index', compact('dokumensingle_rate', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumensingle_rate = single_rate::where('id', $id)->get()->first();

        return view('rate-contract/asteng/singlerate/detail', compact('dokumensingle_rate'));
    }
    public function tambah()
    {
        return view('rate-contract/asteng/singlerate/tambah');
    }
    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = single_rate::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/single-rate')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
        $base_rate_ob = str_replace([','], ['.'], $request->total_base_rate_ob); // Total Base Rate OB (Rp/BCM)
        $base_rate_coal = str_replace([','], ['.'], $request->total_base_rate_coal); // Total Base Rate Coal (Rp/ton)
        $sr = str_replace([','], ['.'], $request->sr); // SR (Stripping Ratio)
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment); // Currency Adjustment
        $premium_rate = str_replace(['%'], [''], $request->premium_rate) / 100; // Premium Rate (%)
        $general_escalation = str_replace(['%'], [''], $request->general_escalation) / 100; // General Escalation (%)
        $name_contract =  $request->name_contract; 

        // Konversi menjadi float untuk perhitungan
        $base_rate_ob = (float) $base_rate_ob;
        $base_rate_coal = (float) $base_rate_coal;
        $sr = (float) $sr;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;
        $name_contract =  $name_contract;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = ($base_rate_ob * $sr + $base_rate_coal) * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Simpan ke database
        DB::table('single_rate')->insert([
            'total_base_rate_ob' => $request->total_base_rate_ob,
            'total_base_rate_coal' => $request->total_base_rate_coal,
            'sr' => $request->sr,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'name_contract' => $request->name_contract,
            'total_single_rate_actual' => $rate_actual,
            'contract_reference' => $path,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
        ]);

        return redirect()->to('rate-contract/asteng/single-rate')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dokumensingle_rate = single_rate::where('id', $id)->get()->first();

        return view('rate-contract/asteng/singlerate/edit', compact('dokumensingle_rate'));
    }

    public function update(Request $request, $id)
    {
        $dokumensingle_rate = single_rate::findOrFail($id);

        $path = $dokumensingle_rate->contract_reference;
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }


        // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
        $base_rate_ob = str_replace([','], ['.'], $request->total_base_rate_ob); // Total Base Rate OB (Rp/BCM)
        $base_rate_coal = str_replace([','], ['.'], $request->total_base_rate_coal); // Total Base Rate Coal (Rp/ton)
        $sr = str_replace([','], ['.'], $request->sr); // SR (Stripping Ratio)
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment); // Currency Adjustment
        $premium_rate = str_replace(['%'], [''], $request->premium_rate) / 100; // Premium Rate (%)
        $general_escalation = str_replace(['%'], [''], $request->general_escalation) / 100; // General Escalation (%)
        $name_contract =  $request->name_contract;
        // Konversi menjadi float untuk perhitungan
        $base_rate_ob = (float) $base_rate_ob;
        $base_rate_coal = (float) $base_rate_coal;
        $sr = (float) $sr;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;
        $name_contract = $name_contract;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = ($base_rate_ob * $sr + $base_rate_coal) * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Simpan ke database
        $dokumensingle_rate->update([
            'total_base_rate_ob' => $request->total_base_rate_ob,
            'total_base_rate_coal' => $request->total_base_rate_coal,
            'sr' => $request->sr,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'name_contract' => $request->name_contract,
            'total_single_rate_actual' => $rate_actual,
            'contract_reference' => $path,
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asteng/single-rate')->with('success', 'Data berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumensingle_rate = single_rate::findOrFail($id);

        $path = $dokumensingle_rate->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        $dokumensingle_rate->delete();

        return redirect()->to('rate-contract/asteng/single-rate');
    }
}
