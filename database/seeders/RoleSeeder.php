<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!Role::where('role', 'Admin')->first()){
            Role::create([
                'role' => 'Admin',
                'deskripsi' => 'Role Admin Segala Bisa'
            ]);
        }

        if(!Role::where('role', 'Pengguna')->first()){
            Role::create([
                'role' => 'Pengguna',
                'deskripsi' => 'Role Pengguna Aplikasi'
            ]);
        }
    }
}
