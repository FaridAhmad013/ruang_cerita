<?php

namespace App\DataTables;

use App\Models\LogActivitySmki;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LogActivitySmkiDataTable extends DataTable
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
            ->editColumn('activity_date', function($item){
                if ($item->activity_date) {
                    return Carbon::parse($item->activity_date)->format('d-m-Y H:i:s');
                }
                return '';
            })
            ->rawColumns(['activity_date']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TBprDokumenSmki $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LogActivitySmki $model): QueryBuilder
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
            Column::make('bpr_name')->title('Nama BPR'),
            Column::make('activity')->title('Aktivitas'),
            Column::make('username')->title('Username'),
            Column::make('user_json')->title('Atribut User'),
            Column::make('action_by_user')->title('Aksi Oleh'),
            Column::make('activity_date')->title('Tanggal Aktivitas'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'LogActivitySmki_' . date('YmdHis');
    }
}
