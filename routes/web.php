<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\BiodataController;
use App\Http\Controllers\Dashboard\BarangController;
use App\Http\Controllers\Dashboard\KategoriController;
use App\Http\Controllers\PWA\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('dashboard.pages.home.index');
    return redirect()->route('login');
});


route::name('dashboard.')->prefix('dashboard/')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/', function () {
            return view('dashboard.pages.home.index');
        })->name('home');

        route::get('biodata', [BiodataController::class, 'index'])->name('biodata.index');
        route::post('biodata/insert', [BiodataController::class, 'insert'])->name('biodata.insert');
        route::get('biodata/edit/{id}', [BiodataController::class, 'edit'])->name('biodata.edit');
        route::post('biodata/update', [BiodataController::class, 'update'])->name('biodata.update');
        route::delete('biodata/delete/{id}', [BiodataController::class, 'delete'])->name('biodata.delete');
        route::get('biodata/delete/{id}', [BiodataController::class, 'delete'])->name('biodata.delete');

        route::get('barang', [BarangController::class, 'index'])->name('barang.index');
        route::post('barang/insert', [BarangController::class, 'insert'])->name('barang.insert');
        route::get('barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
        route::post('barang/update', [BarangController::class, 'update'])->name('barang.update');
        route::delete('barang/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');

        route::get('kategori', [KategoriController::class, 'index'])->name('kategori.index');
        route::post('kategori/insert', [KategoriController::class, 'insert'])->name('kategori.insert');
        route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        route::post('kategori/update', [KategoriController::class, 'update'])->name('kategori.update');
        route::delete('kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');

        Route::get('barang/export', [BarangController::class, 'export_excel'])->name('barang.export');
        Route::get('kategori/export', [KategoriController::class, 'export_excel'])->name('kategori.export');

        route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });


// Auth Admin
route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');
route::post('admin/login', [LoginController::class, 'login'])->name('login');
