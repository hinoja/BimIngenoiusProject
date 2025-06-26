<?php

namespace App\Http\Controllers\Front;

use App\Models\News;
use App\Models\Plan;
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

    public function search(Request $request) {
        $query = trim($request->q);
        if (!$query) {
            return back();
        }

        $locale = app()->getLocale();
        $titleField = $locale . '_title';
        $descriptionField = $locale . '_description';
        $contentField = $locale . '_content';
        
        $projects = Project::query()
            ->where($titleField, 'like', "%{$query}%")
            ->orWhere($descriptionField, 'like', "%{$query}%")
            ->orderByDesc('updated_at')
            ->get();

        $news = News::query()
            ->where($titleField, 'like', "%{$query}%")
            ->orWhere($contentField, 'like', "%{$query}%")
            ->orderByDesc('updated_at')
            ->get();

        $plans = Plan::query()
            ->where($titleField, 'like', "%{$query}%")
            ->orWhere($descriptionField, 'like', "%{$query}%")
            ->orderByDesc('updated_at')
            ->get();

        $totalProjects = $projects->count();
        $totalNews = $news->count();
        $totalPlans = $plans->count();
        $totalResults = $totalProjects + $totalNews + $totalPlans;

        return view('front.pages.search', [
            'query'    => $query,
            'projects' => $projects,
            'news'     => $news,
            'plans'    => $plans,
            'totalProjects' => $totalProjects,
            'totalNews' => $totalNews,
            'totalPlans' => $totalPlans,
            'totalResults' => $totalResults,
        ]);
    }

}
