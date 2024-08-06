<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailHasilPemeriksaanRadiologi;
use Brick\Math\BigInteger;


class PendaftaranPemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $DetailHasilPemeriksaanRadiologi = DetailHasilPemeriksaanRadiologi::all();

        return view('isi_nanti', compact('DetailHasilPemeriksaanRadiologi'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DetailHasilPemeriksaanRadiologi::create([
            'idDetailHasilPemeriksaan' => $request->idDetailHasilPemeriksaan,
            'idHasilPemeriksaan' => $request->idHasilPemeriksaan,
            'kodeJenisPemeriksaan' => $request->kodeJenisPemeriksaan,
            'laporan' => $request->laporan
        ]);
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
        DetailHasilPemeriksaanRadiologi::update([
            'idDetailHasilPemeriksaan' => $request->idDetailHasilPemeriksaan,
            'idHasilPemeriksaan' => $request->idHasilPemeriksaan,
            'kodeJenisPemeriksaan' => $request->kodeJenisPemeriksaan,
            'laporan' => $request->laporan
        ]);

        return redirect()->route('isi_nanti')->with('success','Detail Pemeriksaan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $DetailHasilPemeriksaanRadiologi->delete();

        return redirect()->route('isi_nanti')->with('success','Detail Pemeriksaan berhasil dihapus');

    }
}
