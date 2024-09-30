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

    public static function login($user)
    {
        app()->session()->user = $user->id;
        app()->session()->username = $user->username;
    }


    public static function loginAPI($user)
    {
        $userId = $user->id;
        $secret = 'AGG@Tgt!+@4YKsb';
        $expiration = time() + 36000;
        $issuer = 'iportfolio.me';

        $token = Token::create($userId, $secret, $expiration, $issuer);
        return $token;
    }
    public static function userAPI()
    {
        request()->headers->get('Authorization');
        $token = request()->headers->get('Authorization');
        $secret = 'AGG@Tgt!+@4YKsb';
        $valid = Token::validate($token, $secret);
        if($valid){
            return Token::getPayload($token)['user_id'];
        }
        return 0;
        
    }


}