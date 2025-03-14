<?php

namespace App\Http\Controllers\user\asbar_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daywork_asbar;
use App\Models\item_daywork_asbar;
use Carbon\Carbon;



class DayworkAsbarUserController extends Controller
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
    
        return view('/user/rate-contract/asbar/dayworkasbar/index', compact('dokumendaywork', 'tahunList', 'itemList'));
    }
    public function detail($id)
    {
        $dokumendaywork_asbar = daywork_asbar::where('id_daywork_asbar', $id)->get()->first();

        return view('user/rate-contract/asbar/dayworkasbar/detail', compact('dokumendaywork_asbar'));
    }
}
