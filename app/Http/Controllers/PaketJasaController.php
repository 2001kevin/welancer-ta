<?php

namespace App\Http\Controllers;

use App\Models\paketJasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaketJasaController extends Controller
{
    public function paketJasa(){
        $paketJasas = paketJasa::all();
        return view('dashboard.paket_jasa.index', compact('paketJasas'));
    }

    public function createpaketJasa(){
        return view('dashboard.paket_jasa.create');
    }

    public function storepaketJasa(Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        paketJasa::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        toast('Data Paket Jasa Sukses Dibuat!','success');
        return redirect(route('paketJasa'));
    }

    public function updatepaketJasa(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        paketJasa::where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        toast('Data Paket Jasa Sukses Diedit!','success');
        return redirect(route('paketJasa'));
    }

    public function deletepaketJasa($id){
        DB::table('paket_jasas')->where('id', $id)->delete();
        toast('Data Paket Jasa Sukses Dihapus!','success');
        return redirect(route('paketJasa'));
    }
}
