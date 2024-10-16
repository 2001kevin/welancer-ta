<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\RevenueDistribution;
use App\Models\SettingTermin;
use Illuminate\Http\Request;

class SettingTerminController extends Controller
{
    public function index(){
        $settingRevenue = RevenueDistribution::first();
        $settingTermin = SettingTermin::first();
        $currency = Currency::first();
        return view('dashboard.setting.termin', compact('settingTermin', 'settingRevenue', 'currency'));
    }

    public function store(Request $request){
        $settingTermin = new SettingTermin();
        $settingTermin->jumlah_termin = $request->jumlah_termin;
        $settingTermin->rincian = $request->termin;
        $success = $settingTermin->save();
        if($success){
            toast('Setting Termin Created Successfully', 'success');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id){
        $settingTermin = SettingTermin::find($id);
        $settingTermin->jumlah_termin = $request->jumlah_termin;
        $settingTermin->rincian = $request->termin;
        $success = $settingTermin->save();
        if($success){
            toast('Setting Termin Updated Successfully', 'success');
            return redirect()->back();
        }
    }
}
