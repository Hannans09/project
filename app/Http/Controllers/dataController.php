<?php

namespace App\Http\Controllers;

use App\Models\data;
use App\Models\kriteria;
use App\Models\alternatif;
use Illuminate\Http\Request;

class dataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = data::with('kriteria')->latest()->paginate(5);
        return view('data.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = kriteria::all();
        $alternatif = alternatif::all();
        return view('data.create', compact('kriteria', 'alternatif'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kriteria_id' => 'required',
            'alternatif_id' => 'required',
            'value' => 'required'
        ]);

        data::create([
            'kriteria_id' => $request->kriteria_id,
            'alternatif_id' => $request->alternatif_id,
            'value' => $request->value
        ]);

        return redirect()->route('data.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
