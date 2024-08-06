<?php

namespace App\Http\Controllers;

use App\Models\Modalitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ModalitasController extends Controller
{
    public function show()
    {
        $joinAlamatIp = DB::table('master_dicom')
        ->select('*')
        ->get();

        $showModalitas = Modalitas::latest()->paginate(10);
        return view('karyawan.list-modalitas', compact('showModalitas','joinAlamatIp'));
    }

    public function index()
    {

    }

    public function create(Request $request)
    {

    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'namaModalitas' => 'required|min:5',
                'jenisModalitas' => 'required',
                'merekModalitas' => 'required',
                'nomorSeriModalitas' => 'required',
                'alamatIp' => 'required',
                'kodeRuang' => 'required',
            ]
            );
            Modalitas::create($request->all());
            return redirect()->route('show_modalitas');
    }

    public function edit(Request $request)
    {
        // dd($request->all());
        $modalitas = Modalitas::findOrFail($request->kodeModalitas);
        $modalitas->update([
            'namaModalitas' => $request->namaModalitas,
            'jenisModalitas' => $request->jenisModalitas,
            'merekModalitas' => $request->merekModalitas,
            'nomorSeriModalitas' => $request->nomorSeriModalitas,
            'alamatIp' => $request->alamatIp,
            'kodeRuang' => $request->kodeRuang,
        ]);
        return redirect()->route('show_modalitas')->with('success', 'Modalitas berhasil diubah');
    }

    public function destroy($kodeModalitas)
    {


        Modalitas::destroy($kodeModalitas);

        return redirect()->route('show_modalitas')->with('success', 'Modalitas berhasil dihapus');
    }
}
