<?php

namespace App\Http\Controllers\user;

use App\Models\fuel;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FuelUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $item = $request->input('item'); // Input filter item

        // Query dasar untuk mengambil data
        $query = fuel::query();

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

        // Filter berdasarkan item
        if ($item) {
            $query->where('item', $item);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumenfuel = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = fuel::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Kirim data ke view
        return view('/user/rate-contract/asteng/fuel/index', compact('dokumenfuel', 'tahunList'));
    }

    public function detail($id)
    {
        $dokumenfuel = fuel::where('id', $id)->get()->first();

        return view('/user/rate-contract/asteng/fuel/detail', compact('dokumenfuel'));
    }
}
