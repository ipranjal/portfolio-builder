<?php

 namespace App\Helper;

 class Auth{
    public static function loggedIn(){
        return app()->session()->has('user');
    }

    public static function user(){
        return app()->session()->user;
    }

    public static function logout(){
        app()->session()->remove('user');
    }

    public static function login($user){
        app()->session()->user = $user->id;
        app()->session()->username = $user->username;
    }
    
    
 }