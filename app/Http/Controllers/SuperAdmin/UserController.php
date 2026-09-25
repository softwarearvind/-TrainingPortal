<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display users.
     */
    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        return view('super-admin.users.index', compact('users'));
    }


    /**
     * Show create form.
     */
    public function create()
    {
        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view('super-admin.users.create', compact('roles'));
    }


    /**
     * Store user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                'exists:roles,name',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);

        $user = User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => $validated['password'],

            'status' => $validated['status'],

        ]);

        $user->assignRole($validated['role']);

        return redirect()
            ->route('super-admin.users.index')
            ->with('success', 'User created successfully.');
    }


    /**
     * Show edit form.
     */
    public function edit(User $user)
    {
        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        $userRole = $user->roles->first();

        return view(
            'super-admin.users.edit',
            compact('user', 'roles', 'userRole')
        );
    }


    /**
     * Update user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'password' => [
                'nullable',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                'exists:roles,name',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);

        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->status = $validated['status'];

        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        $user->syncRoles([
            $validated['role']
        ]);

        return redirect()
            ->route('super-admin.users.index')
            ->with('success', 'User updated successfully.');
    }


    /**
     * Delete user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('super-admin.users.index')
            ->with('success', 'User deleted successfully.');
    }


    /**
     * Toggle user status.
     */
    public function toggleStatus(User $user)
    {
        $user->update([
            'status' => !$user->status,
        ]);

        return back()
            ->with('success', 'User status updated.');
    }
}
