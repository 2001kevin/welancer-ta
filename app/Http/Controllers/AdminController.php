<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $currency = Currency::all();
        return view('dashboard.dashboard', compact('currency'));
    }
}
