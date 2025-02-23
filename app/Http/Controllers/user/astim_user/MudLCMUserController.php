<?php

namespace App\Http\Controllers\user\astim_user;
use Carbon\Carbon;
use App\Models\mud_lcm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MudLCMUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input tahun dari request
         $tahun = $request->input('tahun');
         $filterTahun = $request->input('filter_tahun');
         // Query dasar untuk mengambil data
         $query = mud_lcm::query();
 
         // Filter berdasarkan pencarian tahun
         if ($tahun) {
             $query->whereYear('created_at', $tahun);
         }
 
         // Filter berdasarkan dropdown filter_tahun
         if ($filterTahun) {
             $query->whereYear('created_at', $filterTahun);
         }
 
         // Ambil data hasil query dan format bulan/tahun
         $dokumenmud_lcm = $query->get()->map(function ($item) {
             $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
             return $item;
         });
 
         // Ambil daftar tahun unik untuk dropdown filter
         $tahunList = mud_lcm::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
 
         // Kirim data ke view
         return view('user/rate-contract/astim/mudlcm/index', compact('dokumenmud_lcm', 'tahunList'));
     }
 

    public function detail($id)
    {
        $dokumenmud_lcm = mud_lcm::where('id', $id)->get()->first();

        return view('user/rate-contract/astim/mudlcm/detail', compact('dokumenmud_lcm'));
    }
}
