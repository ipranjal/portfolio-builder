<?php

namespace App\Helper;
use ReallySimpleJWT\Token;


class Auth
{
    public static function loggedIn()
    {
        return app()->session()->has('user');
    }

    public static function user()
    {
        return app()->session()->user;
    }

    public static function logout()
    {
        app()->session()->remove('user');
    }

    public static function login($id)
    {
        app()->session()->user = $id;
    }
}