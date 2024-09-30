<?php

namespace App\Controllers;
use App\Helper\Auth;

class Api
{

    public function getHome()
    {
        $user = Auth::userAPI();
        if($user == 0){
            return response()->json(['error' => 'Unauthorized']);
        }

        $site = db()->find('site')->where('user_id = '.$user)->first();
        $about = db()->find('about')->where('site_id = '.$site->id)->first();

        return response()->json(['site' => $site->toString(), 'about' => $about->toString()]);

    }

    public function postLogin(){
        $user = db()->find('user')->where('email = "'.request()->email.'"')->first();
        if($user){
            if(password_verify(request()->password, $user->password)){
                $token = Auth::loginAPI($user->id);
                return response()->json(['token' => $token]);
            }
        }
        return response()->json(['error' => 'Unauthorized']);
    }


    public function getProjects()
    {
        $user = Auth::userAPI();
        if($user == 0){
            return response()->json(['error' => 'Unauthorized']);
        }
        $site = db()->find('site')->where('user_id = '.$user)->first();
        $projects = db()->find('project')->where('site_id = '.$site->id)->get();      
        return response()->json(['site' => $site->toString(),'projects' => $projects->toString()]);
    }

    public function getContact()
    {
       
        $user = Auth::userAPI();
        if($user == 0){
            return response()->json(['error' => 'Unauthorized']);
        }
        $site = db()->find('site')->where('user_id = '.$user)->first();
        $contact = db()->find('contact')->where('site_id = '.$site->id)->first();
        return response()->json(['site' => $site->toString(), 'contact' => $contact->toString()]);
    }





}