<?php

namespace App\Http\Controllers;

use App\Models\MasterDicom;
use Illuminate\Http\Request;

class DicomController extends Controller
{

    public function create(Request $request)
    {

    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'alamatIp' =>'',
                'netMask' => '',
                'layananDicom' => '',
                'peran' => '',
                'aet' => '',
                'port' => '',
            ]
            );
            MasterDicom::create($request->all());
            return redirect()->route('show_dicom')->with('success', 'Dicom berhasil dimasukkan');
    }

    public function show (Request $request)
    {
        $showDicom = MasterDicom::latest()->paginate(10);
        return view('karyawan.list-dicom', compact('showDicom'));
    }

    public function edit(Request $request)
    {
        // dd($request->all());
        $dicom = MasterDicom::findOrFail($request->idLayananDicom);
        $dicom->update([
            'alamatIp' => $request->alamatIp,
            'netMask' => $request->netMask,
            'layananDicom' => $request->layananDicom,
            'peran' => $request->peran,
            'aet' => $request->aet,
            'port' => $request->port,
        ]);
        return redirect()->route('show_dicom')->with('success', 'Dicom berhasil diubah');
    }

    public function destroy($alamatIp)
    {
        MasterDicom::destroy($alamatIp);

        return redirect()->route('show_dicom')->with('success', 'Dicom berhasil dihapus');
    }
}
