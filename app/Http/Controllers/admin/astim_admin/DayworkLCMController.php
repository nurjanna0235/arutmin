<?php

namespace App\Http\Controllers\admin\astim_admin;

use App\Models\daywork_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\item_daywork_lcm;
use App\Models\value_daywork_lcm;


class DayworkLCMController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
        $tahun = $request->input('tahun');
        $filterTahun = $request->input('filter_tahun');

        // Query dasar untuk mengambil data
        $query = daywork_lcm::query();

        // Filter berdasarkan pencarian tahun
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter berdasarkan dropdown filter_tahun
        if ($filterTahun) {
            $query->whereYear('created_at', $filterTahun);
        }

        // Ambil data hasil query dan format bulan/tahun
        $dokumendaywork_lcm = $query->get()->map(function ($item) {
            $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
            return $item;
        });

        $item_daywork_lcm = DB::table('item_daywork_lcm')->get();

        // Ambil daftar tahun unik untuk dropdown filter
        $tahunList = daywork_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

        return view('rate-contract/astim/dayworklcm/index', compact('dokumendaywork_lcm', 'item_daywork_lcm'));
    }

    public function tambah()
    {
        $item_daywork_lcm = DB::table('item_daywork_lcm')->get();

        return view('rate-contract/astim/dayworklcm/tambah', compact('item_daywork_lcm'));
    }
    public function simpan(Request $request)
    {

        $path = $request->file('contract_reference')->store('img', 'public');


        $id_daywork_lcm = daywork_lcm::insertGetId([
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $id_item = 1;

        foreach ($request->actual_rate as $key => $itemActual) {
            $itemFbr = $request->fbr[$key]; // Ambil elemen dengan indeks yang sama dari array `fbr`

            value_daywork_lcm::create([
                'id' => $id_daywork_lcm,
                'id_item_daywork_lcm' => $id_item++,
                'actual_rate' => $itemActual,
                'fbr' => $itemFbr,
            ]);
        }

        return redirect()->to('rate-contract/astim/daywork-lcm')->with('success', 'Data berhasil ditambahkan');
    }
}
