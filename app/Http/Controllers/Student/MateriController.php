<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\MateriDetail;
use App\Models\MateriProgress;
use App\Models\Score;
use App\Models\Kuis;

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

        // Log aktivitas buka daftar materi
        logActivity('open_materi_list', null, 'Membuka daftar materi');

        return view($this->view . "index", ['table' => $table]);
    }

    public function show($id)
    {
        $materi = $this->materi->findOrFail($id);
        $materiDetails = MateriDetail::where('materi_id', $materi->id)->get();
        $progressMap = MateriProgress::where('user_id', auth()->id())
            ->whereIn('materi_detail_id', $materiDetails->pluck('id'))
            ->pluck('progress', 'materi_detail_id');

        $kuis = Kuis::where('materi_id', $materi->id)->get(); // <<--- ini ditambahkan

        // Log aktivitas buka materi
        logActivity('open_materi', $materi->id, 'Membuka materi: ' . $materi->title);

        $data = [
            'materi' => $materi,
            'materiDetails' => $materiDetails,
            'progressMap' => $progressMap,
            'kuis' => $kuis, // <<--- lempar ke view
        ];

        return view($this->view . "show", $data);
    }

    public function code($id, Request $request)
    {
        $decodedCode = null;

        if ($request->has('code')) {
            $decodedCode = base64_decode($request->get('code'));
        }

        // Log aktivitas buka code editor
        $materiTitle = Materi::where('id', $id)->value('title');
        logActivity('open_code_editor', $id, 'Membuka code editor untuk materi: ' . $materiTitle);

        return view($this->view.'code' , ['code' => $decodedCode, 'materi_id' => $id]);
    }

    public function addScore(Request $request)
    {
        $userId = auth()->id();



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

        // Log aktivitas run code
        $materiTitle = Materi::where('id', $request->input('materi_id'))->value('title');
        logActivity('run_code_editor', $request->input('materi_id'), 'Melakukan run code editor pada materi ' . $materiTitle);

        return response()->json(['message' => 'Score updated']);
    }
}
