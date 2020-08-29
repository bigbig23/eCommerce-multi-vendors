<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('dashboard.auth.login');
    }


    public function processLogin(AdminLoginRequest $request){
        $remember_me = $request->has('remember_me') ? true : false;

        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $remember_me)){
            return redirect()->route('admin.dashboard');
            //return 'hy admin';

        }else{
            return redirect()->back()->with('error','هناك خطاء بالبيانات');
        }
    }
}