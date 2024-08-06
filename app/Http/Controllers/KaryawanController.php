<?php

namespace App\Http\Controllers;

use App\Models\DetailPemeriksaan;
use App\Models\DetailPendaftaranPemeriksaan;
use App\Models\Karyawan;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\PendaftaranPemeriksaan;
use App\Models\TransaksiPemeriksaan;
use Brick\Math\BigInteger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    protected $pasienController;
    public function __construct(PasienController $pasienController)
    {
        $this->pasienController = $pasienController;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = Karyawan::all();

        return view('isi_nanti', compact('karyawan'));
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
    public function store(int $userId, Request $request)
    {
        Karyawan::create([
            'idUser' => $userId,
            'idKtp' => $request->idKtp,
            'jenisKelamin' => $request->jenisKelamin,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'nomorHp' => $request->nomorHp,
            'nomorTelpRumah' => $request->nomorTelpRumah,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        //
        //
        $karyawan->update([
            'idKaryawan' => $request->idKaryawan,
            'idKtp' => $request->idKtp,
            'jenisKelamin' => $request->jenisKelamin,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'nomorHp' => $request->nomorHp,
            'nomorTelpRumah' => $request->nomorTelpRumah,
        ]);

        return redirect()->route('isi_nanti')->with('success', 'Karyawan berhasil diupdate');
    }

    public function update_karyawan(Request $request)
    {
        // dd($request->password);
        $user = User::findOrFail($request->idUser);

        $karyawan = Karyawan::where('idUser', $request->idUser);
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Conditionally update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);
        $karyawan->update([
            'idKtp' => $request->idKtp,
            'jenisKelamin' => $request->jenisKelamin,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'nomorHp' => $request->nomorHp,
            'nomorTelpRumah' => $request->nomorTelpRumah,
        ]);

        return redirect()->route('show-list-karyawan')->with('success', 'Karyawan berhasil diupdate');
    }
    public function store_pasien(Request $request)
    {
        // dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->pasienController->store($user->id, $request);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('show_list_pasien_admin')->with('success', 'Pasien berhasil ditambahkan');
        }

        return redirect()->route('show_list_pasien')->with('success', 'Pasien berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('isi_nanti')->with('success', 'Karyawan berhasil dihapus');
    }

    public function getTotalKaryawan()
    {
        $totalKaryawan = DB::table('karyawan')->count();
        return $totalKaryawan;
    }

    public function buildDashboard()
    {
        $pasienController = new PasienController();
        $dokterController = new DokterController();
        $pemeriksaanController = new TransaksiPemeriksaanController();

        $totalPasien = $pasienController->getTotalPasien();
        $totalDokter = $dokterController->getTotalDokter();
        $totalKaryawan = $this->getTotalKaryawan();
        $pemeriksaanTerbaru = $pemeriksaanController->recentPemeriksaan();

        return view('karyawan.dashboard-karyawan', compact('totalPasien', 'totalDokter', 'totalKaryawan', 'pemeriksaanTerbaru'));
    }
    public function destroy_karyawan(Request $request)
    {
        $user = User::findOrFail($request->idUser);
        $karyawan = Karyawan::where('idUser', $request->idUser);

        $karyawan->delete();
        $user->delete();
        return redirect()->route('show-list-karyawan')->with('success', 'karyawan berhasil dihapus');
    }

    public function destroy_pasien(Request $request)
    {
        $user = User::findOrFail($request->idUser);
        $pasien = Pasien::where('idUser', $request->idUser);

        $pasien->delete();
        $user->delete();

        if (Auth::user()->role == 'admin') {
            return redirect()->route('show_list_pasien')->with('success', 'Pasien berhasil dihapus');
        }

        return redirect()->route('show_list_pasien')->with('success', 'Pasien berhasil dihapus');
    }

    public function showListKaryawan()
    {
        $usersWithKaryawan = User::join('karyawan', 'users.id', '=', 'karyawan.idUser')
            ->where('users.role', 'karyawan')
            ->get(['users.*', 'karyawan.*']);
        // dd($usersWithKaryawan->all());
        return view('admin.list-karyawan', compact('usersWithKaryawan'));
    }

    public function verifikasi()
    {
        // <th>ID Pemeriksaan</th>
        // <th>Tanggal Pendaftaran</th>
        // <th>ID Pasien</th>
        // <th>Nama Pasien</th>
        // <th>Detail</th>

        $pendaftaran = PendaftaranPemeriksaan::join('pasien', 'pendaftaran_pemeriksaan.idPasien', '=', 'pasien.idPasien')->join('users', 'pasien.idUser', '=', 'users.id')->select('pendaftaran_pemeriksaan.nomorPendaftaran', 'users.name', 'pendaftaran_pemeriksaan.tanggalDaftar', 'pasien.idPasien')->where('pendaftaran_pemeriksaan.verifikasi', 0)->get();
        $pendaftaranTertolak = PendaftaranPemeriksaan::join('pasien', 'pendaftaran_pemeriksaan.idPasien', '=', 'pasien.idPasien')->join('users', 'pasien.idUser', '=', 'users.id')->select('pendaftaran_pemeriksaan.nomorPendaftaran', 'users.name', 'pendaftaran_pemeriksaan.tanggalDaftar', 'pasien.idPasien')->where('pendaftaran_pemeriksaan.verifikasi', -1)->get();
        // dd($pendaftaran);

        return view('karyawan.verifikasi', compact('pendaftaran', 'pendaftaranTertolak'));
    }

    public function detailverifikasi($nomorPendaftaran)
    {
        // dd($nomorPendaftaran);
        $pendaftaran = PendaftaranPemeriksaan::where('pendaftaran_pemeriksaan.nomorPendaftaran', $nomorPendaftaran)->join('pasien', 'pendaftaran_pemeriksaan.idPasien', '=', 'pasien.idPasien')->join('users', 'pasien.idUser', '=', 'users.id')->select('pendaftaran_pemeriksaan.nomorPendaftaran', 'users.name', 'pendaftaran_pemeriksaan.tanggalDaftar', 'pasien.idPasien')->first();

        // dd($pendaftaran);

        $detailpemeriksaan = DetailPendaftaranPemeriksaan::where('detail_pendaftaran.noPendaftaran', $nomorPendaftaran)->join('master_jenis_pemeriksaan as mjp', 'mjp.kodeJenisPemeriksaan', '=', 'detail_pendaftaran.kodeJenisPemeriksaan')->select('mjp.namaJenisPemeriksaan')->get();

        $dokter = Dokter::join('users', 'dokter.idUser', '=', 'users.id')->select('*')->get();

        // dd($dokter);
        // dd($detailpemeriksaan);

        return view('karyawan.detailverifikasi', compact('pendaftaran', 'detailpemeriksaan', 'dokter'));
    }
    public function acceptVerif(Request $request)
    {
        // dd($request->all());

        $pendaftaran = PendaftaranPemeriksaan::where('nomorPendaftaran', $request->nomorPendaftaran)->update(['verifikasi' => 1]);

        $pemeriksaan = TransaksiPemeriksaan::create([
            'nomorPendaftaran' => $request->nomorPendaftaran,
            'idKaryawanRadiografer' => $request->idKaryawan,
            'idKaryawanDokterRadiologi' => $request->idDokter,
        ]);
        // nomorPemeriksaan (FK ke table transaksi_pemeriksaan)	bigint auto increment
        // ruangan	varchar
        // statusKetersediaan	enum ( approve, reject)
        if($request->ruangan){
            foreach ($request->ruangan as $key => $ruangan) {
                $statusKetersediaan = $request->statusKetersediaan[$key];

                DetailPemeriksaan::create([
                    'nomorPemeriksaan' => $pemeriksaan->nomorPemeriksaan,
                    'ruangan' => $ruangan,
                    'statusKetersediaan' => $statusKetersediaan,
                ]);
            }

        };

        return redirect()->route('verifikasi');
    }

    public function rejectVerif(Request $request)
    {
        $pendaftaran = PendaftaranPemeriksaan::where('nomorPendaftaran', $request->nomorPendaftaran)->update(['verifikasi' => -1]);
        return redirect()->route('verifikasi');
    }

    public function storeKaryawan(Request $request)
    {
        // dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'karyawan',
        ]);

        Karyawan::create([
            'idUser' => $user->id,
            'idKtp' => $request->idKtp,
            'jenisKelamin' => $request->jenisKelamin,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'nomorHp' => $request->nomorHp,
            'nomorTelpRumah' => $request->nomorTelpRumah,
        ]);

        return redirect(route('show-list-karyawan', absolute: false));
    }
}
