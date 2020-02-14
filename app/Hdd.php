<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hdd extends Model
{
    protected $table = 'tb_hdd';
    protected $primaryKey = 'id_hdd';
    protected $fillable = ['ukuran_hdd'];
    public $timestamps = false;
}
