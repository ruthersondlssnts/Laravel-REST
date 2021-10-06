<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $user->roles;
        $role = $user->roles()->where('name', 'manager')->get();
        if ($role->isEmpty()) {
            return response(["message" => "Forbidden."], 403);
        }

        // if (!$user->isEmpty()) {
        //     abort(403);
        // }
        return $next($request);
    }
}
