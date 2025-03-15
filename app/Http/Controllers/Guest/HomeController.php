<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->view = "guest.pages.home.";
    }

    public function index(){
        return view($this->view. "index");
    }
}
