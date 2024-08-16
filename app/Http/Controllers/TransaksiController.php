<?php

namespace App\Http\Controllers;

use App\Events\FixPricesUpdated;
use App\Models\DetailTransaksi;
use App\Models\DetailTransaksiJasa;
use App\Models\Jasa;
use App\Models\Kategori;
use App\Models\Material;
use App\Models\RincianJasa;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function indexTransaksi(){
        $user_id = auth()->user()->id;
        $transaksis = transaksi::where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();

        return view('dashboard.transaksi.index', compact('transaksis'));
    }

    public function indexAdmin(){
        $transaksis = transaksi::orderBy('created_at', 'desc')->get();
        return view('dashboard.transaksi.index', compact('transaksis'));
    }

    public function createTransaksi(){
        $jasas = Jasa::whereHas('rincian_jasa')->get();
        $sub_services = RincianJasa::all();
        $kategoris = Kategori::all();
        return view('dashboard.transaksi.create', compact('jasas', 'kategoris'));
    }

    public function storeTransaksi(Request $request)
    {
        $totalValue = $request->input('total_value');
        $valueMax = $request->input('valueMax');
        $status = 'On Negotiations';

        $transaksi = new Transaksi();
        $transaksi->user_id = auth()->user()->id;
        $transaksi->pegawai_id = null;
        $transaksi->nama = $request->name_project;
        $transaksi->kategori_id = $request->kategori;
        $transaksi->jumlah_harga = $totalValue;
        $transaksi->status = $status;
        $data1 = $transaksi->save();

        if (!$data1) {
            toast('Failed to create transaction', 'error');
            return back()->withErrors(['error' => 'Failed to create transaction']);
        }

        $selectedServiceId = $request->input('service');
        $selectedSubServiceId = $request->input('sub_service', []);

        if (!$selectedServiceId) {
            toast('Service not selected', 'error');
            return back()->withErrors(['error' => 'Service not selected']);
        }

        $jasas = Jasa::whereIn('id', $selectedServiceId)->get();

        foreach ($jasas as $index => $jasa) {
            $detailTransaksi = new DetailTransaksi();
            $detailTransaksi->transaksi_id = $transaksi->id;
            $detailTransaksi->jasa_id = $jasa->id;
            $detailTransaksi->qty = 0;
            $detailTransaksi->Minharga_total = $jasa->min_price;
            $detailTransaksi->Maxharga_total = $valueMax;
            $detailTransaksi->status = $status;
            $detailTransaksi->save();

            $sub_jasas = RincianJasa::whereIn('id', $selectedSubServiceId)
                        ->where('jasa_id', $jasa->id)
                        ->get();
            $id_subJasa = $sub_jasas->pluck('id');
            $subServicePrices = $request->input('subService_price');
            $quantities = $request->input('quantity2');
            // dd($subServicePrices, $quantities['sub-service-option-1'], $id_subJasa);

            foreach ($sub_jasas as $idx => $sub_jasa) {
                // Cek apakah data untuk sub-jasa ini ada dalam array harga dan kuantitas
                    $detailTransaksiJasa = new DetailTransaksiJasa();
                    $detailTransaksiJasa->detail_transaksi_id = $detailTransaksi->id; // ID transaksi yang sesuai
                    $detailTransaksiJasa->detail_jasa_id = $sub_jasa->id;
                    $detailTransaksiJasa->qty = $quantities['sub-service-option-' . $sub_jasa->id];
                    $detailTransaksiJasa->harga = $subServicePrices['sub-service-option-' . $sub_jasa->id];
                    $detailTransaksiJasa->save();
                }

            $material = new Material();
            $material->detail = 'link material';
            $material->link = $request->material_links[$index];
            $material->detail_transaksi_id = $detailTransaksi->id;
            $material->save();

        }

        toast('Transaction Created Successfully', 'success');
        return redirect(route('index-transaksi'));
    }


    public function updateTransaksi(Request $request, $id){
        $transaksi = transaksi::find($id);
        $transaksi->fix_price = $request->fix_price;
        $transaksi->status = $request->status;
        $transaksi->pegawai_id = auth()->guard('pegawai')->id();
        $success = $transaksi->save();
        $termin = $request->termin;
        $persenTermin = $termin/100;
        if ($success) {
            $transaksi_id = $transaksi->id;

            $detailTransaksis = DetailTransaksi::where('transaksi_id', $transaksi_id)->get();
            foreach ($detailTransaksis as $detailTransaksi) {
                $detailTransaksi->status = $request->status;
                $detailSuccess = $detailTransaksi->save();
                if (!$detailSuccess) {
                    toast('Failed to update detail transaction', 'error');
                    return redirect()->back();
                }
            }

            toast('Transaction Updated Successfully', 'success');
            event(new FixPricesUpdated($transaksi, $persenTermin));
            return redirect()->back();
        } else {
            toast('Failed to update transaction', 'error');
            return redirect()->back();
        }
    }
}
