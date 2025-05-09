<?php

namespace App\Http\Controllers\admin;
use App\Models\coal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CoalController extends Controller
{
    public function index(Request $request)
{
    // Ambil input Tahun Awal dan Tahun Akhir dari request
    $startYear = $request->input('start_year');
    $endYear = $request->input('end_year');

    // Query dasar untuk mengambil data
    $query = coal::query();

    // Filter berdasarkan rentang tahun jika tersedia
    if ($startYear && $endYear) {
        $query->whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"]);
    } elseif ($startYear) {
        $query->whereYear('created_at', '>=', $startYear);
    } elseif ($endYear) {
        $query->whereYear('created_at', '<=', $endYear);
    }

    // Ambil data hasil query dan format bulan/tahun
    $dokumencoal = $query->orderByDesc('id')->get()->map(function ($item) {
        $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
        return $item;
    });

    // Ambil daftar tahun unik untuk dropdown filter
    $tahunList = coal::selectRaw('YEAR(created_at) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    // Kirim data ke view
    return view('rate-contract/asteng/coal/index', compact('dokumencoal', 'tahunList'));
}

    public function detail($id)
    {
        // Ambil data berdasarkan ID
        $dokumencoal = coal::where('id', $id)->get()->first();

        // Kirim data ke view
        return view('rate-contract/asteng/coal/detail', compact('dokumencoal'));
    }
    public function tambah()
    {
        return view('rate-contract/asteng/coal/tambah');
    }
    public function simpan(Request $request)
    {
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = coal::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/coal')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Konversi input ke tipe numerik
        $clean_coal = floatval(str_replace(',', '.', $request->clean_coal));
        $loading_and_ripping = floatval(str_replace(',', '.', $request->loading_and_ripping));
        $coal_hauling = floatval(str_replace(',', '.', $request->coal_hauling));
        $hrm = floatval(str_replace(',', '.', $request->hrm));
        $pit_support = floatval(str_replace(',', '.', $request->pit_support));
        $currency_adjustment = floatval(str_replace(',', '.', $request->currency_adjustment));
        $premium_rate = floatval(str_replace('%', '', $request->premium_rate)) / 100;
        $general_escalation = floatval(str_replace('%', '', $request->general_escalation)) / 100;
        $name_contract = $request->name_contract;

        // Hitung Sub Total Base Rate Coal
        $sub_total_base_rate_coal = $clean_coal + $loading_and_ripping + $coal_hauling + $hrm + $pit_support;

        // Hitung Total Rate Coal Actual
        $total_rate_coal_actual = $sub_total_base_rate_coal
            * $currency_adjustment
            * (1 + $premium_rate)
            * (1 + $general_escalation);

        // Simpan ke database
        $coal = new coal();
        $coal->clean_coal = $clean_coal;
        $coal->loading_and_ripping = $loading_and_ripping;
        $coal->coal_hauling = $coal_hauling;
        $coal->hrm = $hrm;
        $coal->pit_support = $pit_support;
        $coal->sub_total_base_rate_coal = $sub_total_base_rate_coal;
        $coal->currency_adjustment = $currency_adjustment;
        $coal->premium_rate = $request->premium_rate;
        $coal->general_escalation = $request->general_escalation;
        $coal->name_contract = $name_contract;
        $coal->total_rate_coal_actual = $total_rate_coal_actual;
        $coal->created_at = $request->bulan;
        $coal->contract_reference = $path;
        $coal->save();

        // Redirect atau tampilkan view dengan pesan sukses
        return redirect()->to('rate-contract/asteng/coal')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $dokumen_coal = coal::where('id', $id)->get()->first();

        return view('rate-contract/asteng/coal/edit', compact('dokumen_coal'));
    }

    public function update(Request $request, $id)
    {

        $dokumen_coal = coal::where('id', $id)->get()->first(); // Ambil data sebelumnya

        // Konversi input ke tipe numerik
        $clean_coal = floatval(str_replace(',', '.', $request->clean_coal));
        $loading_and_ripping = floatval(str_replace(',', '.', $request->loading_and_ripping));
        $coal_hauling = floatval(str_replace(',', '.', $request->coal_hauling));
        $hrm = floatval(str_replace(',', '.', $request->hrm));
        $pit_support = floatval(str_replace(',', '.', $request->pit_support));
        $currency_adjustment = floatval(str_replace(',', '.', $request->currency_adjustment));
        $premium_rate = floatval(str_replace('%', '', $request->premium_rate)) / 100;
        $general_escalation = floatval(str_replace('%', '', $request->general_escalation)) / 100;
        $name_contract = $request->name_contract;

        // Hitung Sub Total Base Rate Coal
        $sub_total_base_rate_coal = $clean_coal + $loading_and_ripping + $coal_hauling + $hrm + $pit_support;

        // Hitung Total Rate Coal Actual
        $total_rate_coal_actual = $sub_total_base_rate_coal
            * $currency_adjustment
            * (1 + $premium_rate)
            * (1 + $general_escalation);

            $path = $dokumen_coal->contract_reference;
            if ($request->hasFile('contract_reference')) {
                // Hapus file lama jika ada
                if ($path) {
                    Storage::disk('public')->delete($path);
                }
                // Simpan file baru
                $path = $request->file('contract_reference')->store('img', 'public');
            }

        // Simpan ke database
        $dokumen_coal->clean_coal = $clean_coal;
        $dokumen_coal->loading_and_ripping = $loading_and_ripping;
        $dokumen_coal->coal_hauling = $coal_hauling;
        $dokumen_coal->hrm = $hrm;
        $dokumen_coal->pit_support = $pit_support;
        $dokumen_coal->sub_total_base_rate_coal = $sub_total_base_rate_coal;
        $dokumen_coal->currency_adjustment = $currency_adjustment;
        $dokumen_coal->premium_rate = $premium_rate;
        $dokumen_coal->general_escalation = $general_escalation;
        $dokumen_coal->name_contract = $name_contract;
        $dokumen_coal->total_rate_coal_actual = $total_rate_coal_actual;
        $dokumen_coal->contract_reference = $path;
        // Data tambahan
        $dokumen_coal->save();

        return redirect()->to('rate-contract/asteng/coal')->with('success', 'Data berhasil diubah');
    }

    public function hapus($id)
    {
        $dokumencoal = coal::findOrFail($id);

        $path = $dokumencoal->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        $dokumencoal->delete();

        return redirect()->to('rate-contract/asteng/coal');
    }
}
