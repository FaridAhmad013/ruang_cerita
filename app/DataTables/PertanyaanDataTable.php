<?php

namespace App\DataTables;

use App\Models\Pertanyaan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PertanyaanDataTable extends DataTable
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
            ->addColumn('aksi', function ($data) {
                $html = '<div class="btn-group btn-group-sm" branch="group">';
                $html .= '<button onclick="edit('.$data->id.')" type="button" class="btn btn-sm btn-default" title="Ubah"><i class="fas fa-pen"></i></button>';
                $html .= '<button onclick="destroy('.$data->id.')" type="button" class="btn btn-sm btn-default" title="Hapus"><i class="fas fa-trash"></i></button>';
                $html .= '</div>';
                return $html;
            })
            ->editColumn('pertanyaan', function($item){
                return '<a href="javascript:show('.$item->id.')">'.$item->pertanyaan.'</a>';
            })
            ->addColumn('kategori_pertanyaan', function ($item) {
                $kategori_pertanyaan = $item->kategori_pertanyaan;
                if ($kategori_pertanyaan) {
                    return $kategori_pertanyaan->kategori;
                }
                return '';
            })
            ->editColumn('created_at', function ($data) {
                if ($data->created_at) {
                    return Carbon::parse($data->created_at)->format('d-m-Y H:i:s');
                }
                return '';
            })
            ->editColumn('updated_at', function ($data) {
                if ($data->updated_at) {
                    return Carbon::parse($data->updated_at)->format('d-m-Y H:i:s');
                }
                return '';
            })
            ->rawColumns(['aksi', 'pertanyaan']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pertanyaan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pertanyaan $model): QueryBuilder
    {
        return $model->newQuery()->with('kategori_pertanyaan');
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
            Column::make('pertanyaan'),
            Column::make('kategori_pertanyaan_id'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pertanyaan_' . date('YmdHis');
    }
}
