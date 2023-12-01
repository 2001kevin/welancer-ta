<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PaketJasaController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('login-user', [Authentication::class, 'indexLoginUser'])->name('login-user');
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

Route::get('dashboard/jasa', [JasaController::class, 'jasa'])->name('jasa');
Route::get('jasa/create', [JasaController::class, 'createJasa'])->name('create-jasa');
Route::post('jasa/store', [JasaController::class, 'storeJasa'])->name('store-jasa');
Route::post('jasa/update/{id}', [JasaController::class, 'updateJasa'])->name('update-jasa');
Route::post('jasa/delete/{id}', [JasaController::class, 'deleteJasa'])->name('delete-jasa');
