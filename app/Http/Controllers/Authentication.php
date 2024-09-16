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
        $user->save();
        toast('Registrasi Sukses!','success');
        return redirect()->route('login')->with('success', 'Registration success, Please Login!');
    }

    public function loginAdmin(Request $request){
         $credentials = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        // return $request;
        if (Auth::guard('pegawai')->attempt($credentials)) {
            toast('Login Sukses!','success');
            return redirect()->intended('/');
        }else{

            return back()->withErrors([
               'password' => 'Wrong email or password',
           ]);
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
            toast('Login Sukses!','success');
            return redirect()->intended('/');
        }

        // if(Auth::attempt($credentials)){
        //     $request->session()->regenerate();

        //     return redirect()->intended('/');
        // }

         return back()->withErrors([
            'password' => 'Wrong email or password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
