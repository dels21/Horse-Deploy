<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPemeriksaanRadiologi;
use Brick\Math\BigInteger;


class PendaftaranPemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $HasilPemeriksaanRadiologi = HasilPemeriksaanRadiologi::all();

        return view('isi_nanti', compact('HasilPemeriksaanRadiologi'));

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
        HasilPemeriksaanRadiologi::create([
            'idHasilPemeriksaan'=> $request->idHasilPemeriksaan,
            'nomorPemeriksaan'=> $request->nomorPemeriksaan,
            'tanggalLaporan' => $request->tanggalLaporan,
            'idKaryawan'=> $request->idKaryawan
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
        HasilPemeriksaanRadiologi::update([
            'idHasilPemeriksaan'=> $request->idHasilPemeriksaan,
            'nomorPemeriksaan'=> $request->nomorPemeriksaan,
            'tanggalLaporan' => $request->tanggalLaporan,
            'idKaryawan'=> $request->idKaryawan
        ]);
        return redirect()->route('isi_nanti')->with('success','Pemeriksaan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $HasilPemeriksaanRadiologi->delete();

        return redirect()->route('isi_nanti')->with('success','Pemeriksaan berhasil dihapus');

    }
}
