<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;


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
    return view('User.homeUser');
    // return view('auth.login');
});

Auth::routes();

Route::get('/homeUser', [App\Http\Controllers\UserController::class, 'homeUser'])->name('homeUser');

Route::group(['middleware' => ['auth','role:1']], function(){
    //data semetara
    Route::get('/addDataDiriPihak', [App\Http\Controllers\UserController::class, 'addDataDiriPihak'])->name('addDataDiriPihak');
    Route::post('/addTemporaryPeristiwaUser', [App\Http\Controllers\UserController::class, 'addTemporaryPeristiwaUser'])->name('addTemporaryPeristiwaUser');
    Route::get('/showTemporaryPeristiwaUser', [App\Http\Controllers\UserController::class, 'showTemporaryPeristiwaUser'])->name('showTemporaryPeristiwaUser');
    //data real
    Route::get('/get-citiess/{provinsiId}', [App\Http\Controllers\UserController::class, 'getCitiess'])->name('getCitiess');
    Route::get('/get-districtss/{kabupatenId}', [App\Http\Controllers\UserController::class, 'getDistrictss'])->name('getDistrictss');
    Route::get('/get-subdistrictss/{kecamatanId}', [App\Http\Controllers\UserController::class, 'getSubDistrictss'])->name('getSubDistrictss');
    Route::get('/indexUser', [App\Http\Controllers\UserController::class, 'index'])->name('indexUser');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'eksekusi'])->name('user');
    Route::get('/detailDataDiriEksekusi/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('detailDataDiriEksekusi');
    Route::get('/detailAllEksekusi/{id}', [App\Http\Controllers\UserController::class, 'showDataAllEksekusi'])->name('detailAllEksekusi');
    Route::post('/storeEksekusi', [App\Http\Controllers\UserController::class, 'storeEksekusi'])->name('storeEksekusi');
    Route::get('/editDataDiriEksekusi/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editDataDiriEksekusi');
    Route::put('/updateDataDiriEksekusi/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('updateDataDiriEksekusi');
    Route::get('/printResume/{file}', [App\Http\Controllers\UserController::class, 'printResume'])->name('printResume');

    Route::get('/halamanPembayaran/{id}', [App\Http\Controllers\UserController::class, 'halamanPembayaran'])->name('halamanPembayaran');
    Route::post('/pembayaran/{id}', [App\Http\Controllers\UserController::class, 'pembayaran'])->name('pembayaran');
    Route::get('/halamanUploadUlangPembayaran/{id}', [App\Http\Controllers\UserController::class, 'halamanUploadUlangPembayaran'])->name('halamanUploadUlangPembayaran');
    Route::post('/uploadUlangPembayaran/{id}', [App\Http\Controllers\UserController::class, 'uploadUlangPembayaran'])->name('uploadUlangPembayaran');
    Route::get('/downloadUser/{file}', [App\Http\Controllers\UserController::class, 'download'])->name('downloadUserFile');
    Route::get('/deletedEksekusiUser/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('deletedEksekusiUser');
    Route::get('/showDeletedEksekusiUser/{id}', [App\Http\Controllers\UserController::class, 'showDeleted'])->name('showDeletedEksekusiUser');
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
    Route::get('/print/{file}', [App\Http\Controllers\PengadilanController::class, 'print'])->name('printFile');
    Route::get('/deletedSertifikat/{id}', [App\Http\Controllers\PengadilanController::class, 'destroy'])->name('deletedSertifikat');
    Route::get('/showDeleted/{id}', [App\Http\Controllers\PengadilanController::class, 'showDeleted'])->name('showDeleted');

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
    Route::get('/peristiwa/delete/{id}', [App\Http\Controllers\PeristiwaController::class, 'destroy'])->name('deletedPeristiwa');
    // pihak peristiwa
    Route::get('/get-cities/{provinsiId}', [App\Http\Controllers\PeristiwaController::class, 'getCities'])->name('getCities');
    Route::get('/get-districts/{kabupatenId}', [App\Http\Controllers\PeristiwaController::class, 'getDistricts'])->name('getDistricts');
    Route::get('/get-subdistricts/{kecamatanId}', [App\Http\Controllers\PeristiwaController::class, 'getSubDistricts'])->name('getSubDistricts');
    Route::get('/addPihakPeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'createPihak'])->name('addPihakPeristiwa');
    Route::post('/storePihakPeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'storePihak'])->name('storePihakPeristiwa');
    Route::get('/editPihakPeristiwa/{idDiri}/{id}', [App\Http\Controllers\PeristiwaController::class, 'editPihak'])->name('editPihakPeristiwa');
    Route::put('/updatePihakPeristiwa/{idDiri}/{id}', [App\Http\Controllers\PeristiwaController::class, 'updatePihak'])->name('updatePihakPeristiwa');
    Route::get('/detailPihakPeristiwa/{id}', [App\Http\Controllers\PeristiwaController::class, 'showPihak'])->name('detailPihakPeristiwa');
    Route::get('/peristiwa/pihak/delete/{id}', [App\Http\Controllers\PeristiwaController::class, 'deletePihak'])->name('deletePihakPeristiwa');
    // amar putusan
    Route::get('/peristiwa/amar-putusan/edit/{id}', [App\Http\Controllers\PeristiwaController::class, 'editAmarPutusan'])->name('editAmarPutusan');
    Route::put('/peristiwa/amar-putusan/update/{id}', [App\Http\Controllers\PeristiwaController::class, 'updateAmarPutusan'])->name('updateAmarPutusan');
    // surat putusan
    Route::get('/peristiwa/surat-putusan/edit/{id}', [App\Http\Controllers\PeristiwaController::class, 'editSuratPutusan'])->name('editSuratPutusan');
    Route::put('/peristiwa/surat-putusan/update/{id}', [App\Http\Controllers\PeristiwaController::class, 'updateSuratPutusan'])->name('updateSuratPutusan');
    // surat pengantar editSuratPengantar
    Route::get('/peristiwa/surat-pengantar/edit/{id}', [App\Http\Controllers\PeristiwaController::class, 'editSuratPengantar'])->name('editSuratPengantar');
    Route::put('/peristiwa/surat-pengantar/update/{id}', [App\Http\Controllers\PeristiwaController::class, 'updateSuratPengantar'])->name('updateSuratPengantar');


    //eksekusi
    Route::get('/eksekusi', [App\Http\Controllers\EksekusiController::class, 'index'])->name('eksekusi');
    Route::get('/detailDataDiriEksekusiAdmin/{id}', [App\Http\Controllers\EksekusiController::class, 'show'])->name('detailDataDiriEksekusiAdmin');
    Route::get('/detailAllEksekusiAdmin/{id}', [App\Http\Controllers\EksekusiController::class, 'showDataAllEksekusi'])->name('detailAllEksekusiAdmin');
    Route::get('/halamanKonfirmasiData/{id}', [App\Http\Controllers\EksekusiController::class, 'halamanKonfirmasiData'])->name('halamanKonfirmasiData');
    Route::post('/konfirmasiData/{id}', [App\Http\Controllers\EksekusiController::class, 'konfirmasiData'])->name('konfirmasiData');
    Route::get('/halamanTolakData/{id}', [App\Http\Controllers\EksekusiController::class, 'halamanTolakData'])->name('halamanTolakData');
    Route::post('/tolakData/{id}', [App\Http\Controllers\EksekusiController::class, 'tolakData'])->name('tolakData');
    Route::get('/halamanAanmaning/{id}', [App\Http\Controllers\EksekusiController::class, 'halamanAanmaning'])->name('halamanAanmaning');
    Route::post('/konfirmasiAanmaning/{id}', [App\Http\Controllers\EksekusiController::class, 'konfirmasiAanmaning'])->name('konfirmasiAanmaning');
    Route::get('/halamanEditAanmaning/{id}', [App\Http\Controllers\EksekusiController::class, 'halamanEditAanmaning'])->name('halamanEditAanmaning');
    Route::post('/konfirmasiEditAanmaning/{id}', [App\Http\Controllers\EksekusiController::class, 'konfirmasiEditAanmaning'])->name('konfirmasiEditAanmaning');
    Route::get('/halamanEksekusi/{id}', [App\Http\Controllers\EksekusiController::class, 'halamanEksekusi'])->name('halamanEksekusi');
    Route::post('/tetapkanEksekusi/{id}', [App\Http\Controllers\EksekusiController::class, 'tetapkanEksekusi'])->name('tetapkanEksekusi');
    Route::get('/halamanEditEksekusi/{id}', [App\Http\Controllers\EksekusiController::class, 'halamanEditEksekusi'])->name('halamanEditEksekusi');
    Route::post('/tetapkanEditEksekusi/{id}', [App\Http\Controllers\EksekusiController::class, 'tetapkanEditEksekusi'])->name('tetapkanEditEksekusi');
   
    Route::get('/terimaPembayaran/{id}', [App\Http\Controllers\EksekusiController::class, 'terimaPembayaran'])->name('terimaPembayaran');
    Route::post('/tolakPembayaran/{id}', [App\Http\Controllers\EksekusiController::class, 'tolakPembayaran'])->name('tolakPembayaran');
    Route::post('/terimaAanmaning/{id}', [App\Http\Controllers\EksekusiController::class, 'terimaAanmaning'])->name('terimaAanmaning');
    Route::post('/tolakAanmaning/{id}', [App\Http\Controllers\EksekusiController::class, 'tolakAanmaning'])->name('tolakAanmaning');
    Route::post('/selesaiKasus/{id}', [App\Http\Controllers\EksekusiController::class, 'selesaiKasus'])->name('selesaiKasus');
    Route::get('/download/{file}', [App\Http\Controllers\EksekusiController::class, 'download'])->name('downloadFile');

    Route::get('/dataUser', [App\Http\Controllers\EksekusiController::class, 'dataUser'])->name('dataUser');
    Route::get('/nonAktif/{id}', [App\Http\Controllers\EksekusiController::class, 'nonAktif'])->name('nonAktif');
    Route::get('/aktif/{id}', [App\Http\Controllers\EksekusiController::class, 'aktif'])->name('aktif');
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
    Route::get('/dukcapil', [App\Http\Controllers\DukcapilController::class, 'dukcapil'])->name('dukcapil');
    Route::get('/detailDukcapil/{id}', [App\Http\Controllers\DukcapilController::class, 'show'])->name('detailDukcapil');
    Route::get('/detailDataDiriDukcapil/{id}', [App\Http\Controllers\DukcapilController::class, 'showDataDiri'])->name('detailDataDiriDukcapil');
    Route::get('/downloadCapil/{file}', [App\Http\Controllers\DukcapilController::class, 'download'])->name('downloadFileCapil');
    Route::get('/printCapil/{file}', [App\Http\Controllers\DukcapilController::class, 'print'])->name('printFileCapil');
    Route::get('/diprosesCapil/{id}', [App\Http\Controllers\DukcapilController::class, 'diprosesCapil'])->name('diprosesCapil');
    Route::get('/konfirmasiCapil/{id}', [App\Http\Controllers\DukcapilController::class, 'konfirmasiCapil'])->name('konfirmasiCapil');
});