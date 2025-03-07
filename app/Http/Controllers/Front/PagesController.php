<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home() {
        return view('front.pages.home');
    }

    public function about() {
        return view('front.pages.about');
    }

    public function contact() {
        return view('front.pages.contact');
    }

    public function quote() {
        return view('front.pages.quote');
    }
    
}
