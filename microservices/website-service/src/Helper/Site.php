<?php

namespace App\Helper;

class Site{

    public static function getId(){
        $host = request()->getHost();
        $username = explode('.', $host)[0];
        $user = db()->find('user')->where('username = ?')->setParameter(0, $username)->first();
        if(isset($user->id)){
            $site = db()->find('site')->where('user_id = ?')->setParameter(0, $user->id)->first();
            if($site){
                return $site->id;
            }
        }
         return 0;
    }
}