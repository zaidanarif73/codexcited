<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.leaderboard.";
    }

    public function index(){
        return view($this->view. "index");
    }
}
