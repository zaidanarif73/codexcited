<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentActivity; 

class StudentActivityController extends Controller
{
    public function __construct()
    {
        $this->view = "teacher.pages.log.";
    }

    public function index()
    {

         $activities = StudentActivity::with('user') // eager load user

         //left join with users table to get user avatar
        ->leftJoin('users', 'student_activities.user_id', '=', 'users.id')
        ->select('student_activities.*', 'users.avatar as user_avatar')
        ->orderBy('created_at', 'desc')
        ->paginate(10); // ganti 10 sesuai jumlah per halaman

        return view($this->view . "index", [
            'activities' => $activities, // Pass the activities to the view
        ]);
    }
}
