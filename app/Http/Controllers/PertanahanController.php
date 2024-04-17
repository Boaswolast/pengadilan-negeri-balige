<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PertanahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::select('CALL viewAll_sertifikatTanah()');
        $data = collect($data);
        return view('Pertanahan/daftarKasusPertanahan',['data' => $data]);
    }

    public function showDataAll(string $id)
    {
        $dataDiriAll = DB::select('CALL viewAll_sertifikatTanah_dataDiri(?)', array($id));
        $dataGugatan = DB::select('CALL view_sertifikatTanah_gugatan(?)', array($id));
        $dataPetitum = DB::select('CALL view_sertifikatTanah_petitum(?)', array($id));
        $dataStatus = DB::select('CALL view_sertifikatTanah_status(?)', array($id));
        $dataDiriAll = collect($dataDiriAll);
        $dataGugatan = collect($dataGugatan);
        $dataPetitum = collect($dataPetitum);
        $dataStatus = collect($dataStatus);
        return view('Pertanahan.detailPermohonanPemblokiran', [
            'dataDiriAll' => $dataDiriAll,
            'dataGugatan' => $dataGugatan,
            'dataPetitum' => $dataPetitum,
            'dataStatus' => $dataStatus,
        ]);
    }

    public function show(string $id)
    {
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        return view('Pertanahan.detailPihakPermohonanPemblokiran', ['sertifikat' => $sertifikat]);
    }

    public function buktiBlokir()
    {
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        return view('Pertanahan.addSKBPN', ['sertifikat' => $sertifikat]);
    }

    public function uploadBuktiBlokir(Request $request, $id)
    {
        if($request->hasFile('pdf')){
            // Simpan file PDF
            $dokumen = $request->file('pdf');
            $dokumenPath = $dokumen->storeAs('dokumen', $dokumen->getClientOriginalName());
    
            // Cari data berdasarkan ID
            $data = DB::table('pemblokiran_sertifikat')->where('id', $id)->whereNull('surat_pemblokiran_bpn')->first();
    
            if($data){
                // Update kolom surat_pemblokiran_bpn dengan path file PDF yang disimpan
                DB::table('pemblokiran_sertifikat')->where('id', $id)->update(['surat_pemblokiran_bpn'=> $dokumenPath]);
                return "File PDF berhasil diunggah dan disimpan pada baris data dengan ID: $id.";
            }else{
                return "Data dengan ID: $id tidak ditemukan atau kolom surat_pemblokiran_bpn sudah diisi.";
            }
        }else{
            // In case no file is uploaded, redirect or display appropriate message
            // For now, assuming you want to redirect to a view where the user can upload a PDF file
            return redirect()->back()->with('error', 'Mohon unggah file PDF.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
