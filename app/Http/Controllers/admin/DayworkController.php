<?php

namespace App\Http\Controllers\admin;

use App\Models\daywork;
use App\Models\value_daywork;
use App\Models\item_daywork;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DayworkController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari request
        $tahun = $request->input('tahun');
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');
        $item = $request->input('item'); // Input filter item
    
        // Query dasar untuk mengambil data
        $query = daywork::join('item_daywork', 'item_daywork.id_item', '=', 'daywork.id_item')
                        ->join('value_daywork', 'value_daywork.id_daywork', '=', 'daywork.id_daywork');
    
        // Filter berdasarkan rentang tahun (start_year dan end_year)
        if ($startYear && $endYear) {
            $query->whereBetween('daywork.created_at', ["$startYear-01-01", "$endYear-12-31"]);
        } elseif ($startYear) {
            $query->whereYear('daywork.created_at', '>=', $startYear);
        } elseif ($endYear) {
            $query->whereYear('daywork.created_at', '<=', $endYear);
        } elseif ($tahun) {
            $query->whereYear('daywork.created_at', $tahun);
        }
    
        // Filter berdasarkan item
        if ($item) {
            $query->where('item_daywork.id_item', $item);
        }
    
        // Eksekusi query dan format data
        $dokumendaywork = $query->get()->map(function ($item) {
            // Memformat atribut tanggal jika ada
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Atur nama kolom sesuai kebutuhan
            return $item;
        });
    
        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = daywork::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
    
        // Ambil daftar item untuk dropdown filter
        $itemList = item_daywork::select('id_item', 'nama_item')->distinct()->get();
    
        return view('rate-contract/asteng/daywork/index', compact('dokumendaywork', 'tahunList', 'itemList'));
    }
      public function detail($id)
    {
        $dokumendaywork = daywork::where('id_daywork', $id)->get()->first();
        return view('rate-contract/asteng/daywork/detail', compact('dokumendaywork'));
    }

    public function tambah()
    {
        $item = DB::table('item_daywork')->get();
        return view('rate-contract/asteng/daywork/tambah', compact('item'));
    }

    public function edit($id)
    {
        $dokumendaywork = daywork::join('item_daywork', 'item_daywork.id_item', '=', 'daywork.id_item')
            ->join('value_daywork', 'value_daywork.id_daywork', '=', 'daywork.id_daywork')
            ->where('daywork.id_daywork', $id)
            ->get()
            ->first();

        $item = DB::table('item_daywork')->get();
        return view('rate-contract/asteng/daywork/edit', compact('dokumendaywork', 'item'));
    }

    public function update(Request $request, $id)
    {

        // Konversi input ke tipe data numerik
        $base_rate_exc_fuel = (float) $request->base_rate_exc_fuel;
        $fbr = (float) $request->fbr;
        $currency_adjustment = (float) $request->currency_adjustment;
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

        // Perhitungan rate_actual
        $actual_rate_exc_fuel = $base_rate_exc_fuel * $currency_adjustment;

        $dokumen = daywork::where('id_daywork', $id)->first();

        $path = $dokumen->contract_reference;
        if ($request->hasFile('contract_reference')) {
            // Hapus file lama jika ada
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }

        $dokumen = daywork::where('id_daywork', $id)->update([
            'id_item' => $request->item,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
            'contract_reference' => $path,
        ]);

        // Proses upload file jika ada file baru
        value_daywork::where('id_daywork', $id)->update([
            'id_daywork' => $id,
            'base_rate_exc' => $base_rate_exc_fuel,
            'actual_rate_exc' => $actual_rate_exc_fuel,
            'fbr' => $fbr,
        ]);

        return redirect()->to('rate-contract/asteng/daywork')->with('success', 'Data berhasil diupdate');
    }

    public function simpan(Request $request)
    {
        $tanggalInput = now(); // Ambil waktu saat ini
        $dokument = daywork::whereYear('created_at', $tanggalInput->year)
            ->whereMonth('created_at', $tanggalInput->month)
            ->first();

        if ($dokument) {
            return redirect()->to('rate-contract/asteng/daywork')->with('error', 'Data untuk bulan ini sudah ada.');
        }
        $path = $request->file('contract_reference')->store('img', 'public');

        // Konversi input ke tipe data numerik
        $base_rate_exc_fuel = (float) $request->base_rate_exc_fuel;
        $fbr = (float) $request->fbr;
        $currency_adjustment = (float) $request->currency_adjustment;
        $premium_rate = (float) $request->premium_rate / 100; // Konversi persen ke desimal
        $general_escalation = (float) $request->general_escalation / 100; // Konversi persen ke desimal

        // Perhitungan rate_actual
        $actual_rate_exc_fuel = $base_rate_exc_fuel * $currency_adjustment;

        // Simpan data ke tabel daywork
        daywork::create([
            'id_item' => $request->item,
            'currency_adjustment' => $currency_adjustment,
            'premium_rate' => $request->premium_rate, // Nilai asli dalam persen
            'general_escalation' => $request->general_escalation, // Nilai asli dalam persen
            'contract_reference' => $path,
        ]);
        value_daywork::create([
            'id_daywork' => DB::getPdo()->lastInsertId(),
            'base_rate_exc' => $base_rate_exc_fuel,
            'actual_rate_exc' => $actual_rate_exc_fuel,
            'fbr' => $actual_rate_exc_fuel,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->to('rate-contract/asteng/daywork')->with('success', 'Data berhasil ditambahkan');
    }
    public function hapus($id)
    {
        $dokumensdaywork = daywork::findOrFail($id);
        $dokumensdaywork->delete();

        value_daywork::where('id_daywork', $dokumensdaywork->id_daywork)->delete();

        return redirect()->to('rate-contract/asteng/daywork');
    }
}
