<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daywork_asbar;
use App\Models\daywork_lcm;
use App\Models\item_daywork_asbar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DayworkAsbarController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown
        $item = $request->input('item'); // Input filter item
    
        // Query dasar untuk mengambil data
        $query = daywork_asbar::join('item_daywork_asbar', 'item_daywork_asbar.id_item_daywork_asbar', '=', 'daywork_asbar.id_item_daywork_asbar');
    
        // Filter berdasarkan rentang tahun jika tahun awal dan tahun akhir diberikan
        if ($tahunAwal && $tahunAkhir) {
            $query->whereYear('daywork_asbar.created_at', '>=', $tahunAwal)
                  ->whereYear('daywork_asbar.created_at', '<=', $tahunAkhir);
        } elseif ($tahunAwal) {
            // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
            $query->whereYear('daywork_asbar.created_at', '>=', $tahunAwal);
        } elseif ($tahunAkhir) {
            // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
            $query->whereYear('daywork_asbar.created_at', '<=', $tahunAkhir);
        }
    
        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('daywork_asbar.created_at', $filterTahun);
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
        $tanggalInput = Carbon::parse($request->bulan);
        $dokument = daywork_asbar::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asbar/daywork-asbar')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        // Simpan file kontrak ke folder img
        $path = $request->file('contract_reference')->store('img', 'public');

        // Konversi input ke tipe data numerik
        $base_rate_exc_fuel = (float) $request->base_rate_exc_fuel;
        $currency_adjustment = (float) $request->currency_adjustment;
        $index = (float) $request->index; // Konversi persen ke desimal
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal
        $name_contract = $request->name_contract;

        // Perhitungan rate_actual
        $actual_rate_exc_fuel = $base_rate_exc_fuel * $currency_adjustment * $index * $general_escalation;

        // Simpan data ke tabel daywork
        daywork_asbar::create([
            'id_item_daywork_asbar' => $request->item,
            'currency_adjustment' => $currency_adjustment,
            'index' => $index, // Nilai asli dalam persen
            'premium_rate' => $premium_rate, // Nilai asli dalam persen
            'general_escalation' => $general_escalation, // Nilai asli dalam persen
            'name_contract' => $name_contract,
            'contract_reference' => $path,
            'actual_rate_exc_fuel' => $actual_rate_exc_fuel,
            'base_rate_exc_fuel' => $base_rate_exc_fuel,
            'created_at' => $request->bulan,
            'updated_at' => $request->bulan,
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
        $name_contract =  $request->name_contract;

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
            'name_contract' => $name_contract,
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

        $path = $dokumendaywork_asbar->contract_reference;
        if ($path) {
            Storage::disk('public')->delete($path);
        }

        $dokumendaywork_asbar->delete();


        return redirect()->to('rate-contract/asbar/daywork-asbar');
    }
}
