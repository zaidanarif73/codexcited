<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\RoleEnum;

class UserController extends Controller
{
    public function __construct() {
        $this->view = "teacher.pages.user.";
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'latest'); // default terbaru

        $students = User::query()
            ->role(RoleEnum::Student) // filter role student
            ->when($sort === 'name_asc', fn($q) => $q->orderBy('name', 'asc'))
            ->when($sort === 'name_desc', fn($q) => $q->orderBy('name', 'desc'))
            ->when($sort === 'latest', fn($q) => $q->orderBy('created_at', 'desc'))
            ->when($sort === 'oldest', fn($q) => $q->orderBy('created_at', 'asc'))
            ->paginate(10)
            ->appends(['sort' => $sort]); // biar pagination ikut bawa parameter sort

        return view($this->view . "index", compact('students', 'sort'));
    }
}