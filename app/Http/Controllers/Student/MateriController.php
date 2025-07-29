<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\MateriDetail;
use App\Models\MateriProgress;

class MateriController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.materi.";
        $this->materi = new Materi();
    }

    public function index(Request $request)
    {
        $userId = auth()->id(); // ambil ID user yang login
        $table = $this->materi->with('details')->orderBy('difficulty', 'asc')->get();

        // Loop setiap materi untuk hitung progress-nya
        foreach ($table as $materi) {
            $submateriList = $materi->details; // ambil submateri
            $submateriIds = $submateriList->pluck('id'); // ambil id-nya
            $totalSubmateri = $submateriList->count();

            if ($totalSubmateri === 0) {
                $materi->user_progress = 0;
                continue;
            }

            // Ambil progres dari user untuk submateri yang relevan
            $progressItems = MateriProgress::where('user_id', $userId)
                ->whereIn('materi_detail_id', $submateriIds)
                ->pluck('progress', 'materi_detail_id');

            // Hitung total nilai progres
            $totalProgress = 0;
            foreach ($submateriIds as $id) {
                $totalProgress += $progressItems[$id] ?? 0; // kalau tidak ada, anggap 0
            }

            // Hitung rata-rata progres materi
            $materi->user_progress = round($totalProgress / $totalSubmateri);
        }

        return view($this->view . "index", ['table' => $table]);
    }

    public function show($id){
        $materi = $this->materi->findOrFail($id);
        $materiDetails = MateriDetail::where('materi_id', $materi->id)->get();
        $progressMap = MateriProgress::where('user_id', auth()->id())
            ->whereIn('materi_detail_id', $materiDetails->pluck('id'))
            ->pluck('progress', 'materi_detail_id');

        $data = [
            'materi' => $materi,
            'materiDetails' => $materiDetails,
            'progressMap' => $progressMap,
        ];

        return view($this->view . "show", $data);
        // return view($this->view. "show");
    }

    public function code($id, Request $request)
    {
        $decodedCode = null;

        if ($request->has('code')) {
            $decodedCode = base64_decode($request->get('code'));
        }

        return view($this->view.'code' , ['code' => $decodedCode,]);
    }
}
