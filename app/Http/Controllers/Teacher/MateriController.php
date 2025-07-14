<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi; // Assuming you have a Materi model
use Illuminate\Pagination\Paginator;
use App\Http\Requests\Materi\StoreRequest;
use App\Helpers\UploadHelper;
use Error;

class MateriController extends Controller
{
    public function __construct(){
        $this->view = "teacher.pages.materi.";
        $this->route = "teacher.materi.";
        $this->materi = new Materi();
    }

    public function index(Request $request)
    {
        $table = $this->materi;
        $table = $table->orderBy("created_at", "DESC");
        $table = $table->paginate(10)->withQueryString();

        $data = [
            'table' => $table,
        ];

        // Return the view with the data
        return view($this->view . "index", $data);
    }

    public function create()
    {
        // Return the create view
        return view($this->view . "create");
    }

    public function store(StoreRequest $request){
        try {
            $title = $request->title;
            $description = $request->description;
            $cover = $request->file('cover');

            if($cover){
                $upload = UploadHelper::upload_file($cover,'cover materi',['jpeg','jpg','png','gif']);

                if($upload["IsError"] == TRUE){
                    throw new Error($upload["Message"]);
                }

                $cover = $upload["Path"];
                $create = $this->materi->create([
                    'title' => $title,
                    'description' => $description,
                    'cover' => $cover,
                ]);
            }
            alert()->html('Berhasil','Data berhasil ditambahkan','success'); 
            return redirect()->route($this->route."index");

        }catch (\Throwable $e) {
            // Log::emergency($e->getMessage());

            alert()->error('Gagal',$e->getMessage());

            return redirect()->route($this->route."create")->withInput();
        }
    }
}
