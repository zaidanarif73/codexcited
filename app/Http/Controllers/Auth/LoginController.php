<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct() {
        $this->view = "auth.";
    } 
    
    public function index(){

        // if(Auth::check()){
        //     return redirect()->route('dashboard.dashboard.index');
        // }
        return view($this->view."login");
    }
}
