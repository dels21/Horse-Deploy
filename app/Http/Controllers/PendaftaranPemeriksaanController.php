<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranPemeriksaan;
use App\Models\DetailPendaftaranPemeriksaan;
use App\Models\Pasien;
use App\Models\MasterJenisPemeriksaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PendaftaranPemeriksaanController extends Controller
{
    public function detailWithPendaftaran(){
    $idUser = Auth::id();

    $detailWithPendaftaran = DetailPendaftaranPemeriksaan::join('pendaftaran_pemeriksaan', 'detail_pendaftaran.noPendaftaran', '=', 'pendaftaran_pemeriksaan.nomorPendaftaran')
        ->join('pasien', 'pendaftaran_pemeriksaan.idPasien', '=', 'pasien.idPasien')
        ->where('pasien.idUser', $idUser)
        ->get(['pendaftaran_pemeriksaan.*', 'detail_pendaftaran.*', 'pasien.idUser']);

    $detailWithMasterPemeriksaan = MasterJenisPemeriksaan::join('detail_pendaftaran', 'detail_pendaftaran.kodeJenisPemeriksaan', '=', 'master_jenis_pemeriksaan.kodeJenisPemeriksaan')
        ->join('pendaftaran_pemeriksaan', 'detail_pendaftaran.noPendaftaran', '=', 'pendaftaran_pemeriksaan.nomorPendaftaran')
        ->join('pasien', 'pendaftaran_pemeriksaan.idPasien', '=', 'pasien.idPasien')
        ->where('pasien.idUser', $idUser)
        ->get(['detail_pendaftaran.*', 'master_jenis_pemeriksaan.namaJenisPemeriksaan', 'pasien.idUser']);

    $pasienWithPendaftaran = Pasien::join('pendaftaran_pemeriksaan', 'pasien.idPasien', '=', 'pendaftaran_pemeriksaan.idPasien')
        ->where('pasien.idUser', $idUser)
        ->get(['pendaftaran_pemeriksaan.*', 'pasien.*']);

    $mergedDetails = $detailWithPendaftaran->map(function ($item) use ($detailWithMasterPemeriksaan, $pasienWithPendaftaran) {
        $master = $detailWithMasterPemeriksaan->firstWhere('kodeJenisPemeriksaan', $item->kodeJenisPemeriksaan);
        $pasien = $pasienWithPendaftaran->firstWhere('idPasien', $item->idPasien);

        $item->namaJenisPemeriksaan = $master ? $master->namaJenisPemeriksaan : null;
        $item->namaPasien = $pasien ? $pasien->namaPasien : null; // Assuming you want to show namaPasien instead of idPasien
        return $item;
    });

        return view('pasien.list-pemeriksaan-pasien', compact('mergedDetails'));
     }


     public function index()
    {
        $dataId = Auth::user()->id;
        $dataExists = Pasien::where('idUser', $dataId)->exists();
        $idPasien = Pasien::where('idUser', $dataId)->first();

        // dd($idPasien);
        $pendaftaran = PendaftaranPemeriksaan::all();
        $joinJenisPemeriksaan = DB::table('master_jenis_pemeriksaan')
        ->select('*')
        ->get();

        return view('pasien.form-pendaftaran-pemeriksaan', compact('pendaftaran', 'dataId', 'dataExists', 'joinJenisPemeriksaan', 'idPasien'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        try {
            $pasien = Pasien::where('idUser', Auth::user()->id)->firstOrFail();


            $attachment = $request->file('attachment');
            $fileAttachment = time().".".$attachment->getClientOriginalExtension();

            $pathFileLampiran = Storage::disk('public')->putFileAs('attachment', $attachment, $fileAttachment);

            // dd($pasien);
            $pendaftaran = PendaftaranPemeriksaan::create([
                'idPasien' => $pasien->idPasien,
                'namaDokterPengirim' => $request->namaDokterPengirim,
                'attachment' => $fileAttachment,
                'tanggalDaftar' => $request->tanggalDaftar,
            ]);

            foreach ($request->jenisPemeriksaan as $key => $jenisPemeriksaan){
                $jamMulai = $request->jamMulai[$key];
                $jamSelesai = $request->jamSelesai[$key];
                $tanggalPemeriksaan = $request->tanggalPemeriksaan[$key];

                DetailPendaftaranPemeriksaan::create([
                    'noPendaftaran' => $pendaftaran->nomorPendaftaran,
                    'kodeJenisPemeriksaan' => $jenisPemeriksaan,
                    'jamMulai' => $jamMulai,
                    'jamSelesai' => $jamSelesai,
                    'tanggalPendaftaranPemeriksaan' => $tanggalPemeriksaan,
                ]);

            }

            return redirect()->route('pasien.dashboard-pasien')->with('success','Pendaftaran berhasil dibuat');

        } catch (ModelNotFoundException $e) {
            // If not found, redirect to 'lengkapi-data-diri' page
            return redirect()->route('pasien.lengkapi-data-diri');
        }


    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request)
    {
        $attachment = $request->file('attachment');
        $fileAttachment = time().".".$attachment->getClientOriginalExtension();

        $pathFileLampiran = Storage::disk('public')->putFileAs('attachment', $attachment, $fileAttachment);

        PendaftaranPemeriksaan::update([
            'nomorPendaftaran' => $request->nomorPendaftaran,
            'idPasien' => Auth::user()->id,
            'namaDokterPengirim' => $request->namaDokterPengirim,
            'attachment' => $fileAttachment,
            'tanggalDaftar' => $request->tanggalDaftar,
        ]);

        return redirect()->route('pasien.daftar-pemeriksaan')->with('success','Pendaftaran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendaftaranPemeriksaan $id)
    {
        //
        $id->delete();

        return redirect()->route('pasien.daftar-pemeriksaan')->with('success','Pendaftaran berhasil dihapus');

    }


}
