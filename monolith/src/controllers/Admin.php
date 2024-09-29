<?php

namespace App\Controllers;
use App\Helper\Auth;
class Admin{
    public function getIndex(){
        if (!table_exists('user')) {
            return redirect('/onboard');
        }
        if(Auth::loggedIn()){
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    public function postIndex(){
        if (!table_exists('user')) {
            return redirect('/onboard');
        }
        if(Auth::loggedIn()){
            return redirect('/admin/dashboard');
        }
        $user = db()->find('user')->where('email = ?')->setParameter(0, request()->email)->first();

        if($user && password_verify(request()->password, $user->password)){
                Auth::login($user);
                return redirect('/admin/dashboard');
        }
        return redirect('/admin', ['error' => 'Invalid login details']);
    }


    public function getDashboard(){
        if (!Auth::loggedIn()) {
            return redirect('/admin');
        }
        $site = db()->find('site')->where('user_id',Auth::user())->first();
        return view('admin.dashboard',['site' => $site]);
    }

    public function postDashboard(){
        if (!Auth::loggedIn()) {
            return redirect('/admin');
        }
        $site = db()->find('site')->where('user_id',Auth::user())->first();

        $files = storage()->saveRequest();
        if(request()->files->has('avatar')){
            $site->avatar = storage()->getUrl($files['avatar']);
        }
        if(request()->files->has('resume')){
            $site->resume = storage()->getUrl($files['resume']);
        }
         $site->title = request()->title;
         $site->about = request()->about;
         $site->save();
        return redirect('/admin/dashboard',['success' => 'Site information updated successfully']);
    }

    public function getAbout(){
        if (!Auth::loggedIn()) {
            return redirect('/admin');
        }
        $site = db()->find('site')->where('user_id',Auth::user())->first();
        $about = db()->find('about')->where('site_id', $site->id)->first();
        return view('admin.about',['about' => $about]);
    }

    public function postAbout(){
        if (!Auth::loggedIn()) {
            return redirect('/admin');
        }
        $site = db()->find('site')->where('user_id',Auth::user())->first();
        $about = db()->find('about')->where('site_id', $site->id)->first();
        $about->content = request()->about;
        $about->save();
        return redirect('/admin/about',['success' => 'About information updated successfully']);
        
    }
    public function getContact(){
        if (!Auth::loggedIn()) {
            return redirect('/admin');
        }
        $site = db()->find('site')->where('user_id',Auth::user())->first();
        $contact = db()->find('contact')->where('site_id', $site->id)->first();
        $crequests = db()->find('request')->where('site_id', $site->id)->get();
        return view('admin.contact',['contact' => $contact, 'crequests' => $crequests]);
    }

    public function postContact(){
        if (!Auth::loggedIn()) {
            return redirect('/admin');
        }
        $site = db()->find('site')->where('user_id',Auth::user())->first();
        $contact = db()->find('contact')->where('site_id', $site->id)->first();
        $contact->email = request()->get('email','');
        $contact->facebook = request()->get('facebook','');
        $contact->twitter = request()->get('twitter','');
        $contact->instagram = request()->get('instagram','');
        $contact->linkedin = request()->get('linkedin','');
        $contact->github = request()->get('github','');
        $contact->save();
        return redirect('/admin/contact',['success' => 'Contact information updated successfully']);
    }

    public function getProjects($type=''){
        if($type == 'add'){
            return view('admin.projects.add');
        }

        return view('admin.projects.index');
    }

    public function postProjects(){
        $site = db()->find('site')->where('user_id',Auth::user())->first();
        $project = model('project');
        $project->site_id = $site->id;
        $files = storage()->saveRequest();
        if(request()->files->has('img')){
            $project->img = storage()->getUrl($files['img']);
        }
        $project->title = request()->title;
        $project->summary = request()->summary;
        $project->link = request()->link;
        $project->save();
        return redirect('/admin/projects/view',['success' => 'Project added successfully']);
    }
    


}