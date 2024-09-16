<?php

namespace App\Http\Controllers;

use App\Models\SettingTermin;
use Illuminate\Http\Request;

class SettingTerminController extends Controller
{
    public function index(){
        $settingTermin = SettingTermin::first();
        return view('dashboard.setting.termin', compact('settingTermin'));
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
