<?php

namespace App\Controllers;
use App\Helper\Auth;
class Main
{
    public function allIndex()
    {
        return redirect('/login');
    }
    public function allLogout(){
        Auth::logout();
        return redirect('/');
    }

    public function getLogin()
    {
        if (Auth::loggedIn()) {
            return redirect('/dashboard');
        }
        return view(view: 'admin.login');
    }


    public function postLogin()
    {
       
        if (Auth::loggedIn()) {
            return redirect('/dashboard');
        }

        if (request()->email == 'admin@iportfolio.me' && request()->password == 'jn4358@$k') {
            Auth::login(9999);
            return redirect('/dashboard');
        }
        return redirect('/login', ['error' => 'Invalid login details']);
    }


    public function getDashboard()
    {
        if (!Auth::loggedIn()) {
            return redirect('/login');
        }
        $sites = db()->get('site');
        return view('admin.dashboard', ['sites' => $sites]);

    }


}