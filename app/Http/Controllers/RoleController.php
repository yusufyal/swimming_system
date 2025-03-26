<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view role')->only(['index']);
        $this->middleware('permission:show role')->only(['show']);
        $this->middleware('permission:create role')->only(['create', 'store']);
        $this->middleware('permission:edit role')->only(['update', 'edit']);
        $this->middleware('permission:delete role')->only(['delete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles = Role::all();
        $totalRoles = Role::all()->count();
        return view('roles.index', compact('roles','totalRoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();


        return view('roles.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',

        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web', // default web
        ]);

        if ($role) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            // Assign permissions to role
            $role->givePermissionTo($permissions);

            return redirect()->route('roles.index')->with('success', 'Role added successfully.');
        } else {
            return redirect()->route('roles.index')->with('success', 'Failed to create role.');
        }
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
    public function edit($id)
    {
        $role = Role::find($id); 

        if ($role) {
            // Get the permissions associated with the role
            $roleHasPermissions = $role->permissions->pluck('id')->toArray(); // Pluck the permission IDs

            // Get all available permissions
            $permissions = Permission::all();

            // Pass data to the view
            return view('roles.edit', compact('role', 'permissions', 'roleHasPermissions'));
        } else {
            // Redirect back with an error if role is not found
            return redirect()->route('roles.index')->with('error', 'Role not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $permissions = Permission::whereIn('id', $request->permissions)->get();

        // Remove permissions from role
        $role->syncPermissions();

        // Assign permissions to role
        $role->givePermissionTo($permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Role not found.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

}
