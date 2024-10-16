<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authentication extends Controller
{
    public function indexLoginUser(){
        return view('auth.loginUser');
    }

    public function indexLoginAdmin(){
        return view('auth.loginAdmin');
    }

    public function register(){
        return view('auth.register');
    }

    public function register_action(Request $request){

        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'password' => 'required',
            // 'password_confirmation' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ]);
        $data1 = $user->save();
        if($data1){
            toast('Registration Success!','success');
            return redirect()->route('login-user');
        }else{
            alert()->error('Authentication Failed', 'Wrong email or password.');
            return redirect()->back();
        }
    }

    public function loginAdmin(Request $request){
         $credentials = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        // return $request;
        if (Auth::guard('pegawai')->attempt($credentials)) {
            return redirect()->intended('/');
        }else{
            alert()->error('Authentication Failed', 'Wrong email or password.');
            return redirect()->back();
        }

        // if(Auth::attempt($credentials)){
        //     $request->session()->regenerate();

        //     return redirect()->intended('/');
        // }

    }

    public function loginUser(Request $request){
         $credentials = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        // return $request;
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/');
        }

        // if(Auth::attempt($credentials)){
        //     $request->session()->regenerate();

        //     return redirect()->intended('/');
        // }

        alert()->error('Authentication Failed', 'Wrong email or password.');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
