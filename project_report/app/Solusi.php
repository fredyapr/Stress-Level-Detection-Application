<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    protected $primaryKey = 'id_solusi';
    protected $table = 'solusi';
    protected $fillable = ['solusi','keterangan'];
}
