<?php

namespace App\Helpers;

use Carbon\Carbon;

class Util
{
  public static function removeSeperator($rupiah)
  {
    $clean = explode(',', $rupiah);
    $depan = preg_replace('/\D/', '', $clean[0]);
    $belakang = isset($clean[1]) ? $clean[1] : '';
    if ($belakang) {
      $nominal = $depan . '.' . $belakang;
    } else {
      $nominal = $depan;
    }

    return $nominal;
  }

  public static function rupiah($nominal)
  {
    return 'Rp ' . number_format((float) $nominal, 2, ',', '.');
  }

  public static function percent($number)
  {
    return $number . '%';
  }

  public static function generatePassword()
  {
    // $spesial_char = '@#$%^&+=';
    $spesial_char = '+=';
    $rand_spesial = random_int(0, 1);
    $spesial = $spesial_char[$rand_spesial];
    return \Str::random(8) . $spesial . random_int(10, 99) . 'sx';
  }

  public static function getRangeYear($interval)
  {
    $tahun = [];
    $now = date('Y');
    $awal = (int) $now - $interval;
    $akhir = (int) $now + $interval;

    for ($i = $awal; $i <= $akhir; $i++) {
      $tahun[] = $i;
    }

    return $tahun;
  }

  public static function getBulan($interval){
    $bulan = [];
    for($i = $interval; $i <= 12; $i++){
        $bulan[$i] = self::getNamaBulanIndonesia($i);
    }
    return $bulan;
  }

  public static function cDateAsu($date)
  {
    $oDate = Carbon::createFromFormat("Y-m-d\TH:i:s.vP", $date);
    $oDate->setTimezone('+7:00');
    return $oDate->format("Y-m-d H:i:s");
  }

  public static function validationConvert($data = null)
  {
    $formattedErrors = [];
    $data = (array) $data;
    foreach ($data as $key => $item) {
      foreach ($data[$key] as $item2) {
        $formattedErrors[$key][] = ucfirst($key) . " " . strtolower($item2);
      }
    }

    return $formattedErrors;
  }

  public static function status($data)
  {
    $html = '';
    switch ($data) {
      case '1':
        $html = '<span class="badge text-white bg-success">Aktif</span>';
        break;
      case '0':
        $html = '<span class="badge text-white bg-danger">Tidak Aktif</span>';
        break;
      default:
        $html = '';
    }

    return $html;
  }

  public static function object_to_array($data)
  {
    if (is_array($data) || is_object($data)) {
      $result = [];
      foreach ($data as $key => $value) {
        $result[$key] = (is_array($value) || is_object($value)) ? Util::object_to_array($value) : $value;
      }
      return $result;
    }
    return $data;
  }

  public static function terbilang($angka = 0) {
      $angka = floatval($angka);
      $bilangan = array(
        '',
        'satu',
        'dua',
        'tiga',
        'empat',
        'lima',
        'enam',
        'tujuh',
        'delapan',
        'sembilan',
        'sepuluh',
        'sebelas'
      );
      if ($angka < 12) {
        return $bilangan[$angka];
      } else if ($angka < 20) {
        return $bilangan[$angka - 10] . ' belas';
      } else if ($angka < 100) {
        return $bilangan[floor($angka / 10)] . ' puluh ' . $bilangan[$angka % 10];
      } else if ($angka < 200) {
        return 'seratus ' . Util::terbilang($angka - 100);
      } else if ($angka < 1000) {
        return $bilangan[floor($angka / 100)] . ' ratus ' . Util::terbilang($angka % 100);
      } else if ($angka < 2000) {
        return 'seribu ' . Util::terbilang($angka - 1000);
      } else if ($angka < 1000000) {
        return Util::terbilang(floor($angka / 1000)) . ' ribu ' . Util::terbilang($angka % 1000);
      } else if ($angka < 1000000000) {
        return Util::terbilang(floor($angka / 1000000)) . ' juta ' . Util::terbilang($angka % 1000000);
      } else if ($angka < 1000000000000) {
        return Util::terbilang(floor($angka / 1000000000)) . ' miliar ' . Util::terbilang($angka % 1000000000);
      } else if ($angka < 1000000000000000) {
        return Util::terbilang(floor($angka / 1000000000000)) . ' triliun ' . Util::terbilang($angka % 1000000000000);
      } else {
        return 'Angka terlalu besar';
      }
  }

  public static function isPasswordValid($password, $username = null)
  {
      if ($username == null) {
        $regex = '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!])[a-zA-Z0-9@#$%^&+=!]{8,}$/';
      } else {
        $escapedUsername = preg_quote($username, '/');
        $regex = '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=!])[a-zA-Z0-9@#$%^&+=!' . $escapedUsername . ']{8,}$/';
      }

      return preg_match($regex, $password);
  }


  public static function getNamaBulanIndonesia($bulan)
  {
    $namaBulan = [
      'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember',
    ];

    // Pastikan bulan berada dalam rentang 1 hingga 12
    if ($bulan >= 1 && $bulan <= 12) {
      return $namaBulan[$bulan - 1];
    } else {
      return 'Bulan tidak valid';
    }
  }

  public static function tanggal_bahasa($tanggal){
    return str_replace('(', self::getNamaBulanIndonesia(Carbon::parse($tanggal)->format('m')), Carbon::parse($tanggal)->format('d ( Y H:i'));
  }
}

