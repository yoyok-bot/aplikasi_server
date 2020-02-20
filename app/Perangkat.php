<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    protected $table = 'tb_perangkat';
    protected $primaryKey = 'id_perangkat';
    protected $fillable = ['nama_perangkat','tipe_perangkat','status_kepemilikan','id_hdd','id_ram','id_rak'];
    public $timestamps = false;
}
