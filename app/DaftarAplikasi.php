<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarAplikasi extends Model
{
    protected $table = 'tb_daftar_aplikasi';
    protected $primaryKey = 'id_aplikasi';
    protected $fillable = ['nama_aplikasi','id_perangkat'];
    public $timestamps = false;
}