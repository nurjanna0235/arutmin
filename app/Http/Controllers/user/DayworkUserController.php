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
    
        $dokumendaywork = $query->orderByDesc('daywork.id_daywork')->get()->map(function ($item) {
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
    public function detail($id)
    {
        $dokumendaywork = daywork::where('id_daywork', $id)->get()->first();
        return view('/user/rate-contract/asteng/daywork/detail', compact('dokumendaywork'));
    }
}