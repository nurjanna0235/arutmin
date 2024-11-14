<?php

namespace App\Http\Controllers\admin;
use App\Models\ob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OBController extends Controller
{
    public function index()
    {
        $dokumenob = ob::all();
       
        return view('dokumen/asteng/ob/index',compact('dokumenob'));
    }
    public function detail($id)
    {
            $dokumenob = ob::where('id',$id)->get()->first();
        return view('dokumen/asteng/ob/detail',compact('dokumenob'));
    }
    public function tambah()
    {
        return view('dokumen/asteng/ob/tambah');
    }

    public function simpan(Request $request)
    {
        
        ob::create([
            'load_and_haul' => $request->load_and_haul,
            'drill_and_blast' => $request->drill_and_blast,
            'pit_support' => $request->pit_support,
            'pit_lighting' => $request->pit_lighting,
            'hrm' => $request->hrm,
            'dump_maintenance' => $request->dump_maintenance,
            'dewatering_sediment' => $request->dewatering_sediment,
            'sub_total_base_rate_ob' => $request->sub_total_base_rate_ob,
            'sr' => $request->sr,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'total_rate_ob_actual' => $request->total_rate_ob_actual,
            'contract_reference' => $request->contract_reference,
        ]);

    return redirect()->to('dokumen/asteng/ob')->with('success', 'Dokumen berhasil ditambahkan');
}
public function hapus($id){
    $dokumenob = ob::findOrFail($id);
    $dokumenob->delete();

    return redirect()->to('dokumen/asteng/ob');
}
}