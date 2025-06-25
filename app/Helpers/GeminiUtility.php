<?php
namespace App\Helpers;

use App\Models\JawabanUser;
use App\Models\KategoriPertanyaan;
use App\Models\Pertanyaan;
use App\Models\SesiJournal;
use Exception;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class GeminiUtility{

  static function tentukanTemaHarian(string $ringkasanKemarin, int $userId): string
  {
     // Kunci cache yang unik per pengguna per hari
        $cacheKey = 'tema_harian_' . $userId . '_' . date('Y-m-d');

        // Simpan tema di cache sampai akhir hari
        $tema = Cache::remember($cacheKey, now()->endOfDay(), function () use ($ringkasanKemarin) {
            // Daftar tema yang tersedia di aplikasimu
            $daftarTema = KategoriPertanyaan::pluck('kategori')->toArray();
            $daftarTemaString = "- " . implode("\n- ", $daftarTema);

            // Merancang prompt dengan menggunakan sintaks HEREDOC untuk kemudahan membaca
            $prompt = <<<PROMPT
            [Peran]
            Anda adalah seorang life coach AI yang cerdas dan bertugas merekomendasikan tema jurnal harian yang bermanfaat.

            [Konteks]
            Seorang pengguna kemarin mendapatkan ringkasan jurnal sebagai berikut:
            "{$ringkasanKemarin}"

            [Daftar Tema yang Tersedia]
            Berikut adalah pilihan tema yang bisa saya berikan kepada pengguna hari ini:
            {$daftarTemaString}

            [Tugas Utama]
            Berdasarkan ringkasan jurnal pengguna kemarin, pilih SATU tema dari daftar di atas yang paling relevan dan bermanfaat untuk dieksplorasi oleh pengguna hari ini.

            [Instruksi Tambahan]
            Kembalikan jawaban HANYA berupa nama tema yang kamu pilih. Contoh: "Mengatasi Kecemasan".
            PROMPT;

            try {
                $response = Gemini::generativeModel('gemini-2.0-flash')->generateContent($prompt);

                // Membersihkan respons dari spasi atau baris baru yang tidak diinginkan
                $tema = trim($response->text());

                // Fallback jika Gemini mengembalikan jawaban kosong atau tidak ada di daftar
                if (empty($tema) || !in_array($tema, $daftarTema)) {
                    return $daftarTema[array_rand($daftarTema)]; // Pilih tema acak sebagai fallback
                }

                return $tema;

            } catch (Exception $e) {
                Log::error('Gagal menentukan tema dari Gemini: ' . $e->getMessage());
                // Jika API gagal, pilih tema acak sebagai fallback
                return $daftarTema[array_rand($daftarTema)];
            }
        });

        return $tema;
  }

  static function get_pertanyaan_harian(string $tema): array
  {
    // Nama unik untuk cache kita
    $cacheKey = 'pertanyaan_harian_' . date('Y-m-d') . '_' . Str::slug($tema);
    $pertanyaanTerpilih = Cache::remember($cacheKey, now()->endOfDay(), function () use ($tema) {

        // Cache::remember akan:
        // 1. Cek apakah ada cache dengan key '$cacheKey'.
        // 2. Jika ADA, langsung kembalikan isinya.
        // 3. Jika TIDAK ADA, jalankan fungsi di bawah, simpan hasilnya ke cache, lalu kembalikan.

        // Format daftar pertanyaan menjadi string bernomor agar mudah dibaca oleh AI
        $daftarPertanyaanString = "";
        $daftarPertanyaan = Pertanyaan::with('kategori_pertanyaan')->get();
        foreach ($daftarPertanyaan as $index => $item) {
            $nomor = $index + 1;
            $kategori = $item->kategori_pertanyaan->kategori ?? 'Umum';
            $daftarPertanyaanString .= "{$nomor}. {$item->pertanyaan} (Kategori: {$kategori})\n";
        }

        $prompt = <<<PROMPT
        [Peran]
        Anda adalah seorang kurator jurnal yang bijaksana dan empatik.

        [Konteks]
        Saya sedang menyiapkan satu set pertanyaan jurnal harian untuk seorang pengguna. Tema untuk hari ini adalah "{$tema}".

        [Tugas]
        Dari daftar pertanyaan di bawah ini, pilih 10 pertanyaan yang paling relevan dengan tema "{$tema}". Susunlah urutannya agar terasa mengalir: dimulai dari yang ringan, kemudian sedikit lebih dalam, dan diakhiri dengan nada yang positif.

        [Instruksi Tambahan]
        - Pastikan pertanyaan yang dipilih bervariasi.
        - Kembalikan jawaban HANYA dalam bentuk daftar bernomor (1. Pertanyaan... 2. Pertanyaan... dst.), tanpa ada teks pembuka atau penutup.

        [Data Pertanyaan]
        {$daftarPertanyaanString}
        PROMPT;

        $response = Gemini::generativeModel('gemini-2.0-flash')->generateContent($prompt);
        try {

            // Parsing respons teks menjadi array.
            // Gemini biasanya akan mengembalikan format "1. Teks\n2. Teks\n...".
            // Kita perlu membersihkan nomor dan spasi di depannya.
            $lines = explode("\n", trim($response->text()));
            $hasilParsing = [];
            foreach ($lines as $line) {
                // Regex untuk menghapus format nomor seperti "1. " atau "1) "
                $cleanedLine = trim(preg_replace('/^\s*\d+[\.\)]\s*/', '', $line));
                if (!empty($cleanedLine)) {
                    $hasilParsing[] = $cleanedLine;
                }
            }

            // Fallback jika parsing gagal atau jumlahnya kurang dari 10
            if(count($hasilParsing) < 10) {
               $pertanyaanAcak = $daftarPertanyaan->shuffle()->take(10);
                return $pertanyaanAcak->pluck('pertanyaan')->toArray();
            }

            return array_slice($hasilParsing, 0, 10);

        } catch (Exception $e) {
            Log::error('Gagal memilih pertanyaan dari Gemini: ' . $e->getMessage());
            $pertanyaanAcak = $daftarPertanyaan->shuffle()->take(10);
            return $pertanyaanAcak->pluck('pertanyaan')->toArray();
        }
    });

    return $pertanyaanTerpilih;
  }

  static function buatKesimpulanSesi($sesi_jurnal_id): string
  {
        $jawaban = JawabanUser::where('sesi_jurnal_id', $sesi_jurnal_id)->get();

        if ($jawaban->count() < 10) {
            return "Sepertinya obrolan kita belum selesai. Yuk, lanjutkan lagi nanti.";
        }

        $cacheKey = 'kesimpulan_sesi_' . $sesi_jurnal_id;

        $kesimpulan = Cache::rememberForever($cacheKey, function () use ($sesi_jurnal_id, $jawaban) {
            // Langkah 2: Format data menjadi string yang mudah dibaca oleh AI.
            $dataObrolanString = "";
            $pertanyaan = json_decode(SesiJournal::find($sesi_jurnal_id)->kumpulan_pertanyaan);
            for($i = 0; $i < count($pertanyaan); $i++){
                $dataObrolanString .= "Q: {$pertanyaan[$i]}\n";
                $dataObrolanString .= "A: {$jawaban[$i]->jawaban_user}\n";
                $dataObrolanString .= "---\n";
            }

            // Langkah 3: Rancang prompt yang detail dan empatik.
            $prompt = <<<PROMPT
            [Peran]
            Anda adalah "Jurnal Kamu", sebuah partner AI yang hangat, empatik, dan sangat peduli. Anda berbicara layaknya seorang teman baik atau pasangan yang suportif.

            [Konteks]
            Pengguna baru saja menyelesaikan sesi jurnal hariannya dengan menjawab 10 pertanyaan. Tugas Anda adalah membaca seluruh percakapan dan memberikan sebuah kesimpulan yang menyentuh dan penuh pemahaman.

            [Data Obrolan Lengkap]
            {$dataObrolanString}

            [Tugas Utama]
            1.  Sapa pengguna dengan hangat (contoh: "Hey, makasih ya udah cerita banyak hari ini...").
            2.  Tulis sebuah paragraf kesimpulan yang personal.
            3.  Di dalam paragraf tersebut, sebutkan secara spesifik 1-2 poin positif dari cerita pengguna (misalnya, keberhasilan atau momen bahagia yang ia sebutkan) untuk menunjukkan bahwa Anda benar-benar mendengarkan.
            4.  Akui juga 1-2 poin yang terasa berat atau menyedihkan jika ada, dan tunjukkan empati.
            5.  Berikan kesimpulan umum tentang mood pengguna secara keseluruhan (contoh: "Secara umum, sepertinya harimu cukup produktif walau sedikit melelahkan.").
            6.  Tutup dengan kalimat yang menenangkan atau memberi semangat untuk hari esok.

            [Gaya Bahasa]
            - Gunakan bahasa "aku-kamu" yang personal dan santai.
            - Jangan terdengar seperti psikolog, terapis, atau robot. Jadilah teman.
            - Gunakan emoji secukupnya untuk menambah kehangatan (contoh: ❤️, ✨, 💪).
            - Jangan gunakan format list atau poin, buatlah dalam bentuk paragraf naratif yang mengalir.
            PROMPT;


            $response = Gemini::generativeModel('gemini-2.0-flash')->generateContent($prompt);
            try {
                // Langkah 4: Panggil Gemini API untuk mendapatkan kesimpulan.
                $kesimpulan = trim($response->text());
                return $kesimpulan;

            } catch (Exception $e) {
                Log::error('Gagal membuat kesimpulan dari Gemini: ' . $e->getMessage());
                return "Maaf, sepertinya aku sedang kesulitan merangkai kata saat ini. Coba lihat lagi nanti ya.";
            }
        });

        return $kesimpulan;
    }

}
