<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;


class M_petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';
    protected $primaryKey = 'id';

    public $timestamp = false;
    protected $guarded = ['id'];
}
