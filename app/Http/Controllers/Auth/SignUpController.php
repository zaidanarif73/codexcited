<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\RoleEnum;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Auth;
use Error; 

class SignUpController extends Controller
{
    public function index(){
        return "Sukses !";
    }

    public function post(SignUpRequest $request){
        
        try {
            $email = $request->email;
            $password = $request->password;

            $field = [
                'email' => $email,
                'password' => $password
            ];

  
            $user_email = User::where('email', $request->email)->first();

            if($user_email){
                alert()->html('Gagal','Email sudah terdaftar','error');
                return redirect()->back();
            }else{
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->assignRole(RoleEnum::Student);
                $user->save();

                alert()->html('Berhasil','Pendaftaran berhasil, silahkan login','success');
                return redirect()->back();
            }

        } catch (Error $e) {
            Log::error($e);
        }
        
    }
}
