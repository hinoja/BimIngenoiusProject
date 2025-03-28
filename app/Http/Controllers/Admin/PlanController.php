<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function create()
    {
        return view('admin.plans.create');
    }

    public function show(Plan $plan)
    {
        return view('admin.projects.show', [
            'plan' => $plan,
        ]);
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', [
            'plan' => $plan,
        ]);
    }
}
