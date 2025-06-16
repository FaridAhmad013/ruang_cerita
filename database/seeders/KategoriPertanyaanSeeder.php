<?php

namespace Database\Seeders;

use App\Models\KategoriPertanyaan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriPertanyaan::insert([
            ["kategori" => "Perasaan & Emosi", 'created_at' => Carbon::now()],
            ["kategori" => "Aktifitas & Produktivitas", 'created_at' => Carbon::now()],
            ["kategori" => "Kesehatan Fisik", 'created_at' => Carbon::now()],
            ["kategori" => "Interaksi Sosial", 'created_at' => Carbon::now()],
            ["kategori" => "Tantangan dan Pencapaian", 'created_at' => Carbon::now()],
            ["kategori" => "Kebiasaan", 'created_at' => Carbon::now()],
            ["kategori" => "Kreatifitas dan inspirasi", 'created_at' => Carbon::now()],
            ["kategori" => "Keuangan & Tujuan", 'created_at' => Carbon::now()],
            ["kategori" => "Sprititual", 'created_at' => Carbon::now()],
            ["kategori" => "Refleksi & Harapan", 'created_at' => Carbon::now()]
        ]);
    }
}
