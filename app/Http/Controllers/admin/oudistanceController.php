<?php

namespace App\Http\Controllers\admin;

use App\Models\oudistance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class oudistanceController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');
        $item = $request->input('item'); // Input filter item

        $startYear = $request->input('start_year');
    $endYear = $request->input('end_year');

        // Query dasar untuk mengambil data
        $query = oudistance::query();

        // Filter berdasarkan rentang tahun (start_year dan end_year)
        if ($startYear && $endYear) {
            $query->whereBetween('oudistance.created_at', ["$startYear-01-01", "$endYear-12-31"]);
        } elseif ($startYear) {
            $query->whereYear('oudistance.created_at', '>=', $startYear);
        } elseif ($endYear) {
            $query->whereYear('oudistance.created_at', '<=', $endYear);
        } elseif ($tahun) {
            $query->whereYear('oudistance.created_at', $tahun);
        }

        // Filter berdasarkan item
        if ($item) {
            $query->where('item', $item);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenoudistance = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = oudistance::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('rate-contract/asteng/oudistance/index', compact('dokumenoudistance', 'tahunList'));
    }


    public function detail($id)
    {
        $dokumenoudistance = oudistance::where('id', $id)->get()->first();
        return view('rate-contract/asteng/oudistance/detail', compact('dokumenoudistance'));
    }
    public function tambah()
    {
        return view('rate-contract/asteng/oudistance/tambah');
    }
    public function simpan(Request $request)
    {
        $tanggalInput = now(); // Ambil waktu saat ini
        $dokument = oudistance::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/oudistance')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Validasi input
        // $request->validate([
        //     'activity' => 'required',
        //     'item' => 'required',
        //     'base_rate' => 'required',
        //     'actual_rate' => 'required',
        //     'contractual_distance_km' => 'required',
        //     'contract_reference' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        //     'currency_adjustment' => 'required',
        //     'premium_rate' => 'nullable',
        //     'general_escalation' => 'nullable',
        // ]);

        // Proses data input
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $actual_rate = str_replace([','], ['.'], $request->actual_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $actual_rate = (float) $actual_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;

        $actual_rate = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // simpan data ke database
        oudistance::insert([
            'activity' => $request->activity,
            'item' => $request->item,
            'base_rate' => $request->base_rate,
            'actual_rate' => $actual_rate,
            'contractual_distance_km' => $request->contractual_distance_km,
            'contract_reference' => $path,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'created_at' => now(),
        ]);

        return redirect()->to('rate-contract/asteng/oudistance')->with('success', 'Rate contract berhasil ditambahkan');
    }

    public function edit($id)
    {
        $dokumenoudistance = oudistance::where('id', $id)->get()->first();
        return view('rate-contract/asteng/oudistance/edit', compact('dokumenoudistance'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        // $request->validate([
        //     'activity' => 'required',
        //     'item' => 'required',
        //     'base_rate' => 'required',
        //     'contractual_distance_km' => 'required',
        //     'currency_adjustment' => 'required',
        //     'premium_rate' => 'required|min:0|max:100',
        //     'general_escalation' => 'required|min:0|max:100',
        //     'contract_reference' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        // ]);

        $dokumenoudistance = oudistance::find($id);

        // Proses upload file jika ada file baru
        $path = $dokumenoudistance->contract_reference; // Gunakan file lama jika tidak ada file baru
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $actual_rate = str_replace([','], ['.'], $request->actual_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $actual_rate = (float) $actual_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;

        $actual_rate = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Simpan ke database
        $dokumenoudistance->update([
            'activity' => $request->activity,
            'item' => $request->item,
            'base_rate' => $base_rate,
            'actual_rate' => $actual_rate,
            'contractual_distance_km' => $request->contractual_distance_km,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'contract_reference' => $path,
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asteng/oudistance')->with('success', 'Rate contract berhasil diupdate');
    }

    public function hapus($id)
    {
        $dokumenoudistance = oudistance::findOrFail($id);

        $path = $dokumenoudistance->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        $dokumenoudistance->delete();

        return redirect()->to('rate-contract/asteng/oudistance');
    }
}
