<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Jasa;
use App\Models\Kategori;
use App\Models\transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function indexTransaksi(){
        $user_id = auth()->user()->id;
        $transaksis = transaksi::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('dashboard.transaksi.index', compact('transaksis'));
    }

    public function indexAdmin(){
        $transaksis = transaksi::all();
        return view('dashboard.transaksi.index', compact('transaksis'));
    }

    public function createTransaksi(){
        $jasas = Jasa::all();
        $kategoris = Kategori::all();
        return view('dashboard.transaksi.create', compact('jasas', 'kategoris'));
    }

    public function storeTransaksi(Request $request){
        // $minPrice = $request->input('minPrice');
        // $maxPrice = $request->input('maxPrice');
        // $combinedPrice = $minPrice . ' - ' . $maxPrice;
        $totalValue = $request->input('totalValue');

        $status = 'On Negotiations';
        // return $request->all();
        $transaksi = new transaksi();
        $transaksi->user_id = auth()->user()->id;
        $transaksi->pegawai_id = null;
        $transaksi->nama = $request->name_project;
        $transaksi->kategori_id = $request->kategori;
        $transaksi->jumlah_harga = $totalValue;
        $transaksi->status = $status;
        $data1 = $transaksi->save();

        // Dapatkan nilai dari formulir
        $selectedServiceId = $request->input('service');

        $jasas = Jasa::find($selectedServiceId);
        // $string = typeOf($jasa);
        // // Ambil data jasa berdasarkan ID yang dipilih
        // return $request->service;
        foreach($jasas as $jasa){
            $detailTransaksi = new DetailTransaksi();
            $detailTransaksi->transaksi_id = $transaksi->id;
            $detailTransaksi->jasa_id = $jasa->id;
            $detailTransaksi->qty = '0';
            $detailTransaksi->Minharga_total = $jasa->min_price;
            $detailTransaksi->Maxharga_total = $jasa->max_price;
            $detailTransaksi->status = $status;
            $detailTransaksi->save();
            // if($jasa){
            // }
        }
        // $service_tambahans = $request->input('service', []);
        // foreach ($service_tambahans as $service){
        //     if($service !== '' && $service !== NULL){
        //         $detailTransaksi = new DetailTransaksi();
        //         $detailTransaksi->transaksi_id = $transaksi->id;
        //         $detailTransaksi->jasa_id = $request->service;
        //         $detailTransaksi->qty = '0';
        //         $detailTransaksi->Minharga_total = $jasa->min_price;
        //         $detailTransaksi->Maxharga_total = $jasa->max_price;
        //         $detailTransaksi->status = $status;
        //         $detailTransaksi->save();
        //     }
        // }

        if($data1){
            toast('Transaction Created Successfully','success');
            return redirect(route('index-transaksi'));
        }
        return view('dashboard.transaksi.index')->with('gagal', 'Menambah Paket Layanan');



    }
}
