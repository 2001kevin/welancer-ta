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

    public function getSubServices($serviceId)
    {
        $subServices = RincianJasa::where('jasa_id', $serviceId)->get();
        $services = Jasa::whereHas('rincian_jasa')->where('id', $serviceId)->get();
        return response()->json([
            'subServices' => $subServices,
            'services' => $services
        ]);
    }

    public function createRincian(){
        $jasas = Jasa::all();
        return view('dashboard.rincian_jasa.create', compact('jasas'));
    }

    public function storeRincian(Request $request){
        $request->validate([
            'nama' => 'required',
            'jasa' => 'required',
            'unit' => 'required',
            'unit_type' => 'required',
            'harga' => 'required'
        ]);

        RincianJasa::create([
            'nama' => $request->nama,
            'unit' => $request->unit,
            'unit_type' => $request->unit_type,
            'harga' => $request->harga,
            'jasa_id' => $request->jasa
        ]);
        $jasa = Jasa::find($request->jasa); // Ganti 1 dengan ID Jasa yang ingin diperbarui

        $minPrice = $jasa->rincian_jasa->min('harga');
        $maxPrice = $jasa->rincian_jasa->max('harga');

        $jasa->min_price = $minPrice;
        $jasa->max_price = $maxPrice;
        $jasa->save();;

        toast('Data Rincian Sukses Dibuat!','success');
        return redirect(route('rincian-jasa'));
    }

    public function updateRincian(Request $request, $id){
        // $request->validate([
        //     'nama' => 'required',
        //     'jasa' => 'required',
        //     'unit' => 'required',
        //     'unit_type' => 'required',
        //     'harga' => 'required'
        // ]);

        RincianJasa::where('id', $id)->update([
            'nama' => $request->nama,
            'unit' => $request->unit,
            'tipe_unit' => $request->unit_type,
            'harga' => $request->harga,
            'jasa_id' => $request->jasa_id
        ]);
        $jasa = Jasa::find($request->jasa_id); // Ganti 1 dengan ID Jasa yang ingin diperbarui

        $minPrice = $jasa->rincian_jasa->min('harga');
        $maxPrice = $jasa->rincian_jasa->max('harga');

        $jasa->min_price = $minPrice;
        $jasa->max_price = $maxPrice;
        $jasa->save();

        toast('Data Rincian Sukses Diedit!','success');
        return redirect(route('rincian-jasa'));
    }

    public function deleteRincian($id){
        DB::table('rincian_jasas')->where('id', $id)->delete();
        toast('Data Rincian Sukses Dihapus!','success');
        return redirect(route('rincian-jasa'));
    }
}
