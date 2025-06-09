<?php

namespace App\Charts;

use App\Helpers\AuthCommon;
use App\Helpers\ConstantUtility;
use App\Helpers\Util;
use App\Models\TBprDokumenSmki;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GrafikJumlahUploadChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($tahun, $bulan = null)
    {
        $auth = AuthCommon::user();
        $i = 1;
        $max = 0;

        $currentDate = Carbon::parse($tahun.'-01-01');
        $max = $currentDate->daysInMonth;
        if(!$bulan && $bulan == null){
            $max = 12;
        }

        $waitingApprovalData = [];
        $rejectedData = [];
        $approvedData = [];
        $label = [];
        for (; $i <= $max; $i++) {
            if(!$bulan && $bulan == null){
                $date = $currentDate->setMonth($i);
                $label[] = Util::getNamaBulanIndonesia($currentDate->month).' '. $currentDate->year;
            } else {
                $currentDate->setMonth($bulan);
                $date = $currentDate->setDay($i);
                $label[] = $currentDate->format('d-m-Y');
            }
            $formattedDate = $date->format('Y-m-d');
            if(!$bulan && $bulan == null){
                $formattedDate = $date->format('Y-m');
            }
            $waitingApprovalCount = TBprDokumenSmki::dateRange($formattedDate)->status(ConstantUtility::STATUS_NEED_APPROVAL)->filterBpr()->count();
            $rejectedCount = TBprDokumenSmki::dateRange($formattedDate)->status(ConstantUtility::STATUS_REJECTED)->filterBpr()->count();
            $approvedCount = TBprDokumenSmki::dateRange($formattedDate)->status(ConstantUtility::STATUS_APPROVED)->filterBpr()->count();

            $waitingApprovalData[] = $waitingApprovalCount;
            $rejectedData[] = $rejectedCount;
            $approvedData[] = $approvedCount;
        }


        return [
            'labels' => $label,
            'datasets' => [
                [
                    'name' => 'Menunggu Persetujuan',
                    'data' => $waitingApprovalData,
                    'color' => '#fb6340'
                ],
                [
                    'name' => 'Ditolak',
                    'data' => $rejectedData,
                    'color' => '#f5365c'
                ],
                [
                    'name' => 'Disetujui',
                    'data' => $approvedData,
                    'color' => '#2dce89'
                ],
            ],
        ];
    }
}
