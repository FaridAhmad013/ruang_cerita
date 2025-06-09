<?php

namespace App\Helpers;

class PermissionCommon {

    public static function check($assign){
        $permission = session('slug_permit');
        // dd($permission);
        if(!$permission) $permission = [];
        return in_array($assign, $permission);
    }

    public static function all(){
        $permission = session('slug_permit');
        if(!$permission) $permission = [];

        return $permission;
    }
}
