<?php

namespace App\Http\Controllers;

use App\Models\RevenueDistribution;
use Illuminate\Http\Request;

class RevenueDistributionController extends Controller
{
    public function store(Request $request){
        $revenue = new RevenueDistribution();
        $revenue->freelancer = $request->freelancer;
        $revenue->company = $request->company;
        $data1 = $revenue->save();
        if($data1){
            return redirect()->back();
        }
    }
}
