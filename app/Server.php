<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'tb_server';
    protected $primaryKey = 'id_server';
    protected $fillable = ['ip_server','id_vps','id_perangkat'];
    public $timestamps = false;
}
