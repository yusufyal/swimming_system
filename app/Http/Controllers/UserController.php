<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view user')->only(['index']);
        $this->middleware('permission:show user')->only(['show']);
        $this->middleware('permission:create user')->only(['create', 'store']);
        $this->middleware('permission:edit user')->only(['update', 'edit']);
        $this->middleware('permission:delete user')->only(['delete']);
    }

    public function index()
    {
        $users = User::all();
        $totalUsers = User::all()->count();
        return view('users.index', compact('users','totalUsers'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('users.add', compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|exists:roles,id', // Validate role ID exists
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        // Fetch the role name from the ID
        $roleName = Role::findOrFail($request->role)->name;

        // Assign the role to the user
        $user->assignRole($roleName);

        return redirect()->route('users.index')->with('success', 'User Added Successfully!');
    }

    public function show($id)
    {
        //    
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Fetch all roles
        $userRole = $user->getRoleNames()->first(); // Get the user's current role name
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Ensure email is unique except for this user
            'password' => 'nullable|string|min:8', // Password is optional during updates
            'role' => 'required|exists:roles,id',  // Validate role ID exists
        ]);

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Keep existing password if not updated
        ]);

        // Fetch the role name from the ID
        $roleName = Role::findOrFail($request->role)->name;

        // Sync the user's role
        $user->syncRoles($roleName);

        return redirect()->route('users.index')->with('success', 'User Updated Successfully!');
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return redirect()->route('users.index')->with('danger', 'User deleted successfully.');
        } else {
            return redirect()->with('danger', 'User Not Found.');
        }
    }
}
