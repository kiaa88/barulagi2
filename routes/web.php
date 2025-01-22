<?php

use App\Http\Controllers\Auth\LoginController;
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
        route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });


// Auth Admin
route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');
route::post('admin/login', [LoginController::class, 'login'])->name('login');
