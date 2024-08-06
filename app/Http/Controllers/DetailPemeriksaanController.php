<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemeriksaan;

class DetailPemeriksaanController extends Controller
{

    public function index()
    {
        return view('dashboard',  ['user' => 'karyawan', 'page' => 'list-pemeriksaan']);  
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'nomorPemeriksaan' => 'required|max:255',
                'jamMulaiPemeriksaanAlat' => '',
                'jamSelesaiPemeriksaanAlat' => '',
                'ruangan' => '',
                'keterangan' => '',
                'diskon' => '',
                'hargaTotal' => '',
                'status' => '',
            ]
            );
            DetailPemeriksaan::create($request->all());
            return redirect()->route('dashboard');
    }

    public function show (Request $request)
    {

    }

    public function edit(Request $request, DetailPemeriksaan $detailpemeriksaan)
    {
        $detailpemeriksaan->update([
            'nomorPemeriksaan' => $request->nomorPemeriksaan,
            'jamMulaiPemeriksaanAlat' => $request->jamMulaiPemeriksaanAlat,
            'jamSelesaiPemeriksaanAlat' => $request->jamSelesaiPemeriksaanAlat,
            'ruangan' => $request->ruangan,
            'keterangan' => $request->keterangan,
            'diskon' => $request->diskon,
            'hargaTotal' => $request->hargaTotal,
            'status' => $request->status,
        ]);
        return redirect()->route('dashboard')->with('success', 'Detail Pemeriksaan berhasil diubah');
    }

    public function destroy(DetailPemeriksaan $detailpemeriksaan)
    {
        $detailpemeriksaan->delete();

        return redirect()->route('dashboard')->with('success', 'Detail Pemeriksaan berhasil dihapus');
    }
}
