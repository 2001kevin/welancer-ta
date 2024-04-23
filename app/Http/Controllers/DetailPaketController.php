<?php

namespace App\Http\Controllers;

use App\Models\DetailPaket;
use App\Models\Jasa;
use App\Models\paketJasa;
use Illuminate\Http\Request;

class DetailPaketController extends Controller
{
    public function index(){
        $detailPakets = DetailPaket::all();
        return view('dashboard.jasas.index', compact('detailPakets'));
    }

    public function create(){
        $paketJasas = paketJasa::all();
        $jasas = Jasa::all();

        return view('dashboard.detail_paket.create', compact('paketJasas', 'jasas'));
    }

    public function store(Request $request){
        $request->validate([
            'paket_jasa' => 'required',
            'jasa' => 'required',
        ]);

        DetailPaket::create([
            'paket_jasa_id' => $request->paket_jasa,
            'jasa_id' => $request->jasa,
        ]);
        toast('Data Jasa Sukses Dibuat!','success');
        return redirect(route('jasa'));
    }

    public function update(Request $request, $id){
        DetailPaket::where('id', $id)->update([
            'paket_jasa_id' => $request->paket_jasa,
            'jasa_id' => $request->jasa,
        ]);

        toast('Update Service Package Successfully!','success');
        return redirect(route('jasa'));
    }

    public function delete($id){
        DetailPaket::where('id', $id)->delete();
        toast('Delete Service Package Successfully!','success');
        return redirect(route('jasa'));
    }
}
