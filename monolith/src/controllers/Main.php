<?php

namespace App\Controllers;
use App\Helper\Auth;
class Main
{

    public function getIndex()
    {
       if (!table_exists('site')) {
            return redirect('/onboard');
        }
        $site = db()->find('site')->first();
        $about = db()->find('about')->where('site_id', $site->id)->first();

        return view('site.home',['site' => $site, 'about' => $about]);
    }


    public function getOnboard()
    {
        if (table_exists('user')) {
            return redirect('/admin');
        }
        return view('onboard');
    }

    public function postOnboard()
    {
        if (!table_exists('user')) {
            // Create user
            $user = model('user');
            $user->username = request()->username;
            $user->email = request()->email;
            $user->password = password_hash(request()->password, PASSWORD_DEFAULT);
            $user->save();

            // Populate dummy site information
            $site = model('site');
            $site->user_id = $user->id;
            $site->title = request()->username;
            $site->name = request()->username;
            $site->avatar = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVLqfekg_kitC_QJ5kgBUTh2tt5EIcxEnQDQ&s';
            $site->about = 'This is an awesome summary about me ...';
            $site->resume = '';
            $site->save();

            //Populate dummy about me
            $about = model('about');
            $about->site_id = $site->id;
            $about->content = 'Here is a detailed information about me ...';
            $about->save();

            //Populate dummy projects
            $project = model('project');
            $project->site_id = $site->id;
            $project->img = 'https://img.freepik.com/free-vector/flat-design-architecture-project-sale-banner-template_23-2149444012.jpg';
            $project->title = 'Project 1';
            $project->summary = 'This is a dummy project content which explains the project in details';
            $project->link = '';
            $project->save();

            //Populate dummy contact
            $contact = model('contact');
            $contact->site_id = $site->id;
            $contact->email = request()->email;
            $contact->facebook = '';
            $contact->twitter = '';
            $contact->instagram = '';
            $contact->linkedin = '';
            $contact->github = '';
            $contact->save();
            return redirect('/admin/dashboard', ['success' => 'Account created successfully']);
        }

        return redirect('/admin');


    }

    public function getProjects()
    {
        if (!table_exists('site')) {
            return redirect('/onboard');
        }
        $site = db()->find('site')->first();
        $projects = db()->find('project')->where('site_id', $site->id)->get();      
        return view('site.projects', ['site' => $site, 'projects' => $projects]);
    }

    public function allContact()
    {
        if (!table_exists('site')) {
            return redirect('/onboard');
        }
        $site = db()->find('site')->first();
        $contact = db()->find('contact')->where('site_id', $site->id)->first();
        $contact->save();
        return view('site.contact', ['site' => $site, 'contact' => $contact]);
    }

    public function allLogout(){
        Auth::logout();
        return redirect('/admin');
    }

    public function postContact()
    {

        $site = db()->find('site')->first();
        $contact_request = model('request');
        $contact_request->site_id = $site->id;
        $contact_request->name = request()->name;
        $contact_request->email = request()->email;
        $contact_request->msg = request()->msg;
        $contact_request->save();

        return redirect('/contact', ['success' => 'Contact request sent successfully']);
    }




}