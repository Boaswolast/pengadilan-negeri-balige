<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; 

class EksekusiController extends Controller
{
    public function index()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $dataAll = collect(DB::select('CALL viewAll_eksekusi()'));
        $dataAll = collect($dataAll);
        return view('Eksekusi/eksekusi',[
            'data' => $dataAll, 
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function showDataAllEksekusi(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $dataDiriAll = DB::select('CALL viewAll_eksekusi_dataDiri(?)', array($id));
        $dataAanmaning = DB::select('CALL view_eksekusi_aanmaning(?)', array($id));
        $dataPermohonan = DB::select('CALL view_eksekusi_dokumenPermohonan(?)', array($id));
        $dataPembayaran = DB::select('CALL view_eksekusi_pembayaran(?)', array($id));
        $dataTelaah = DB::select('CALL view_eksekusi_telaah(?)', array($id));
        $dataDiriAll = collect($dataDiriAll);
        $dataAanmaning = collect($dataAanmaning);
        $dataPermohonan = collect($dataPermohonan);
        $dataPembayaran = collect($dataPembayaran);
        $dataTelaah = collect($dataTelaah);
        
        // $status = DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->get();
        // $id = DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->pluck('id_pemblokiran')->first();
        return view('Eksekusi.detailEksekusi', [
            'dataDiriAll' => $dataDiriAll,
            // 'status' => $status, 
            // 'id' => $id,
            'dataAanmaning' => $dataAanmaning,
            'dataPermohonan' => $dataPermohonan,
            'dataPembayaran' => $dataPembayaran,
            'dataTelaah' => $dataTelaah,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function show(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $eksekusi = DB::select('CALL view_eksekusi_dataDiri(?)', array($id));
        $eksekusi = collect($eksekusi);
        return view('Eksekusi.detailDataDiriEksekusi', [
            'eksekusi' => $eksekusi, 
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function halamanKonfirmasiData(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);


        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        $dataAll = DB::table('telaah')->where('id_telaah', $id)->get();
        return view('Eksekusi.konfirmasiData', [
            'eksekusi' => $dataAll,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function konfirmasiData(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'resume' => 'required|mimes:png,jpg,jpeg,pdf',
            'skum' => 'required|mimes:png,jpg,jpeg,pdf',
            'status_telaah' => 'required',
            'tgl_telaah' => 'required',
            'keterangan' => 'required',
        ]);
        
        $telaah = DB::table('telaah')->where('id_telaah', $id)->first();

        if (!$telaah) {
            return redirect()->route('eksekusi')->with('error', 'Data telaah tidak ditemukan');
        }
    
        // Simpan file resume
        $resume = $request->file('resume');
        $resumeName = $resume->getClientOriginalName();
        $resumePath = $resume->move(public_path('dokumen/Eksekusi'), $resumeName);
    
        // Simpan file skum
        $skum = $request->file('skum');
        $skumName = $skum->getClientOriginalName();
        $skumPath = $skum->move(public_path('dokumen/Eksekusi'), $skumName);
    
        // Buat entri baru dalam tabel pembayaran
        $pembayaranId = DB::table('pembayaran')->insertGetId([
            'skum' => basename($skumPath),
            'status_pembayaran' => 'Menunggu', 
        ]);
    
        // Buat entri baru dalam tabel eksekusi
        DB::table('telaah')->where('id_telaah', $id)->update([
            'resume' => basename($resumePath),
            'status_telaah' => $request->status_telaah,
            'tgl_telaah' => $request->tgl_telaah,
            'keterangan' => $request->keterangan,
        ]);

        DB::table('eksekusi')->where('telaah_id', $id)->update([
            'pembayaran_id' => $pembayaranId,
        ]);
    
        return redirect()->route('eksekusi')->with('success', 'Konfirmasi Terkirim');
        // dd($post);
        // if ($post) {
        //     // Periksa apakah ada file yang diunggah
        //     if ($request->hasFile('resume')) {
        //         // Simpan file dokumen
        //         $document = $request->file('resume');
        //         $documentName = $document->getClientOriginalName();
        //         $mimeType = $document->getClientMimeType();
        //         $documentPath = $document->move(public_path('dokumen/Eksekusi'), $documentName);

        //         $documentPath = basename($documentPath);

        //         // Update status dan tambahkan path dokumen
        //         DB::table('telaah')->where('id_telaah', $id)->update([
        //             'status_telaah' => $request->status_telaah,
        //             'tgl_telaah' => $request->tgl_telaah,
        //             'keterangan' => $request->keterangan,
        //             'resume' => $documentPath
        //         ]);

        //         return redirect()->route('eksekusi')->with('success', 'Konfirmasi Terkirim');
        //     } else {
        //         return redirect()->route('eksekusi')->with('error', 'Terjadi kesalahan');
        //     }
        // } else {
        //     return redirect()->route('eksekusi')->with('error', 'Terjadi kesalahan');
        // }
    }

    public function halamanTolakData(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $dataAll = DB::table('telaah')->where('id_telaah', $id)->get();
        return view('Eksekusi.tolakData', [
            'eksekusi' => $dataAll,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function TolakData(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'resume' => 'required|mimes:png,jpg,jpeg,pdf',
            'status_telaah' => 'required',
            'tgl_telaah' => 'required',
            'keterangan' => 'required',
        ]);
        
        $post = DB::table('telaah')->where('id_telaah', $id)->first();

        // dd($post);
        if ($post) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('resume')) {
                // Simpan file dokumen
                $document = $request->file('resume');
                $documentName = $document->getClientOriginalName();
                $mimeType = $document->getClientMimeType();
                $documentPath = $document->move(public_path('dokumen/Eksekusi'), $documentName);

                $documentPath = basename($documentPath);

                // Update status dan tambahkan path dokumen
                DB::table('telaah')->where('id_telaah', $id)->update([
                    'status_telaah' => $request->status_telaah,
                    'tgl_telaah' => $request->tgl_telaah,
                    'keterangan' => $request->keterangan,
                    'resume' => $documentPath
                ]);

                return redirect()->route('eksekusi')->with('success', 'Konfirmasi Terkirim');
            } else {
                return redirect()->route('eksekusi')->with('error', 'Terjadi kesalahan');
            }
        } else {
            return redirect()->route('eksekusi')->with('error', 'Terjadi kesalahan');
        }
    }

    public function terimaPembayaran(string $id)
    {
        DB::table('pembayaran')->where('id_pembayaran', $id)->update(['status_pembayaran' => 'Diterima']);

        return redirect()->route('eksekusi')->with('success', 'Berhasil Diterima');
    }

    public function tolakPembayaran(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:255',
        ]);
    
        // Tangkap data dari input form
        $keterangan = $request->input('keterangan');
    
        // Lakukan operasi penyimpanan ke database
        DB::table('pembayaran')->where('id_pembayaran', $id)->update([
            'status_pembayaran' => 'Ditolak',
            'keterangan' => $keterangan, // Simpan alasan penolakan ke dalam database
        ]);

        return redirect()->route('eksekusi')->with('success', 'Berhasil Ditolak');
    }

    public function halamanAanmaning(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $dataAll = DB::table('eksekusi')->where('aanmaning_id', $id)->get();
        return view('Eksekusi.aanmaning', [
            'aanmaning' => $dataAll,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function konfirmasiAanmaning(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'surat_pemanggilan' => 'required|mimes:png,jpg,jpeg,pdf',
            'tgl_aanmaning' => 'required',
        ]);
        
        $telaah = DB::table('aanmaning')->where('id_aanmaning', $id)->first();

        if (!$telaah) {
            return redirect()->route('eksekusi')->with('error', 'Data telaah tidak ditemukan');
        }
    
        // Simpan file skum
        $suratPemanggilan = $request->file('surat_pemanggilan');
        $suratPemanggilanName = $suratPemanggilan->getClientOriginalName();
        $suratPemanggilanPath = $suratPemanggilan->move(public_path('dokumen/Aanmaning'), $suratPemanggilanName);
    
        // Buat entri baru dalam tabel pembayaran
        // $pembayaranId = DB::table('pembayaran')->insertGetId([
        //     'surat_pemanggilan' => basename($surat_pemanggilanPath),
        //     'status_pembayaran' => 'Menunggu', 
        // ]);
    
        // Buat entri baru dalam tabel eksekusi
        DB::table('aanmaning')->where('id_aanmaning', $id)->update([
            'surat_pemanggilan' => basename($suratPemanggilanPath),
            'tgl_aanmaning' => $request->tgl_aanmaning,
            'status_aanmaning' => 'Menunggu'
        ]);

        DB::table('eksekusi')->where('aanmaning_id', $id)->update([
            'proses' => 'Aanmaning',
        ]);
    
        return redirect()->route('eksekusi')->with('success', 'Konfirmasi Terkirim');
    }

    public function terimaAanmaning(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:255',
        ]);
    
        // Tangkap data dari input form
        $keterangan = $request->input('keterangan');
    
        // Lakukan operasi penyimpanan ke database
        DB::table('aanmaning')->where('id_aanmaning', $id)->update([
            'status_aanmaning' => 'Diterima',
            'keterangan' => $keterangan, // Simpan alasan penolakan ke dalam database
        ]);

        return redirect()->route('eksekusi')->with('success', 'Berhasil Diterima');
    }

    public function tolakAanmaning(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:255',
        ]);
    
        // Tangkap data dari input form
        $keterangan = $request->input('keterangan');
    
        // Lakukan operasi penyimpanan ke database
        DB::table('aanmaning')->where('id_aanmaning', $id)->update([
            'status_aanmaning' => 'Ditolak',
            'keterangan' => $keterangan, // Simpan alasan penolakan ke dalam database
        ]);

        return redirect()->route('eksekusi')->with('success', 'Berhasil Ditolak');
    }

    public function halamanEksekusi(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $dataAll = DB::table('eksekusi')->where('id_eksekusi', $id)->get();
        return view('Eksekusi.halamanEksekusi', [
            'eksekusi' => $dataAll,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function tetapkanEksekusi(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'penetapan_eksekusi' => 'required|mimes:png,jpg,jpeg,pdf',
            'tgl_eksekusi' => 'required',
        ]);
        
        $eksekusi = DB::table('eksekusi')->where('id_eksekusi', $id)->first();

        if (!$eksekusi) {
            return redirect()->route('eksekusi')->with('error', 'Data eksekusi tidak ditemukan');
        }
    
        // Simpan file skum
        $suratPenetapan = $request->file('penetapan_eksekusi');
        $suratPenetapanName = $suratPenetapan->getClientOriginalName();
        $suratPenetapanPath = $suratPenetapan->move(public_path('dokumen/Penetapan'), $suratPenetapanName);
    
        // Buat entri baru dalam tabel eksekusi
        DB::table('eksekusi')->where('id_eksekusi', $id)->update([
            'penetapan_eksekusi' => basename($suratPenetapanPath),
            'tgl_eksekusi' => $request->tgl_eksekusi,
            'status_eksekusi' => 'Diproses',
            'Proses' => 'Eksekusi'
        ]);  

        $id_aanmaning = $eksekusi->aanmaning_id;
        
        DB::table('aanmaning')->where('id_aanmaning', $id_aanmaning)->update([
            'status_aanmaning' => 'Selesai',
        ]);
        return redirect()->route('eksekusi')->with('success', 'Konfirmasi Terkirim');
    }

    public function selesaiKasus(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:255',
        ]);
    
        // Tangkap data dari input form
        $keterangan = $request->input('keterangan');
    
        // Lakukan operasi penyimpanan ke database
        DB::table('eksekusi')->where('id_eksekusi', $id)->update([
            'status_eksekusi' => 'Selesai',
            'keterangan' => $keterangan, // Simpan alasan penolakan ke dalam database
        ]);

        return redirect()->route('eksekusi')->with('success', 'Berhasil Ditolak');
    }
}
