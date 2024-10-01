<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|string|max:255',
                'deskripsi' => 'required',
            ],
            [
                'nama.required' => 'Name required',
                'nama.string' => 'Name must be a text',
                'nama.max' => 'Name cannot more than 255 character',
                'deskripsi.required' => 'Description required'
            ]
        );

        if ($validator->fails()) {
            // Create a list of errors
            $errors = $validator->errors()->all();
            $errorList = '<ul>';
            foreach ($errors as $error) {
                $errorList .= "<li>{$error}</li>";
            }
            $errorList .= '</ul>';

            // Store error list in session
            session()->flash('error_list', $errorList);

            // Redirect back to previous page
            return redirect()->back()->withInput();
        }

        Kategori::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        toast('Category Successfully Created!','success');
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
