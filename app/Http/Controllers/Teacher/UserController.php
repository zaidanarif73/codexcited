<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Score;
use App\Enums\RoleEnum;
use App\Http\Requests\Profile\UpdateRequest;
use App\Enums\UserEnum;
use Error;
use App\Helpers\UploadHelper;
use App\Models\ScoreLog;

class UserController extends Controller
{
    public function __construct() {
        $this->view = "teacher.pages.user.";
        $this->route = "teacher.user.";
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'latest'); // default terbaru
        $search = $request->input('search'); // ambil keyword search

        $students = User::query()
            ->role(RoleEnum::Student) // filter role student
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%")
                                        ->orWhere('email', 'like', "%$search%"))
            ->when($sort === 'name_asc', fn($q) => $q->orderBy('name', 'asc'))
            ->when($sort === 'name_desc', fn($q) => $q->orderBy('name', 'desc'))
            ->when($sort === 'latest', fn($q) => $q->orderBy('created_at', 'desc'))
            ->when($sort === 'oldest', fn($q) => $q->orderBy('created_at', 'asc'))
            ->paginate(10)
            ->appends(['sort' => $sort, 'search' => $search]); // bawa param search

        return view($this->view . "index", compact('students', 'sort', 'search'));
    }

    // Form edit siswa
    public function edit($id)
    {
        $student = User::role(RoleEnum::Student)->findOrFail($id);
        return view($this->view . "edit", compact('student'));
    }

    // Update data siswa
    public function update(Request $request, $id)
    {
        try{
            $student = User::role(RoleEnum::Student)->findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => "required|email|unique:users,email,$id",
                'password' => 'nullable|string|min:6|confirmed',
                'avatar' => 'nullable|image|max:2048',
            ]);

            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $avatar = $request->avatar;

            if($avatar){
                $upload = UploadHelper::upload_file($avatar,'user-avatar',UserEnum::AVATAR_EXT);

                if($upload["IsError"] == TRUE){
                    throw new Error($upload["Message"]);
                }

                $avatar = $upload["Path"];
            }
            else{
                $avatar = $student->avatar;
            }

            if($password){
                $password = bcrypt($password);
            }
            else{
                $password = $student->password;
            }

            $student->update([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'avatar' => $avatar,
            ]);

            alert()->html('Berhasil','Data berhasil diubah','success'); 
            return redirect()->route($this->route."index");

        }catch(\Throwable $e){
            alert()->error('Gagal',$e->getMessage());
            return redirect()->route($this->route."index")->withInput();
        }
    }

     // Hapus siswa
    public function destroy($id)
    {
        $student = User::role(RoleEnum::Student)->findOrFail($id);

        $student->delete();

        alert()->html('Berhasil','Siswa berhasil dihapus secara permanen','success'); 
        return redirect()->route($this->route.'index');
    }

    // Show Siswa
    public function show($id)
    {
        $student = User::findOrFail($id);

        // Ambil data skor per menit (hari ini)
        $scoresPerMinute = ScoreLog::selectRaw('DATE_FORMAT(updated_at, "%H:%i") as minute, SUM(score) as total_score')
            ->where('user_id', $id)
            ->whereDate('updated_at', now()->toDateString()) // hanya hari ini
            ->groupBy('minute')
            ->orderBy('minute')
            ->get();

        // Ubah menjadi akumulatif
        $cumulative = 0;
        foreach ($scoresPerMinute as $row) {
            $cumulative += $row->total_score;
            $row->total_score = $cumulative;
        }

        // Per Jam (hari ini)
        $scoresPerHour = ScoreLog::selectRaw('DATE_FORMAT(updated_at, "%H:00") as hour, SUM(score) as total_score')
            ->where('user_id', $id)
            ->whereDate('updated_at', now()->toDateString())
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        // Ubah jadi akumulatif
        $total = 0;
        $scoresPerHour = $scoresPerHour->map(function($row) use (&$total) {
            $total += $row->total_score;
            return (object)[
                'hour' => $row->hour,
                'total_score' => $total
            ];
        });

        // Ambil data skor per hari
        $scoresPerDay = ScoreLog::selectRaw('DATE(updated_at) as date, SUM(score) as total_score')
            ->where('user_id', $id)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Buat akumulasi per hari
        $cumulativeDay = [];
        $total = 0;
        foreach ($scoresPerDay as $row) {
            $total += $row->total_score;
            $cumulativeDay[] = [
                'date' => $row->date,
                'total_score' => $total
            ];
        }

        // Ambil data skor per minggu (akumulatif)
        $scoresPerWeek = ScoreLog::selectRaw('YEARWEEK(updated_at, 1) as week, SUM(score) as total_score')
            ->where('user_id', $id)
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Ubah jadi akumulatif
        $cumulative = 0;
        $scoresPerWeek = $scoresPerWeek->map(function($item) use (&$cumulative) {
            $cumulative += $item->total_score;
            return (object) [
                'week' => $item->week,
                'total_score' => $cumulative
            ];
        });

        // Ambil data skor per bulan
        $scoresPerMonth = ScoreLog::selectRaw('DATE_FORMAT(updated_at, "%Y-%m") as month, SUM(score) as total_score')
            ->where('user_id', $id)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Buat akumulasi per bulan
        $cumulativeMonth = [];
        $total = 0;
        foreach ($scoresPerMonth as $row) {
            $total += $row->total_score;
            $cumulativeMonth[] = [
                'month' => $row->month,
                'total_score' => $total
            ];
        }

        //HIstory score log
        $scoreHistory = ScoreLog::where('user_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5); // 5 record per halaman

        //total score
        $totalScore = Score::where('user_id', $student->id)->sum('score');

        return view($this->view . "show", compact('student', 'totalScore', 'scoreHistory', 'scoresPerDay', 'scoresPerWeek','scoresPerMonth', 'scoresPerMinute', 'scoresPerHour'));
    }
}