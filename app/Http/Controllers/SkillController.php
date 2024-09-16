<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\skill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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

        skill::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);

        toast('Data Skill Sukses Dibuat!','success');
        return redirect(route('skill'));
    }

    public function updateSkill(Request $request, $id){
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

        skill::where('id', $id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);
        toast('Data Skill Sukses Diedit!','success');
        return redirect(route('skill'));
    }

    public function deleteSkill($id){
        // DB::table('skills')->where('id', $id)->delete();
        $skill = Skill::find($id);
        $skill->delete();
        toast('Data Skill Sukses Dihapus!','success');
        return redirect(route('skill'));
    }
}
