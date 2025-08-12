<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score; 

class LeaderboardController extends Controller
{
    public function __construct() {
        $this->view = "teacher.pages.leaderboard.";
    }

    public function index()
    {
        $leaderboard = Score::query()
            ->leftJoin('users', 'scores.user_id', '=', 'users.id')
            ->select('scores.*', 'users.avatar as user_avatar', 'users.name', 'users.email')
            ->orderByDesc('scores.score')
            ->paginate(10);

        return view($this->view."index", compact('leaderboard'));
    }
}
