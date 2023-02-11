<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function role(User $user)
    {
        $user = User::findOrFail($user->id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.role', compact('user','roles', 'permissions'));
    }

    public function attachRole(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);

        if ($user->hasRole($request->role)) {
            return redirect()->back()->with('r-error', 'Role already attached.');
        }

        $user->assignRole($request->role);
        return redirect()->back()->with('r-success', 'Role attached successfully.');
    }

    public function detachRole(User $user, Role $role)
    {
        $user = User::findOrFail($user->id);

        if (!$user->hasRole($role)) {
            return redirect()->back()->with('r-error', 'Role already detached.');
        }

        $user->removeRole($role);
        return redirect()->back()->with('r-success', 'Role detached successfully.');
    }

    public function attachPermission(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);

        if ($user->hasPermissionTo($request->permission)) {
            return redirect()->back()->with('p-error', 'Permission already attached.');
        }

        $user->givePermissionTo($request->permission);
        return redirect()->back()->with('p-success', 'Permission attached successfully.');
    }

    public function detachPermission(User $user, Permission $permission)
    {
        $user = User::findOrFail($user->id);

        if (!$user->hasPermissionTo($permission)) {
            return redirect()->back()->with('p-error', 'Permission already detached.');
        }

        $user->revokePermissionTo($permission);
        return redirect()->back()->with('p-success', 'Permission detached successfully.');
    }
}
