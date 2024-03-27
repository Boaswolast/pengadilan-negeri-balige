<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','role:0']], function(){
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/addSertifikatTanahUser', [App\Http\Controllers\AddSertifikatTanahUserController::class, 'index'])->name('addSertifikatUser');
});

Route::group(['middleware' => ['auth','role:1']], function(){
    Route::get('/dukcapil', [App\Http\Controllers\DukcapilController::class, 'index'])->name('dukcapil');
});

Route::group(['middleware' => ['auth','role:2']], function(){
    Route::get('/pengadilan', [App\Http\Controllers\PengadilanController::class, 'index'])->name('pengadilan');
    Route::get('/addSertifikat', [App\Http\Controllers\PengadilanController::class, 'addSertifikat'])->name('addSertifikatPengadilan');
    Route::post('/storeSertifikat', [App\Http\Controllers\PengadilanController::class, 'storeSertifikat'])->name('storeSertifikat');
    Route::put('/updateSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'update'])->name('updateSertifikat');
    Route::get('/editSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'edit'])->name('editSertifikat');
    Route::get('/detailSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'show'])->name('detailSertifikat');
    Route::delete('/deletedSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'destroy'])->name('deletedSertifikat');

    //coba coba
    Route::get('/temporaryData', [App\Http\Controllers\PengadilanController::class, 'temporary'])->name('temporaryData');
    Route::get('/showTemporaryData', [App\Http\Controllers\PengadilanController::class, 'showTemporaryData'])->name('showTemporaryData');
    Route::post('/addTemporaryData', [App\Http\Controllers\PengadilanController::class, 'addTemporaryData'])->name('addTemporaryData');
    Route::post('/saveTemporaryData', [App\Http\Controllers\PengadilanController::class, 'saveData'])->name('saveTemporaryData');

    // peristiwa penting
    Route::get('/peristiwa', [App\Http\Controllers\PeristiwaController::class, 'index'])->name('peristiwa');
});

Route::group(['middleware' => ['auth','role:3']], function(){
    Route::get('/pertanahan', [App\Http\Controllers\PertanahanController::class, 'index'])->name('pertanahan');
    Route::get('/kasusPertanahan', [App\Http\Controllers\KasusPertanahanController::class, 'index'])->name('kasusPertanahan');
});