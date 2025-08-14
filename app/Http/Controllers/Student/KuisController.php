<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\ScoreLog;
use Illuminate\Support\Facades\App;

class KuisController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.kuis.";
    }

    public function show($materi_id)
    {
        // Ambil kuis berdasarkan materi_id (misal materi_id = 1)
        $questions = Kuis::where('materi_id', $materi_id)->get();

        $materi = Materi::find($materi_id);

        if (!$materi) {
            return redirect()->route('student.materi.index');
        }

        // Simpan log aktivitas with helper function
        logActivity('open_quiz', $materi_id, 'Membuka kuis untuk materi ' . Materi::where('id', $materi_id)->value('title'));

        return view($this->view . "show", compact('questions', 'materi_id'));
    }

    public function simpanSkor(Request $request)
    {
        $userId = auth()->id();
        $materiId = $request->input('materi_id');


        // Cek apakah user sudah punya data score
        $score = \App\Models\Score::where('user_id', $userId)->first();

        if ($score) {
            $score->increment('score', $request->input('score', 1));
        } else {
            \App\Models\Score::create([
                'user_id' => $userId,
                'score' => $request->input('score', 1),
            ]);
        }

        // Simpan log score
        logScore(
            $userId,
            'quiz',
            $request->input('score', 1),
            $score->score
        );

        // Simpan log aktivitas
        logActivity(
            'submit_quiz',
            $materiId,
            'Mengirim jawaban kuis dengan skor ' . $request->input('score', 1) .' untuk materi ' . Materi::where('id', $materiId)->value('title'),
        );
        
        return response()->json(['message' => 'Score updated']);
    }
}
