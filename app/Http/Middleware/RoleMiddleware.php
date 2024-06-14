<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\Roles;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , string $role): Response
    {
        
        if(!auth()->check()){
            return $next($request); // could be guest
        }

        $currUser = auth()->user() ;
        $currRoleName = $currUser->roles()->pluck('name')->first() ;
        
        if($currRoleName != $role)
        {
            
            if($currRoleName == Roles::ADMIN)
            {
                return redirect()->route('admin.home'); 
            }return redirect()->route('user.home');
            
        }
      

        
        
        return $next($request);
    }
}
