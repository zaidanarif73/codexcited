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

        $mp = MateriProgress::updateOrCreate(
            ['user_id' => $r->user()->id, 'materi_detail_id' => $data['materi_detail_id']],
            ['progress' => $data['progress']]
        );

        // Update total progress for the user on skor
        $total = MateriProgress::where('user_id', $r->user()->id)
            ->sum('progress');
            
        Score::updateOrCreate(
            ['user_id' => $r->user()->id],
            ['score'   => $total]
        );

        if($data['progress'] == 100){
            $detail = MateriDetail::where('id', $data['materi_detail_id'])->value('title');

            logActivity('open_materi_detail', $r->user()->id, 'Menyelesaikan sub materi '. $detail .' dengan skor: ' . $data['progress']);
        }
        
        return response()->json(['saved' => $mp->progress,'total_score'  => $total]);
    }
}
