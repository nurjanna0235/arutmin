<?php

namespace App\Http\Controllers\user\astim_user;

use App\Models\pit_clearing_lcm;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\top_soil_lcm;
use Illuminate\Http\Request;

class TopSoilLCMUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = pit_clearing_lcm::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumentop_soil_lcm = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = top_soil_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('user/rate-contract/astim/topsoillcm/index', compact('dokumentop_soil_lcm', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumentop_soil_lcm = top_soil_lcm::where('id', $id)->get()->first();

        return view('user/rate-contract/astim/topsoillcm/detail', compact('dokumentop_soil_lcm'));
    }

}
