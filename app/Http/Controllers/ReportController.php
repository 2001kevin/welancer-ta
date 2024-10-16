<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\transaksi;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Jasa;
use App\Models\MappingSubGrup;
use App\Models\MappingSubProject;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function adminReport(Request $request){
        $currentYear = Carbon::now()->year;

        // Ambil nilai start date dan end date dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query dasar untuk transaksi
        $query = transaksi::query();
        $query2 = MappingSubGrup::query();
        $subGrups = MappingSubGrup::all();
        if ($startDate && $endDate) {
            // Filter data berdasarkan range tanggal yang dipilih
            $subGrups = MappingSubGrup::whereBetween('created_at', [$startDate, $endDate])->get();
            $query->whereBetween('created_at', [$startDate, $endDate]);
            $query2->whereBetween('created_at', [$startDate, $endDate]);
        } else {
            // Default, filter berdasarkan tahun berjalan
            $query->whereYear('created_at', $currentYear);
            $query2->whereYear('created_at', $currentYear);
        }

        // Menghitung total revenue
        $revenue = $query->sum('keuntungan_bersih');
        $revenueFreelancer = $query2->sum('keuntungan_bersih');
        // Jumlah user dari tabel users
        $jumlahUser = User::count();

        // Jumlah project dari tabel transaksis pada rentang tanggal atau tahun ini
        $jumlahProject = $query->count();

        // Jumlah freelancer dari tabel pegawais yang mempunyai role freelancer
        $jumlahFreelancer = Pegawai::where('role', 'freelancer')->count();

        // Daftar freelancer, urutkan berdasarkan tanggal pembuatan terbaru
        $pegawais = Pegawai::where('role', 'freelancer')->orderBy('created_at', 'desc')->get();

        // Jumlah jasa dari tabel jasas
        $jumlahJasa = Jasa::count();

        // Ambil data mata uang
        $currency = Currency::pluck('currency');

        // Ambil revenue berdasarkan bulan pada rentang tanggal atau tahun ini
        $revenues = $query->selectRaw('MONTH(created_at) as month, SUM(keuntungan_bersih) as total')
        ->groupBy('month')
        ->orderBy('month')
        ->get();



        // Buat array label untuk bulan dan array data untuk revenue
        $months = [];
        $revenuesData = [];

        foreach (range(1, 12) as $month) {
            $months[] = Carbon::createFromDate(null, $month, 1)->format('F'); // Nama bulan
            $revenuesData[] = $revenues->firstWhere('month', $month)->total ?? 0; // Default 0 jika tidak ada revenue di bulan tersebut
        }

        return view('dashboard.report.adminReport', compact('subGrups', 'revenueFreelancer', 'months', 'revenuesData', 'revenue', 'jumlahUser', 'jumlahProject', 'jumlahFreelancer', 'jumlahJasa', 'currency', 'pegawais'));
    }

    public function detailFreelancer(Request $request, $id){
        $currency = Currency::pluck('currency');
        $currentYear = Carbon::now()->year;
        // Ambil nilai start date dan end date dari request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        $subProjects = MappingSubProject::where('pegawai_id', $id)->get();
        $idSubGrup = MappingSubProject::where('pegawai_id', $id)->pluck('mapping_sub_grup_id');
        $subGrups = MappingSubGrup::find($idSubGrup);

        // Query dasar untuk sub projects
        $query = MappingSubProject::where('pegawai_id', $id)->whereYear('created_at', $currentYear);

        if ($startDate && $endDate) {
            // Filter data berdasarkan range tanggal yang dipilih
            $query->whereBetween('created_at', [$startDate, $endDate]);
            $subGrups = MappingSubGrup::whereBetween('created_at', [$startDate, $endDate])->find($idSubGrup);
        }

        // Lanjutkan dengan logika lain seperti menghitung jumlah project, revenue, dll
        $jumlahProject = $query->count();
        $revenue = $query->sum('gaji');

        // Query untuk revenue per bulan (ini hanya mengambil bulan dan total gaji)
        $revenues = MappingSubProject::selectRaw('MONTH(created_at) as month, SUM(gaji) as total')
        ->where('pegawai_id', $id)
        ->whereYear('created_at', $currentYear)
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            $q->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Ambil semua subProjects sesuai dengan filter tanggal
        $subProjects = $query->get();

        // Menghasilkan data untuk ditampilkan di view
        $pegawai = Pegawai::find($id);

        // Menghasilkan data bulanan
        $months = [];
        $revenuesData = [];
        foreach (range(1, 12) as $month) {
            $months[] = Carbon::createFromDate(null, $month, 1)->format('F'); // Nama bulan
            $revenuesData[] = $revenues->firstWhere('month', $month)->total ?? 0; // Default 0 jika tidak ada revenue di bulan tersebut
        }

        return view('dashboard.report.freelancer', compact('subGrups', 'revenue', 'revenuesData', 'months', 'jumlahProject', 'subProjects', 'pegawai', 'currency'));
    }

    public function reportFreelancer(Request $request){
        $id = auth()->guard('pegawai')->id();
        $currency = Currency::pluck('currency');
        $currentYear = Carbon::now()->year;

        $startDate = $request->input('start');
        $endDate = $request->input('end');

        $subProjects = MappingSubProject::where('pegawai_id', $id)->get();
        $idSubGrup = MappingSubProject::where('pegawai_id', $id)->pluck('mapping_sub_grup_id');
        $subGrups = MappingSubGrup::find($idSubGrup);

        // Filter berdasarkan startDate dan endDate jika ada
        $query = MappingSubProject::where('pegawai_id', $id);

        if ($startDate && $endDate) {
            // Pastikan format tanggal sesuai
            $query->whereBetween('created_at', [$startDate, $endDate]);
            $subGrups = MappingSubGrup::whereBetween('created_at', [$startDate, $endDate])->find($idSubGrup);
        }

        // Mengambil jumlah project dan revenue berdasarkan rentang tanggal
        $jumlahProject = $query->whereYear('created_at', $currentYear)->count();
        $revenue = $query->whereYear('created_at', $currentYear)->sum('gaji');

        // Query untuk revenue bulanan
        $revenues = $query->selectRaw('MONTH(created_at) as month, SUM(gaji) as total')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Query untuk mendapatkan data detail dari sub projects
        $subProjects = MappingSubProject::where('pegawai_id', $id)
        ->whereYear('created_at', $currentYear)
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        })
            ->get(); // Ini akan mengambil seluruh data sub projects sesuai filter

        $pegawai = Pegawai::find($id);

        // Buat array label untuk bulan dan array data untuk revenue
        $months = [];
        $revenuesData = [];

        foreach (range(1, 12) as $month) {
            $months[] = Carbon::createFromDate(null, $month, 1)->format('F'); // Nama bulan
            $revenuesData[] = $revenues->firstWhere('month', $month)->total ?? 0; // Jika tidak ada revenue di bulan tersebut, default ke 0
        }

        return view('dashboard.report.freelancer', compact('subGrups','revenue', 'revenuesData', 'months', 'currency', 'jumlahProject', 'subProjects', 'pegawai'));
    }
}
