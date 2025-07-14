<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\RoleEnum;
use Auth;

class TeacherAccessMiddleware
{

    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user(); 
        if (empty($user) || !$user->hasRole([RoleEnum::Teacher])) {
            alert()->html('Gagal',"Anda sedang login sebagai teacher!",'error');
            
            if($user){
                Auth::logout();
            } 
            return redirect()->route('auth.login.index');   
        } 
        return $next($request); 
    }
}
