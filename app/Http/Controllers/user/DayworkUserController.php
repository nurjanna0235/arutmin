<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daywork;
use App\Models\item_daywork;
use Carbon\Carbon;

class DayworkUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');
        $item = $request->input('item'); // Input filter item
    
        // Query dasar untuk mengambil data
        $query = daywork::join('item_daywork', 'item_daywork.id_item', '=', 'daywork.id_item')
            ->join('value_daywork', 'value_daywork.id_daywork', '=', 'daywork.id_daywork');
    
        // Filter berdasarkan pencarian tahun
        if ($tahun) {
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
    
        return view('/user/rate-contract/asteng/daywork/index', compact('dokumendaywork', 'tahunList', 'itemList'));
    }
}