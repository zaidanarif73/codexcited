<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->view = "guest.pages.home.";
    }

    public function index()
    {
        $user = auth()->user();

        // Jika belum login, tampilkan halaman guest
        if ($user === null) {
            $materis = Materi::with('details')->get();

            $courseCounts = [
                'html' => Materi::where('type', 'html')->count(),
                'css' => Materi::where('type', 'css')->count(),
                'js' => Materi::where('type', 'js')->count(),
                'other' => Materi::whereNotIn('type', ['html', 'css', 'js'])->count(),
            ];

            return view($this->view . 'index', compact('materis', 'courseCounts'));
        }

        // Jika sudah login sebagai student
        if ($user->hasRole([\App\Enums\RoleEnum::Student])) {
            return redirect()->route('student.dashboard.index');
        }

        // Jika sudah login sebagai teacher
        if ($user->hasRole([\App\Enums\RoleEnum::Teacher])) {
            return redirect()->route('teacher.dashboard.index');
        }

        // Jika user login tapi tidak punya role (fallback)
        abort(403, 'Unauthorized');
    }
}
