<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiPemeriksaan;
use App\Models\PendaftaranPemeriksaan;
use App\Models\DetailPendaftaranPemeriksaan;
use App\Models\DetailHasilPemeriksaanRadiologi;
use App\Models\Pasien;
use App\Models\User;

class PemeriksaanSayaController extends Controller
{
    public function showDetail($id) {
        $dataId = Auth::user()->id;
        $dataExists = Pasien::where('idUser', $dataId)->exists();
        $detail = TransaksiPemeriksaan::select('transaksi_pemeriksaan.*', 'pp.*', 'u.*', 'dp.*')
            ->join('detail_pemeriksaan as dp', 'dp.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')
            ->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')
            ->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')
            ->join('users as u', 'u.id', '=', 'p.idUser')
            ->where('dp.nomorPemeriksaan', '=', $id)
            ->paginate(10);

            $detailPemeriksaan = TransaksiPemeriksaan::select('transaksi_pemeriksaan.*', 'pp.*', 'dp.*')->join('detail_pemeriksaan as dp', 'dp.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')->where('dp.nomorPemeriksaan', '=', $id)->paginate(10);

            $detailPendaftaran = TransaksiPemeriksaan::select('*')->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')->join('detail_pendaftaran as dpp', 'pp.nomorPendaftaran', '=', 'dpp.noPendaftaran')->join('master_jenis_pemeriksaan as mjp', 'dpp.kodeJenisPemeriksaan', '=', 'mjp.kodeJenisPemeriksaan')->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')->join('users as u', 'u.id', '=', 'p.idUser')->where('transaksi_pemeriksaan.nomorPemeriksaan', '=', $id)->paginate(10);
            // dd($detailPendaftaran);
            $hasil = TransaksiPemeriksaan::join('hasil_pemeriksaan_radiologi as hpr', 'hpr.nomorPemeriksaan','=','transaksi_pemeriksaan.nomorPemeriksaan')->select('*')->where('transaksi_pemeriksaan.nomorPemeriksaan', $id)->first();
            if($hasil){
                // dd($hasil);
                $detailHasil = DetailHasilPemeriksaanRadiologi::select('*')->where('detail_hasil_pemeriksaan_radiologi.idHasilPemeriksaan', $hasil->idHasilPemeriksaan)->get();
                // $detailHasil = null;
            }
            else{
                // dd($hasil);
                $detailHasil = null;
            }

            // dd($detailHasil);

            return view('pasien.detail-pemeriksaan-pasien', compact('detail', 'dataExists', 'detailPemeriksaan', 'detailPendaftaran', 'detailHasil'));
        }

        public function showData(Request $request)
        {
            $dataId = Auth::user()->id;
            $dataExists = Pasien::where('idUser', $dataId)->exists();
            // Assuming you have some way of getting the logged-in user ID, let's say $loggedInUserId
            $loggedInUserId = Auth::user()->id;// This assumes you're using Laravel's authentication

            // Fetch the data using Eloquent relationships
            $data = TransaksiPemeriksaan::select('transaksi_pemeriksaan.*', 'pp.*', 'u.*')
            ->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')
            ->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')
            ->join('users as u', 'u.id', '=', 'p.idUser')
            // ->with('pendaftaranPemeriksaan.detailPendaftaran') // Eager load detailPendaftaran relationship
            ->where('u.id', '=', $loggedInUserId)
            ->paginate(10);


            // dd($data);
            return view('pasien.list-pemeriksaan-pasien', ['data' => $data, 'dataExists' => $dataExists, 'loggedInUserId' => $loggedInUserId]);
    }


}
