<?php

namespace App\DataTables;

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

class TBprDokumenSmkiOtorisasiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('aksi', function ($data) {
                $html = '<a href="' . route('otorisasi_dokumen.show', $data->id) . '" class="ml-3 btn btn-success btn-sm" title="Detail Dokumen"><i class="fas fa-file"></i> DETAIL</a>';
                return $html;
            })
            ->addColumn('bpr', function ($item) {
                $bpr = $item->_bpr;
                if ($bpr) {
                    $corporate = $bpr->perusahaan;
                    $bpr_name = strtoupper(($corporate ? $corporate->name : '') . ' ' . ($bpr->jenis_bank) . ' ' . ($bpr->name ?? ''));
                    return $bpr_name;
                }
                return '';
            })
            ->editColumn('status', function ($item) {
                return Util::status_dokumen($item->status);
            })
            ->editColumn('uploaded_at', function ($data) {
                if($data->uploaded_at){
                    return Carbon::parse($data->uploaded_at)->format('d-m-Y H:i:s');
                }
                return '';
            })
            ->rawColumns(['aksi', 'status', 'judul']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TBprDokumenSmki $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TBprDokumenSmki $model): QueryBuilder
    {
        return $model->newQuery()->with('_bpr')->status(ConstantUtility::STATUS_NEED_APPROVAL);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('masterkelengkapandokumenapproval-table')
        ->columns($this->getColumns())
        // ->minifiedAjax()
        ->dom("<'row'<'col-sm-6'B><'col-sm-3'f><'col-sm-3'l>> <'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
        ->orderBy(7, 'desc')
        ->buttons([
            Button::make('excel'),
            Button::make('csv'),
            Button::make('pdf'),
            Button::make('print'),
        ])
        ->scrollY('100011021000110')
        ->scrollX(true);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('id')
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
