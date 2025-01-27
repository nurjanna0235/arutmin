<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daywork_asbar;
use App\Models\item_daywork_asbar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DayworkAsbarController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');
        $item = $request->input('item'); // Input filter item

        // Query dasar untuk mengambil data
        $query = daywork_asbar::join('item_daywork_asbar', 'item_daywork_asbar.id_item_daywork_asbar', '=', 'daywork_asbar.id_item_daywork_asbar');

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('daywork_asbar.created_at', $tahun);
        }

        // Filter berdasarkan item
        if ($item) {
            $query->where('item_daywork_asbar.id_item_daywork_asbar', $item);
        }

        // Eksekusi query dan format data
        $dokumendaywork = $query->get()->map(function ($item) {
            // Memformat atribut tanggal jika ada
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Atur nama kolom sesuai kebutuhan
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = daywork_asbar::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Ambil daftar item untuk dropdown filter
        $itemList = item_daywork_asbar::select('id_item_daywork_asbar', 'nama_item')->distinct()->get();

        return view('rate-contract/asbar/dayworkasbar/index', compact('dokumendaywork', 'tahunList', 'itemList'));
    }
    public function tambah()
    {
        $item = DB::table('item_daywork_asbar')->get();
        return view('rate-contract/asbar/dayworkasbar/tambah', compact('item'));
    }

    public function simpan(Request $request)
    {
        // Simpan file kontrak ke folder img
        $path = $request->file('contract_reference')->store('img', 'public');

        // Konversi input ke tipe data numerik
        $base_rate_exc_fuel = (float) $request->base_rate_exc_fuel;
        $national_suptent = (float) $request->national_suptent;
        $national_spv = (float) $request->national_spv;
        $operator = (float) $request->operator;
        $labour = (float) $request->labour;
        $mechanic = (float) $request->mechanic;
        $currency_adjustment = (float) $request->currency_adjustment;
        $index = (float) $request->index; // Konversi persen ke desimal
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

        // Perhitungan rate_actual
        $actual_rate_exc_fuel = $base_rate_exc_fuel * $currency_adjustment * $index * $general_escalation;

        // Simpan data ke tabel daywork
        daywork_asbar::create([
            'id_item_daywork_asbar' => $request->item,
            'currency_adjustment' => $currency_adjustment,
            'index' => $index, // Nilai asli dalam persen
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
            'contract_reference' => $path,
            'actual_rate_exc_fuel' => $actual_rate_exc_fuel,
            'base_rate_exc_fuel' => $base_rate_exc_fuel,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asbar/daywork-asbar')->with('success', 'Data berhasil ditambahkan');
    }

    public function detail($id)
    {
        $dokumendaywork_asbar = daywork_asbar::where('id_daywork_asbar', $id)->get()->first();
        
        return view('rate-contract/asbar/dayworkasbar/detail', compact('dokumendaywork_asbar'));
    }
    public function update(Request $request, $id)
    {
        // Konversi input ke tipe data numerik
        $id_item_daywork_asbar = (int) $request->item;
        $base_rate_exc_fuel = (float) $request->base_rate_exc_fuel;
        $currency_adjustment = (float) $request->currency_adjustment;
        $index = (float) $request->index; // Konversi persen ke desimal
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

        // Perhitungan rate_actual
        $actual_rate_exc_fuel = $base_rate_exc_fuel * $currency_adjustment * $index * $general_escalation;

        $dokumen = daywork_asbar::where('id_daywork_asbar', $id)->first();

        $path = $dokumen->contract_reference;
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }

        $dokumen = daywork_asbar::where('id_daywork_asbar', $id)->update([
            'id_item_daywork_asbar' => $id_item_daywork_asbar,
            'index' => $index,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
            'contract_reference' => $path,
            'actual_rate_exc_fuel' => $actual_rate_exc_fuel,
            'base_rate_exc_fuel' => $base_rate_exc_fuel,
            'updated_at' => now(),

        ]);


        return redirect()->to('rate-contract/asbar/daywork-asbar')->with('success', 'Data berhasil diupdate');
    }
    public function edit($id)
    {
        $dokumendaywork_asbar = daywork_asbar::join('item_daywork_asbar', 'item_daywork_asbar.id_item_daywork_asbar', '=', 'daywork_asbar.id_item_daywork_asbar')
            ->where('daywork_asbar.id_daywork_asbar', $id)
            ->get()
            ->first();
        $item = DB::table('item_daywork_asbar')->get();
        return view('rate-contract/asbar/dayworkasbar/edit', compact('dokumendaywork_asbar', 'item'));
    }
    public function hapus($id)
    {
        $dokumendaywork_asbar = daywork_asbar::findOrFail($id);
        $dokumendaywork_asbar->delete();


        return redirect()->to('rate-contract/asbar/daywork-asbar');
    }
}