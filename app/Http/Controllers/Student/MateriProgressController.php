<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MateriProgress;
use App\Models\MateriDetail;
use App\Models\Score;

class MateriProgressController extends Controller
{
    public function update(Request $r)
    {
        $data = $r->validate([
            'materi_detail_id' => ['required','exists:materi_details,id'],
            'progress'         => ['required','integer','min:0','max:100'],
        ]);

        // Cek progress lama
        $existingProgress = MateriProgress::where('user_id', $r->user()->id)
            ->where('materi_detail_id', $data['materi_detail_id'])
            ->value('progress') ?? 0;

        // Update progress
        $mp = MateriProgress::updateOrCreate(
            ['user_id' => $r->user()->id, 'materi_detail_id' => $data['materi_detail_id']],
            ['progress' => $data['progress']]
        );

        // Ambil skor lama
        $currentScore = Score::where('user_id', $r->user()->id)->value('score') ?? 0;

        // Default total skor tetap sama
        $total = $currentScore;

        // Hanya tambah skor kalau dari <100 ke 100
        if ($existingProgress < 100 && $data['progress'] == 100) {
            $total = $currentScore + 100; // skor tambahan per submateri

            Score::updateOrCreate(
                ['user_id' => $r->user()->id],
                ['score'   => $total]
            );

            $detail = MateriDetail::where('id', $data['materi_detail_id'])->value('title');

            logActivity('open_materi_detail', $r->user()->id, 'Menyelesaikan sub materi '. $detail .' dengan skor: ' . 100);

            logScore(
                $r->user()->id,
                'sub_materi',
                100,
                $total
            );
        }

        return response()->json([
            'saved'       => $mp->progress,
            'total_score' => $total
        ]);
    }
}
