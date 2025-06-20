<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'password', 'email', 'nama_depan', 'nama_belakang', 'status', 'auth_attemp', 'role_id'];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
