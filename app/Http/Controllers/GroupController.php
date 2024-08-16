<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\DetailTransaksiJasa;
use App\Models\Diskusi;
use App\Models\MappingGrup;
use App\Models\MappingSubGrup;
use App\Models\Pegawai;
use App\Models\transaksi;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index($id){
        $transaksi = transaksi::find($id);
        $grups = MappingGrup::where('transaksi_id', $id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.grup.index', compact('grups', 'transaksi'));
    }

    public function create($id){
        $pegawais = Pegawai::all();
        $transaksi = transaksi::find($id);
        $idTransaksi = $transaksi->id;
        $detailTransaksis = DetailTransaksi::where('transaksi_id', $idTransaksi)
                ->with(['detailTransaksiJasas.rincianJasa.detailJasa.pegawai', 'jasa'])
                ->get();
        return view('dashboard.grup.create', compact('pegawais', 'transaksi', 'detailTransaksis'));
    }

    public function store(Request $request){

        $transaksi_id = $request->transaksi_id;
        $transaksi = transaksi::find($transaksi_id)->first();
        $grup = new MappingGrup();
        $grup->pegawai_id = $request->pm;
        $grup->transaksi_id = $transaksi_id;
        $grup->nama = $request->name;
        $data1 = $grup->save();

        $sub_names = $request->sub_name;

        foreach($sub_names as $index => $sub_name){
            $sub_grup = new MappingSubGrup();
            $sub_grup->transaksi_id = $transaksi_id;
            $sub_grup->mapping_grup_id = $grup->id;
            $sub_grup->detail_transaksi_id = $request->detail_transaksi_id;
            $sub_grup->nama = $sub_name;
            $sub_grup->pegawai_id = $request->pegawai[$index];
            $data2 = $sub_grup->save();
        }

        if($data1 && $data2){
            // Generate 4 Diskusi setelah berhasil menyimpan MappingGrup dan MappingSubGrup
            $diskusiTypes = [
                'Price Discussion',
                'Project Discussion Phase 1',
                'Project Discussion Phase 2',
                'Project Discussion Phase 3',
            ];

            foreach ($diskusiTypes as $type) {
                $diskusi = new Diskusi();
                $diskusi->transaksi_id = $transaksi_id;
                $diskusi->mapping_grup_id = $grup->id;
                $diskusi->tipe_diskusi = $type;
                $diskusi->status = 'not fixed';
                $diskusi->user_id = $transaksi->user_id;
                $diskusi->save();
            }
            toast('Group Successfully Created!','success');
            return redirect(route('index-grup', $transaksi_id));
        }
    }

    public function subGrup($id){
        $subGrups = MappingSubGrup::where('mapping_grup_id', $id)->get();
        return view('dashboard.grup.subGrup', compact('subGrups'));
    }
}
