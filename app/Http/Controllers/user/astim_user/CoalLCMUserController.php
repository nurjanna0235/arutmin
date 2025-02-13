<?php

namespace App\Http\Controllers\user\astim_user;
use Carbon\Carbon;
use App\Models\coal_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoalLCMUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = coal_lcm::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumencoal_lcm = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = coal_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('user/rate-contract/astim/coallcm/index', compact('dokumencoal_lcm', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumencoal_lcm = coal_lcm::where('id', $id)->get()->first();

        return view('user/rate-contract/astim/coallcm/detail', compact('dokumencoal_lcm'));
    }

}
