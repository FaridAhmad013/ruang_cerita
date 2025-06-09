<?php

namespace App\Helpers;

class TokenCommon {
    
    function __construct(){ }

    public static function setToken($name, $value){
        $token = session('token_common');
        $token[$name] = $value;
        if(is_array($token) && count($token) > 0){
            app('session')->put('token_common', $token);
        }
        return true;
    }

    public static function getToken($name){
        // dd(app('session')->all());
        $token = app('session')->get('token_common');
        return isset($token[$name]) ? $token[$name]: '';
    }
    
}
