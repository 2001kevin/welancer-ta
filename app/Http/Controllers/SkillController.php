<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\skill;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    public function skill(){

        $skills = skill::all();
        return view('dashboard.skill.index', compact('skills'));
    }

    public function createSkill(){
        return view('dashboard.skill.create');
    }

    public function storeSkill(Request $request){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        skill::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        toast('Data Skill Sukses Dibuat!','success');
        return redirect(route('skill'));
    }

    public function updateSkill(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        skill::where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        toast('Data Skill Sukses Diedit!','success');
        return redirect(route('skill'));
    }

    public function deleteSkill($id){
        DB::table('skills')->where('id', $id)->delete();
        toast('Data Skill Sukses Dihapus!','success');
        return redirect(route('skill'));
    }
}
