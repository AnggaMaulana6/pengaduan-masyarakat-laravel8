<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Masyarakat;
use App\Models\Petugas;

class DashboardController extends Controller
{
    public function index(){
        //administrator
        $dataNonValid = Pengaduan::whereNull('status')->count();
        $valid = Pengaduan::where('status', '0')->count();
        $proses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();
        $ditolak = Pengaduan::where('status', 'ditolak')->count();
        
        // Masyarakat
        $m_nonvalid = Pengaduan::whereNull('status')
        ->when(auth()->user()->nik, function ($query) {
            return $query->where('nik', auth()->user()->nik);
        })
        ->count();    $m_valid = Pengaduan::where('status', '0')
    ->when(auth()->user()->nik, function ($query) {
        return $query->where('nik', auth()->user()->nik);
    })
    ->count();

    $m_proses = Pengaduan::where('status', 'proses')
    ->when(auth()->user()->nik, function ($query) {
        return $query->where('nik', auth()->user()->nik);
    })
    ->count();

    $m_selesai = Pengaduan::where('status', 'selesai')
    ->when(auth()->user()->nik, function ($query) {
        return $query->where('nik', auth()->user()->nik);
    })
    ->count();
    $m_ditolak = Pengaduan::where('status', 'ditolak')
    ->when(auth()->user()->nik, function ($query) {
        return $query->where('nik', auth()->user()->nik);
    })
    ->count();        
    $aduanjmlh = Pengaduan::where('nik', auth()->user()->nik)->count();
    
    return view('masyarakat.dashboard',[
        'title' => 'Dahboard'
    ], compact('dataNonValid', 'valid', 'proses', 'selesai', 'ditolak', 'aduanjmlh', 'm_nonvalid', 'm_valid', 'm_proses', 'm_selesai', 'm_ditolak'));
    }
    public function edit($nik){
        $dataMas = Masyarakat::findOrFail($nik);
        // $dataPet = Pengaduan::findOrFail($id);

        return view('masyarakat.setting',[
            'title'=> 'Setting Akun'
        ], compact('dataMas'));
    }
    public function editAdmin($id_petugas){
        $petugas = Petugas::findOrFail($id_petugas);

        return view('administrator.settingAdmin',[
            'title'=> 'Setting Akun'
        ], compact('petugas'));
    }
    public function update(Request $request, $nik)
    {
        $masyarakat = Masyarakat::findOrFail($nik);

        $rules = [
            'nik' => 'required',
            'nama' => 'required',
            'username' => 'required|min:3',
            'password' => 'required|min:5',
            'telp' => 'required|min:12|max:13'
        ];
        
        $validateData = $request->validate($rules);
        $validateData['password'] = Hash::make($validateData['password']);
        Masyarakat::where('nik', $masyarakat->nik)->update($validateData);

        return redirect('/dashboard')->with('success', 'Data Masyarakat berhasil diupdate!');
    // dd($nik);
    }
    public function updateAdmin(Request $request, $id_petugas)
    {
        $p = Petugas::find($id_petugas);

        $rules = [
            'nama_petugas' => 'required|max:35',
            'email' => 'required|email',
            'username' => ['required', 'min:3', 'max:255'],
            'password' => 'required|min:5|max:255',
            'telp' => 'required|min:11|max:13',
            // 'level' => 'required'
        ];
        
        $validateData = $request->validate($rules);
        $validateData['password'] = Hash::make($validateData['password']);
        Petugas::where('id_petugas', $p->id_petugas)->update($validateData);
        
        return redirect('/dashboard')->with('success', 'Data Petugas berhasil diupdate!');
    // dd($id_petugas);
    }
}
