<?php

namespace App\Controllers;

class Main
{

    public function getIndex()
    {

        $site = db()->find('site')->first();
        $about = db()->find('about')->where('site_id', $site->id)->first();

        return view('site.home',['site' => $site, 'about' => $about]);
    }


    public function getProjects()
    {
        $site = db()->find('site')->first();
        $projects = db()->find('project')->where('site_id', $site->id)->get();      
        return view('site.projects', ['site' => $site, 'projects' => $projects]);
    }

    public function allContact()
    {

        $site = db()->find('site')->first();
        $contact = db()->find('contact')->where('site_id', $site->id)->first();
        $contact->save();
        return view('site.contact', ['site' => $site, 'contact' => $contact]);
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