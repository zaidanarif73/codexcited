<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\RoleEnum;
use App\Http\Requests\Profile\UpdateRequest;
use App\Enums\UserEnum;
use Error;
use App\Helpers\UploadHelper;


class UserController extends Controller
{
    public function __construct() {
        $this->view = "teacher.pages.user.";
        $this->route = "teacher.user.";
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'latest'); // default terbaru

        $students = User::query()
            ->role(RoleEnum::Student) // filter role student
            ->when($sort === 'name_asc', fn($q) => $q->orderBy('name', 'asc'))
            ->when($sort === 'name_desc', fn($q) => $q->orderBy('name', 'desc'))
            ->when($sort === 'latest', fn($q) => $q->orderBy('created_at', 'desc'))
            ->when($sort === 'oldest', fn($q) => $q->orderBy('created_at', 'asc'))
            ->paginate(10)
            ->appends(['sort' => $sort]); // biar pagination ikut bawa parameter sort

        return view($this->view . "index", compact('students', 'sort'));
    }

    // Form edit siswa
    public function edit($id)
    {
        $student = User::role(RoleEnum::Student)->findOrFail($id);
        return view($this->view . "edit", compact('student'));
    }

    // Update data siswa
    public function update(Request $request, $id)
    {
        try{
            $student = User::role(RoleEnum::Student)->findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => "required|email|unique:users,email,$id",
                'password' => 'nullable|string|min:6|confirmed',
                'avatar' => 'nullable|image|max:2048',
            ]);

            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $avatar = $request->avatar;

            if($avatar){
                $upload = UploadHelper::upload_file($avatar,'user-avatar',UserEnum::AVATAR_EXT);

                if($upload["IsError"] == TRUE){
                    throw new Error($upload["Message"]);
                }

                $avatar = $upload["Path"];
            }
            else{
                $avatar = $student->avatar;
            }

            if($password){
                $password = bcrypt($password);
            }
            else{
                $password = $student->password;
            }

            $student->update([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'avatar' => $avatar,
            ]);

            alert()->html('Berhasil','Data berhasil diubah','success'); 
            return redirect()->route($this->route."index");

        }catch(\Throwable $e){
            alert()->error('Gagal',$e->getMessage());
            return redirect()->route($this->route."index")->withInput();
        }
    }

     // Hapus siswa
    public function destroy($id)
    {
        $student = User::role(RoleEnum::Student)->findOrFail($id);

        $student->delete();

        alert()->html('Berhasil','Siswa berhasil dihapus secara permanen','success'); 
        return redirect()->route($this->route.'index');
    }
}