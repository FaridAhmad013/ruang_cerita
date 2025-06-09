<?php

namespace App\DataTables;

use App\Helpers\AuthCommon;
use App\Helpers\Util;
use App\Models\AauthUser;
use App\Models\MPengajuanDokumen;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AauthUserDataTable extends DataTable
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
            ->addColumn('aksi', function($item){
                $html = '';

                $role = AuthCommon::user()->role ?? null;
                if(in_array($role->name, ['Web Admin', 'Admin', 'Admin SMKI', 'Web Admin Perbarindo'])){

                    $html = '<div class="btn-group btn-group-sm">';
                    $html .= '<button onclick="edit(' . $item->id . ')" type="button" class="btn btn-sm btn-default" title="Edit"><i class="fas fa-pen"></i></button>';
                    if($item->enabled_mfa && ($item->mfa_secret != null || $item->mfa_secret != '')){
                        $html .= '<button onclick="reset_2fa(' . $item->id . ')" type="button" class="btn btn-sm btn-default" title="Reset Authentikator"><i class="fas fa-lock"></i></button>';
                    }
                    $html .= '<button onclick="reset_password(' . $item->id . ')" type="button" class="btn btn-sm btn-default" title="Reset Password"><i class="fas fa-sync"></i></button>';
                    $html .= '</div>';
                    if ($item->auth_attemp > 2) {
                        $html .= '<button onclick="unblock(' . $item->id . ')" type="button" class="btn btn-sm btn-danger ml-1" title="UNBLOCK">UNBLOCK</button>';
                    }
                }
                return $html;
            })
            ->addColumn('bpr', function($item){
                $bpr = $item->_bpr;
                if ($bpr) {
                    $corporate = $bpr->perusahaan;
                    return strtoupper(($corporate ? $corporate->name : '') . ' ' . ($bpr->jenis_bank) . ' ' . ($bpr->name ?? ''));
                }
                return '';
            })
            ->addColumn('dpd', function ($item) {
                $dpd = $item->_dpd;
                if ($dpd) {
                    return $dpd->name;
                }
                return '';
            })
            ->addColumn('status', function($item){
                return Util::status_aauth_user($item->status);
            })
            ->rawColumns([ 'status', 'aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TBprDokumenSmki $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AauthUser $model): QueryBuilder
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
            Column::make('aksi'),
            Column::make('username'),
            Column::make('email'),
            Column::make('bpr'),
            Column::make('dpd'),
            Column::make('status')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'AauthUser_' . date('YmdHis');
    }
}
