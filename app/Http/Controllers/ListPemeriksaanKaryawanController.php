<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisPemeriksaan;
use Illuminate\Http\Request;
use App\Models\TransaksiPemeriksaan;
use App\Models\DetailPendaftaranPemeriksaan;
use App\Models\DetailPemeriksaan;
use App\Models\PendaftaranPemeriksaan;
use Illuminate\Support\Facades\DB;

class ListPemeriksaanKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        DB::statement("SET sql_mode = ''");
        $data = DB::table('transaksi_pemeriksaan as tp')->join('pendaftaran_pemeriksaan as pp', 'tp.nomorPendaftaran', '=', 'pp.nomorPendaftaran')->leftJoin('detail_pemeriksaan as dp', 'tp.nomorPemeriksaan', '=', 'dp.nomorPemeriksaan')->groupBy('tp.nomorPemeriksaan')->join('karyawan as k', 'k.idKaryawan', '=', 'tp.idKaryawanRadiografer')->join('dokter as d', 'd.idDokter', '=', 'tp.idKaryawanDokterRadiologi')->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')->join('users as u_karyawan', 'u_karyawan.id', '=', 'k.idUser')->join('users as u_dokter', 'u_dokter.id', '=', 'd.idUser')->join('users as u_pasien', 'u_pasien.id', '=', 'p.idUser')->select('tp.*', 'pp.*', 'tp.tanggalPemeriksaan', 'dp.jamMulaiPemeriksaanAlat', 'dp.jamSelesaiPemeriksaanAlat', 'dp.ruangan', 'u_karyawan.name as karyawan_name', 'u_dokter.name as dokter_name', 'u_pasien.name as pasien_name')->get();

        // dd($data);
        return view('karyawan.list-pemeriksaan-karyawan', compact('data'));
    }

    public function showDetail($id)
    {
        $detail = TransaksiPemeriksaan::join('detail_pemeriksaan', 'detail_pemeriksaan.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')->join('pendaftaran_pemeriksaan', 'pendaftaran_pemeriksaan.nomorPendaftaran', '=', 'transaksi_pemeriksaan.nomorPendaftaran')->where('detail_pemeriksaan.nomorPemeriksaan', '=', $id)->select('transaksi_pemeriksaan.*', 'pendaftaran_pemeriksaan.*', 'detail_pemeriksaan.*')->paginate(10);


        $idPem =  $id;
        $pendaftaran = PendaftaranPemeriksaan::join('transaksi_pemeriksaan as tp', 'tp.nomorPendaftaran', '=', 'pendaftaran_pemeriksaan.nomorPendaftaran')
        ->select('*')->where('tp.nomorPemeriksaan',$id)
        ->first();

        $detailPendaftaran = DetailPendaftaranPemeriksaan::join('master_jenis_pemeriksaan as mjp', 'detail_pendaftaran.kodeJenisPemeriksaan', '=', 'mjp.kodeJenisPemeriksaan')
        ->select('*')->where('detail_pendaftaran.noPendaftaran', $pendaftaran->nomorPendaftaran)->select('*')->get();
        // dd($detailPendaftaran);


        $diagnosis = TransaksiPemeriksaan::findOrFail($id)->diagnosis;
        $keterangan = TransaksiPemeriksaan::findOrFail($id)->keterangan;






        return view('karyawan.detail-pemeriksaan-karyawan', compact('detail', 'diagnosis', 'keterangan', 'detailPendaftaran'));
    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());

        $detailPemeriksaan = DetailPemeriksaan::findOrFail($request->idDPP);
        $detailPemeriksaan->update(['status' => $request->status]);

        return redirect()->back();
    }

    public function updateDiagnosisKeterangan(Request $request)
    {
        // dd($request->all());

        $pemeriksaan = TransaksiPemeriksaan::findOrFail($request->idPemeriksaan);
        $pemeriksaan->update([
            'diagnosis'=>$request->diagnosis,
            'keterangan'=>$request->keterangan,
        ]);
        return redirect()->back();
    }

    public function show($id)
    {
        $detail = TransaksiPemeriksaan::findOrFail($id);
        return response()->json($detail);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly createwwd resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

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
