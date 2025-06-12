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

        $role = AuthCommon::user()->role ?? null;

        return view('pages.dashboard.v1', compact('role'));
    }
}
