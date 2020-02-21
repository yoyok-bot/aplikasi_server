<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    protected $table = 'tb_ram';
    protected $primaryKey = 'id_ram';
    protected $fillable = ['ukuran_ram'];
    public $timestamps = false;
}
