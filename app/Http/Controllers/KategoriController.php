<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function kategori(){

        $kategoris = Kategori::all();
        return view('dashboard.kategori.index', compact('kategoris'));
    }

    public function createKategori(){
        return view('dashboard.kategori.create');
    }

    public function storekategori(Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        toast('Data Kategori Sukses Dibuat!','success');
        return redirect(route('kategori'));
    }

    public function updatekategori(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        Kategori::where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        toast('Data Kategori Sukses Diedit!','success');
        return redirect(route('kategori'));
    }

    public function deletekategori($id){
        DB::table('kategoris')->where('id', $id)->delete();
        toast('Data Kategori Sukses Dihapus!','success');
        return redirect(route('kategori'));
    }
}
