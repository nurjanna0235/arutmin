<?php

namespace App\Http\Controllers\user;
use App\Models\top_soil;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopSoilUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input Tahun Awal dan Tahun Akhir dari request
        $startYear = $request->input('start_year');
        $endYear = $request->input('end_year');

        // Query dasar untuk mengambil data
        $query = top_soil::query();

        // Filter berdasarkan rentang tahun jika tersedia
        if ($startYear && $endYear) {
            $query->whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"]);
        } elseif ($startYear) {
            $query->whereYear('created_at', '>=', $startYear);
        } elseif ($endYear) {
            $query->whereYear('created_at', '<=', $endYear);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumentop_soil = $query->orderByDesc('id')->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = top_soil::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Kirim data ke view
        return view('/user/rate-contract/asteng/topsoil/index', compact('dokumentop_soil', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumentop_soil = top_soil::where('id', $id)->get()->first();

        return view('/user/rate-contract/asteng/topsoil/detail', compact('dokumentop_soil'));
    }
}
