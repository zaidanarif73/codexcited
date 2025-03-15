<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->view = "teacher.pages.dashboard.";
    }

    public function index(){
        return view($this->view. "index");
    }
}
