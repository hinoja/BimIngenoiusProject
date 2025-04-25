<?php

namespace App\Http\Controllers\Front;

use App\Models\News;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home() {
        return view('front.pages.home', [
            'projects' => Project::query()->latest()->with(['category:id,en_name,fr_name'])->take(8)->get(),
            'news' => News::query()->latest()->published()->take(5)->get(),
        ]);
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
    public function turnkey() {
        return view('front.pages.turnkey');
    }

}
