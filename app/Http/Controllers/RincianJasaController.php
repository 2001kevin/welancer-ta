<?php

namespace App\Http\Controllers;

use App\Models\DetailJasa;
use App\Models\Jasa;
use App\Models\Pegawai;
use App\Models\PegawaiSkill;
use App\Models\RincianJasa;
use App\Models\skill;
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

    public function createRincian($id){
        $jasa = Jasa::find($id);
        $skills = skill::all();
        $pegawais = Pegawai::where('role', 'freelancer')->get();
        return view('dashboard.rincian_jasa.create', compact('jasa', 'skills', 'pegawais'));
    }

    public function storeRincian(Request $request){
        $request->validate([
            'nama' => 'required',
            'jasa' => 'required',
            'unit' => 'required',
            'unit_type' => 'required',
            'harga' => 'required'
        ]);

        // RincianJasa::create([
        //     'nama' => $request->nama,
        //     'unit' => $request->unit,
        //     'unit_type' => $request->unit_type,
        //     'harga' => $request->harga,
        //     'jasa_id' => $request->jasa
        // ]);


        $rincianJasa = new RincianJasa();
        $rincianJasa->nama = $request->nama;
        $rincianJasa->unit = $request->unit;
        $rincianJasa->tipe_unit = $request->unit_type;
        $rincianJasa->jasa_id = $request->jasa;
        $rincianJasa->harga = $request->harga;
        $data1 = $rincianJasa->save();

        // $detailJasa = new DetailJasa();
        // $detailJasa->skill_id = $request->skill;
        // $detailJasa->rincian_jasa_id = $rincianJasa->id;
        // $detailJasa->pegawai_id = $request->pegawai;
        // $detailJasa->level_freelancer = $level;
        // $data2 = $detailJasa->save();

        if($data1){
            toast('Sub Service Created Successfully!','success');
        }
        return redirect(route('detail-subJasa', $request->jasa));
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

    public function detailJasa($id){
        $detailJasas = DetailJasa::where('rincian_jasa_id', $id)->get();
        $skills = skill::all();
        $rincianJasa = RincianJasa::find($id);
        return view('dashboard.jasas.detailJasa', compact('detailJasas', 'skills', 'rincianJasa'));
    }

    public function addDetailJasa(Request $request){
        $pegawai = Pegawai::find($request->pegawai);
        $skill = $pegawai->skills()->where('skill_id', $request->skill)->first();

        // Mengambil level dari tabel pivot
        $level = $skill->pivot->level;

        $detailJasa = new DetailJasa();
        $detailJasa->skill_id = $request->skill;
        $detailJasa->pegawai_id = $request->pegawai;
        $detailJasa->level = $level;
        $detailJasa->rincian_jasa_id = $request->rincian_jasa_id;
        $data1 = $detailJasa->save();
        if($data1){
            toast('Freelancer added successfully!', 'success');
            return redirect(route('detail-subservice', $request->rincian_jasa_id));
        }
    }
}
