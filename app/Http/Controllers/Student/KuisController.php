<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.kuis.";
    }

    public function index()
    {
        $questions = [
        [
            'question' => "Apa ibu kota negara Jepang?",
            'options' => ["Tokyo", "Osaka", "Kyoto", "Hiroshima"],
            'correct' => 0,
            'explanation' => "Tokyo adalah ibu kota Jepang sejak 1869 dan merupakan pusat pemerintahan dan ekonomi.",
        ],
        [
            'question' => "Siapa penemu bola lampu?",
            'options' => ["Einstein", "Newton", "Edison", "Tesla"],
            'correct' => 2,
            'explanation' => "Thomas Edison dikenal sebagai penemu bola lampu yang bisa bertahan lama, walau banyak ilmuwan lain juga berkontribusi.",
        ],
        [
            'question' => "Apa hasil dari 2 + 2?",
            'options' => ["2", "3", "4", "5"],
            'correct' => 2,
            'explanation' => "2 + 2 = 4 adalah dasar dari operasi penjumlahan dalam matematika dasar.",
        ],
    ];

    return view($this->view . "index", compact('questions'));
    }
}
