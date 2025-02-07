<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch; // ✅ Import Branch model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
{
    $branches = Branch::all(); // ✅ Fetch all branches
    return view('auth.register', compact('branches'));
}


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'branch_id' => ['required', 'exists:branches,id'],
        ]);
    
        // ✅ Convert branch_id to integer before saving
        $branchId = (int) $request->branch_id;
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'branch_id' => $branchId, // ✅ Ensure it's being saved correctly
        ]);
    
        $user->assignRole('worker'); // ✅ Assign default role
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect()->route('dashboard');
    }
    



}
