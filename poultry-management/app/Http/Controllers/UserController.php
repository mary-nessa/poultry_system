<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'branch')->get(); // Load users with roles & branch
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $branches = \App\Models\Branch::all(); // ✅ Fetch all branches
        return view('users.edit', compact('user', 'roles', 'branches'));
    }
    

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
            'branch_id' => 'nullable|exists:branches,id', // ✅ Ensure branch exists
        ]);

        $user->syncRoles([$request->role]);
        $user->branch_id = $request->branch_id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
