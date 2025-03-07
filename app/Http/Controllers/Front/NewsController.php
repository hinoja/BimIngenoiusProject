<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);

        return view('front.news.index', [
            'news' => $news,
        ]);
    }

    public function show(News $news)
    {
        return view('front.news.show', [
            'news' => $news,
        ]);
    }
}
