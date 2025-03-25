<?php

namespace App\Http\Controllers\Front;

use App\Models\Plan;
use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    public function index()
    {
        $plans = Plan::query()
            ->latest()
            ->with('images:id,name')
            ->paginate(9);

        return view('front.plans.index', [
            'plans' => $plans,
        ]);
    }

    public function show(Plan $plan)
    {
        return view('front.plans.show', [
            'plan' => $plan,
        ]);
    }
}
