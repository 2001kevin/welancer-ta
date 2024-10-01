<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\transaksi;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Jasa;
use App\Models\MappingSubProject;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function adminReport(){
        $currentYear = Carbon::now()->year;
        // Revenue (total keuntungan_bersih dari tabel transaksis pada tahun ini)
        $revenue = transaksi::whereYear('created_at', $currentYear)->sum('keuntungan_bersih');

        // Jumlah user dari tabel users
        $jumlahUser = User::count();

        // Jumlah project dari tabel transaksis pada tahun ini
        $jumlahProject = transaksi::whereYear('created_at', $currentYear)->count();

        // Jumlah freelancer dari tabel pegawais yang mempunyai role freelancer
        $jumlahFreelancer = Pegawai::where('role', 'freelancer')->count();

        $pegawais = Pegawai::where('role', 'freelancer')->orderBy('created_at', 'desc')->get();
        // Jumlah jasa dari tabel jasas
        $jumlahJasa = Jasa::count();
        $currency = Currency::pluck('currency');

        // Ambil revenue berdasarkan bulan pada tahun ini
        $revenues = transaksi::selectRaw('MONTH(created_at) as month, SUM(keuntungan_bersih) as total')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Buat array label untuk bulan dan array data untuk revenue
        $months = [];
        $revenuesData = [];

        foreach (range(1, 12) as $month) {
            $months[] = Carbon::createFromDate(null, $month, 1)->format('F'); // Nama bulan
            $revenuesData[] = $revenues->firstWhere('month', $month)->total ?? 0; // Jika tidak ada revenue di bulan tersebut, default ke 0
        }
        return view('dashboard.report.adminReport', compact('months', 'revenuesData', 'revenue', 'jumlahUser', 'jumlahProject', 'jumlahFreelancer', 'jumlahJasa', 'currency', 'pegawais'));
    }

    public function detailFreelancer($id){
        $currency = Currency::pluck('currency');
        $currentYear = Carbon::now()->year;
        $jumlahProject = MappingSubProject::where('pegawai_id', $id)->whereYear('created_at', $currentYear)->count();
        $revenue = MappingSubProject::whereYear('created_at', $currentYear)->where('pegawai_id', $id)->sum('gaji');
        $revenues = MappingSubProject::selectRaw('MONTH(created_at) as month, SUM(gaji) as total')
        ->whereYear('created_at', $currentYear)
        ->where('pegawai_id', $id)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $pegawai = Pegawai::find($id);

        $subProjects = MappingSubProject::where('pegawai_id', $id)->whereYear('created_at', $currentYear)->get();
        // Buat array label untuk bulan dan array data untuk revenue
        $months = [];
        $revenuesData = [];

        foreach (range(1, 12) as $month) {
            $months[] = Carbon::createFromDate(null, $month, 1)->format('F'); // Nama bulan
            $revenuesData[] = $revenues->firstWhere('month', $month)->total ?? 0; // Jika tidak ada revenue di bulan tersebut, default ke 0
        }

        return view('dashboard.report.detailReport', compact('revenue', 'revenuesData', 'months', 'currency', 'jumlahProject', 'subProjects', 'pegawai'));
    }

    public function reportFreelancer(){
        $id = auth()->guard('pegawai')->id();
        $currency = Currency::pluck('currency');
        $currentYear = Carbon::now()->year;
        $jumlahProject = MappingSubProject::where('pegawai_id', $id)->whereYear('created_at', $currentYear)->count();
        $revenue = MappingSubProject::whereYear('created_at', $currentYear)->where('pegawai_id', $id)->sum('gaji');
        $revenues = MappingSubProject::selectRaw('MONTH(created_at) as month, SUM(gaji) as total')
        ->whereYear('created_at', $currentYear)
        ->where('pegawai_id', $id)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $pegawai = Pegawai::find($id);

        $subProjects = MappingSubProject::where('pegawai_id', $id)->whereYear('created_at', $currentYear)->get();
        // Buat array label untuk bulan dan array data untuk revenue
        $months = [];
        $revenuesData = [];

        foreach (range(1, 12) as $month) {
            $months[] = Carbon::createFromDate(null, $month, 1)->format('F'); // Nama bulan
            $revenuesData[] = $revenues->firstWhere('month', $month)->total ?? 0; // Jika tidak ada revenue di bulan tersebut, default ke 0
        }

        return view('dashboard.report.freelancer', compact('revenue', 'revenuesData', 'months', 'currency', 'jumlahProject', 'subProjects', 'pegawai'));
    }
}
