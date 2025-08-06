<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function __construct()
    {
        $this->view = "guest.pages.materi.";
        $this->materi = new \App\Models\Materi();
    }

    public function index()
    {
        $user = auth()->user();

        // Jika belum login, tampilkan halaman guest
        if ($user === null) {
            $materis = $this->materi->with('details')->get();
            $table = $this->materi->with('details')->orderBy('difficulty', 'asc')->get();

            return view($this->view . 'index', compact('materis', 'table'));
        }

        // Jika sudah login sebagai student
        if ($user->hasRole([\App\Enums\RoleEnum::Student])) {
            return redirect()->route('student.materi.index');
        }
        
        // Jika sudah login sebagai teacher 
        if ($user->hasRole([\App\Enums\RoleEnum::Teacher])) {
            return redirect()->route('teacher.materi.index');
        }

        // Jika user login tapi tidak punya role (fallback)
        abort(403, 'Unauthorized');
    }
}
