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

Route::group(['middleware' => ['auth','role:1']], function(){
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/addDataDiriPihak', [App\Http\Controllers\UserController::class, 'addDataDiriPihak'])->name('addDataDiriPihak');
    Route::get('/homeUser', [App\Http\Controllers\UserController::class, 'homeUser'])->name('homeUser');
});

Route::group(['middleware' => ['auth','role:2']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //data sementara
    Route::get('/addDataDiriSertifikat', [App\Http\Controllers\PengadilanController::class, 'addDataDiri'])->name('addDataDiriSertifikat');
    Route::post('/addTemporarySertifikat', [App\Http\Controllers\PengadilanController::class, 'addTemporarySertifikat'])->name('addTemporarySertifikat');
    Route::get('/showTemporarySertifikat', [App\Http\Controllers\PengadilanController::class, 'showTemporarySertifikat'])->name('showTemporarySertifikat');
    //--end data sementara

    Route::get('/pengadilan', [App\Http\Controllers\PengadilanController::class, 'index'])->name('pengadilan');
    Route::get('/addSertifikat', [App\Http\Controllers\PengadilanController::class, 'addSertifikat'])->name('addSertifikatPengadilan');
    Route::get('/addPihak/{id}', [App\Http\Controllers\PengadilanController::class, 'addPihak'])->name('addPihakPengadilan');
    Route::post('/storePihak/{id}', [App\Http\Controllers\PengadilanController::class, 'storePihak'])->name('storePihakPengadilan');
    Route::post('/storeSertifikat', [App\Http\Controllers\PengadilanController::class, 'storeSertifikat'])->name('storeSertifikat');
    Route::get('/editSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'edit'])->name('editSertifikat');
    Route::put('/updateSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'update'])->name('updateSertifikat');
    Route::get('/editSertifikatPetitum/{id}', [App\Http\Controllers\PengadilanController::class, 'editPetitum'])->name('editSertifikatPetitum');
    Route::put('/updateSertifikatPetitum/{id}', [App\Http\Controllers\PengadilanController::class, 'updatePetitum'])->name('updateSertifikatPetitum');

    Route::get('/detailSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'show'])->name('detailSertifikat');
    Route::get('/detailAllSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'showDataAll'])->name('detailAllSertifikat');
    Route::get('/download/{file}', [App\Http\Controllers\PengadilanController::class, 'download'])->name('downloadFile');
    Route::get('/print/{file}', [App\Http\Controllers\PengadilanController::class, 'print'])->name('printFile');
    Route::delete('/deletedSertifikat/{kode_unik}', [App\Http\Controllers\PengadilanController::class, 'destroy'])->name('deletedSertifikat');
    Route::delete('/showDeleted/{id}', [App\Http\Controllers\PengadilanController::class, 'showDeleted'])->name('showDeleted');

    //coba coba
    // Route::get('/temporaryData', [App\Http\Controllers\PengadilanController::class, 'temporary'])->name('temporaryData');
    // Route::get('/showTemporaryData', [App\Http\Controllers\PengadilanController::class, 'showTemporaryData'])->name('showTemporaryData');
    // Route::post('/addTemporaryData', [App\Http\Controllers\PengadilanController::class, 'addTemporaryData'])->name('addTemporaryData');
    // Route::post('/saveTemporaryData', [App\Http\Controllers\PengadilanController::class, 'saveData'])->name('saveTemporaryData');

    // peristiwa penting
    //data sementara
    Route::get('/addDataDiriPeristiwa', [App\Http\Controllers\PeristiwaController::class, 'addDataDiri'])->name('addDataDiriPeristiwa');
    Route::post('/addTemporaryPeristiwa', [App\Http\Controllers\PeristiwaController::class, 'addTemporaryPeristiwa'])->name('addTemporaryPeristiwa');
    Route::get('/showTemporaryPeristiwa', [App\Http\Controllers\PeristiwaController::class, 'showTemporaryPeristiwa'])->name('showTemporaryPeristiwa');
    //--end data sementara
    Route::get('/peristiwa', [App\Http\Controllers\PeristiwaController::class, 'index'])->name('peristiwa');
    Route::get('/addPeristiwa', [App\Http\Controllers\PeristiwaController::class, 'create'])->name('addPeristiwa');
    Route::post('/storePeristiwa', [App\Http\Controllers\PeristiwaController::class, 'store'])->name('storePeristiwa');
    Route::put('/updatePeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'update'])->name('updatePeristiwa');
    Route::get('/editPeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'edit'])->name('editPeristiwa');
    Route::get('/detailPeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'show'])->name('detailPeristiwa');
    Route::get('/detailAllPeristiwa', [App\Http\Controllers\PeristiwaController::class, 'showDataAll'])->name('detailAllPeristiwa');
    Route::delete('/peristiwa/delete/{id}', [App\Http\Controllers\PeristiwaController::class, 'destroy'])->name('deletedPeristiwa');
    // pihak peristiwa
    Route::get('/get-cities/{provinsiId}', [App\Http\Controllers\PeristiwaController::class, 'getCities'])->name('getCities');
    Route::get('/get-districts/{kabupatenId}', [App\Http\Controllers\PeristiwaController::class, 'getDistricts'])->name('getDistricts');
    Route::get('/get-subdistricts/{kecamatanId}', [App\Http\Controllers\PeristiwaController::class, 'getSubDistricts'])->name('getSubDistricts');
    Route::get('/addPihakPeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'createPihak'])->name('addPihakPeristiwa');
    Route::post('/storePihakPeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'storePihak'])->name('storePihakPeristiwa');
    Route::get('/editPihakPeristiwa/{idDiri}/{id}', [App\Http\Controllers\PeristiwaController::class, 'editPihak'])->name('editPihakPeristiwa');
    Route::put('/updatePihakPeristiwa/{idDiri}/{id}', [App\Http\Controllers\PeristiwaController::class, 'updatePihak'])->name('updatePihakPeristiwa');
    Route::get('/detailPihakPeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'showPihak'])->name('detailPihakPeristiwa');
    Route::put('/peristiwa/pihak/delete/{idDiri}/{id}', [App\Http\Controllers\PeristiwaController::class, 'deletePihak'])->name('deletePihakPeristiwa');
    // amar putusan
    Route::get('/peristiwa/amar-putusan/edit/{id}', [App\Http\Controllers\PeristiwaController::class, 'editAmarPutusan'])->name('editAmarPutusan');
    Route::put('/peristiwa/amar-putusan/update/{id}', [App\Http\Controllers\PeristiwaController::class, 'updateAmarPutusan'])->name('updateAmarPutusan');
    // surat putusan
    Route::get('/peristiwa/surat-putusan/edit/{id}', [App\Http\Controllers\PeristiwaController::class, 'editSuratPutusan'])->name('editSuratPutusan');
    Route::put('/peristiwa/surat-putusan/update/{id}', [App\Http\Controllers\PeristiwaController::class, 'updateSuratPutusan'])->name('updateSuratPutusan');
    // surat pengantar editSuratPengantar
    Route::get('/peristiwa/surat-pengantar/edit/{id}', [App\Http\Controllers\PeristiwaController::class, 'editSuratPengantar'])->name('editSuratPengantar');
    Route::put('/peristiwa/surat-pengantar/update/{id}', [App\Http\Controllers\PeristiwaController::class, 'updateSuratPengantar'])->name('updateSuratPengantar');
});

Route::group(['middleware' => ['auth','role:3']], function(){
    Route::get('/pertanahan', [App\Http\Controllers\PertanahanController::class, 'index'])->name('pertanahan');
    Route::get('/detailAllSertifikatPertanahan/{id}', [App\Http\Controllers\PertanahanController::class, 'showDataAll'])->name('detailAllSertifikatPertanahan');
    Route::get('/detailSertifikatPertanahan/{id}', [App\Http\Controllers\PertanahanController::class, 'show'])->name('detailSertifikatPertanahan');
    Route::get('/uploadBuktiPemblokiran', [App\Http\Controllers\PertanahanController::class, 'buktiBlokir'])->name('uploadBuktiPemblokiran');
    Route::post('/submitBuktiPemblokiran/{id}', [App\Http\Controllers\PertanahanController::class, 'uploadBuktiBlokir'])->name('submitBuktiPemblokiran');
    Route::get('/downloadBPN/{file}', [App\Http\Controllers\PertanahanController::class, 'download'])->name('downloadFileBPN');
    Route::get('/printBPN/{file}', [App\Http\Controllers\PertanahanController::class, 'print'])->name('printFileBPN');
    Route::get('/diproses/{id}', [App\Http\Controllers\PertanahanController::class, 'diproses'])->name('diproses');
});

Route::group(['middleware' => ['auth','role:4']], function(){
    Route::get('/dukcapil', [App\Http\Controllers\DukcapilController::class, 'index'])->name('dukcapil');
});