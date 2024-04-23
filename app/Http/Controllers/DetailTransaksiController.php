<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function indexService(){
        $user_id = auth()->user()->id;
        $services = Transaksi::with('detail_transaksi')->where('user_id', $user_id)->get();


        return view('dashboard.detail_transaksi.index', compact('services'));
    }

    public function indexServiceAdmin(){
        $services = Transaksi::with('detail_transaksi')->get();
        return view('dashboard.detail_transaksi.index', compact('services'));
    }
}
