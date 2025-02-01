<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    
    public function index()
    {
        $totalRateActualAsteng = DB::table('pit_clearing')
        ->whereYear('created_at', now()->year)
        ->sum('rate_actual');
        
        $totalTopSoilAsteng = DB::table('top_soil')
        ->whereYear('created_at', now()->year)
        ->sum('rate_actual');

        $total = $totalRateActualAsteng + $totalTopSoilAsteng;
       
       
        return view('admin.beranda.index');
    }
}
