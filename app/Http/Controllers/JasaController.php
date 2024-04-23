<?php

namespace App\Http\Controllers;

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

class JasaController extends Controller
{
    public function jasa(){
        $detailPakets = DetailPaket::all();
        $paketJasas = paketJasa::all();
        $kategoris = Kategori::all();
        $jasas = Jasa::all();
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
                                                    ));
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
        toast('Data Jasa Sukses Dibuat!','success');
        return redirect(route('jasa'));
    }

    public function updateJasa(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'min_price' => 'required|numeric|lte:max_price',
            'max_price' => 'required|numeric|gte:min_price',
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
        toast('Service Updated Successfully!','success');
        return redirect(route('jasa'));
    }

    public function deleteJasa($id){
        DB::table('jasas')->where('id', $id)->delete();
        toast('Data Jasa Sukses Dihapus!','success');
        return redirect(route('jasa'));
    }

    public function createDetailJasa(){
        $skills = skill::all();
        $rincians = RincianJasa::all();
        $pegawais = Pegawai::all();
        return view('dashboard.detail_jasa.create', compact('skills', 'rincians', 'pegawais'));
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
        return redirect(route('jasa'));
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
