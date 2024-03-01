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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','role:0']], function(){
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
});

Route::group(['middleware' => ['auth','role:1']], function(){
    Route::get('/dukcapil', [App\Http\Controllers\DukcapilController::class, 'index'])->name('dukcapil');
});

Route::group(['middleware' => ['auth','role:2']], function(){
    Route::get('/pengadilan', [App\Http\Controllers\PengadilanController::class, 'index'])->name('pengadilan');
});

Route::group(['middleware' => ['auth','role:3']], function(){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
});