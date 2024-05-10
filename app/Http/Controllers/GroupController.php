<?php

namespace App\Http\Controllers;

use App\Models\MappingGrup;
use App\Models\Pegawai;
use App\Models\transaksi;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index($id){
        $transaksi = transaksi::find($id);
        $grups = MappingGrup::where('transaksi_id', $id)->get();
        return view('dashboard.grup.index', compact('grups', 'transaksi'));
    }

    public function create($id){
        $pegawais = Pegawai::all();
        $transaksi = transaksi::find($id);

        return view('dashboard.grup.create', compact('pegawais', 'transaksi'));
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
