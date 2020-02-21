<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vps extends Model
{
    protected $table = 'tb_vps';
    protected $primaryKey = 'id_vps';
    protected $fillable = ['ip_vps','ip_public','id_perangkat'];
    public $timestamps = false;
}
