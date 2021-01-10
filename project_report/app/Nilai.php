<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $primaryKey = 'id_nilai';
    protected $table = 'nilai';
    protected $fillable = ['id_pengguna','id_kuesioner','nilai'];
}
