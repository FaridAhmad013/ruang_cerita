<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $fillable = ['pertanyaan', 'kategori_pertanyaan_id'];

    public function kategori_pertanyaan(){
        return $this->belongsTo(KategoriPertanyaan::class, 'kategori_pertanyaan_id', 'id');
    }
}
