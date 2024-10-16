<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksiJasa;
use App\Models\MappingGrup;
use App\Models\MappingSubGrup;
use App\Models\Material;
use App\Models\Project;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(){
        if(auth()->check()){
            $user_id = auth()->user()->id;
            $transaksi_id = transaksi::where('user_id', $user_id)->pluck('id');
            $sub_grups = MappingSubGrup::whereIn('transaksi_id', $transaksi_id)->orderBy('created_at', 'desc')->get();
            return view('dashboard.project.index', compact('sub_grups'));
        }else{
            $pegawai_id = auth()->guard('pegawai')->id(); // Ambil ID pegawai yang sedang login
            $sub_grups = MappingSubGrup::whereHas('subProject', function ($query) use ($pegawai_id) {
                $query->where('pegawai_id', $pegawai_id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
            return view('dashboard.project.index', compact('sub_grups'));
        }
    }

    public function project($id){
        if(auth()->check()){
            $sub_grup = MappingSubGrup::where('id', $id)->first();
            $transaksi_id = $sub_grup->transaksi_id;
            $transaksi = transaksi::find($transaksi_id);
            $status_transaksi = $transaksi->status;
            $detail_transaksi_id = $sub_grup->detail_transaksi_id;
            $material = Material::where('detail_transaksi_id', $detail_transaksi_id)->first();
            $projects = Project::where('sub_grup_id', $id)->orderBy('created_at', 'desc')->get();
            return view('dashboard.project.project', compact('projects', 'material', 'status_transaksi'));
        }else{
            $sub_grup = MappingSubGrup::where('id', $id)->first();
            $transaksi_id = $sub_grup->transaksi_id;
            $transaksi = transaksi::find($transaksi_id);
            $status_transaksi = $transaksi->status;
            $detail_transaksi_id = $sub_grup->detail_transaksi_id;
            $material = Material::where('detail_transaksi_id', $detail_transaksi_id)->first();
            $projects = Project::where('sub_grup_id', $id)->orderBy('created_at', 'desc')->get();
            $serviceLead_id = $sub_grup->pegawai_id;

            return view('dashboard.project.project', compact('projects', 'material', 'status_transaksi', 'serviceLead_id'));
        }

    }

    public function detailProject($id){
        $project = Project::where('id', $id)->first();
        $detail_transaksi_id = $project->subGrup->detail_transaksi_id;
        $services = DetailTransaksiJasa::where('detail_transaksi_id', $detail_transaksi_id)->get();
        $sub_grup = MappingSubGrup::find($project->sub_grup_id);
        $serviceLead_id = $sub_grup->pegawai_id;
        return view('dashboard.project.detail', compact('project', 'services', 'serviceLead_id'));
    }

    public function updateLink(Request $request, $id){
        $project = Project::find($id);
        $project->link = $request->link;
        $success = $project->save();
        if($success){
            toast('Link Created Successfully', 'success');
            return redirect()->back();
        }else{
            toast('Link Created Failed', 'error');
            return redirect()->back();
        }
    }

    public function updateStatus(Request $request, $id){
        $project = Project::find($id);
        $project->status = $request->status;
        $data1 = $project->save();

        if($data1){
            toast('Project Updated Successfully', 'success');
            return redirect()->back();
        }
    }
}
