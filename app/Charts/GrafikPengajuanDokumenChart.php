<?php

namespace App\Charts;

use App\Helpers\AuthCommon;
use App\Helpers\ConstantUtility;
use App\Helpers\Util;
use App\Models\TBprDokumenSmki;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GrafikPengajuanDokumenChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($tahun, $bulan = null)
    {
        $label = [
            'Menunggu Persetujuan',
            'Ditolak',
            'Disetujui'
        ];

        $data_need_approval = TBprDokumenSmki::status(ConstantUtility::STATUS_NEED_APPROVAL)->filterBpr();
        $data_rejected = TBprDokumenSmki::status(ConstantUtility::STATUS_REJECTED)->filterBpr();
        $data_approved = TBprDokumenSmki::status(ConstantUtility::STATUS_APPROVED)->filterBpr();
        if($tahun){
            $data_need_approval->whereYear('uploaded_at', $tahun);
            $data_rejected->whereYear('uploaded_at', $tahun);
            $data_approved->whereYear('uploaded_at', $tahun);
        }

        if($bulan){
            $data_need_approval->whereMonth('uploaded_at', $bulan);
            $data_rejected->whereMonth('uploaded_at', $bulan);
            $data_approved->whereMonth('uploaded_at', $bulan);
        }

        return [
            'labels' => $label,
            'series' => [
                $data_need_approval->count(),
                $data_rejected->count(),
                $data_approved->count(),
            ],
            'chart' => [
                'type' => 'pie',
                'width' => '550'
            ],
            'colors' =>['#fb6340', '#f5365c', '#2dce89']
        ];
    }
}
