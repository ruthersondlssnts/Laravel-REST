<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminManager
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
        $role =$user->roles;
        $isManager = $role->where('id',2);
        $isAdmin = $role->where('id',3);
        if(($isManager->isEmpty()) && ($isAdmin->isEmpty())){
            return response(["message" => "Forbidden."], 403);
        }
       
         return $next($request);
    }
}
