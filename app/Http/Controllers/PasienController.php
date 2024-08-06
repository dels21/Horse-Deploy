<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function update_pasien(Request $request)
    {
        $user = User::findOrFail($request->idUser);

        // dd($request->all());

        $pasien = Pasien::where('idUser', $request->idUser);
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $user->update($updateData);
        $pasien->update([
            'tempatLahir' =>$request->tempatLahir,
            'statusPerkawinan' =>$request->statusPerkawinan,
            'tipeIdentitas' =>$request->tipeIdentitas,
            'tanggalLahir' =>$request->tanggalLahir,
            'noIdentitas' =>$request->noIdentitas,
            'nomorRumah' =>$request->nomorRumah,
            'nomorHp' =>$request->nomorHp,
            'namaKontakDarurat' =>$request->namaKontakDarurat,
            'nomorDarurat' =>$request->nomorDarurat,
            'kewarganegaraan' =>$request->kewarganegaraan,
            'alergi' =>$request->alergi,
            'golonganDarah' =>$request->golonganDarah,
            'tinggiBadan' =>$request->tinggiBadan,
            'beratBadan' =>$request->beratBadan
        ]);
        if(Auth::user()->role == "admin"){
            return redirect()->route('show_list_pasien_admin')->with('success','Pasien berhasil diupdate');
        }
        return redirect()->route('show_list_pasien')->with('success','Pasien berhasil diupdate');
    }


     public function pasienFromUser(){
        $role = Auth::user()->role;
        $usersWithPasien = User::join('pasien', 'users.id', '=', 'pasien.idUser')
            ->where('users.role', 'pasien')
            ->get(['users.*', 'pasien.*']);

        return view("$role.list-pasien", compact('usersWithPasien'));
     }
    public function index()
    {
        $pasien = Pasien::all();

        return view('karyawan.list-pasien', compact('pasien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $userId, Request $request)
    {
        //
        // dd($request->all());
        Pasien::create([
            'idUser' => $userId,
            'tempatLahir' =>$request->tempatLahir,
            'tanggalLahir' =>$request->tanggalLahir,
            'noIdentitas' =>$request->noIdentitas,
            'tipeIdentitas' =>$request->tipeIdentitas,
            'jenisKelamin' =>$request->jenisKelamin,
            'pekerjaan' =>$request->pekerjaan,
            'alamat' =>$request->alamat,
            'kota' =>$request->kota,
            'nomorRumah' =>$request->nomorRumah,
            'nomorHp' =>$request->nomorHp,
            'namaKontakDarurat' =>$request->namaKontakDarurat,
            'nomorDarurat' =>$request->nomorDarurat,
            'kewarganegaraan' =>$request->kewarganegaraan,
            'statusPerkawinan' =>$request->statusPerkawinan,
            'tanggalDaftar' =>$request->input('tanggalDaftar'),
            'alergi' =>$request->alergi,
            'golonganDarah' =>$request->golonganDarah,
            'tinggiBadan' =>$request->tinggiBadan,
            'beratBadan' =>$request->beratBadan,

        ]);


        return redirect(route('pasien.dashboard-pasien', absolute:false));
    }

    public function show(Pasien $pasien)
    {
        //
    }


    public function edit(Pasien $pasien)
    {
        //
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('isi_nanti')->with('success', 'Pasien berhasil dihapus');
    }

    public function getTotalPasien()
    {
        $totalPasien = DB::table('pasien')->count();
        return $totalPasien;
    }
}
