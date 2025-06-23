<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Actions\UpdateUserStatus;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Jobs\SendNewUserCredentialsJob;

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
    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::all(['id', 'name'])
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Stocker le mot de passe en clair pour l'envoyer par email
        $plainPassword = $validated['password'];

        $validated['password'] = bcrypt($validated['password']);
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = true;

        $user = User::create($validated);

        // Envoyer la notification avec les identifiants via un job
        SendNewUserCredentialsJob::dispatch($user, $plainPassword)
            ->afterResponse();

        session()->flash('success', __('User created successfully and credentials sent by email'));

        return redirect()->route('admin.users.index');
    }

    /**
     * Enable or disable user account
     */
    public function updateStatus(UpdateUserStatus $updateUserStatus, User $user): RedirectResponse
    {

        if (! $user->is_active && ($user->disabled_by !== Auth::id()) && $user->disabled_at) {
            session()->flash('error', __('You cannot enable this account because it was disabled by its owner.'));

            return back();
        }

        $updateUserStatus->handle($user);

        $message = match (intval($user->is_active)) {
            1 => __('Account has been successfully unblocked.'),
            0 => __('Account has been successfully blocked.'),
        };

        session()->flash('success', $message);



        return back();
    }
}






