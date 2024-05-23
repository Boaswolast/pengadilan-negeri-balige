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
         return $count === 0 ? null : $count;
     }

    public function index()
    {
        $notif = collect(DB::select('CALL notifBPN()'));
        foreach($notif as $notification){
            if($notification->jumlah_permohonan === 0){
                $notification->jumlah_permohonan = null;
            }
        }
        $data = collect(DB::select('CALL viewAll_sertifikatTanah()'))
        ->filter(function ($item) {
            return $item->status_permohonan == 'Menunggu' || $item->status_permohonan == 'Sedang diproses';
        });
        $data = collect($data);
        return view('Pertanahan/daftarKasusPertanahan',[
            'data' => $data, 
            'notif' => $notif
        ]);
    }

    public function showDataAll(string $id)
    {
        $notif = collect(DB::select('CALL notifBPN()'));
        foreach($notif as $notification){
            if($notification->jumlah_permohonan === 0){
                $notification->jumlah_permohonan = null;
            }
        }
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
            'notif' => $notif
        ]);
    }

    public function show(string $id)
    {
        $notif = collect(DB::select('CALL notifBPN()'));
        foreach($notif as $notification){
            if($notification->jumlah_permohonan === 0){
                $notification->jumlah_permohonan = null;
            }
        }
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        return view('Pertanahan.detailPihakPermohonanPemblokiran', [
            'sertifikat' => $sertifikat, 
            'notif' => $notif
        ]);
    }

    public function buktiBlokir()
    {
        $notif = collect(DB::select('CALL notifBPN()'));
        foreach($notif as $notification){
            if($notification->jumlah_permohonan === 0){
                $notification->jumlah_permohonan = null;
            }
        }
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        return view('Pertanahan.addSKBPN', [
            'sertifikat' => $sertifikat,
            'notif' => $notif
        ]);
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
                $documentPath = $document->move(public_path('dokumen/Pertanahan'), $documentName);
                $tgl_diproses = now();
                $documentPath = basename($documentPath);

                // Update status dan tambahkan path dokumen
                DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->update([
                    'status_id' => 6,
                    'is_read_byPN' => 3,
                    'tgl_diproses' => $tgl_diproses,
                    'surat_pemblokiran_bpn' => $documentPath
                ]);

                return redirect()->route('pertanahan')->with('success', 'Konfirmasi Terkirim');
            } else {
                // Jika tidak ada file yang diunggah, hanya ubah status
                DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->update(['status_id' => 5, 'is_read_byPN' => 1]);

                return redirect()->route('pertanahan')->with('warning', 'Terkonfirmasi untuk diroses');
            }
        } else {
            return redirect()->route('pertanahan')->with('error', 'Terjadi kesalahan');
        }
    }

    public function diproses($id){
        $tgl_diproses = now();
        $diproses = DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->update([
            'status_id' => 5, 'is_read_byPN' => 1,
            'tgl_diproses' => $tgl_diproses
        ]);

        return redirect()->route('detailAllSertifikatPertanahan', ['id' => $id])->with('success', 'Data telah disimpan.');
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
}
