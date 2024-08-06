<?php

namespace App\Http\Controllers;

use App\Models\DetailHasilPemeriksaanRadiologi;
use App\Models\DetailPemeriksaan;
use App\Models\DetailPendaftaranPemeriksaan;
use App\Models\Dokter;
use App\Models\HasilPemeriksaanRadiologi;
use App\Models\Pasien;
use App\Models\PendaftaranPemeriksaan;
use App\Models\TransaksiPemeriksaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanDokterController extends Controller
{
    public function showDetail($id)
    {
        $detailPemeriksaan = TransaksiPemeriksaan::select('transaksi_pemeriksaan.*', 'pp.*', 'dp.*')->join('detail_pemeriksaan as dp', 'dp.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')->where('dp.nomorPemeriksaan', '=', $id)->paginate(10);

        $detailPendaftaran = TransaksiPemeriksaan::select('*')->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')->join('detail_pendaftaran as dpp', 'pp.nomorPendaftaran', '=', 'dpp.noPendaftaran')->join('master_jenis_pemeriksaan as mjp', 'dpp.kodeJenisPemeriksaan', '=', 'mjp.kodeJenisPemeriksaan')->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')->join('users as u', 'u.id', '=', 'p.idUser')->where('transaksi_pemeriksaan.nomorPemeriksaan', '=', $id)->get();


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

        

        // $detail = TransaksiPemeriksaan::select('transaksi_pemeriksaan.*', 'pp.*', 'u.*', 'dp.*', 'p.*', 'dpp.*', 'jp.*')
        // ->join('detail_pemeriksaan as dp', 'dp.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')
        // ->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')
        // ->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')
        // ->join('users as u', 'u.id', '=', 'p.idUser')
        // ->join('detail_pendaftaran as dpp', 'dpp.noPendaftaran', '=', 'pp.nomorPendaftaran')
        // ->join('master_jenis_pemeriksaan as jp', 'jp.kodeJenisPemeriksaan', '=', 'dpp.kodeJenisPemeriksaan')
        // ->where('dp.idDetailPemeriksaan', '=', $id)
        // ->paginate(10);
        // dd($detail);


        return view('dokter.detail-pemeriksaan-dokter', compact('detailPemeriksaan', 'detailPendaftaran', 'detailHasil'));
    }

    public function showData()
    {
        // Assuming you have some way of getting the logged-in user ID, let's say $loggedInUserId
        // dd(Auth::user()->id);
        $loggedInUserId = Auth::user()->id; // This assumes you're using Laravel's authentication

        // Fetch the data using Eloquent relationships
        $data = TransaksiPemeriksaan::select('transaksi_pemeriksaan.*', 'pp.*', 'u.*', 'u.id', 'd.*')
            ->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')
            ->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')
            ->join('dokter as d', 'd.idDokter', '=', 'transaksi_pemeriksaan.idKaryawanDokterRadiologi')
            ->join('users as u', 'u.id', '=', 'p.idUser')
            // ->with('pendaftaranPemeriksaan.detailPendaftaran') // Eager load detailPendaftaran relationship
            ->where('d.idUser', $loggedInUserId)
            ->paginate(10);

        // dd($data);
        return view('dokter.list-pemeriksaan-dokter', compact('data', 'loggedInUserId'));
    }

    public function editDetail($id)
    {
        $details = TransaksiPemeriksaan::select('transaksi_pemeriksaan.*', 'pp.*', 'u.*', 'dp.*', 'p.*', 'dpp.*', 'jp.*')->join('detail_pemeriksaan as dp', 'dp.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')->join('users as u', 'u.id', '=', 'p.idUser')->join('detail_pendaftaran as dpp', 'dpp.noPendaftaran', '=', 'pp.nomorPendaftaran')->join('master_jenis_pemeriksaan as jp', 'jp.kodeJenisPemeriksaan', '=', 'dpp.kodeJenisPemeriksaan')->where('dp.idDetailPemeriksaan', '=', $id)->paginate(10);
        $detail = $details->first();

        // dd($details);
        return view('dokter.form_detail', compact('detail'));
    }

    public function updateDiagnosis(Request $request)
    {
        $request->validate(
            [
                'laporan' => 'required|string',
            ],
            [
                'laporan.required' => 'Hasil Pemeriksaan wajib diisi.',
            ],
        );

        // // dd($detailPemeriksaan);

        // dd($request->all());
        // $hasil = HasilPemeriksaanRadiologi::create([
        //     'nomorPemeriksaan' => $request->nomorPemeriksaan,
        //     'idDokter' => $request->idDokter,
        //     'tanggalLaporan' => $request->tanggalLaporan,
        // ]);
        $dokter = Dokter::where('idUser', Auth::user()->id)->firstOrFail();
        $hasil = HasilPemeriksaanRadiologi::firstOrCreate(
            ['nomorPemeriksaan' => $request->nomorPemeriksaan],
            [
                'idDokter' => $dokter->idDokter,
                'tanggalLaporan' => $request->tanggalLaporan,
            ],
        );

        $detailPemeriksaan = TransaksiPemeriksaan::select('transaksi_pemeriksaan.*', 'pp.*', 'dp.*')
            ->join('detail_pemeriksaan as dp', 'dp.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')
            ->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')
            ->where('dp.nomorPemeriksaan', '=', $request->nomorPemeriksaan)
            ->paginate(10);

        $detailPendaftaran = TransaksiPemeriksaan::select('*')
            ->join('pendaftaran_pemeriksaan as pp', 'transaksi_pemeriksaan.nomorPendaftaran', '=', 'pp.nomorPendaftaran')
            ->join('detail_pendaftaran as dpp', 'pp.nomorPendaftaran', '=', 'dpp.noPendaftaran')
            ->join('master_jenis_pemeriksaan as mjp', 'dpp.kodeJenisPemeriksaan', '=', 'mjp.kodeJenisPemeriksaan')
            ->join('pasien as p', 'p.idPasien', '=', 'pp.idPasien')
            ->join('users as u', 'u.id', '=', 'p.idUser')
            ->where('transaksi_pemeriksaan.nomorPemeriksaan', '=', $request->nomorPemeriksaan)
            ->paginate(10);

        // Example ID you want to find
        $targetId = $request->idDetailPemeriksaan;

        // Find the index of the target ID within the paginated results
        $index = $detailPemeriksaan->getCollection()->search(function ($item) use ($targetId) {
            return $item->idDetailPemeriksaan == $targetId;
        });

        // dd($detailPendaftaran[$index]->kodeJenisPemeriksaan);
        $hasil = HasilPemeriksaanRadiologi::firstOrCreate(
            ['nomorPemeriksaan' => $request->nomorPemeriksaan],
            [
                'idDokter' => $dokter->idDokter,
                'tanggalLaporan' => $request->tanggalLaporan,
            ],
        );

        // Check if the record exists
        $existingRecord = DetailHasilPemeriksaanRadiologi::where('idHasilPemeriksaan', $hasil->idHasilPemeriksaan)
            ->where('kodeJenisPemeriksaan', $detailPendaftaran[$index]->kodeJenisPemeriksaan)
            ->first();

        // dd($existingRecord);

        if ($existingRecord) {
            // If the record exists, update the 'laporan' field
            // $existingRecord->laporan = $request->laporan;
            $existingRecord->update([
                'laporan' => $request->laporan
            ]);
        } else {
            // If the record does not exist, create a new one
            $detailhasil = DetailHasilPemeriksaanRadiologi::create([
                'idHasilPemeriksaan' => $hasil->idHasilPemeriksaan,
                'kodeJenisPemeriksaan' => $detailPendaftaran[$index]->kodeJenisPemeriksaan,
                'laporan' => $request->laporan,
            ]);
        }

        // foreach ($request->jenisPemeriksaan as $key => $jenisPemeriksaan){
        //     $jamMulai = $request->jamMulai[$key];
        //     $jamSelesai = $request->jamSelesai[$key];
        //     $tanggalPemeriksaan = $request->tanggalPemeriksaan[$key];

        //     DetailPendaftaranPemeriksaan::create([
        //         'noPendaftaran' => $hasil->idHas,
        //         'kodeJenisPemeriksaan' => $jenisPemeriksaan,
        //         'jamMulai' => $jamMulai,
        //         'jamSelesai' => $jamSelesai,
        //         'tanggalPendaftaranPemeriksaan' => $tanggalPemeriksaan,
        //     ]);

        // }
        return redirect()->route('detail_pemeriksaan_dokter', $request->nomorPemeriksaan);
    }
}
