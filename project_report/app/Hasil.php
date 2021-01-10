<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    protected $primaryKey = 'id_hasil';
    protected $table = 'hasil';
    protected $fillable = ['id_pengguna','hasil'];
}
