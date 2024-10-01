<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\DetailJasa;
use App\Models\DetailPaket;
use App\Models\Jasa;
use App\Models\Kategori;
use App\Models\paketJasa;
use App\Models\Pegawai;
use App\Models\RincianJasa;
use App\Models\skill;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JasaController extends Controller
{
    public function jasa($id){
        $currency = Currency::pluck('currency');
        $detailPakets = DetailPaket::all();
        $paketJasas = paketJasa::all();
        $kategoris = Kategori::all();
        $kategori_id = Kategori::find($id);
        $jasas = Jasa::where('kategori_id', $id)->orderBy('created_at', 'desc')->get();
        $detailJasas = DetailJasa::all();
        $skills = skill::all();
        $rincians = RincianJasa::all();
        $pegawais = Pegawai::all();
        // $rincians = RincianJasa::with('detailJasa')->get();
        $rincians = DB::table('rincian_jasas')
            ->join('detail_jasas', 'rincian_jasas.id', '=', 'detail_jasas.rincian_jasa_id')
            ->join('skills', 'detail_jasas.skill_id', '=', 'skills.id')
            ->join('pegawais', 'detail_jasas.pegawai_id', '=', 'pegawais.id')
            ->join('jasas', 'rincian_jasas.jasa_id', '=', 'jasas.id')
            ->select(
                'rincian_jasas.*',
                'detail_jasas.id AS detail_jasa_id',
                'skills.nama AS nama_skill',
                'pegawais.name AS nama_pegawai',
                'jasas.nama AS nama_jasa'
            )
            ->get();

        return view('dashboard.jasas.index', compact('jasas',
                                                    'paketJasas',
                                                    'kategoris',
                                                    'rincians',
                                                    'detailPakets',
                                                    'detailJasas',
                                                    'skills',
                                                    'pegawais',
                                                    'rincians',
                                                    'kategori_id',
                                                    'currency'
                                                    ));
    }

    public function createJasa($id){
        $paketJasas = paketJasa::all();
        $kategori = Kategori::find($id);
        return view('dashboard.jasas.create', compact('paketJasas', 'kategori'));
    }

    public function storeJasa(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|string|max:255',
                'deskripsi' => 'required',
                'kategori' => 'required'
            ],
            [
                'nama.required' => 'Name required',
                'nama.string' => 'Name must be a text',
                'nama.max' => 'Name cannot more than 255 character',
                'deskripsi.required' => 'Description required',
                'kategori.required' => 'Kategori required'
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
        $kategori_id = $request->kategori;

        Jasa::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori,
        ]);
        toast('Data Jasa Sukses Dibuat!','success');
        return redirect(route('jasa', $kategori_id));
    }

    public function updateJasa(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        $jasa = Jasa::find($id);
        $kategori_id = $jasa->kategori_id;
        Jasa::where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ]);
        toast('Service Updated Successfully!','success');
        return redirect(route('jasa', $kategori_id));
    }

    public function deleteJasa($id){
        $jasa = Jasa::find($id);
        $kategori_id = $jasa->kategori_id;
        $jasa->delete();
        toast('Data Jasa Sukses Dihapus!','success');
        return redirect(route('jasa', $kategori_id));
    }

    public function createDetailJasa(){
        $skills = skill::all();
        $rincians = RincianJasa::all();
        $pegawais = Pegawai::all();
        return view('dashboard.detail_jasa.create', compact('skills', 'rincians', 'pegawais'));
    }

    public function detailSubJasa($id){
        $jasa = Jasa::find($id);
        $subService = RincianJasa::where('jasa_id', $id)->pluck('id');
        $detailJasas = DetailJasa::whereIn('rincian_jasa_id', $subService)->get();
        $currency = Currency::pluck('currency');
        // return $detailJasas;
        return view('dashboard.jasas.subService', compact('detailJasas', 'jasa', 'currency'));
    }

    public function storeDetailJasa(Request $request){
        $request->validate([
            'skill' => 'required',
            'rincianJasa' => 'required',
            'pegawai' => 'required',
        ]);

        DetailJasa::create([
            'skill_id' => $request->skill,
            'rincian_jasa_id' => $request->rincianJasa,
            'pegawai_id' => $request->pegawai,
        ]);
        toast('Service Detail Created Successfully!','success');
        return redirect()->back();
    }

    public function updateDetailJasa(Request $request, $id){
        DetailJasa::where('id', $id)->update([
            'skill_id' => $request->skill,
            'rincian_jasa_id' => $request->rincianJasa,
            'pegawai_id' => $request->pegawai,
        ]);
        toast('Service Detail Updated Successfully!','success');
        return redirect(route('jasa'));
    }

    public function deleteDetailJasa($id){
        DetailJasa::where('id', $id)->delete();
        toast('Service Detail Deleted Successfully!','success');
        return redirect(route('jasa'));
    }
}
