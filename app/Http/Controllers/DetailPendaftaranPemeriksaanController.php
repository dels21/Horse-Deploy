<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPendaftaranPemeriksaan;
use Brick\Math\BigInteger;


class PendaftaranPemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $DetailPendaftaranPemeriksaan = DetailPendaftaranPemeriksaan::all();

        return view('isi_nanti', compact('DetailPendaftaranPemeriksaan'));

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
        DetailPendaftaranPemeriksaan::create([
            'idDetailPendaftaranPemeriksaan' => $request->idDetailPendaftaranPemeriksaan,
            'noPendaftaran' => $request->noPendaftaran,
            'kodeJenisPemeriksaan' => $request->kodeJenisPemeriksaan,
            'jamMulai' => $request->jamMulai,
            'jamSelesai' => $request->jamSelesai,
            'statusKetersediaan' => $request->statusKetersediaan,
            'keteranganKetersediaan' => $request->keteranganKetersediaan
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
        DetailPendaftaranPemeriksaan::update([
            'idDetailPendaftaranPemeriksaan' => $request->idDetailPendaftaranPemeriksaan,
            'noPendaftaran' => $request->noPendaftaran,
            'kodeJenisPemeriksaan' => $request->kodeJenisPemeriksaan,
            'jamMulai' => $request->jamMulai,
            'jamSelesai' => $request->jamSelesai,
            'statusKetersediaan' => $request->statusKetersediaan,
            'keteranganKetersediaan' => $request->keteranganKetersediaan
        ]);

        return redirect()->route('isi_nanti')->with('success','Detail Pendaftaran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $DetailPendaftaranPemeriksaan->delete();

        return redirect()->route('isi_nanti')->with('success','Detail Pendaftaran berhasil dihapus');

    }
}
