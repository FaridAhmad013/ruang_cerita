<?php

namespace App\DataTables;

use App\Helpers\AuthCommon;
use App\Helpers\ConstantUtility;
use App\Helpers\Util;
use App\Models\TBprDokumenSmki;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TBprDokumenSmkiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $bpr = @request('search')['bpr'];
        if($bpr){
            $query->where('bpr_id', $bpr);
        }

        $judul = @request('search')['judul'];
        if($judul){
            $query->where('judul', $judul);
        }

        $status = @request('search')['status'];
        if($status){
            $query->where('status', $status);
        }

        $start_uploaded_at = @request('search')['start_uploaded_at'];
        $end_uploaded_at = @request('search')['end_uploaded_at'];
        if ($start_uploaded_at && $end_uploaded_at) {
            if ($start_uploaded_at === $end_uploaded_at) {
                $query->whereDate('uploaded_at', $start_uploaded_at);
            } else {
                $query->whereBetween('uploaded_at', [$start_uploaded_at, $end_uploaded_at]);
            }
        }

        $start_authorization_at = @request('search')['start_authorization_at'];
        $end_authorization_at = @request('search')['end_authorization_at'];
        if ($start_authorization_at && $end_authorization_at) {
            if ($start_authorization_at === $end_authorization_at) {
                $query->whereDate('authorization_at', $start_authorization_at);
            } else {
                $query->whereBetween('authorization_at', [$start_authorization_at, $end_authorization_at]);
            }
        }
        return (new EloquentDataTable($query))
            ->addColumn('aksi', function ($data) {
                $html = '';
                $html = '<a href="'.route('kelola_dokumen.show', $data->id). '" class="btn btn-success btn-sm" title="Detail Dokumen"><i class="fas fa-file"></i> DETAIL</a>';
                if($data->status == ConstantUtility::STATUS_APPROVED){
                    $html .= '<a href="javascript:show_piagam_penerimaan('.$data->id.')" class="btn btn-warning btn-sm" title="Lihat Piagam Penerimaan"><i class="fas fa-gift"></i> PIAGAM</a>';
                }
                return $html;
            })
            ->addColumn('bpr', function ($item) {
                $bpr = $item->_bpr;
                if ($bpr) {
                    $corporate = $bpr->perusahaan;
                    return strtoupper(($corporate ? $corporate->name : '').' '.($bpr->jenis_bank).' '.($bpr->name ?? ''));
                }
                return '';
            })
            ->editColumn('status', function($item){
                return Util::status_dokumen($item->status, $item->id);

            })
            ->editColumn('uploaded_at', function ($data) {
                if ($data->uploaded_at) {
                    return Carbon::parse($data->uploaded_at)->format('d-m-Y H:i:s');
                }
                return '';
            })
            ->editColumn('authorization_at', function ($data) {
                if ($data->authorization_at) {
                    return Carbon::parse($data->authorization_at)->format('d-m-Y H:i:s');
                }
                return '';
            })
            ->rawColumns(['aksi', 'bpr', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TBprDokumenSmki $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TBprDokumenSmki $model): QueryBuilder
    {
        return $model->newQuery()->with('_bpr')->filterBpr();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('aksi')
                ->title('aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->orderable(false)
                ->searchable(false),
            Column::make('nomor_transaksi'),
            Column::make('bpr'),
            Column::make('judul'),
            Column::make('tahun'),
            Column::make('nama_pic'),
            Column::make('jabatan_pic'),
            Column::make('uploaded_at')->title('Diunggah Pada'),
            Column::make('authorization_at')->title('Otorisasi Pada'),
            Column::make('nama_approver')->title('Otorisasi Oleh'),
            Column::make('status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ManajemenDokumenSmki_' . date('YmdHis');
    }
}
