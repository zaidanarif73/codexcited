<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Score;

class LeaderboardController extends Controller
{

    public function __construct() {
        $this->view = "guest.pages.leaderboard.";
    }

    public function index()
    {

        $user = auth()->user();

        // Jika belum login, tampilkan halaman guest
        if ($user === null) {

            $scores = Score::with('user')
            ->orderByDesc('score')
            ->take(20) // ambil 20 besar saja
            ->get();

            return view($this->view. "index", compact('scores'));
        }

        // Jika sudah login sebagai student
        if ($user->hasRole([\App\Enums\RoleEnum::Student])) {
            return redirect()->route('student.leaderboard.index');
        }
        
        // Jika sudah login sebagai teacher
        if ($user->hasRole([\App\Enums\RoleEnum::Teacher])) {
            // return redirect()->route('teacher.leaderboard.index');
        }

        // Jika user login tapi tidak punya role (fallback)
        abort(403, 'Unauthorized');
    }
}
