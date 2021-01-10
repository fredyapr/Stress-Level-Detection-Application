<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $primaryKey = 'id_pertanyaan';
    protected $table = 'pertanyaan';
    protected $fillable = ['pertanyaan','kategori'];
}
