<?php

namespace App\Http\Controllers;
use App\Services\SomeConcreteClass;

use Illuminate\Http\Request;

class RateContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('rate-contract.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rate-contract.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_rate-contract' => 'required|string|max:255',
        'path' => 'required|file'
    ]);

    // Upload file
    $path = $request->file('path')->store('rate-contract');

    // Simpan data dokumen
    Dokumen::create([
        'nama_dokumen' => $request->nama_dokumen,
        'path' => $path,
    ]);

    return redirect()->route('dokumen.index')->with('success', 'Data berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('dokumen.show', compact('dokumen'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $dokumen = Dokumen::findOrFail($id);
    return view('dokumen.edit', compact('dokumen'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'path' => 'nullable|file'
        ]);
    
        $dokumen = Dokumen::findOrFail($id);
    
        if ($request->hasFile('path')) {
            $path = $request->file('path')->store('dokumen');
            $dokumen->update([
                'nama_dokumen' => $request->nama_dokumen,
                'path' => $path,
            ]);
        } else {
            $dokumen->update([
                'nama_dokumen' => $request->nama_dokumen,
            ]);
        }
    
        return redirect()->route('dokumen.index')->with('success', 'Data berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $dokumen = Dokumen::findOrFail($id);
    $dokumen->delete();

    return redirect()->route('dokumen.index')->with('success', 'Data berhasil dihapus');
}
}
