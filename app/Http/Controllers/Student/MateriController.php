<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\MateriDetail;

class MateriController extends Controller
{
    public function __construct()
    {
        $this->view = "student.pages.materi.";
        $this->materi = new Materi();
    }

    public function index(Request $request){

        $table = $this->materi;
        $table = $table->orderBy('created_at', 'desc')->get();

        $data =  [
            'table' => $table,
        ];

        return view($this->view. "index", $data);
    }

    public function show($id){
        $materi = $this->materi->findOrFail($id);
        $materiDetails = MateriDetail::where('materi_id', $materi->id)->get();

        $data = [
            'materi' => $materi,
            'materiDetails' => $materiDetails,
        ];

        return view($this->view . "show", $data);
        // return view($this->view. "show");
    }
}
