<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiSkill;
use App\Models\skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index(){
        $pegawais = Pegawai::orderBy('created_at', 'desc')->where('role', 'freelancer')->get();
        return view('dashboard.pegawai.index', compact('pegawais'));
    }

    public function create(){
        $skills = skill::all();
        return view('dashboard.pegawai.create', compact('skills'));
    }

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|string|max:255',
                'hp' => 'required|numeric',
                'alamat' => 'required',
                'skill' => 'required',
                'level' => 'required',
                'email' => 'required|email|unique:pegawais,email|max:255',
                'password' => [
                    'required',
                    'string',
                    'min:6',              // minimal 8 karakter
                    'confirmed',          // harus cocok dengan password_confirmation
                ],
            ],
            [
                'nama.required' => 'Name required',
                'nama.string' => 'Name must be a text',
                'nama.max' => 'Name cannot more than 255 character',
                'hp.required' => 'no handphone required',
                'skill.required' => 'Skill data required',
                'level.required' => 'Level data required',
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

        $pegawai = new Pegawai();
        $pegawai->name = $request->nama;
        $pegawai->alamat = $request->alamat;
        $pegawai->hp = $request->hp;
        $pegawai->email = $request->email;
        $pegawai->password = Hash::make($request->password);
        $pegawai->role = 'freelancer';
        $data1 = $pegawai->save();

        $pegawaiSkill = new PegawaiSkill();
        $pegawaiSkill->pegawai_id = $pegawai->id;
        $pegawaiSkill->skill_id = $request->skill;
        $pegawaiSkill->level = $request->level;
        $data2 = $pegawaiSkill->save();

        if($data1 && $data2){
            toast('Frellancer Data Successfully Created!', 'success');
            return redirect(route('index-pegawai'));
        }
    }

    public function getPegawaisBySkill($skillId)
    {
        // Query untuk mendapatkan pegawai berdasarkan skill
        $pegawais = Pegawai::whereHas('skills', function ($query) use ($skillId) {
            $query->where('skill_id', $skillId);
        })->get();

        // Return response dalam bentuk JSON
        return response()->json($pegawais);
    }

    public function detailSkill($id){
        $pegawaiSkills = PegawaiSkill::where('pegawai_id', $id)->get();
        return view('dashboard.pegawai.detailSkill', compact('pegawaiSkills'));
    }
}
