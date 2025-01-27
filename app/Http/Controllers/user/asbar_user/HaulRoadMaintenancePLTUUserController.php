<?php

namespace App\Http\Controllers\user\asbar_user;
use App\Models\haul_road_maintenance_pltu;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HaulRoadMaintenancePLTUUserController extends Controller
{
    public function index(Request $request)
    {
             // Ambil input tahun dari request
       $tahun = $request->input('tahun');
       $filterTahun = $request->input('filter_tahun');

       // Query dasar untuk mengambil data
       $query = haul_road_maintenance_pltu::query();

       // Filter berdasarkan pencarian tahun
       if ($tahun) {
           $query->whereYear('created_at', $tahun);
       }

       // Filter berdasarkan dropdown filter_tahun
       if ($filterTahun) {
           $query->whereYear('created_at', $filterTahun);
       }

       // Ambil data hasil query dan format bulan/tahun
       $dokumenhaulroadmaintenancepltu = $query->get()->map(function ($item) {
           $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
           return $item;
       });
    
       // Ambil daftar tahun unik untuk dropdown filter
       $tahunList = haul_road_maintenance_pltu::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');
        return view('user/rate-contract/asbar/haul-road-maintenance-pltu/index', compact('dokumenhaulroadmaintenancepltu', 'tahunList'));    
    }

   public function detail($id)
   {
       $dokumenhaulroadmaintenancepltu = haul_road_maintenance_pltu::where('id', $id)->get()->first();

       return view('user/rate-contract/asbar/haul-road-maintenance-pltu/detail', compact('dokumenhaulroadmaintenancepltu'));
   }

}
