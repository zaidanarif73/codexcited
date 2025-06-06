<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.materi.";
    }

    public function index(){
        return view($this->view. "index");
    }

    public function show($materi){
        return view($this->view. "show", compact('materi'));
    }
}
