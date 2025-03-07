<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {
        return view('front.plans.index');
    }

    // public function show(Plan $plan)
    // {
    //     return view('front.plans.show', [
    //         'plan' => $plan,
    //     ]);
    // }
}
