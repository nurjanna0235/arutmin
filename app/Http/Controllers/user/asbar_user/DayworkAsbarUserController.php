<?php

namespace App\Http\Controllers\user\asbar_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\daywork_asbar;
use App\Models\item_daywork_asbar;
use Carbon\Carbon;



class DayworkAsbarUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');
        $item = $request->input('item');
        // Query dasar untuk mengambil data
        $query = daywork_asbar::join('item_daywork_asbar', 'item_daywork_asbar.id_item_daywork_asbar', '=', 'daywork_asbar.id_item_daywork_asbar');

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('daywork_asbar.created_at', $tahun);
        }

        // Filter berdasarkan item
        if ($item) {
            $query->where('item_daywork_asbar.id_item_daywork_asbar', $item);
        }

        // Eksekusi query dan format data
        $dokumendaywork = $query->get()->map(function ($item) {
            // Memformat atribut tanggal jika ada
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Atur nama kolom sesuai kebutuhan
            return $item;
        });

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = daywork_asbar::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        // Ambil daftar item untuk dropdown filter
        $itemList = item_daywork_asbar::select('id_item_daywork_asbar', 'nama_item')->distinct()->get();

        return view('user/rate-contract/asbar/dayworkasbar/index', compact('dokumendaywork', 'tahunList', 'itemList'));
    }
    public function detail($id)
    {
        $dokumendaywork_asbar = daywork_asbar::where('id_daywork_asbar', $id)->get()->first();

        return view('user/rate-contract/asbar/dayworkasbar/detail', compact('dokumendaywork_asbar'));
    }
}
