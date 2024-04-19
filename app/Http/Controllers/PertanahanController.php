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

     public function countNotif($notif)
     {
         $count = DB::table('pemblokiran_sertifikat')->where('status_notif', $notif)->count();
         return $count;
     }

    public function index()
    {
        $statusCount = $this->countNotif('0');
        $data = DB::select('CALL viewAll_sertifikatTanah()');
        $data = collect($data);
        return view('Pertanahan/daftarKasusPertanahan',['data' => $data, 'statusNotif' => $statusCount]);
    }

    public function showDataAll(string $id)
    {
        $statusCount = $this->countNotif('0');
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
            'statusNotif' => $statusCount,
        ]);
    }

    public function show(string $id)
    {
        $statusCount = $this->countNotif('0');
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        return view('Pertanahan.detailPihakPermohonanPemblokiran', ['sertifikat' => $sertifikat, 'statusNotif' => $statusCount]);
    }

    public function buktiBlokir()
    {
        $statusCount = $this->countNotif('0');
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        return view('Pertanahan.addSKBPN', ['sertifikat' => $sertifikat]);
    }

    public function uploadBuktiBlokir(Request $request, $id)
    {
        $request->validate([
            'surat_pemblokiran_bpn' => 'required|mimes:pdf,doc,docx',
        ]);
        
        $post = DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->first();

        // Debug: Cetak nilai $post untuk memeriksa hasil query
        // dd($post);
        // Periksa apakah post ditemukan
        if ($post) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('surat_pemblokiran_bpn')) {
                // Simpan file dokumen
                $document = $request->file('surat_pemblokiran_bpn');
                $documentName = $document->getClientOriginalName();
                $mimeType = $document->getClientMimeType();
                $documentPath = $document->storeAs('public/dokumen', $documentName);

                $documentPath = basename($documentPath);

                // Update status dan tambahkan path dokumen
                DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->update([
                    'status_id' => 3,
                    'surat_pemblokiran_bpn' => $documentPath
                ]);

                return "Status post berhasil diubah dan dokumen berhasil diunggah.";
            } else {
                // Jika tidak ada file yang diunggah, hanya ubah status
                DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->update(['status_id' => 3]);

                return "Status post berhasil diubah.";
            }
        } else {
            return "Post tidak ditemukan.";
        }
    }
    
    public function download(Request $request, $file)
    {
        $filePath = public_path('storage/dokumen/' . $file);

        return response()->download($filePath);
    }

    public function print(Request $request, $file)
    {
        $path = public_path('storage/dokumen/' . $file);

        // Periksa apakah file ada
        if (!file_exists($path)) {
            return response()->json(['error' => 'File tidak ditemukan'], 404);
        }

        // Tentukan tipe konten berdasarkan ekstensi file
        $contentType = mime_content_type($path);

        // Baca isi file
        $fileContent = file_get_contents($path);

        // Kembalikan response dengan tipe konten yang sesuai
        return response($fileContent, 200)->header('Content-Type', $contentType);
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
