<?php

namespace App\Http\Controllers\user;
use App\Models\other;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherUserController extends Controller
{
    public function index(Request $request)
{
    // Ambil input Tahun Awal dan Tahun Akhir dari request
    $startYear = $request->input('start_year');
    $endYear = $request->input('end_year');

    // Query dasar untuk mengambil data
    $query = other::query();

    // Filter berdasarkan rentang tahun jika tersedia
    if ($startYear && $endYear) {
        $query->whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"]);
    } elseif ($startYear) {
        $query->whereYear('created_at', '>=', $startYear);
    } elseif ($endYear) {
        $query->whereYear('created_at', '<=', $endYear);
    }

    // Ambil data hasil query dan format bulan/tahun
    $dokumenother = $query->get()->map(function ($item) {
        $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
        return $item;
    });

    // Ambil daftar tahun unik untuk dropdown filter
    $tahunList = other::selectRaw('YEAR(created_at) as tahun')
        ->distinct()
        ->orderBy('tahun', 'desc')
        ->pluck('tahun');

    // Kirim data ke view
    return view('/user/rate-contract/asteng/other/index', compact('dokumenother', 'tahunList'));
    
}
    public function detail($id)
    {
        $dokumenother = other::where('id', $id)->get()->first();

        return view('/user/rate-contract/asteng/other/detail', compact('dokumenother'));
    }
}

