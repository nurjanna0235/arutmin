<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\oudistance;
use Carbon\Carbon;

class oudistanceUserController extends Controller
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
        $dokumenoudistance = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = oudistance::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('/user/rate-contract/asteng/oudistance/index', compact('dokumenoudistance', 'tahunList'));
    }


    public function detail($id)
    {
        $dokumenoudistance = oudistance::where('id', $id)->get()->first();
        return view('/user/rate-contract/asteng/oudistance/detail', compact('dokumenoudistance'));
    }
}