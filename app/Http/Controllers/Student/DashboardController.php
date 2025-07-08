<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.dashboard.";
        $this->score = new Score();
    }

    public function index(){
        
        $user = Auth::user();
        $currentUserId = $user->id;

        $score = $this->score
            ->leftJoin('users', 'scores.user_id', '=', 'users.id')
            ->select('scores.*', 'users.name as user_name', 'users.avatar as user_avatar')
            ->orderBy('scores.score', 'desc')
            ->get();

        // Calculate current user's rank
        $rank = null;
        foreach ($score as $index => $entry) {
            if ($entry->user_id == $currentUserId) {
                $rank = $index + 1; // index is 0-based, so add 1
                break;
            }
        }

        return view($this->view . "index", ['rank' => $rank ?? 'Belum ada rank']);
    }
}

