<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized action. User not authenticated.');
        }

        $user = Auth::user();
        \Log::info('Checking Role Middleware', [
            'user_id' => $user->id,
            'user_roles' => $user->getRoleNames(), // Debug roles
            'required_role' => $role
        ]);

        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized action. User does not have required role.');
        }

        return $next($request);
    }
}
