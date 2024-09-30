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

    public function getDelete(){
        if (!Auth::loggedIn()) {
            return redirect('/login');
        }
        $site = db()->find('site')->where('id = '.request()->id)->first();
        $site->delete();
        $about = db()->find('about')->where('site_id = '.request()->id)->first();
        $about->delete();
        $projects = db()->find('project')->where('site_id = '.request()->id)->get();
        foreach($projects as $project){
            $project->delete();
        }
        $contact = db()->find('contact')->where('site_id = '.request()->id)->first();
        $contact->delete();
        $requets = db()->find('request')->where('site_id = '.request()->id)->get();
        foreach($requets as $request){
            $request->delete();
        }
        return redirect('/dashboard');
    }


}