<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.discussion.";
    }

    public function index(){
        return view($this->view. "index");
    }
}
