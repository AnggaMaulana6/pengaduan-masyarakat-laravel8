<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Pengaduan extends Model
{
    use HasFactory;
    
    protected $table ='pengaduans';
    protected $primaryKey = 'id_pengaduan';
    protected $guarded =['id_pengaduan'];
    protected $with = ['masyarakat'];

    public function dataLaporan(){
        return DB::table('pengaduans')
            ->leftjoin('masyarakats', 'masyarakats.nik', '=', 'pengaduans.nik')
            // ->where('id_pengaduan' , 'id_pengaduan') 
            ->get();
            
    }
    public function allAduan(){
        return DB::table('pengaduans')
            ->leftjoin('masyarakats', 'masyarakats.nik', '=', 'pengaduans.nik')
            ->where('id_pengaduan' , 'id_pengaduan') 
            ->get();
            
    }
    public function allData(){
        return DB::table('pengaduans')
            ->leftjoin('masyarakats', 'masyarakats.nik', '=', 'pengaduans.nik')
            ->where('status' , '=', NULL)
            ->get();
            
    }
    public function dataValid(){
        return DB::table('pengaduans')
            ->leftjoin('masyarakats', 'masyarakats.nik', '=', 'pengaduans.nik')
            ->where('status' , '=', '0')
            ->get();
            
    }
    public function dataProses(){
        return DB::table('pengaduans')
            ->leftjoin('masyarakats', 'masyarakats.nik', '=', 'pengaduans.nik')
            ->where('status' , '=', 'proses')
            ->get();
            
    }
    public function dataSelesai(){
        return DB::table('pengaduans')
            ->leftjoin('masyarakats', 'masyarakats.nik', '=', 'pengaduans.nik')
            ->where('status' , '=', 'selesai')
            ->get();
            
    }
    public function dataDitolak(){
        return DB::table('pengaduans')
            ->leftjoin('masyarakats', 'masyarakats.nik', '=', 'pengaduans.nik')
            ->where('status' , '=', 'ditolak')
            ->get();
            
    }
    public function getDataTangg(){
        return DB::table('pengaduans')
            ->leftjoin('tanggapans', 'tanggapans.id_pengaduan', '=', 'pengaduans.id_pengaduan')
            ->leftjoin('petugas', 'petugas.id_petugas', '=', 'tanggapans.id_petugas')
            ->where('tanggapan' , '=', 'ditolak')
            ->get();
            
    }

    // public function nik(){
    //     return $this->belongsTo(Masyarakat::class);
    // }
    public function masyarakat(){
        return $this->belongsTo(Masyarakat::class, 'nik');
    }
 }
