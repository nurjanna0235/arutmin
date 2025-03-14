<?php

namespace App\Http\Controllers\user\astim_user;

use App\Models\pit_clearing_lcm;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PitClearingLCMUserController extends Controller
{
    public function index(Request $request)
{
    // Ambil input tahun dari request
    $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
    $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
    $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown

    // Query dasar untuk mengambil data
    $query = pit_clearing_lcm::query();

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

    // Ambil data hasil query dan format bulan/tahun
    $dokumenpit_clearing_lcm = $query->get()->map(function ($item) {
        $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
        return $item;
    });

    // Ambil daftar tahun unik untuk dropdown filter
    $tahunList = pit_clearing_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

    // Kirim data ke view
    return view('/user/rate-contract/astim/pitclearinglcm/index', compact('dokumenpit_clearing_lcm', 'tahunList'));
}


    public function detail($id)
    {
        $dokumenpit_clearing_lcm = pit_clearing_lcm::where('id', $id)->get()->first();

        return view('user/rate-contract/astim/pitclearinglcm/detail', compact('dokumenpit_clearing_lcm'));
    }
    public function view($id){
        $dokumenpit_clearing_lcm = pit_clearing_lcm::where('id', $id)->get()->first();

        return view('user/rate-contract/astim/pitclearinglcm/view', compact('dokumenpit_clearing_lcm'));
    }
}
