<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Actions\UpdateUserStatus;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
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
            Toastr::success(__('You cannot enable this account because it was disabled by its owner.'), 'Success');

            return back();
        }

        $updateUserStatus->handle($user);

        $message = match (intval($user->is_active)) {
            1 => __('Account has been successfully unblocked.'),
            0 => __('Account has been successfully blocked.'),
        };

          Toastr::success($message, 'Success',  ['timeOut' => 5000]);

         
        return back();
    }

}
