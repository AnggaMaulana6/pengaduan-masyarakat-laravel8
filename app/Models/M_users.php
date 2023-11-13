<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;


class M_users extends Model
{
    use HasFactory;
    protected $table = 'masyarakat';
    protected $primaryKey = 'id';

    public $timestamp = false;
    protected $guarded = ['id'];
}
