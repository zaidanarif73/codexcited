<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\RoleEnum;
use Auth;

class StudentAccessMiddleware
{

    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); 
        if (empty($user) || !$user->hasRole([RoleEnum::Student])) {
            alert()->html('Gagal',"Harap Login Dahulu!",'error');
            
            if($user){
                Auth::logout();
            } 
            return redirect()->route('auth.login.index');   
        } 
        return $next($request); 
    }
}
