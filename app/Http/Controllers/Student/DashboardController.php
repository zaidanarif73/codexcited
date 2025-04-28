<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.dashboard.";
    }

    public function index(){
        return view($this->view. "index");
    }
}

