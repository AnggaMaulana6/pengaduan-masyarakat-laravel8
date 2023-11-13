<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;
use App\Models\Tanggapan;
class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';

    public $timestamp = false;
    protected $guarded = ['id_petugas'];

    public function tanggapan(){
        return $this->hasMany(Tanggapan::class);
    }
}
