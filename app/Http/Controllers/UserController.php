<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginUser(){
        return view('auth.loginUser');
    }
}
