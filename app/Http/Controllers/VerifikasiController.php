<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Masyarakat;
;
class VerifikasiController extends Controller
{

    public function __construct(){
        $this->Pengaduan = new Pengaduan();
    }
    public function index(){

        $pengaduans = [
            'title' => 'Data Non Valid',
            'pengaduans' => $this->Pengaduan->allData(),
        ];
 
        return view('administrator.verifikasi.nonvalid' ,$pengaduans,);
        // dd('pengaduans');

    }
    public function indexSelesai(){

        $pengaduans = [
            'title' => 'Data Selesai',
            'pengaduans' => $this->Pengaduan->dataSelesai(),
        ];
 
        return view('administrator.validasi.selesai' ,$pengaduans,);
        // dd('pengaduans');

    }
    public function indexDitolak(){

        $pengaduans = [
            'title' => 'Data Ditolak',
            'pengaduans' => $this->Pengaduan->dataDitolak(),
        ];
 
        return view('administrator.verifikasi.ditolak' ,$pengaduans,);
        // dd('pengaduans');

    }
    public function indexProses(){

        $pengaduans = [
            'title' => 'Data Proses',
            'pengaduans' => $this->Pengaduan->dataProses(),
        ];
 
        return view('administrator.validasi.proses' ,$pengaduans,);
        // dd('pengaduans');

    }
    public function indexValid(){

        $pengaduans = [
            'title' => 'Data Valid',
            'pengaduans' => $this->Pengaduan->dataValid(),
        ];
 
        return view('administrator.verifikasi.valid' ,$pengaduans,);
        // dd('pengaduans');

    }
  
    public function valid(){
        Pengaduan::whereNull('status')->update([
            'status' => '0'
        ]);
    return redirect('/verifikasi-nonvalid')->with('success', 'Aduan berhasil divalidasi');
    }

    public function proses($id_pengaduan){
      $proses = Pengaduan::findOrFail($id_pengaduan);
      if(!$proses){
        return redirect('/verifikasi-valid')->with('error', 'Data tidak ditemukan');
      }
      $proses->status = 'proses';
      $proses->save();
    return redirect('/verifikasi-valid')->with('success', 'Aduan berhasil diproses');

    }
    public function selesai($id_pengaduan){
      $selesai = Pengaduan::findOrFail($id_pengaduan);
      if(!$selesai){
        return redirect('/verifikasi-proses')->with('error', 'Data tidak ditemukan');
      }
      $selesai->status = 'selesai';
      $selesai->save();
    return redirect('/verifikasi-proses')->with('success', 'Aduan berhasil diproses');

    }
    public function tolak($id_pengaduan){
      $tolak = Pengaduan::findOrFail($id_pengaduan);
      if(!$tolak){
        return redirect('/verifikasi-nonvalid')->with('error', 'Data tidak ditemukan');
      }
      $tolak->status = 'ditolak';
      $tolak->save();
    return redirect('/verifikasi-nonvalid')->with('success', 'Aduan berhasil diproses');

    }
}
