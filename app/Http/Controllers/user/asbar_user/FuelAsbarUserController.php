<?php

namespace App\Http\Controllers\user\asbar_user;
use App\Models\fuel_asbar;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FuelAsbarUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown
        $item = $request->input('item'); // Input filter item
    
        // Query dasar untuk mengambil data
        $query = fuel_asbar::query();
    
        // Filter berdasarkan rentang tahun jika tahun awal dan tahun akhir diberikan
        if ($tahunAwal && $tahunAkhir) {
            $query->whereYear('created_at', '>=', $tahunAwal)
                  ->whereYear('created_at', '<=', $tahunAkhir);
        } elseif ($tahunAwal) {
            // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
            $query->whereYear('created_at', '>=', $tahunAwal);
        } elseif ($tahunAkhir) {
            // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
            $query->whereYear('created_at', '<=', $tahunAkhir);
        }
    
        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }
    
        // Filter berdasarkan item
        if ($item) {
            $query->where('item', $item);
        }
    
        // Ambil data hasil query dan format bulan/tahun
        $dokumenfuelasbar = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });
    
        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = fuel_asbar::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
    
        // Kirim data ke view
        return view('/user/rate-contract/asbar/fuelasbar/index', compact('dokumenfuelasbar', 'tahunList'));
    }
    

    public function detail($id)
    {
        $dokumenfuelasbar = fuel_asbar::where('id', $id)->get()->first();
        return view('user/rate-contract/asbar/fuelasbar/detail', compact('dokumenfuelasbar'));
    }

}
