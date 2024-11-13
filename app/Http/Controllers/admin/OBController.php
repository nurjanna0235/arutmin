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
        // Upload file
 
    
        pit_clearing::create([
            'nama_dokumen' => $request->nama_dokumen,
      
        ]);
        return redirect()->route('dokumen/asteng/ob/simpan')->with('success', 'Dokumen berhasil ditambahkan');
    }
    public function delete($id){
        $dokumenpit_clearing = pit_clearing::findOrFail($id);
        $dokumenpit_clearing->delete();

        return redirect()->to('dokumen/asteng/ob/hapus/');
    }
    }