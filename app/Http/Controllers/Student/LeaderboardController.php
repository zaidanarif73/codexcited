<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Leaderboard;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.leaderboard.";
        $this->leaderboard = new Leaderboard();
    }

    public function index(Request $request)
    {
        // Fetch the leaderboard dat
        $this->leaderboard = $this->leaderboard->leftJoin('users', 'leaderboards.user_id', '=', 'users.id')
            ->select('leaderboards.*', 'users.name as user_name', 'users.avatar as user_avatar')
            ->orderBy('leaderboards.score', 'desc')
            ->get();

        $table = $this->leaderboard;
        
        $data = [
            'table' => $table,
        ];

        return view($this->view. "index", $data);
        // return dd($table);
    }
}
