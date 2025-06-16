<?php

namespace Database\Seeders;

use App\Models\Pertanyaan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pertanyaan::insert([
            //perasaan & emosi
                ["pertanyaan" => "Hari ini rasanya kayak apa, sih? Kayak cerah, mendung, atau hujan badai?"  , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Adeeeeh, ada yang bikin kamu senyum-senyum sendiri hari ini? Cerita dong!"  , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau aku boleh tebak, kayaknya kamu lagi ada beban, nggak sih? Boleh bagi-bagi?" , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Tadi malem tidurnya nyenyak atau bolak-balik gulingan?"  , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Aku penasaran, hal apa yang bikin kamu paling bersyukur hari ini?"  , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalo hari ini bisa di-rewind, kamu mau ulang bagian apa?"  , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Lagi banyak overthinking atau santai aja nih hari ini?"  , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Wah, kalo perasaanmu sekarang bisa jadi lagu, kira-kira judulnya apa?"  , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada yang bikin kamu ngerasa ah, pengen pelukan sekarang?"  , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Skala 1-10, seberapa bahagia kamu hari ini? Boleh kasih tau kenapa?" , "kategori_pertanyaan_id" => "1", 'created_at' => Carbon::now()],
            //aktifitas dan produktifitas
                ["pertanyaan" => "Hari ini produktif banget atau malah sosmed-an terus?  jujur ajaaaa"  , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Aktivitas paling seru hari ini apa? Jangan bilang scroll TikTok doang!"  , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu ngerjain sesuatu yang bikin kamu nah, ini worth it banget hari ini?" , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada tugas yang kamu nggak ngerjain karena males? Aku nggak judge kok!"  , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalo besok bisa lebih baik, kamu mau fokus ngapain?"  , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Hari ini lebih banyak ah, nanti aja atau gaskeun selesaiin!?"  , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Aku penasaran, apa hal kecil yang kamu selesaikan tapi bikin lega??"  , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih banyak duduk atau gerak hari ini? Jangan lupa stretching!"  , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada skill baru yang kepikiran buat dipelajari? Aku bisa bantu cari infonya!" , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Skala 1-10, seberapa puas sama cara kamu ngabisin waktu hari ini?" , "kategori_pertanyaan_id" => "2", 'created_at' => Carbon::now()],
            //kesehatan fisik
                ["pertanyaan" => "Tubuhmu ngomong apa hari ini? Capek, enerjik, atau tolong istirahat?" , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Minum airnya cukup? Cekokin air minerall Jangan sampe dehidrasi!"  , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Sarapan/makan siangnya enak nggak? Jangan bilang cuma kopi doang!"  , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Olahraga hari ini? Jalan kaki ke warung juga udah termasuk, lho!"  , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada bagian tubuh yang sakit atau nggak nyaman? Jangan diabaikan ya!" , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Udah cek postur dudukmu hari ini? Jangan bungkuk mulu~"  , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalo energi kamu hari ini bisa diukur, baterainya berapa persen?"  , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang bikin kamu ngerasa ah, badan butuh istirahat banget nih?" , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu ngemil apa hari ini? aku juga suka ngemil, jangan disimpan sendiri, bagi bagii dong"  , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Besok mau coba hidup lebih sehat? Aku temenin!" , "kategori_pertanyaan_id" => "3", 'created_at' => Carbon::now()],
            //interaksi sosial
                ["pertanyaan" => "Siapa yang paling bikin kamu senyum hari ini? Boleh tag mereka wkwk."  , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada yang bikin kamu kesel atau kecewa? Cerita aja, aku dengerin kok." , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih banyak ngobrol atau ngerem sendiri hari ini?" , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada orang yang bikin kamu ngerasa thank God ada dia hari ini?" , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau bisa teleport ke satu orang sekarang, kamu mau ketemu siapa?" , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu ngerasa didukung atau justru dikritik hari ini?" , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada compliment yang pengen kamu dengar tapi belum kesampaian?"  , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih sering bantu orang atau minta bantuan hari ini?" , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada konflik yang masih dipikirin? Aku siap jadi sounding board!" , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Skala 1-10, seberapa connected kamu sama orang lain hari ini?" , "kategori_pertanyaan_id" => "4", 'created_at' => Carbon::now()],
            //tantangan & pencapaian
                ["pertanyaan" => "Ajaib banget kamu berhasil ngelakuin apa hari ini? aku yakin pasti ada!" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalo ada satu masalah yang bisa ilang besok, kamu mau apa?" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang bikin kamu ngerasa wah, aku kuat banget ternyata?"  , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada keputusan yang kamu sesali atau justru bangga hari ini?" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Pelangi setelah hujan: pelajaran apa yang kamu dapet hari ini?" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Besok mau coba hadapi apa yang kamu hindari hari ini?" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang bikin kamu ngerasa yes, aku berkembang!?" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau bisa kasih nasihat ke diri sendiri di pagi tadi, apa yang mau kamu bilang?" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa satu hal kecil yang bisa bikin besok 10% lebih baik?" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih banyak ngerasa berhasil atau gagal hari ini?" , "kategori_pertanyaan_id" => "5", 'created_at' => Carbon::now()],
            //kebiasaan
                ["pertanyaan" => "Hari ini kamu udah ngapain aja buat diri sendiri? jangan bilang cuma tidur doang!"  , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada kebiasaan kecil yang bikin kamu ngerasa ini beneran membantu banget?" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalo punya waktu ekstra 1 jam hari ini, mau kamu pake buat apa?" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Aroma atau suara apa yang bikin kamu ngerasa tenang hari ini?" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Skala 1-10, seberapa sering kamu ngecek HP hari ini? aku juga suka lupa waktu!" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada benda di sekitarmu yang bikin betah atau justru ganggu konsentrasi?" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih sering bilang iya atau nggak ke orang lain hari ini?" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Aktivitas apa yang bikin kamu ngerasa ah, ini me-time banget?" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalo hari ini ada tombol reset, bagian mana yang mau kamu ulang?" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang pengen kamu lakukan tapi belum kesampaian? jangan disimpan mulu!" , "kategori_pertanyaan_id" => "6", 'created_at' => Carbon::now()],
            //kreatifitas & inspirasi
                ["pertanyaan" => "Ada ide random yang tiba-tiba muncul hari ini? cerita dong, siapa tau seru!" , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu nemu konten/hal menarik di internet hari ini? share lah~" , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau bisa ngerjain project kreatif tanpa batas, mau bikin apa?"  , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Lagi ada fase mentok atau banyak ide nih?" , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang bikin kamu ngerasa wow, aku keren banget hari ini?"  , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih banyak ngerasa bosen atau penasaran hari ini?" , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada quote/kata-kata yang nempel di pikiranmu hari ini?"  , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau bisa kolab dengan siapa pun di dunia, kamu mau ajak siapa?" , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa warna yang paling mewakili harimu? aku tebak biru… atau merah?"  , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Besok mau coba eksplor hal baru? Aku temenin!" , "kategori_pertanyaan_id" => "7", 'created_at' => Carbon::now()],
            //keuangan dan tujuan
                ["pertanyaan" => "Hari ini ada pengeluaran yang bikin kamu aduh, harusnya nggak sih?"  , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau bisa dapet uang tambahan sekarang, mau dipake buat apa?" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lagi ngerasa aman atau khawatir soal keuangan?" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada rencana finansial kecil yang kamu lakukan hari ini?" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Impian apa yang pengen kamu tabung buat capai?" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu belanja online hari ini? jujur aja, nggak akan laporin ke siapapun kok wkwk" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau besok dapet uang tak terduga, mau beliin apa buat diri sendiri?" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang bikin kamu ngerasa hidup aku cukup kok sekarang?" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih banyak mikirin hari ini atau masa depan soal uang?" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Skala 1-10, seberapa puas kamu dengan manajemen uangmu hari ini?" , "kategori_pertanyaan_id" => "8", 'created_at' => Carbon::now()],
            //sprititual
                ["pertanyaan" => "Kamu sempet berdoa/meditasi/heningin pikiran hari ini?" , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada momen hari ini yang bikin kamu ngerasa terkoneksi dengan sesuatu?"  , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu sempet berdoa/meditasi/heningin pikiran hari ini?" , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau bisa dapet jawaban dari alam semesta, apa yang mau kamu tanya?" , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih sering ngerasa bersyukur atau pengen lebih hari ini?" , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa hal kecil yang bikin kamu ngerasa hidup itu indah?" , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Ada tempat atau situasi yang bikin kamu ngerasa damai hari ini?" , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau bisa lepas satu beban pikiran, apa yang mau kamu buang?"  , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang pengen kamu ingat saat lagi stres? aku bisa bantu ingetin" , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Skala 1-10, seberapa tenang pikiranmu hari ini?" , "kategori_pertanyaan_id" => "9", 'created_at' => Carbon::now()],
            //refleksi
                ["pertanyaan" => "Kalau umurmu cuma tinggal 1 tahun, apa yang mau kamu ubah dari hari ini?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang pengen kamu lakukan tapi takut dicemooh orang?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih takut gagal atau nggak pernah nyoba?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Siapa dirimu hari ini: versi yang kamu banggain atau yang kamu sembunyiin?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa kualitas terbaikmu yang keluar hari ini?"  , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kalau besok adalah hari terakhirmu, apa yang mau kamu tinggalin?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Apa yang bikin kamu ngerasa aku layak dapat lebih hari ini?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Kamu lebih sering ngerasa cukup atau kurang hari ini?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Pesan apa yang mau kamu sampaikan ke diri sendiri 5 tahun lalu?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
                ["pertanyaan" => "Terakhir, peluk virtual dari aku! Kamu hebat hari ini karena apa?" , "kategori_pertanyaan_id" => "10", 'created_at' => Carbon::now()],
        ]);
    }
}
