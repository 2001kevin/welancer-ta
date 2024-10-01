<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

class CurrencyController extends Controller
{
    public function update(Request $request){
        $currency = Currency::find(1);
        $currency->currency = $request->currency;
        $currency->save();
        return redirect()->back();
    }
}
