<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\DetailPaketController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PaketJasaController;
use App\Http\Controllers\RincianJasaController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TerminPembayaranController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\RincianJasa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('login-user', [Authentication::class, 'indexLoginUser'])->name('login');
Route::get('login-admin', [Authentication::class, 'indexLoginAdmin'])->name('login-admin');
Route::post('loginAdmin', [Authentication::class, 'loginAdmin'])->name('loginAdmin');
Route::post('login', [Authentication::class, 'loginUser'])->name('loginUser');
Route::get('logout', [Authentication::class, 'logout'])->name('logout');
Route::get('register', [Authentication::class, 'register'])->name('register');
Route::post('register', [Authentication::class, 'register_action'])->name('register-action');

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('dashboard/kategori', [KategoriController::class, 'kategori'])->name('kategori');
Route::get('kategori/create', [KategoriController::class, 'createkategori'])->name('create-kategori');
Route::post('kategori/store', [KategoriController::class, 'storekategori'])->name('store-kategori');
Route::post('kategori/update/{id}', [KategoriController::class, 'updatekategori'])->name('update-kategori');
Route::post('kategori/delete/{id}', [KategoriController::class, 'deletekategori'])->name('delete-kategori');

Route::get('dashboard/paketJasa', [PaketJasaController::class, 'paketJasa'])->name('paketJasa');
Route::get('paketJasa/create', [PaketJasaController::class, 'createpaketJasa'])->name('create-paketJasa');
Route::post('paketJasa/store', [PaketJasaController::class, 'storepaketJasa'])->name('store-paketJasa');
Route::post('paketJasa/update/{id}', [PaketJasaController::class, 'updatepaketJasa'])->name('update-paketJasa');
Route::post('paketJasa/delete/{id}', [PaketJasaController::class, 'deletepaketJasa'])->name('delete-paketJasa');

Route::get('dashboard/skill', [SkillController::class, 'skill'])->name('skill');
Route::get('skill/create', [SkillController::class, 'createSkill'])->name('create-skill');
Route::post('skill/store', [SkillController::class, 'storeSkill'])->name('store-skill');
Route::post('skill/update/{id}', [SkillController::class, 'updateSkill'])->name('update-skill');
Route::post('skill/delete/{id}', [SkillController::class, 'deleteSkill'])->name('delete-skill');

Route::get('dashboard/jasa/{id}', [JasaController::class, 'jasa'])->name('jasa');
Route::get('jasa/create', [JasaController::class, 'createJasa'])->name('create-jasa');
Route::post('jasa/store', [JasaController::class, 'storeJasa'])->name('store-jasa');
Route::post('jasa/update/{id}', [JasaController::class, 'updateJasa'])->name('update-jasa');
Route::post('jasa/delete/{id}', [JasaController::class, 'deleteJasa'])->name('delete-jasa');

Route::get('dashboard/rincianJasa', [RincianJasaController::class, 'rincianJasa'])->name('rincian-jasa');
Route::get('rincian/create', [RincianJasaController::class, 'createRincian'])->name('create-rincian');
Route::post('rincian/store', [RincianJasaController::class, 'storeRincian'])->name('store-rincian');
Route::post('rincian/update/{id}', [RincianJasaController::class, 'updateRincian'])->name('update-rincian');
Route::post('rincian/delete/{id}', [RincianJasaController::class, 'deleteRincian'])->name('delete-rincian');
Route::get('get-sub-services/{id}', [RincianJasaController::class, 'getSubServices'])->name('get-sub-service');

Route::get('detail/create', [JasaController::class, 'createDetailJasa'])->name('detail-jasa');
Route::post('detail/store', [JasaController::class, 'storeDetailJasa'])->name('store-detail-jasa');
Route::post('detail/update/{id}', [JasaController::class, 'updateDetailJasa'])->name('update-detail-jasa');
Route::post('detail/delete/{id}', [JasaController::class, 'deleteDetailJasa'])->name('delete-detail-jasa');

Route::get('detail-paket/create', [DetailPaketController::class, 'create'])->name('create-detail-paket');
Route::post('detail-paket/store', [DetailPaketController::class, 'store'])->name('store-detail-paket');
Route::post('detail-paket/update/{id}', [DetailPaketController::class, 'update'])->name('update-detail-paket');
Route::post('detail-paket/delete/{id}', [DetailPaketController::class, 'delete'])->name('delete-detail-paket');

Route::get('transaksi/create', [TransaksiController::class, 'createTransaksi'])->name('create-transaksi');
Route::post('transaksi/store', [TransaksiController::class, 'storeTransaksi'])->name('store-transaksi');
Route::get('transaksi/index', [TransaksiController::class, 'indexTransaksi'])->name('index-transaksi');
Route::post('transaksi/update/{id}', [TransaksiController::class, 'updateTransaksi'])->name('update-transaksi');
Route::get('service/index', [DetailTransaksiController::class, 'indexService'])->name('index-service');

Route::get('transaksi/indexAdmin', [TransaksiController::class, 'indexAdmin'])->name('index-transaksi-admin');
Route::get('service/indexAdmin', [DetailTransaksiController::class, 'indexServiceAdmin'])->name('index-service-admin');

Route::get('dashboard/grup/{id}', [GroupController::class, 'index'])->name('index-grup');
Route::get('grup/create/{id}', [GroupController::class, 'create'])->name('grup-create');
Route::post('grup/store', [GroupController::class, 'store'])->name('grup-store');
Route::get('dashboard/sub-grup/{id}', [GroupController::class, 'subGrup'])->name('index-subGrup');

Route::get('/dashboard/diskusi', [DiskusiController::class, 'index'])->name('index-diskusi');
Route::post('/diskusi/store', [DiskusiController::class, 'store'])->name('store-diskusi');
Route::get('/diskusi/room/{room}', [DiskusiController::class, 'room'])->name('room-diskusi');
Route::get('/diskusi/get/{room}', [DiskusiController::class, 'getChat'])->name('get-diskusi');
Route::post('/diskusi/send', [DiskusiController::class, 'sendChat'])->name('send-diskusi');
Route::post('/diskusi/updateDate/{id}', [DiskusiController::class, 'updateDate'])->name('update-date');
Route::post('/diskusi/comment/{id}', [DiskusiController::class, 'comment'])->name('comment');
Route::post('/diskusi/agree/{id}', [DiskusiController::class, 'accDiscussion'])->name('acc-discussion');

Route::get('payment/index', [TerminPembayaranController::class, 'index'])->name('index-termin');
Route::get('user/payment', [TerminPembayaranController::class, 'userIndex'])->name('user-termin');
Route::get('payment/pay', [TerminPembayaranController::class, 'createTransaction'])->name('pay-termin');
Route::get('payment/success', [TerminPembayaranController::class, 'successTermin'])->name('success-termin');
