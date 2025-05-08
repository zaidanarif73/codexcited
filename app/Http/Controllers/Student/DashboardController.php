<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.dashboard.";
    }

    public function index(){

        $user = Auth::user();

        $rank = DB::table('users')
            ->leftJoin('leaderboards', 'users.id', '=', 'leaderboards.user_id')
            ->where('users.id', $user->id)
            ->select('leaderboards.rank')
            ->first();

        return view($this->view. "index", ['rank' => $rank?->rank ?? 'Unranked']);
    }
}

