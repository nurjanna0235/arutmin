<?php

namespace App\Http\Controllers\admin;

use App\Models\coal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Generator;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class CoalController extends Controller
{
    public function index()
    {
        $dokumencoal = coal::all();

        return view('dokumen/asteng/coal/index', compact('dokumencoal'));
    }
    public function detail($id)
    {
        $dokumencoal = coal::where('id', $id)->get()->first();
        return view('dokumen/asteng/coal/detail', compact('dokumencoal'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/coal/tambah');
    }
    public function simpan(Request $request)
    {
       
            // Input dari form
            $clean_coal = str_replace(',', '.', $request->clean_coal);
            $loading_and_ripping = str_replace(',', '.', $request->loading_and_ripping);
            $coal_hauling = str_replace(',', '.', $request->coal_hauling);
            $hrm = str_replace(',', '.', $request->hrm);
            $pit_support = str_replace(',', '.', $request->pit_support);
            $currency_adjustment = str_replace(',', '.', $request->currency_adjustment);
            $premium_rate = str_replace('%', '', $request->premium_rate) / 100;
            $general_escalation = str_replace('%', '', $request->general_escalation) / 100;
        
            // Hitung Sub Total Base Rate Coal
            $sub_total_base_rate_coal = $clean_coal + $loading_and_ripping + $coal_hauling + $hrm + $pit_support;
        
            // Hitung Total Rate Coal Actual
            $total_rate_coal_actual = $sub_total_base_rate_coal 
                * $currency_adjustment 
                * (1 + $premium_rate) 
                * (1 + $general_escalation);
        
            // Simpan ke database
            DB::table('coal_rates')->insert([
                'clean_coal' => $clean_coal,
                'loading_and_ripping' => $loading_and_ripping,
                'coal_hauling' => $coal_hauling,
                'hrm' => $hrm,
                'pit_support' => $pit_support,
                'sub_total_base_rate_coal' => $sub_total_base_rate_coal,
                'currency_adjustment' => $currency_adjustment,
                'premium_rate' => $request->premium_rate,
                'general_escalation' => $request->general_escalation,
                'total_rate_coal_actual' => $total_rate_coal_actual,
                'contract_reference' => $request->contract_reference,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
            return redirect()->to('dokumen/asteng/coal')->with('success', 'Data berhasil ditambahkan');
        }
    public function hapus($id)
    {
        $dokumencoal = coal::findOrFail($id);
        $dokumencoal->delete();

        return redirect()->to('dokumen/asteng/coal');
    }
}
