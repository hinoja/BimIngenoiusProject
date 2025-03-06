<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        if (! in_array($locale, config('app.locales'))) {
            abort(400);
        }

        Session::put('locale', $locale);

        return redirect()->back();
    }
}
