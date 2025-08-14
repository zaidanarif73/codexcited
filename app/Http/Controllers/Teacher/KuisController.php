<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Kuis;

class KuisController extends Controller
{

    public function __construct(){
        $this->view = "teacher.pages.kuis.";
        $this->route = "teacher.materi.";
    }

    public function index($materiId)
    {
        $materi = Materi::with('kuis')->findOrFail($materiId);
        $kuis = Kuis::where('materi_id', $materiId)->get();
        return view($this->view. "index", compact('materi', 'kuis'));
    }

    public function create($materiId)
    {
        $materi = Materi::findOrFail($materiId);
        return view($this->view. "create", compact('materi'));
    }

    public function store(Request $request, $materiId)
    {
        try {
            // 1. Validasi input
            $validated = $request->validate([
                'question' => 'required|string',
                'options' => 'required|array|min:4|max:4',
                'options.*' => 'required|string',
                'correct' => 'required|integer|min:0|max:3',
                'explanation' => 'nullable|string',
            ]);

            // 2. Simpan ke database
            $kuis = new Kuis();
            $kuis->materi_id = $materiId;
            $kuis->question = $validated['question'];
            $kuis->options = $validated['options'];
            $kuis->correct = $validated['correct'];
            $kuis->explanation = $validated['explanation'] ?? null;
            $kuis->save();

            // 3. Redirect sukses
            return redirect()
                ->route('teacher.materi.kuis.index', $materiId)
                ->with('success', 'Kuis berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan kuis.');
        }
    }

    public function edit($materiId, $kuisId)
    {
        $materi = Materi::findOrFail($materiId);
        $kuis = Kuis::where('materi_id', $materiId)->findOrFail($kuisId);

        return view($this->view . 'edit', compact('materi', 'kuis'));
    }

    public function update(Request $request, $materiId, $kuisId)
    {
        $validated = $request->validate([
            'question'     => 'required|string',
            'options'      => 'required|array|min:4|max:4',
            'options.*'    => 'required|string',
            'correct'      => 'required|integer|min:0|max:3',
            'explanation'  => 'nullable|string',
        ]);

        $kuis = Kuis::where('materi_id', $materiId)
                    ->where('id', $kuisId)
                    ->firstOrFail();

        $kuis->update([
            'question'    => $validated['question'],
            'options'     => $validated['options'],
            'correct'     => $validated['correct'],
            'explanation' => $validated['explanation'] ?? null,
        ]);

        alert()->html('Berhasil','Kuis berhasil diupdate','success');
        return redirect()->route('teacher.materi.kuis.index', $materiId);
    }

    public function destroy($materiId, $kuisId)
    {
        $kuis = Kuis::where('materi_id', $materiId)->findOrFail($kuisId);
        $kuis->delete();

        return redirect()->route('teacher.materi.kuis.index', $materiId)->with('success', 'Kuis berhasil dihapus.');
    }


}
