<?php

namespace App\Http\Controllers;

use App\Models\DetailJasa;
use App\Models\DetailTransaksi;
use App\Models\DetailTransaksiJasa;
use App\Models\Diskusi;
use App\Models\MappingGrup;
use App\Models\MappingSubGrup;
use App\Models\MappingSubProject;
use App\Models\Pegawai;
use App\Models\Project;
use App\Models\RincianJasa;
use App\Models\skill;
use App\Models\transaksi;
use Illuminate\Http\Request;
use App\Events\TransactionCreated;

class GroupController extends Controller
{
    public function index($id)
    {
        $transaksi = transaksi::find($id);
        $grups = MappingGrup::where('transaksi_id', $id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.grup.index', compact('grups', 'transaksi'));
    }

    public function create($id)
    {
        $pegawais = Pegawai::all();
        $skill_pm = skill::where('nama', 'Project Manager')->first();
        $skill_id = $skill_pm->id;
        $pm = DetailJasa::where('skill_id', $skill_id)->get();
        $transaksi = transaksi::find($id);
        $idTransaksi = $transaksi->id;
        $detailTransaksis = DetailTransaksi::where('transaksi_id', $idTransaksi)
            ->with(['detailTransaksiJasas.rincianJasa.detailJasa.pegawai', 'jasa'])
            ->get();
        return view('dashboard.grup.create', compact('pegawais', 'transaksi', 'detailTransaksis', 'pm'));
    }

    public function store(Request $request)
    {
        // return $request;
        $transaksi_id = $request->transaksi_id;
        $transaksi = transaksi::find($transaksi_id);
        $transaksiFix = $transaksi->fix_price;
        if($transaksiFix == null){
            $grup = new MappingGrup();
            $grup->pegawai_id = $request->pm;
            $grup->transaksi_id = $transaksi_id;
            $grup->nama = $request->name;
            $data1 = $grup->save();
            $sub_names = $request->sub_name;

            foreach ($sub_names as $index => $sub_name) {
                $sub_grup = new MappingSubGrup();
                $sub_grup->transaksi_id = $transaksi_id;
                $sub_grup->mapping_grup_id = $grup->id;
                $sub_grup->detail_transaksi_id = $request->detail_transaksi_id[$index];
                $sub_grup->nama = $sub_name;
                $sub_grup->pegawai_id = $request->pegawai[$index];
                $data2 = $sub_grup->save();

                $detail_transaksi_jasas = $request['detail_transaksi_jasa_id_' . $sub_grup->detail_transaksi_id];
                foreach ($detail_transaksi_jasas as $index2 => $detail_transaksi_jasa) {
                    $detail_tjs = DetailTransaksiJasa::find($detail_transaksi_jasa);
                    $rincian_jasa_id = $detail_tjs->detail_jasa_id;

                    $pegawai_transaksi_jasas = $request['pegawai_transaksi_jasa_' . $detail_transaksi_jasa];
                    foreach ($pegawai_transaksi_jasas as $index3 => $pegawai_transaksi_jasa) {
                        $sub_project = new MappingSubProject();
                        $sub_project->mapping_sub_grup_id = $sub_grup->id;
                        $sub_project->rincian_jasa_id = $rincian_jasa_id;
                        $sub_project->pegawai_id = $pegawai_transaksi_jasa;
                        $detail_jasa = DetailJasa::where('pegawai_id', $pegawai_transaksi_jasa)
                            ->where('rincian_jasa_id', $rincian_jasa_id)
                            ->first();
                        $level = $detail_jasa->level;
                        if ($level == 'beginner') {
                            $sub_project->presentasi_gaji = 40;
                        } elseif ($level == 'middle') {
                            $sub_project->presentasi_gaji = 60;
                        } else {
                            $sub_project->presentasi_gaji = 100;
                        }
                        $sub_project->save();
                    }
                }
            }

            if ($data1 && $data2) {
                $diskusi = new Diskusi();
                $diskusi->transaksi_id = $transaksi_id;
                $diskusi->mapping_grup_id = $grup->id;
                $diskusi->tipe_diskusi = 'Price Discussion';
                $diskusi->status = 'not fixed';
                $diskusi->user_id = $transaksi->user_id;
                $diskusi->save();

                $rincian = $transaksi->rincian;
                foreach($rincian as $key => $rin){
                    $project = new Project();
                    $project->sub_grup_id = $sub_grup->id;
                    $project->nama = 'Project Phase' . $key+1;
                    $project->save();
                }

                toast('Group Successfully Created!', 'success');
                return redirect(route('index-grup', $transaksi_id));
            }
        }else{
            $grup = new MappingGrup();
            $grup->pegawai_id = $request->pm;
            $grup->transaksi_id = $transaksi_id;
            $grup->nama = $request->name;
            $data1 = $grup->save();
            $sub_names = $request->sub_name;

            foreach ($sub_names as $index => $sub_name) {
                $sub_grup = new MappingSubGrup();
                $sub_grup->transaksi_id = $transaksi_id;
                $sub_grup->mapping_grup_id = $grup->id;
                $sub_grup->detail_transaksi_id = $request->detail_transaksi_id[$index];
                $sub_grup->nama = $sub_name;
                $sub_grup->pegawai_id = $request->pegawai[$index];
                $data2 = $sub_grup->save();

                $detail_transaksi_jasas = $request['detail_transaksi_jasa_id_' . $sub_grup->detail_transaksi_id];
                foreach ($detail_transaksi_jasas as $index2 => $detail_transaksi_jasa) {
                    $detail_tjs = DetailTransaksiJasa::find($detail_transaksi_jasa);
                    $rincian_jasa_id = $detail_tjs->detail_jasa_id;

                    $pegawai_transaksi_jasas = $request['pegawai_transaksi_jasa_' . $detail_transaksi_jasa];
                    foreach ($pegawai_transaksi_jasas as $index3 => $pegawai_transaksi_jasa) {
                        $sub_project = new MappingSubProject();
                        $sub_project->mapping_sub_grup_id = $sub_grup->id;
                        $sub_project->rincian_jasa_id = $rincian_jasa_id;
                        $sub_project->pegawai_id = $pegawai_transaksi_jasa;
                        $detail_jasa = DetailJasa::where('pegawai_id', $pegawai_transaksi_jasa)
                                        ->where('rincian_jasa_id', $rincian_jasa_id)
                                        ->first();
                        $level = $detail_jasa->level;
                        if($level == 'beginner'){
                            $sub_project->presentasi_gaji = 40;
                        }elseif($level == 'middle'){
                            $sub_project->presentasi_gaji = 60;
                        }else{
                            $sub_project->presentasi_gaji = 100;
                        }
                        $sub_project->save();
                    }
                }
            }

            if ($data1 && $data2) {
                event(new TransactionCreated($transaksi));
                $rincian = $transaksi->rincian;
                foreach ($rincian as $key => $rin) {
                    $project = new Project();
                    $project->sub_grup_id = $sub_grup->id;
                    $project->nama = 'Project Phase ' . $key+1;
                    $project->save();
                }
                toast('Group Successfully Created!', 'success');
                return redirect(route('index-grup', $transaksi_id));
            }
        }
    }

    public function subGrup($id)
    {
        $subGrups = MappingSubGrup::where('mapping_grup_id', $id)->get();
        return view('dashboard.grup.subGrup', compact('subGrups'));
    }
}
