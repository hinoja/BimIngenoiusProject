<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Actions\UpdateUserStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.users.index', [
            'users' => User::query()
                ->with('role:id,name')
                ->get(['id', 'name', 'email', 'role_id', 'slug', 'is_active']),
        ]);
    }

    /**
     * Enable or disable user account
     */
    public function updateStatus(UpdateUserStatus $updateUserStatus, User $user): RedirectResponse
    {

        if (! $user->is_active && ($user->disabled_by !== Auth::id()) && $user->disabled_at) {
            notify()->info(__('You cannot enable this account because it was disabled by its owner.'));

            return back();
        }

        $updateUserStatus->handle($user);

        $message = match (intval($user->is_active)) {
            1 => __('Account has been successfully unblocked.'),
            0 => __('Account has been successfully blocked.'),
        };

        notify()->success($message);

        return back();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
