<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    protected $table = 'tb_rak';
    protected $primaryKey = 'id_rak';
    protected $fillable = ['nomer_rak'];
    public $timestamps = false;
}
