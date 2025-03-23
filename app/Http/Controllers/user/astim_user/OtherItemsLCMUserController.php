<?php

namespace App\Http\Controllers\user\astim_user;
use Carbon\Carbon;
use App\Models\other_items_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherItemsLCMUserController extends Controller
{
    public function index(Request $request)
    {
         // Ambil input tahun dari request
         $tahunAwal = $request->input('start_year'); // Input untuk tahun awal
        $tahunAkhir = $request->input('end_year'); // Input untuk tahun akhir
        $filterTahun = $request->input('filter_tahun'); // Input untuk filter tahun dropdown

         // Query dasar untuk mengambil data
         $query = other_items_lcm::query();

          // Filter berdasarkan rentang tahun jika tahun awal dan tahun akhir diberikan
        if ($tahunAwal && $tahunAkhir) {
            $query->whereYear('other_items_lcm.created_at', '>=', $tahunAwal)
                ->whereYear('other_items_lcm.created_at', '<=', $tahunAkhir);
        } elseif ($tahunAwal) {
            // Filter berdasarkan tahun awal jika hanya tahun awal yang diberikan
            $query->whereYear('other_items_lcm.created_at', '>=', $tahunAwal);
        } elseif ($tahunAkhir) {
            // Filter berdasarkan tahun akhir jika hanya tahun akhir yang diberikan
            $query->whereYear('other_items_lcm.created_at', '<=', $tahunAkhir);
        }


         // Filter berdasarkan dropdown filter_tahun
         if ($filterTahun) {
             $query->whereYear('created_at', $filterTahun);
         }

         // Ambil data hasil query dan format bulan/tahun
         $dokumenother_items_lcm = $query->orderByDesc('id')->get()->map(function ($item) {
             $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
             return $item;
         });

         // Ambil daftar tahun unik untuk dropdown filter
         $tahunList = other_items_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

         // Kirim data ke view
         return view('/user/rate-contract/astim/otheritemslcm/index', compact('dokumenother_items_lcm', 'tahunList'));
     }

 

    public function detail($id)
    {
        $dokumenother_items_lcm = other_items_lcm::where('id', $id)->get()->first();

        return view('user/rate-contract/astim/otheritemslcm/detail', compact('dokumenother_items_lcm'));
    }
    public function view($id){
        $dokumenother_items_lcm = other_items_lcm::where('id', $id)->get()->first();

        return view('user/rate-contract/astim/otheritemslcm/view', compact('dokumenother_items_lcm'));
    }
}
