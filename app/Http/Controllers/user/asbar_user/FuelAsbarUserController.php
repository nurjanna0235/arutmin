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
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');
        $item = $request->input('item'); // Input filter item

        // Query dasar untuk mengambil data
        $query = fuel_asbar::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }
        // Filter berdasarkan item
        if ($item) {
            $query->where('item', $item);
        }
        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenfuelasbar = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = fuel_asbar::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        return view('user/rate-contract/asbar/fuelasbar/index', compact('dokumenfuelasbar', 'tahunList'));
    }
    

    public function detail($id)
    {
        $dokumenfuelasbar = fuel_asbar::where('id', $id)->get()->first();
        return view('user/rate-contract/asbar/fuelasbar/detail', compact('dokumenfuelasbar'));
    }

}
