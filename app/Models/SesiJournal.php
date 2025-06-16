<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiJournal extends Model
{
    protected $fillable = ['user_id', 'tanggal', 'kumpulan_pertanyaan', 'status', 'kesimpulan_ai', 'label_mood'];
}
