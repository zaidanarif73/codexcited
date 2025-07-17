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

    public function index(Request $request){

        $table = $this->materi;
        $table = $table->orderBy('difficulty', 'asc')->get();

        $data =  [
            'table' => $table,
        ];

        return view($this->view. "index", $data);
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
}
