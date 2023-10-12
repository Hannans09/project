<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use Illuminate\Http\Request;

class alternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatif = alternatif::all();
        return view('alternatif.index', ['alternatif' => $alternatif]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alternatif.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        alternatif::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('alternatif.create')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alternatif = alternatif::findOrFail($id);
        return view('alternatif.edit', compact('alternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        $alternatif = alternatif::findOrFail($id);

        $alternatif->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('alternatif.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alternatif = alternatif::findOrFail($id);
        $alternatif->delete();
        return redirect()->route('alternatif.index')->with(['success' => 'Data Berhasil di Hapus!']);
    }
}
