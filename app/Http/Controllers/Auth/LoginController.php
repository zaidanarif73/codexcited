<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Enums\RoleEnum;
use App\Http\Requests\LoginRequest;
use Auth;
use Error; 

class LoginController extends Controller
{
    public function __construct() {
        $this->view = "auth.";
    } 
    
    public function index(){

        if(Auth::check()){

            if(Auth::user()->hasRole([
                \App\Enums\RoleEnum::Teacher,
            ])){
                return redirect()->route('teacher.dashboard.index');
            }

            else if(Auth::user()->hasRole([
                \App\Enums\RoleEnum::Student,
            ])){
                return redirect()->route('student.dashboard.index');
            }
        }
        

        return view($this->view."login");
    }

    public function post(LoginRequest $request){
        try {
            $email = $request->email;
            $password = $request->password;

            $rememberme = (empty($request->rememberme)) ? false : true;

            $field = [
                'email' => $email,
                'password' => $password
            ];

            if(Auth::attempt($field,$rememberme)){
                if(!Auth::user()->hasRole([
                        RoleEnum::SuperAdmin,
                        RoleEnum::Teacher,
                        RoleEnum::Student,
                        
                ])){
                    Auth::logout();
                    throw new Error("Anda tidak diperbolehkan mengakses menu ini");
                } 
            
                    if(Auth::user()->hasRole([
                        RoleEnum::Teacher,
                    ])){
                        alert()->html('Berhasil','Login berhasil','success'); 
                        return redirect()->intended(route('teacher.dashboard.index'));
                    }

                    if (Auth::user()->hasRole([
                        RoleEnum::Student,
                    ])) {
                        // Ambil nama user untuk dicatat
                        $userName = Auth::user()->name ?? 'Unknown';

                        // Logging activity
                        logActivity(
                            'login', // event
                            Auth::id(), // id user
                            "Melakukan login akun" // deskripsi
                        );

                        // SweetAlert
                        alert()->html('Berhasil', 'Login berhasil', 'success');

                        return redirect()->intended(route('student.dashboard.index'));
                    }
            }
            else{
                //throw new Error("Email / password tidak sesuai"); 
                alert()->html('Gagal','Email/Password Salah','error');
                return redirect()->intended(route('auth.login.index'));
            }

        }catch(\Throwable $e){
            Log::emergency($e->getMessage());
            alert()->html('Gagal',$e->getMessage(),'error');
            return redirect()->back()->withInput(); 
        }
    }
}
