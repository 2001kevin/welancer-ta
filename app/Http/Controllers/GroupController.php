<?php

namespace App\Http\Controllers;

use App\Models\MappingGrup;
use App\Models\Pegawai;
use App\Models\transaksi;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(){
        $grups = MappingGrup::all();
        return view('dashboard.grup.index', compact('grups'));
    }

    public function create(){
        $pegawais = Pegawai::all();
        $transaksis = transaksi::all();

        return view('dashboard.grup.create', compact('pegawais', 'transaksis'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'pegawai' => 'required',
            'transaksi' => 'required',
        ]);

        MappingGrup::create([
            'nama' => $request->nama,
            'pegawai_id' => $request->pegawai,
            'transaksi_id' => $request->transaksi,
        ]);
        toast('Group Successfully Created!','success');
        return redirect(route('index-grup'));
    }
}
