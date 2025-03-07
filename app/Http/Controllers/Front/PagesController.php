<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home() {
        return view('front.home');
    }

    public function about() {
        return view('front.about');
    }

    public function projects() {
        return view('front.projects');
    }
    
    public function plans() {
        return view('front.plans');
    }

    public function contact() {
        return view('front.contact');
    }

    public function news() {
        return view('front.news');
    }

    public function quote() {
        return view('front.quote');
    }
    
}
