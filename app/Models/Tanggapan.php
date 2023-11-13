<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Tanggapan extends Model
{
    use HasFactory;
    protected $table = 'tanggapans';
    protected $primaryKey = 'id_tanggapan';

    public $timestamp = false;
    protected $guarded = ['id_tanggapan'];

    public function allTanggapan(){
        return DB::table('tanggapans')
            ->leftjoin('petugas', 'petugas.id_petugas', '=', 'tanggapans.id_petugas')
            ->leftjoin('pengaduans', 'pengaduans.id_pengaduan', '=', 'tanggapans.id_pengaduan')
            // ->where('id_pengaduan' , 'id_pengaduan') 
            ->get();
            
    }

    public function petugas(){
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }
    public function pengaduan(){
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan');
    }
}
