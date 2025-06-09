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
        if (!in_array(AuthCommon::user()->role->name, ['Admin','Admin SMKI', 'Admin Bpr', 'Web Admin Perbarindo', 'Konsultan SMKI'])) abort('403');

        $role = AuthCommon::user()->role ?? null;
        $tahun_sekarang = intval(Carbon::now()->format('Y'));
        $tahun_belakang = $tahun_sekarang - 10;
        $tahun_depan = $tahun_sekarang + 1;
        $tahun = [];
        for ($i = $tahun_belakang; $i <= $tahun_depan; $i++) {
            $tahun[] = $i;
        }
        $bulan = Util::getBulan(1);


        $last_log_bpr = LogActivitySmki::where('activity', ConstantUtility::LOG_ACTIVATION_SMKI_ACCOUNT)
            ->where('bpr_name', '<>', null)
            ->orderBy('activity_date', 'desc')
            ->limit(10)
            ->get()->toArray();

        $account = AauthUser::where('status', '1')
            ->whereHas('aauth_groups', function ($query) {
                $query->where('name', 'Admin Bpr');
            });

        $all_account = $account->count();
        $smki_account = $account->where('smki_account',  1)->count();

        return view('pages.dashboard.v1', compact('tahun', 'bulan', 'last_log_bpr', 'all_account', 'smki_account', 'role'));
    }

    public function get_data(Request $request){
        $auth = AuthCommon::user();
        $data = [
            'jumlah_menunggu_persetujuan' => 0,
            'jumlah_ditolak' => 0,
            'jumlah_diterima' => 0,
        ];
        try {
            if ($auth->role) {
                $data['jumlah_menunggu_persetujuan'] = TBprDokumenSmki::status(ConstantUtility::STATUS_NEED_APPROVAL)->filterBpr()->count();
                $data['jumlah_ditolak'] = TBprDokumenSmki::status(ConstantUtility::STATUS_REJECTED)->filterBpr()->count();
                $data['jumlah_diterima'] = TBprDokumenSmki::status(ConstantUtility::STATUS_APPROVED)->filterBpr()->count();
            }

            return response([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response([
                'data' => $data,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function check_match_ip()
    {
        $auth = AuthCommon::user() ?? null;
        $user = AauthUser::select('last_ip_address')->where('id', $auth->id)->first();

        if ($auth && $user) {
            if($user->last_ip_address == $auth->last_ip_address){
                return response([
                    'status' => true,
                    'message' => ResponseConstant::RM_IP_ADDRESS_IS_MATCH
                ]);
            } else {
                return response([
                    'status' => false,
                    'message' => ResponseConstant::RM_IP_ADDRESS_DOES_NOT_MATCH
                ], 400);
            }
        }

        return response([
            'status' => false,
            'message' => ResponseConstant::RM_BAD_REQUEST
        ], 400);
    }

    public function grafik_smki(Request $request, LarapexChart $chart){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $chart = new GrafikJumlahUploadChart($chart);
        $data = $chart->build($tahun, $bulan);

        return response()->json(['status' => true, 'data' => $data]);
    }

    public function grafik_pengajuan_dokumen(Request $request, LarapexChart $chart){
        try {
            $tahun = $request->tahun;
            $bulan = $request->bulan;
            $chart = new GrafikPengajuanDokumenChart($chart);
            $data = $chart->build($tahun, $bulan);
            return response([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
