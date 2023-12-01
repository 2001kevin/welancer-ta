<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use App\Models\Kategori;
use App\Models\paketJasa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    public function jasa(){
        $paketJasas = paketJasa::all();
        $kategoris = Kategori::all();
        $jasas = Jasa::all();
        return view('dashboard.jasas.index', compact('jasas', 'paketJasas', 'kategoris'));
    }

    public function createJasa(){
        $paketJasas = paketJasa::all();
        $kategoris = Kategori::all();
        return view('dashboard.jasas.create', compact('paketJasas', 'kategoris'));
    }

    public function storeJasa(Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'paket_jasa' => 'required',
            'kategori' => 'required'
        ]);

        Jasa::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'paket_jasa_id' => $request->paket_jasa,
            'kategori_id' => $request->kategori,
        ]);
        return redirect(route('jasa'));
    }

    public function updateJasa(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'paket_jasa' => 'required',
            'kategori' => 'required'
        ]);

        Jasa::where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'paket_jasa_id' => $request->paket_jasa,
            'kategori_id' => $request->kategori,
        ]);
        return redirect(route('jasa'));
    }

    public function deleteJasa($id){
        DB::table('jasas')->where('id', $id)->delete();
        return redirect(route('jasa'));
    }
}
