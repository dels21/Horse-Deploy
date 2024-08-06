<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;

class DashboardPasienController extends Controller
{
    public function showDashboard()
    {
        $dataId = Auth::user()->id;
        $dataExists = Pasien::where('idUser', $dataId)->exists();

        // dd($dataExists);

        return view('pasien.dashboard-pasien', ['dataExists' => $dataExists]);
    }

    public function lengkapiDataDiri()
    {
        $dataId = Auth::user()->id;
        $dataExists = Pasien::where('idUser', $dataId)->exists();

        return view('pasien.lengkapi-data-diri', ['dataExists' => $dataExists]);
    }
}
