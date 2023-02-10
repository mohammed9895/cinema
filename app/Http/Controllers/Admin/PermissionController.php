<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }
    public function create()
    {
        return view('admin.permissions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        $permission = Permission::create(['name' => $request->name]);
        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);
        $permission->update(['name' => $request->name]);
        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }

    public function attachRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            return redirect()->back()->with('error', 'Role already attached.');
        }
        $permission->assignRole($request->role);
        return redirect()->back()->with('success', 'Role attached successfully.');
    }

    public function detachRole(Permission $permission, Role $role)
    {
        if (!$permission->hasRole($role)) {
            return redirect()->back()->with('error', 'Role already detached.');
        }
        $permission->removeRole($role);
        return redirect()->back()->with('success', 'Role detached successfully.');
    }
}
