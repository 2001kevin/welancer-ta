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
            $sub_grups = MappingSubGrup::orderBy('created_at', 'desc')->get();
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
            return view('dashboard.project.project', compact('projects', 'material', 'status_transaksi'));
        }

    }

    public function detailProject($id){
        $project = Project::where('id', $id)->first();
        $detail_transaksi_id = $project->subGrup->detail_transaksi_id;
        $services = DetailTransaksiJasa::where('detail_transaksi_id', $detail_transaksi_id)->get();
        return view('dashboard.project.detail', compact('project', 'services'));
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
}
