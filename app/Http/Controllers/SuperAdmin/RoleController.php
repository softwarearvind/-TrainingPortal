<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')
            ->where('guard_name', 'web')
            ->withCount('users')
            ->get();

        return view(
            'super-admin.roles.index',
            compact('roles')
        );
    }


    public function create()
    {
        $permissions = Permission::where(
            'guard_name',
            'web'
        )
        ->orderBy('name')
        ->get();

        return view(
            'super-admin.roles.create',
            compact('permissions')
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:100',
                'unique:roles,name',
            ],

            'permissions' => [
                'nullable',
                'array',
            ],

        ]);


        $role = Role::create([

            'name' => $validated['name'],

            'guard_name' => 'web',

        ]);


        $role->syncPermissions(
            $validated['permissions'] ?? []
        );


        return redirect()
            ->route('super-admin.roles.index')
            ->with(
                'success',
                'Role created successfully.'
            );
    }


    public function edit(Role $role)
    {
        $permissions = Permission::where(
            'guard_name',
            'web'
        )
        ->orderBy('name')
        ->get();

        $rolePermissions = $role
            ->permissions
            ->pluck('name')
            ->toArray();

        return view(
            'super-admin.roles.edit',
            compact(
                'role',
                'permissions',
                'rolePermissions'
            )
        );
    }


    public function update(
        Request $request,
        Role $role
    ) {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:100',
                'unique:roles,name,' . $role->id,
            ],

            'permissions' => [
                'nullable',
                'array',
            ],

        ]);


        $role->update([

            'name' => $validated['name'],

        ]);


        $role->syncPermissions(
            $validated['permissions'] ?? []
        );


        return redirect()
            ->route('super-admin.roles.index')
            ->with(
                'success',
                'Role updated successfully.'
            );
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('super-admin.roles.index')
            ->with(
                'success',
                'Role deleted successfully.'
            );
    }
}
