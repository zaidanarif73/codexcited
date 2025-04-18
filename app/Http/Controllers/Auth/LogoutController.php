<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LogoutController extends Controller
{
    public function logout(){
        
        Auth::logout();
        alert()->html('Berhasil', 'Berhasil Logout', 'success');
        return redirect()->route("auth.login.index");
    }
}
