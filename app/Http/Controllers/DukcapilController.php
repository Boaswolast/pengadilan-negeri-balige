<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DukcapilController extends Controller
{
    public function dukcapil()
    {
        $notif = collect(DB::select('CALL notifBPN()'));
        foreach($notif as $notification){
            if($notification->jumlah_permohonan === 0){
                $notification->jumlah_permohonan = null;
            }
        }
        $data = DB::select('CALL viewAll_peristiwaPenting()');
        $data = collect($data);
        return view('Dukcapil/dukcapil',[
            'data' => $data,
            'notif' => $notif
        ]);
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

    public function show(string $id)
    {
        $notif = collect(DB::select('CALL notifBPN()'));
        foreach($notif as $notification){
            if($notification->jumlah_permohonan === 0){
                $notification->jumlah_permohonan = null;
            }
        }

        $data = DB::select('CALL viewAll_peristiwaPenting_dataDiri(?)', array($id));
        $dataAmar = DB::select('CALL view_peristiwaPenting_amarPutusan(?)', array($id));
        $dataPutusan = DB::select('CALL view_peristiwaPenting_suratPutusan(?)', array($id));
        $dataPengantar = DB::select('CALL view_peristiwaPenting_suratPengantar(?)', array($id));
        $dataStatus = DB::select('CALL view_peristiwaPenting_status(?)', array($id));
        $data = collect($data);
        $dataAmar = collect($dataAmar);
        $dataPutusan = collect($dataPutusan);
        $dataPengantar = collect($dataPengantar);
        $dataStatus = collect($dataStatus);
        
        $kodeUnik = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('kode_unik')->first();
        $id = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('id_peristiwa')->first();
        return view('Dukcapil/detailDukcapil',[
            'data' => $data, 
            'kodeUnik' => $kodeUnik, 
            'id' => $id,
            'dataAmar' => $dataAmar,
            'dataPutusan' => $dataPutusan,
            'dataPengantar' => $dataPengantar,
            'dataStatus' => $dataStatus,
            'notif' => $notif
        ]);
    }

    public function showDataDiri(string $id)
    {
        $notif = collect(DB::select('CALL notifBPN()'));
        foreach($notif as $notification){
            if($notification->jumlah_permohonan === 0){
                $notification->jumlah_permohonan = null;
            }
        }
        $data = DB::select('CALL view_peristiwaPenting_dataDiri(?)', array($id));
        $data = collect($data);
        return view('Dukcapil/detailPihakDukcapil',[
            'data' => $data,
            'notif' => $notif
        ]);
    }

    public function diprosesCapil($id){
        $diproses = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->update(['status_id' => 2, 'is_read_byPN' => 1]);

        return redirect()->route('dukcapil')->with('success', 'Data telah disimpan.');
    }

    public function konfirmasiCapil($id){
        $konfirmasi = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->update(['status_id' => 3, 'is_read_byPN' => 3]);

        return redirect()->route('dukcapil')->with('success', 'Data telah disimpan.');
    }
}
