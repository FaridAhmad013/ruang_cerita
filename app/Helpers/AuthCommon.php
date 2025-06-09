<?php

namespace App\Helpers;

// use DB;

class AuthCommon {

    function __construct(){ }

    public static $token;

    public static function setUser($body){
        @app('session')->forget('user');
        return app('session')->put('user', $body);
    }

    public static function user(){
        return session('user');
    }

    public static function logout(){
        app('session')->forget('slug_permit');
        return app('session')->forget('user');
    }

    public static function checkTypeUser(){
        $session = session('user');
        $role = @$session->roles[0]->name;
        if(str_contains(strtolower($role), 'user va')){
            return 'external';
        }else{
            return 'internal';
        }
    }
}
