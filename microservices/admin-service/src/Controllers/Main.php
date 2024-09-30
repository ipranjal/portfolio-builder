<?php

namespace App\Controllers;
use App\Helper\Auth;
class Main
{
    public function allLogout(){
        Auth::logout();
        return redirect('/');
    }

    public function getIndex()
    {
        if (Auth::loggedIn()) {
            return redirect('/dashboard');
        }
        return view('onboard');
    }

    public function postIndex()
    {
        if(table_exists('user')){
            $user = db()->find('user')->where('username = ?')->setParameter(0, request()->username)->first();
        }else{
            $user = false;
        }
        if (!$user) {
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

            $contact_request = model('request');
            $contact_request->site_id = $site->id;
            $contact_request->name = 'John Doe';
            $contact_request->email = 'John@example.com';
            $contact_request->msg = 'This is a dummy message';
            $contact_request->save();
            
            return redirect('/dashboard', ['success' => 'Account created successfully']);
        }

        return redirect('/login');


    }

    public function getLogin()
    {
       
        if (Auth::loggedIn()) {
            return redirect('/dashboard');
        }
        return view('admin.login');
    }

    public function postLogin()
    {
       
        if (Auth::loggedIn()) {
            return redirect('/dashboard');
        }
        $user = db()->find('user')->where('email = ?')->setParameter(0, request()->email)->first();

        if ($user && password_verify(request()->password, $user->password)) {
            Auth::login($user);
            return redirect('/dashboard');
        }
        return redirect('/login', ['error' => 'Invalid login details']);
    }


    public function getDashboard()
    {
        if (!Auth::loggedIn()) {
            return redirect('/login');
        }
        $site = db()->find('site')->where('user_id = '.Auth::user())->first();
        return view('admin.dashboard', ['site' => $site]);
    }

    public function postDashboard()
    {
        if (!Auth::loggedIn()) {
            return redirect('/login');
        }
        $site = db()->find('site')->where('user_id = '.Auth::user())->first();

        $files = storage()->saveRequest();
        if (request()->files->has('avatar')) {
            if (isset($files['avatar'])) {
                $site->avatar = storage()->getUrl($files['avatar']);
            }
        }
        if (request()->files->has('resume')) {
            if (isset($files['resume'])) {
                $site->resume = storage()->getUrl($files['resume']);
            }
        }
        $site->title = request()->title;
        $site->about = request()->about;
        $site->save();
        return redirect('/dashboard', ['success' => 'Site information updated successfully']);
    }

    public function getAbout()
    {
        if (!Auth::loggedIn()) {
            return redirect('/admin');
        }
        $site = db()->find('site')->where('user_id = '.Auth::user())->first();
        $about = db()->find('about')->where('site_id = '.$site->id)->first();
        return view('admin.about', ['about' => $about]);
    }

    public function postAbout()
    {
        if (!Auth::loggedIn()) {
            return redirect('/admin');
        }
        $site = db()->find('site')->where('user_id = '.Auth::user())->first();
        $about = db()->find('about')->where('site_id = '.$site->id)->first();
        $about->content = request()->about;
        $about->save();
        return redirect('/about', ['success' => 'About information updated successfully']);

    }
    public function getContact()
    {
        if (!Auth::loggedIn()) {
            return redirect('/login');
        }
        $site = db()->find('site')->where('user_id = '.Auth::user())->first();
        $contact = db()->find('contact')->where('site_id = '.$site->id)->first();
        $crequests = db()->find('request')->where('site_id = '.$site->id)->get();
        return view('admin.contact', ['contact' => $contact, 'crequests' => $crequests]);
    }

    public function postContact()
    {
        if (!Auth::loggedIn()) {
            return redirect('/login');
        }
        $site = db()->find('site')->where('user_id = '.Auth::user())->first();
        $contact = db()->find('contact')->where('site_id ='.$site->id)->first();
        $contact->email = request()->get('email', '');
        $contact->facebook = request()->get('facebook', '');
        $contact->twitter = request()->get('twitter', '');
        $contact->instagram = request()->get('instagram', '');
        $contact->linkedin = request()->get('linkedin', '');
        $contact->github = request()->get('github', '');
        $contact->save();
        return redirect('/contact', ['success' => 'Contact information updated successfully']);
    }

    public function getProjects($type = '')
    {

        if ($type == 'add') {
            return view('admin.projects.add');
        }
        if ($type == 'edit') {
            $project = db()->find('project')->where('id = '.request()->id)->first();
            return view('admin.projects.edit', ['project' => $project]);
        }
        if ($type == 'delete') {
            $project = db()->find('project')->where('id ='.request()->id)->first();
            $project->delete();
            return redirect('/projects/view', ['success' => 'Project deleted successfully']);
        }

        $site = db()->find('site')->where('user_id = '.Auth::user())->first();
        $projects = db()->find('project')->where('site_id = '.$site->id)->get();
        return view('admin.projects.index', ['projects' => $projects]);
    }

    public function postProjects()
    {
        if (request()->has('id')) {
            $project = db()->find('project')->where('id = '. request()->id)->first();
            if (request()->files->has('img')) {
                $files = storage()->saveRequest();
                if (isset($files['img'])) {
                    $project->img = storage()->getUrl($files['img']);
                }
            }
            $project->title = request()->title;
            $project->summary = request()->summary;
            $project->link = request()->link;
            $project->save();
            return redirect('/projects/view', ['success' => 'Project updated successfully']);
        }
        $site = db()->find('site')->where('user_id ='. Auth::user())->first();
        $project = model('project');
        $project->site_id = $site->id;
        $files = storage()->saveRequest();
        if (request()->files->has('img')) {
            $project->img = storage()->getUrl($files['img']);
        }
        $project->title = request()->title;
        $project->summary = request()->summary;
        $project->link = request()->link;
        $project->save();
        return redirect('/projects/view', ['success' => 'Project added successfully']);
    }



}