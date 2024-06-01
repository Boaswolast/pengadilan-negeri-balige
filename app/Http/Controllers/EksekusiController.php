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

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);

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

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);

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

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);

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

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);


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
            'keterangan' => 'nullable',
        ], [
            'resume.required' => 'Resume wajib diunggah.',
            'resume.mimes' => 'Resume harus berupa file dengan format: png, jpg, jpeg, atau pdf.',
            'skum.required' => 'SKUM wajib diunggah.',
            'skum.mimes' => 'SKUM harus berupa file dengan format: png, jpg, jpeg, atau pdf.',
            'status_telaah.required' => 'Status telaah wajib diisi.',
            'tgl_telaah.required' => 'Tanggal telaah wajib diisi.',
        ]);
        
        $telaah = DB::table('telaah')->where('id_telaah', $id)->first();

        if (!$telaah) {
            return redirect()->route('eksekusi')->with('error', 'Data telaah tidak ditemukan');
        }
    
        // Simpan file resume
        $resume = $request->file('resume');
        $resumeName = time() . '.' . $resume->getClientOriginalName();
        $resumePath = $resume->move(public_path('dokumen/Eksekusi'), $resumeName);
    
        // Simpan file skum
        $skum = $request->file('skum');
        $skumName = time() . '.' . $skum->getClientOriginalName();
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
            'proses' => 'Pembayaran',
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

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);

        $dataAll = DB::table('telaah')->where('id_telaah', $id)->get();
        return view('Eksekusi.tolakData', [
            'eksekusi' => $dataAll,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function TolakData(Request $request, $id)
    {
        $request->validate([
            'resume' => 'required|mimes:doc,docx,pdf',
            'status_telaah' => 'required',
            'tgl_telaah' => 'required',
            'keterangan' => 'nullable',
        ], [
            'resume.required' => 'Resume wajib diunggah.',
            'resume.mimes' => 'Resume harus berupa file dengan format: doc, docx, atau pdf.',
            'status_telaah.required' => 'Status telaah wajib diisi.',
            'tgl_telaah.required' => 'Tanggal telaah wajib diisi.',
        ]);
        
        $post = DB::table('telaah')->where('id_telaah', $id)->first();

        // dd($post);
        if ($post) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('resume')) {
                // Simpan file dokumen
                $document = $request->file('resume');
                $documentName = time() . '.' . $document->getClientOriginalName();
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
        ], [
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',
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

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);

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
            'tgl_aanmaning' => 'required|date',
        ], [
            'surat_pemanggilan.required' => 'Surat pemanggilan wajib diunggah.',
            'surat_pemanggilan.mimes' => 'Surat pemanggilan harus berupa file dengan format: png, jpg, jpeg, atau pdf.',
            'tgl_aanmaning.required' => 'Tanggal aanmaning wajib diisi.',
            'tgl_aanmaning.date' => 'Tanggal aanmaning harus berupa tanggal yang valid.',
        ]);
        
        $telaah = DB::table('aanmaning')->where('id_aanmaning', $id)->first();

        if (!$telaah) {
            return redirect()->route('eksekusi')->with('error', 'Data telaah tidak ditemukan');
        }
    
        // Simpan file skum
        $suratPemanggilan = $request->file('surat_pemanggilan');
        $suratPemanggilanName = time() . '.' . $suratPemanggilan->getClientOriginalName();
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
            'status_aanmaning' => 'Diproses'
        ]);

        DB::table('eksekusi')->where('aanmaning_id', $id)->update([
            'proses' => 'Aanmaning',
        ]);

        $pembayaran_id = DB::table('eksekusi')->where('aanmaning_id', $id)->value('pembayaran_id');

        DB::table('pembayaran')->where('id_pembayaran', $pembayaran_id)->update([
            'status_pembayaran' => 'Selesai']);
    
        return redirect()->route('eksekusi')->with('success', 'Konfirmasi Terkirim');
    }

    public function halamanEditAanmaning(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);

        $dataAll = DB::table('eksekusi')->where('aanmaning_id', $id)->first();
        if ($dataAll) {
            $aanmaningId = $dataAll->aanmaning_id;
            $aanmaningData = DB::table('aanmaning')->where('id_aanmaning', $aanmaningId)->get();
        } else {
            $aanmaningData = collect();
        }
        return view('Eksekusi.editAanmaning', [
            'aanmaningId' => $aanmaningId,
            'aanmaning' => $aanmaningData,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function konfirmasiEditAanmaning(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'surat_pemanggilan' => 'required|mimes:doc,docx,pdf',
            'tgl_aanmaning' => 'required|date',
        ], [
            'surat_pemanggilan.required' => 'Surat pemanggilan wajib diunggah.',
            'surat_pemanggilan.mimes' => 'Surat pemanggilan harus berupa file dengan format: doc, docx, atau pdf.',
            'tgl_aanmaning.required' => 'Tanggal aanmaning wajib diisi.',
            'tgl_aanmaning.date' => 'Tanggal aanmaning harus berupa tanggal yang valid.',
        ]);
        
        $telaah = DB::table('aanmaning')->where('id_aanmaning', $id)->first();

        if (!$telaah) {
            return redirect()->route('eksekusi')->with('error', 'Data telaah tidak ditemukan');
        }
    
        // Simpan file skum
        $suratPemanggilan = $request->file('surat_pemanggilan');
        $suratPemanggilanName = time() . '.' . $suratPemanggilan->getClientOriginalName();
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
            'status_aanmaning' => 'Diproses'
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

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);

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
            'penetapan_eksekusi' => 'required|mimes:doc,docx,pdf',
            'tgl_eksekusi' => 'required|date',
        ], [
            'penetapan_eksekusi.required' => 'Penetapan eksekusi wajib diunggah.',
            'penetapan_eksekusi.mimes' => 'Penetapan eksekusi harus berupa file dengan format: doc, docx, atau pdf.',
            'tgl_eksekusi.required' => 'Tanggal eksekusi wajib diisi.',
            'tgl_eksekusi.date' => 'Tanggal eksekusi harus berupa tanggal yang valid.',
        ]);
        
        $eksekusi = DB::table('eksekusi')->where('id_eksekusi', $id)->first();

        if (!$eksekusi) {
            return redirect()->route('eksekusi')->with('error', 'Data eksekusi tidak ditemukan');
        }
    
        $suratPenetapan = $request->file('penetapan_eksekusi');
        $suratPenetapanName = time() . '.' . $suratPenetapan->getClientOriginalName();
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

    public function halamanEditEksekusi(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);

        $dataAll = DB::table('eksekusi')->where('id_eksekusi', $id)->get();
        return view('Eksekusi.halamanEditEksekusi', [
            'eksekusi' => $dataAll,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function tetapkanEditEksekusi(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'penetapan_eksekusi' => 'required|mimes:doc,docx,pdf',
            'tgl_eksekusi' => 'required|date',
        ], [
            'penetapan_eksekusi.required' => 'Penetapan eksekusi wajib diunggah.',
            'penetapan_eksekusi.mimes' => 'Penetapan eksekusi harus berupa file dengan format: doc, docx, atau pdf.',
            'tgl_eksekusi.required' => 'Tanggal eksekusi wajib diisi.',
            'tgl_eksekusi.date' => 'Tanggal eksekusi harus berupa tanggal yang valid.',
        ]);
        
        $eksekusi = DB::table('eksekusi')->where('id_eksekusi', $id)->first();

        if (!$eksekusi) {
            return redirect()->route('eksekusi')->with('error', 'Data eksekusi tidak ditemukan');
        }
    
        // Simpan file skum
        $suratPenetapan = $request->file('penetapan_eksekusi');
        $suratPenetapanName = time() . '.' . $suratPenetapan->getClientOriginalName();
        $suratPenetapanPath = $suratPenetapan->move(public_path('dokumen/Penetapan'), $suratPenetapanName);
    
        // Buat entri baru dalam tabel eksekusi
        DB::table('eksekusi')->where('id_eksekusi', $id)->update([
            'penetapan_eksekusi' => basename($suratPenetapanPath),
            'tgl_eksekusi' => $request->tgl_eksekusi,
            'status_eksekusi' => 'Diproses',
            'Proses' => 'Eksekusi'
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
        $tgl_selesai = now();
    
        // Lakukan operasi penyimpanan ke database
        DB::table('eksekusi')->where('id_eksekusi', $id)->update([
            'status_eksekusi' => 'Selesai',
            'keterangan' => $keterangan, 
            'tgl_selesai' => $tgl_selesai
        ]);

        return redirect()->route('eksekusi')->with('success', 'Berhasil Ditolak');
    }

    public function download(Request $request, $file)
    {
        $filePath = public_path('dokumen/Pembayaran/' . $file);

        return response()->download($filePath);
    }

    public function destroy(string $id)
    {
        DB::select('CALL delete_eksekusi(?)', array($id));
        return redirect()->route('pengadilan',$id)->with('success', 'Data Eksekusi Berhasil Dihapus!');
    }

    public function dataUser()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $notif4 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total4 = $notif4->sum('jumlah_permohonan');
        $messages4 = collect($notif4)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3 + $total4;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3, $messages4);


        $dataMasyarakat = DB::table('users')->where('role',  1)->get();
        $dataKetua = DB::table('users')->where('role',  5)->get();
        $dataWakil = DB::table('users')->where('role',  6)->get();
        $dataPanitera = DB::table('users')->where('role',  7)->get();
        $dataSekretaris = DB::table('users')->where('role',  8)->get();
        $countMasyarakat = $dataMasyarakat->count();
        $countKetua = $dataKetua->count();
        $countWakil = $dataWakil->count();
        $countPanitera = $dataPanitera->count();
        $countSekretaris = $dataSekretaris->count();
        return view('Pengadilan/dataUser', [
            'dataMasyarakat' => $dataMasyarakat,
            'dataKetua' => $dataKetua,
            'dataWakil' => $dataWakil,
            'dataPanitera' => $dataPanitera,
            'dataSekretaris' => $dataSekretaris,
            'countMasyarakat' => $countMasyarakat,
            'countKetua' => $countKetua,
            'countWakil' => $countWakil,
            'countPanitera' => $countPanitera,
            'countSekretaris' => $countSekretaris,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function nonAktif(string $id)
    {
        DB::table('users')->where('id', $id)->update(['is_active' => 1]);
        return redirect()->route('dataUser')->with('success', 'Akun Berhasil Dinonaktifkan!');
    } 
    
    public function aktif(string $id)
    {
        DB::table('users')->where('id', $id)->update(['is_active' => 0]);
        return redirect()->route('dataUser')->with('success', 'Akun Berhasil Diaktifkan!');
    }  
}
