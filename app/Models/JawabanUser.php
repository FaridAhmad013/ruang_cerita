<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanUser extends Model
{
    protected $fillable = ['sesi_jurnal_id', 'user_id', 'pertanyaan_label', 'jawaban_user', 'pertanyaan_id'];

    public function pertanyaan(){
        return $this->belongsTo(Pertanyaan::class);
    }

    public function sesi_journal(){
        return $this->belongsTo(SesiJournal::class);
    }
}
