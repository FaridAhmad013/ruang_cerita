<?php
namespace App\Helpers;

class HtmlCommon { 
    static function rstatus($data){
        $html = '';
        switch ($data) {
            case 0:
                $html = '<span class="badge text-white bg-danger">inactive</span>';
                break;
            case 1:
                $html = '<span class="badge text-white bg-success">active</span>';
                break;
            case 2:
                $html = '<span class="badge text-white bg-yellow">need approval</span>';
                break;
            case 3:
                $html = '<span class="badge text-white bg-danger">reject</span>';
                break;
            default:
                $html = '<span class="badge text-white bg-secondary"></span>';
                break;
        }
        return $html;
    }

    static function rstatus_approval($data, $type = 'mitra'){
        $html = '';
        switch ($data) {
            case 1:
                $html = '<span class="badge text-white bg-primary">approval create</span>';
                break;
            case 2:
                $html = '<span class="badge text-white bg-primary">approval update</span>';
                break;
            case 3:
                $html = '<span class="badge text-white bg-primary">approval delete</span>';
                break;
            case 4:
                $html = '<span class="badge text-white bg-primary">approval soft delete</span>';
                break;
            case 5:
                $html = '<span class="badge text-white bg-primary">approval restore</span>';
                break;
            case 6:
                $label = '';
                switch ($type) {
                case 'product':
                    $label = 'fee';
                    break;
                case 'mitra':
                    $label = 'product';
                    break;
                case 'virtual_account':
                    $label = 'suspend';
                    break;
                default:
                    $label = '';
                    break;
                }
                $html = '<span class="badge text-white bg-primary">approval '.$label.'</span>';
                break;
            case 7:
                $label = '';
                switch ($type) {
                case 'product':
                    $label = 'config';
                    break;
                case 'mitra':
                    $label = 'fee';
                    break;
                case 'virtual_account':
                    $label = 'unsuspend';
                    break;
                default:
                    $label = '';
                    break;
                }
                $html = '<span class="badge text-white bg-primary">approval '.$label.'</span>';
                break;
            case 8:
                $label = '';
                switch ($type) {
                case 'mitra':
                    $label = 'user';
                    break;
                default:
                    $label = 'user';
                    break;
                }
                $html = '<span class="badge text-white bg-primary">approval '.$label.'</span>';
                break;
            case 9:
                $html = '<span class="badge text-white bg-primary">approval status</span>';
                break;
            default:
                $html = '<span class="badge text-white bg-secondary"></span>';
                break;
        }
        return $html;
    }

    static function rproduct_type($data){
        $html = '';
        $data = str_replace('_', ' ', $data);
        if($data == 'disbursement'){
            $html = '<span class="badge badge-success"><i class="fas fa-chevron-down"></i> '.$data.'</span>';
        }else if($data == 'general'){
            $html = 'NORMAL';
        }else{
            $html = '<span class="badge badge-danger"><i class="fas fa-chevron-up"></i> '.$data.'</span>';
        }
        return $html;
    }

    static function rstatus_enable($data){
        $html = '';
        if($data == 1){
            $html = `<span class="badge badge-success">enabled</span>`;
        }else{
            $html = `<span class="badge badge-danger">disabled</span>`;
        }
        return $html;
    }

    static function format_rupiah($angka){
	
        $html = "Rp " . number_format($angka,2,',','.');
        return $html;
     
    }

    static function rstatus_suspend($data){
        $html = '';
        if($data == 1){
            $html = '<span class="badge badge-danger">suspend</span>';
        }else{
            $html = '<span class="badge badge-success">unsuspend</span>';
        }
        return $html;
    }

    static function rauto_deposit($data){
        $html = '';
        if($data == false){
            $html = 'TIDAK';
        }else{
            $html = 'YA';
        }
        return $html;
    }
}
