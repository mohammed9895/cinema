<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }

    public function attachPermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return redirect()->back()->with('error', 'Permission already attached.');
        }
        $role->givePermissionTo($request->permission);
        return redirect()->back()->with('success', 'Permission attached successfully.');
    }

    public function detachPermission(Role $role, Permission $permission)
    {
        if (!$role->hasPermissionTo($permission)) {
            return redirect()->back()->with('error', 'Permission not attached.');
        }
        $role->revokePermissionTo($permission);
        return redirect()->back()->with('success', 'Permission detached successfully.');
    }
}
