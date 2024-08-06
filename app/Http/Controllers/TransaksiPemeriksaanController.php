<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPemeriksaan;
use Illuminate\Http\Request;

class TransaksiPemeriksaanController extends Controller
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
                'nomorPendaftaran' => 'required|max:255',
                'idKaryawanRadiografer' => '',
                'idKaryawanDokterRadiologi' => '',
                'namaDokterPengirim' => '',
                'tanggalPemeriksaan' => '',
                'diagnosis' => '',
                'keterangan' => '',
            ]
        );
        TransaksiPemeriksaan::create($request->all());
        return redirect()->route('dashboard');
    }

    public function show(Request $request)
    {
    }

    public function edit(Request $request, TransaksiPemeriksaan $transaksipemeriksaan)
    {
        $transaksipemeriksaan->update([
            'nomorPendaftaran' => $request->nomorPendaftaran,
            'idKaryawanRadiografer' => $request->idKaryawanRadiografer,
            'idKaryawanDokterRadiologi' => $request->idKaryawanRadiologi,
            'namaDokterPengirim' => $request->namaDokterPengirim,
            'tanggalPemeriksaan' => $request->tanggalPemeriksaan,
            'diagnosis' => $request->diagnosis,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('dashboard')->with('success', 'Modalitas berhasil diubah');
    }

    public function destroy(TransaksiPemeriksaan $transaksiPemeriksaan)
    {
        $transaksiPemeriksaan->delete();

        return redirect()->route('dashboard')->with('success', 'Transaksi Pemeriksaan berhasil dihapus');
    }

    public function countPemeriksaanSelesai($idDokter)
    {
        $count = TransaksiPemeriksaan::join('detail_pemeriksaan', 'detail_pemeriksaan.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')
            ->where('detail_pemeriksaan.status', 'Hasil sudah siap')
            ->where('transaksi_pemeriksaan.idKaryawanDokterRadiologi', $idDokter)
            ->count();

        return $count;
    }

    public function countPemeriksaanMenunggu($idDokter)
    {
        $count = TransaksiPemeriksaan::join('detail_pemeriksaan', 'detail_pemeriksaan.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')
            ->where('detail_pemeriksaan.status', 'Menunggu Hasil')
            ->where('transaksi_pemeriksaan.idKaryawanDokterRadiologi', $idDokter)
            ->count();

        return $count;
    }

    public function countPemeriksaanBerjalan($idDokter)
    {
        $count = TransaksiPemeriksaan::join('detail_pemeriksaan', 'detail_pemeriksaan.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')
            ->where('detail_pemeriksaan.status', 'Pemeriksaan')
            ->where('transaksi_pemeriksaan.idKaryawanDokterRadiologi', $idDokter)
            ->count();

        return $count;
    }

    public function getRecentPemeriksaan($idDokter)
    {
        $data = TransaksiPemeriksaan::join('detail_pemeriksaan', 'detail_pemeriksaan.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')
            ->join('pendaftaran_pemeriksaan', 'pendaftaran_pemeriksaan.nomorPendaftaran', '=', 'transaksi_pemeriksaan.nomorPendaftaran')
            ->where('transaksi_pemeriksaan.idKaryawanDokterRadiologi', $idDokter)
            ->orderBy('transaksi_pemeriksaan.tanggalPemeriksaan', 'desc')
            ->take(10)
            ->get(['transaksi_pemeriksaan.nomorPendaftaran as noPendaftaran', 'transaksi_pemeriksaan.nomorPemeriksaan as noPemeriksaan', 'transaksi_pemeriksaan.tanggalPemeriksaan as tanggal', 'pendaftaran_pemeriksaan.idPasien as idPasien', 'transaksi_pemeriksaan.idKaryawanRadiografer as idRadio', 'transaksi_pemeriksaan.idKaryawanDokterRadiologi as idDokter', 'detail_pemeriksaan.jamMulaiPemeriksaanAlat as jamMulai', 'detail_pemeriksaan.jamSelesaiPemeriksaanAlat as jamSelesai', 'detail_pemeriksaan.ruangan as ruangan', 'detail_pemeriksaan.status as status']);

        return $data;
    }

    public function recentPemeriksaan()
    {
        $data = TransaksiPemeriksaan::join('detail_pemeriksaan', 'detail_pemeriksaan.nomorPemeriksaan', '=', 'transaksi_pemeriksaan.nomorPemeriksaan')
            ->join('pendaftaran_pemeriksaan', 'pendaftaran_pemeriksaan.nomorPendaftaran', '=', 'transaksi_pemeriksaan.nomorPendaftaran')
            ->join('dokter', 'dokter.idDokter', '=', 'transaksi_pemeriksaan.idKaryawanDokterRadiologi')
            ->join('users as dokter_users', function ($join) {
                $join->on('dokter_users.id', '=', 'dokter.idUser')
                    ->where('dokter_users.role', 'dokter');
            })
            ->join('pasien', 'pasien.idPasien', '=', 'pendaftaran_pemeriksaan.idPasien')
            ->join('users as pasien_users', function ($join) {
                $join->on('pasien_users.id', '=', 'pasien.idUser')
                    ->where('pasien_users.role', 'pasien');
            })
            ->join('karyawan', 'karyawan.idKaryawan', '=', 'transaksi_pemeriksaan.idKaryawanRadiografer')
            ->join('users as karyawan_users', function ($join) {
                $join->on('karyawan_users.id', '=', 'karyawan.idUser')
                    ->where('karyawan_users.role', 'karyawan');
            })
            ->orderBy('transaksi_pemeriksaan.tanggalPemeriksaan', 'desc')
            ->take(10)
            ->get([
                'transaksi_pemeriksaan.nomorPendaftaran',
                'transaksi_pemeriksaan.nomorPemeriksaan',
                'transaksi_pemeriksaan.tanggalPemeriksaan',
                'transaksi_pemeriksaan.keterangan',
                'pendaftaran_pemeriksaan.namaDokterPengirim',
                'dokter_users.name as namaDokter',
                'pasien_users.name as namaPasien',
                'karyawan_users.name as namaKaryawan',
                'pendaftaran_pemeriksaan.tanggalDaftar as tanggalDaftar'
            ]);
            // dd($data);

        return $data;
    }
}
