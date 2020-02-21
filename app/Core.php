<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Core extends Model
{
    protected $table = 'tb_core';
    protected $primaryKey = 'id_core';
    protected $fillable = ['jumlah_core'];
    public $timestamps = false;
}
