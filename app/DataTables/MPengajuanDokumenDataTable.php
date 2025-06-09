<?php

namespace App\DataTables;

use App\Helpers\AuthCommon;
use App\Helpers\Util;
use App\Models\MPengajuanDokumen;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MPengajuanDokumenDataTable extends DataTable
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
            ->editColumn('id', function ($data) {
                $html = '';

                $role = AuthCommon::user()->role ?? null;
                if(in_array($role->name, ['Web Admin', 'Admin', 'Admin SMKI', 'Web Admin Perbarindo'])){
                    $html = '<div class="btn-group btn-group-sm">';
                    $html .= '<button onclick="destroy('.$data->id.')" type="button" class="btn btn-sm btn-default" title="Hapus"><i class="fas fa-trash"></i></button>';
                    $html .= '<button onclick="edit('.$data->id.')" type="button" class="btn btn-sm btn-default" title="Ubah"><i class="fas fa-pen"></i></button>';
                    $html .= '</div>';
                }
                return $html;
            })
            ->editColumn('status', function($item){
                return Util::status_kelengkapan($item->status);
            })
            ->editColumn('created_at', function($data){
                return $data->created_at->format('d-m-Y H:i:s');
            })
            ->editColumn('updated_at', function ($data) {
                return $data->updated_at->format('d-m-Y H:i:s');
            })
            ->rawColumns(['id', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TBprDokumenSmki $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MPengajuanDokumen $model): QueryBuilder
    {
        return $model->newQuery();
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
                ->searchable(false)
                ->className('text-center'),
            Column::make('judul'),
            Column::make('status')->className('text-center'),
            Column::make('created_at')->title('Dibuat Pada'),
            Column::make('updated_at')->title('Diperbarui Pada'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'MasterKelengkapanDokumen_' . date('YmdHis');
    }
}
