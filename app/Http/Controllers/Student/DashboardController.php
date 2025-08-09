<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\StudentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.dashboard.";
        $this->score = new Score();
        $this->activity = new StudentActivity();
    }

    public function index(){
        $user = Auth::user();
        $currentUserId = $user->id;

        $score = $this->score
            ->leftJoin('users', 'scores.user_id', '=', 'users.id')
            ->select('scores.*', 'users.name as user_name', 'users.avatar as user_avatar')
            ->orderBy('scores.score', 'desc')
            ->get();

        // Hitung jumlah materi yang sudah dikerjakan siswa 
        $materiSelesai = DB::table('materis')
            ->whereIn('id', function ($query) use ($currentUserId) {
                $query->select('materi_details.materi_id')
                    ->from('materi_details')
                    ->leftJoin('materi_progress', function ($join) use ($currentUserId) {
                        $join->on('materi_details.id', '=', 'materi_progress.materi_detail_id')
                            ->where('materi_progress.user_id', '=', $currentUserId);
                    })
                    ->groupBy('materi_details.materi_id')
                    ->havingRaw('COUNT(materi_details.id) = COUNT(materi_progress.id)');
            })
            ->count();

        // Hitung ranking
        $rank = null;
        foreach ($score as $index => $entry) {
            if ($entry->user_id == $currentUserId) {
                $rank = $index + 1;
                break;
            }
        }

        //persentase
        $progress = DB::table('materi_progress')
            ->where('user_id', $currentUserId)
            ->select(DB::raw('SUM(progress) as selesai_count, COUNT(*) as total_count'))
            ->first();

        $totalMateri = DB::table('materi_details')->count();
        

        if ($progress->total_count > 0) {
            $progress = round(($progress->selesai_count / $totalMateri), 2);
        } else {
            $progress = 0; // Jika tidak ada materi, progress dianggap 0%
        }

        // Ambil 3 aktivitas terakhir user kecuali activity_type bernilai 'login', 'open_materi_list', 'open_quiz'
        $recentActivities = $this->activity
            ->where('user_id', $currentUserId)
            ->whereNotIn('activity_type', ['login', 'open_materi_list', 'open_quiz', 'open_code_editor'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view($this->view . "index", [
            'rank' => $rank ?? 'Belum ada rank',
            'materiSelesai' => $materiSelesai,
            'progress' => $progress,
            'recentActivities' => $recentActivities,
        ]);
    }
}

