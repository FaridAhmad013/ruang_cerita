<?php

namespace App\Http\Controllers;

use App\Charts\GrafikJumlahUploadChart;
use App\Charts\GrafikPengajuanDokumenChart;
use App\Helpers\AuthCommon;
use App\Helpers\ConstantUtility;
use App\Helpers\ResponseConstant;
use App\Helpers\Util;
use App\Models\AauthUser;
use App\Models\TBprDokumenSmki;
use App\Models\LogActivitySmki;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!in_array(AuthCommon::user()->role->role, ['Admin','Pengguna'])) abort('403');

        $user = AuthCommon::user();
        $role = $user->role ?? null;
        $waktu_sekarang = Carbon::now()->format('H:i');

        $nama_lengkap = @$user->nama_depan.' '.@$user->nama_belakang;
        if ($waktu_sekarang >= '05:00' && $waktu_sekarang < '10:00') {
            $ucapan = "Selamat Pagi, $nama_lengkap.";
        } elseif ($waktu_sekarang >= '10:00' && $waktu_sekarang < '15:00') {
            $ucapan = "Bagaimana kabarmu siang ini, $nama_lengkap?";
        } elseif ($waktu_sekarang >= '15:00' && $waktu_sekarang < '18:00') {
            $ucapan = "Semoga harimu berjalan baik, $nama_lengkap.";
        } else {
            $ucapan = "Selamat beristirahat, $nama_lengkap.";
        }

        return view('pages.dashboard.v1', compact('role', 'ucapan'));
    }
}
