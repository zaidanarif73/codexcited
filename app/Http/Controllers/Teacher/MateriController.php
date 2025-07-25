<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi; // Assuming you have a Materi model
use App\Models\MateriDetail; // Assuming you have a MateriDetail model
use Illuminate\Pagination\Paginator;
use App\Http\Requests\Materi\StoreRequest;
use App\Helpers\UploadHelper;
use Illuminate\Support\Str;
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
        $search = $request->search;

        $table = $this->materi;

        if (!empty($search)) {
            $table = $table->where(function ($query2) use ($search) {
                $query2->where("title", "like", "%" . $search . "%");
            });
        }

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
            $difficulty = $request->difficulty;
            $type = $request->type === 'custom' && $request->filled('custom_type')? $request->custom_type : $request->type;
            $slug = Str::slug($title);

            $coverPath = null;

            if ($cover) {
                $upload = UploadHelper::upload_file($cover, 'cover materi', ['jpeg','jpg','png','gif']);

                if ($upload["IsError"] == true) {
                    throw new Error($upload["Message"]);
                }

                $coverPath = $upload["Path"];
            }

            $create = $this->materi->create([
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'cover' => $coverPath,
                'type' => $type,
                'difficulty' => $difficulty,
            ]);
            alert()->html('Berhasil','Data berhasil ditambahkan','success'); 
            return redirect()->route($this->route."index");

        }catch (\Throwable $e) {
            // Log::emergency($e->getMessage());

            alert()->error('Gagal',$e->getMessage());

            return redirect()->route($this->route."create")->withInput();
        }
 
    }

    public function edit($id)
    {
        $result = $this->materi->findOrFail($id);

        return view($this->view . "edit", compact('result'));
    }

    public function update(StoreRequest $request, $id)
    {
        try {
            $materi = $this->materi->findOrFail($id);
            $title = $request->title;
            $description = $request->description;
            $cover = $request->file('cover');
            $difficulty = $request->difficulty;
            $type = $request->type === 'custom' && $request->filled('custom_type')? $request->custom_type : $request->type;
            $slug = Str::slug($title);

            if ($cover) {
                $upload = UploadHelper::upload_file($cover, 'cover materi', ['jpeg', 'jpg', 'png', 'gif']);

                if ($upload["IsError"] == TRUE) {
                    throw new Error($upload["Message"]);
                }

                $cover = $upload["Path"];
            } else {
                $cover = $materi->cover;
            }

            $materi->title = $title;
            $materi->slug = $slug;
            $materi->description = $description;
            $materi->cover = $cover;
            $materi->type = $type;
            $materi->difficulty = $difficulty;

            $materi->save();

            alert()->html('Berhasil','Data berhasil diupdate','success'); 
            return redirect()->route($this->route."index");

        } catch (\Throwable $e) {
            // Log::emergency($e->getMessage());

            alert()->error('Gagal',$e->getMessage());

            return redirect()->route($this->route."edit", ['id' => $id])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $materi = $this->materi->findOrFail($id);
            $materi->delete(); // akan otomatis menghapus detail & progress karena cascade

            alert()->success('Berhasil', 'Materi dan semua data terkait berhasil dihapus');
            return redirect()->route($this->route . "index");
        } catch (\Throwable $e) {
            alert()->error('Gagal', $e->getMessage());
            return redirect()->back();
        }
    }

    //Materi Detail Section
    public function show($id)
    {
        $materi = Materi::with('details')->findOrFail($id);

        return view('teacher.pages.materi.detail', compact('materi'));
    }

    public function storeDetail(Request $request, $id)
    {
        try {
            $materi = Materi::findOrFail($id);
            $submateriList = $request->input('submateri');

            if (!is_array($submateriList)) {
                throw new \Exception("Format submateri tidak valid.");
            }

            foreach ($submateriList as $sub) {
                MateriDetail::create([
                    'materi_id' => $materi->id,
                    'title' => $sub['title'] ?? '',
                    'description' => $sub['description'] ?? '',
                ]);
            }

            alert()->html('Berhasil', 'Semua submateri berhasil ditambahkan', 'success');
            return redirect()->route($this->route . "show", $materi->id);

        } catch (\Throwable $e) {
            alert()->error('Gagal', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editDetail($materi_id, $detail_id)
    {
        $materi = Materi::findOrFail($materi_id);
        $detail = MateriDetail::where('materi_id', $materi->id)->findOrFail($detail_id);

        return view('teacher.pages.materi.detail-edit', compact('materi', 'detail'));
    }

    public function updateDetail(Request $request, $materi_id, $detail_id)
    {
        try {
            $materi = Materi::findOrFail($materi_id);
            $detail = MateriDetail::where('materi_id', $materi->id)->findOrFail($detail_id);

            $detail->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            alert()->success('Berhasil', 'Submateri berhasil diupdate');
            return redirect()->route($this->route . 'show', $materi_id);

        } catch (\Throwable $e) {
            alert()->error('Gagal', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroyDetail($materi_id, $detail_id)
    {
        try {
            $detail = MateriDetail::where('materi_id', $materi_id)->findOrFail($detail_id);
            $detail->delete();

            alert()->success('Berhasil', 'Submateri berhasil dihapus');
            return redirect()->route($this->route . 'show', $materi_id);
        } catch (\Throwable $e) {
            alert()->error('Gagal', $e->getMessage());
            return redirect()->back();
        }
    }

}
