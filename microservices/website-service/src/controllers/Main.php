<?php

namespace App\Controllers;
use App\Helper\Site;
class Main
{

    public function getIndex()
    {

        $site = db()->getOne('site', Site::getId());
        $about = db()->find('about')->where('site_id', $site->id)->first();

        return view('site.home',['site' => $site, 'about' => $about]);
    }


    public function getProjects()
    {
        $site = db()->getOne('site', Site::getId());
        $projects = db()->find('project')->where('site_id', $site->id)->get();      
        return view('site.projects', ['site' => $site, 'projects' => $projects]);
    }

    public function allContact()
    {

        $site = db()->getOne('site', Site::getId());
        $contact = db()->find('contact')->where('site_id', $site->id)->first();
        $contact->save();
        return view('site.contact', ['site' => $site, 'contact' => $contact]);
    }

    public function postContact()
    {

        $site = db()->getOne('site', Site::getId());
        $contact_request = model('request');
        $contact_request->site_id = $site->id;
        $contact_request->name = request()->name;
        $contact_request->email = request()->email;
        $contact_request->msg = request()->msg;
        $contact_request->save();

        return redirect('/contact', ['success' => 'Contact request sent successfully']);
    }




}