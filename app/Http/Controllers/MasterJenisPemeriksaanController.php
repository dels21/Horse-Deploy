<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisPemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MasterJenisPemeriksaanController extends Controller
{

    public function index()
    {
        
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

            MasterJenisPemeriksaan::create($request->all());
            return redirect()->route('show_jenis_pemeriksaan');
    }
    public function show()
    {
        $joinKodeModalitas = DB::table('master_modalitas')
        ->select('*')
        ->get();

        $showJenisPemeriksaan = MasterJenisPemeriksaan::latest()->paginate(10);

        return view('karyawan.list-jenis-pemeriksaan', compact('showJenisPemeriksaan', 'joinKodeModalitas'));
    }

    public function edit(Request $request)
    {

        $pemeriksaan = MasterJenisPemeriksaan::findOrFail($request->kodeJenisPemeriksaan);
        $pemeriksaan->update($request->all());


        return redirect()->route('show_jenis_pemeriksaan')->with('success','Jenis pemeriksaan berhasil diupdate');
    }

    public function destroy($kodeJenisPemeriksaan)
    {

        MasterJenisPemeriksaan::destroy($kodeJenisPemeriksaan);

        return redirect()->route('show_jenis_pemeriksaan')->with('success', 'Jenis Pemeriksaan berhasil dihapus');
    }
}


