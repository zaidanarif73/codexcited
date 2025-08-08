<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    //
    public function __construct() {
        $this->view = "guest.pages.tentang.";
    }

    public function index() {

        $user = auth()->user();

        // Jika belum login, tampilkan halaman guest
        if ($user === null) {
            return view($this->view . 'index');
        }

        // Jika sudah login sebagai student
        if ($user->hasRole([\App\Enums\RoleEnum::Student])) {
            return redirect()->route('student.dashboard.index');
        }
        
        // Jika sudah login sebagai teacher 
        if ($user->hasRole([\App\Enums\RoleEnum::Teacher])) {
            return redirect()->route('teacher.dashboard.index');
        }
    }
}
