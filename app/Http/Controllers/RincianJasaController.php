<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\RincianJasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RincianJasaController extends Controller
{
    public function rincianJasa(){
        $rincianJasas = RincianJasa::all();
        $jasas = Jasa::all();
        return view('dashboard.rincian_jasa.index', compact('rincianJasas','jasas'));
    }

    public function createRincian(){
        $jasas = Jasa::all();
        return view('dashboard.rincian_jasa.create', compact('jasas'));
    }

    public function storeRincian(Request $request){
        $request->validate([
            'nama' => 'required',
            'jasa' => 'required'
        ]);

        RincianJasa::create([
            'nama' => $request->nama,
            'jasa_id' => $request->jasa
        ]);
        toast('Data Rincian Sukses Dibuat!','success');
        return redirect(route('rincian-jasa'));
    }

    public function updateRincian(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'jasa' => 'required'
        ]);

        RincianJasa::where('id', $id)->update([
            'nama' => $request->nama,
            'jasa_id' => $request->jasa
        ]);
        toast('Data Rincian Sukses Diedit!','success');
        return redirect(route('rincian-jasa'));
    }

    public function deleteRincian($id){
        DB::table('rincian_jasas')->where('id', $id)->delete();
        toast('Data Rincian Sukses Dihapus!','success');
        return redirect(route('rincian-jasa'));
    }
}
