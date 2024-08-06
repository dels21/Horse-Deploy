<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Karyawan;
use App\Models\Admin;
use App\Models\Pasien;
use App\Models\TransaksiPemeriksaan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Admin::all();

        return view('admin', compact('admin'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function buildDashboard()
    {

        $pasienController = new PasienController();
        $karyawanController = new KaryawanController($pasienController);
        $dokterController = new DokterController();
        $pemeriksaanController = new TransaksiPemeriksaanController();

        $totalPasien = $pasienController->getTotalPasien();
        $totalDokter = $dokterController->getTotalDokter();
        $totalKaryawan = $karyawanController->getTotalKaryawan();
        $transaksiPemeriksaan = $pemeriksaanController->recentPemeriksaan();

        // dd($transaksiPemeriksaan);
        return view('admin.dashboard-admin', compact('totalPasien', 'totalDokter', 'totalKaryawan', 'transaksiPemeriksaan'));
    }
}
