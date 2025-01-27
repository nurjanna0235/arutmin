<?php

namespace App\Http\Controllers\admin\asbar_admin;

use App\Http\Controllers\Controller;
use App\Models\coal_hauling_to_pltu;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CoalHaulingtoPLTUController extends Controller
{
    public function index(Request $request)
    {
       // Ambil input tahun dari request
       $tahun = $request->input('tahun');
       $filterTahun = $request->input('filter_tahun');

       // Query dasar untuk mengambil data
       $query = coal_hauling_to_pltu::query();

       // Filter berdasarkan pencarian tahun
       if ($tahun) {
           $query->whereYear('created_at', $tahun);
       }

       // Filter berdasarkan dropdown filter_tahun
       if ($filterTahun) {
           $query->whereYear('created_at', $filterTahun);
       }

       // Ambil data hasil query dan format bulan/tahun
       $dokumencoalhauling = $query->get()->map(function ($item) {
           $item->bulan_tahun = Carbon::parse($item->created_at)->format('F Y'); // Format Bulan dan Tahun
           return $item;
       });
    

       // Ambil daftar tahun unik untuk dropdown filter
       $tahunList = coal_hauling_to_pltu::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun');

       // Kirim data ke view
       return view('rate-contract/asbar/coalhauling/index', compact('dokumencoalhauling', 'tahunList'));
   }


    public function tambah()
    {
        return view('rate-contract/asbar/coalhauling/tambah');
    }

    public function detail($id)
    {
        $dokumencoalhauling = coal_hauling_to_pltu::where('id', $id)->get()->first();

        return view('rate-contract/asbar/coalhauling/detail', compact('dokumencoalhauling'));
    }
    public function edit($id) 
    {  
        $dokumencoalhauling = coal_hauling_to_pltu::where('id', $id)->get()->first();
   
        return view('rate-contract/asbar/coalhauling/edit',compact('dokumencoalhauling'));
    }
    public function simpan(Request $request)
    {
        $path = $request->file('contract_reference')->store('img', 'public');

        // Mengganti koma dengan titik pada inputan untuk keperluan perhitungan
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ??0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ??0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);
        // Simpan ke database
        DB::table('coal_hauling_to_pltu')->insert([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'actual_rate' => $rate_actual,
            'contract_reference' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         // Redirect dengan pesan sukses
    return redirect()->to('rate-contract/asbar/coal-hauling')->with('success', 'Data berhasil ditambahkan');
        
    }
    public function update(Request $request, $id)
    {
         // Validasi input
         $request->validate([
            'base_rate' => 'required',
            'currency_adjustment' => 'required',
            'premium_rate' => 'nullable',
            'general_escalation' => 'nullable',
            // 'contract_reference' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Ambil data berdasarkan ID
        $dokumen = DB::table('coal_hauling_to_pltu')->where('id', $id)->first();

      // Proses upload file jika ada file baru
      $path = $dokumen->contract_reference; // Gunakan file lama jika tidak ada file baru
      if ($request->hasFile('contract_reference')) {
          // Hapus file lama jika ada
          if ($path) {
              Storage::disk('public')->delete($path);
          }
            
            // Simpan file baru
            $path = $request->file('contract_reference')->store('img', 'public');
        }

        // Proses data input
        $base_rate = str_replace([','], ['.'], $request->base_rate);
        $currency_adjustment = str_replace([','], ['.'], $request->currency_adjustment);
        $premium_rate = str_replace(['%'], [''], $request->premium_rate ?? 0) / 100;
        $general_escalation = str_replace(['%'], [''], $request->general_escalation ?? 0) / 100;

        // Konversi menjadi float untuk perhitungan
        $base_rate = (float) $base_rate;
        $currency_adjustment = (float) $currency_adjustment;
        $premium_rate = (float) $premium_rate;
        $general_escalation = (float) $general_escalation;

        // Hitung Rate Actual sesuai rumus
        $rate_actual = $base_rate * $currency_adjustment * (1 + $premium_rate) * (1 + $general_escalation);

        // Update data ke database
        DB::table('coal_hauling_to_pltu')->where('id', $id)->update([
            'base_rate' => $request->base_rate,
            'currency_adjustment' => $request->currency_adjustment,
            'premium_rate' => $request->premium_rate,
            'general_escalation' => $request->general_escalation,
            'actual_rate' => $rate_actual,
            'contract_reference' => $path,
            'updated_at' => now(),
        ]);
 // Redirect dengan pesan sukses
 return redirect()->to('rate-contract/asbar/coal-hauling')->with('success', 'Data berhasil diperbarui');
    }
    public function hapus($id)
    {
        $dokumencoalhauling = coal_hauling_to_pltu::findOrFail($id);
        $dokumencoalhauling->delete();

        return redirect()->to('rate-contract/asbar/coal-hauling');
    }
    }