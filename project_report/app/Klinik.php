<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klinik extends Model
{
    protected $primaryKey = 'id_klinik';
    protected $table = 'klinik';
    protected $fillable = ['nama_klinik','no_telp','alamat_klinik','lat_klinik','long_klinik'];
}
