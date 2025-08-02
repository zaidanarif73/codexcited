<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.kuis.";
    }

    public function show($materi_id)
    {
        // Ambil kuis berdasarkan materi_id (misal materi_id = 1)
        $questions = Kuis::where('materi_id', $materi_id)->get();

        return view($this->view . "show", compact('questions', 'materi_id'));
    }
}
