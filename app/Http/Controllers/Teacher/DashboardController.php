<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\User;
use App\Models\StudentActivity;
use App\Enums\RoleEnum;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->view = "teacher.pages.dashboard.";
        $this->materi = Materi::class;
        $this->user = User::class;
        $this->activity = StudentActivity::class;
    }

    public function index(){

        //count all materi
        $materiCount = $this->materi::count();

        //count all users who have student role based on RoleEnum
        $studentCount = $this->user::role(RoleEnum::Student)->count();

        //count all user activity logs
        $activityCount = $this->activity::count();

        //count all online user students
        $onlineCount = $this->user::role(RoleEnum::Student)
            ->where('last_seen', '>=', Carbon::now()->subMinutes(5))
            ->count();


        return view($this->view. "index", [
            'materiCount' => $materiCount,
            'studentCount' => $studentCount,
            'activityCount' => $activityCount,
            'onlineCount' => $onlineCount,
        ]);
    }
}
