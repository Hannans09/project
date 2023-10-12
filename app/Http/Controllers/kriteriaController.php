<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use Illuminate\Http\Request;

class kriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = kriteria::all();
        $totalBobot = $kriteria->sum('bobot');
        return view('kriteria.index', compact('kriteria', 'totalBobot'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'bobot' => 'required',
            'atribut' => 'required'
        ]);

        kriteria::create([
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut
        ]);

        return redirect()->route('kriteria.create')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kriteria = kriteria::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'bobot' => 'required',
            'atribut' => 'required'
        ]);

        $kriteria = kriteria::findOrFail($id);

        $kriteria->update([
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut
        ]);

        return redirect()->route('kriteria.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kriteria = kriteria::findOrFail($id);
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with(['success' => 'Data Berhasil di Hapus!']);
    }
}
