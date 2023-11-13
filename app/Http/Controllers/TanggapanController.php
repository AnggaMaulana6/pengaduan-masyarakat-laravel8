<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{

    public function __construct(){
        $this->Tanggapan = new Tanggapan();
    }
    public function index($id_pengaduan){
        $pengaduan = Pengaduan::with('masyarakat')->findOrFail($id_pengaduan);
        $tanggapans = [
            'tanggapans' => $this->Tanggapan->allTanggapan(),
        ];
        if($pengaduan->status == NULL){
            $status = 'Belum Valid';
        }elseif($pengaduan->status == '0'){
            $status = 'Valid';
        }else{
            $status = $pengaduan->status;
        }
        $title ='Tanggapan';
        return view('administrator.validasi.tanggapan', compact('pengaduan', 'status', 'title'), $tanggapans);
    }
    public function store(Request $request, $id_pengaduan){ 
        Pengaduan::findOrFail($id_pengaduan);
        $validateData = $request->validate([
            'tanggapan' => 'required'
        ]);

        Tanggapan::create([
            'tanggapan' => $request->tanggapan,
            'tgl_tanggapan' => now(),
            'id_petugas' => auth()->user()->id_petugas,
            'id_pengaduan' => $id_pengaduan
        ]);
        return redirect('/validasi-proses')->with('success', 'Aduan berhasil ditanggapi');
    // dd($id_pengaduan);
    }
}
