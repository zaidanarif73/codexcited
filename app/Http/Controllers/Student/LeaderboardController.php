<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.leaderboard.";
        $this->score = new score();
    }

    public function index(Request $request)
    {
        // Fetch the score dat
        $this->score = $this->score->leftJoin('users', 'scores.user_id', '=', 'users.id')
            ->select('scores.*', 'users.name as user_name', 'users.avatar as user_avatar')
            ->orderBy('scores.score', 'desc')
            ->get();

        $table = $this->score;
        
        $data = [
            'table' => $table,
        ];

        return view($this->view. "index", $data);
        // return dd($table);
    }
}
