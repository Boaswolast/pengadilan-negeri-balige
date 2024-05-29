<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use setasign\Fpdi\Fpdi;

class TandaTanganController extends Controller
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

        $totalNotif = $total1 + $total2 + $total3;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $data = DB::select('CALL viewAll_tandaTangan()');
        $data = collect($data);
        return view('TTD/index', [
            'data' => $data,
            'totalNotif' => $totalNotif,
            'messages' => $messages
        ]);
    }

    public function indexReq()
    {
        // return view('Pejabat/id');
        $notif1 = collect(DB::select('CALL notifPejabat_TTD()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $totalNotif = $total1;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1);

        $userId = Auth::id();
        $data = collect(DB::select('CALL viewAll_TTD_Pejabat(?)', [$userId]));
        $data = collect($data);
        return view('Pejabat/index', [
            'data' => $data,
            'totalNotif' => $totalNotif,
            'messages' => $messages
        ]);
    }
    public function detail(string $id)
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

        $totalNotif = $total1 + $total2 + $total3;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $data = DB::select('CALL view_tandaTangan(?)', array($id));
        $data = collect($data);

        // $kodeUnik = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('kode_unik')->first();
        // $id = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('id_peristiwa')->first();
        return view('TTD/detail', [
            'data' => $data,
            'id' => $id,
            'totalNotif' => $totalNotif,
            'messages' => $messages
        ]);
    }
    public function request(){
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all();

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all();

        $totalNotif = $total1 + $total2 + $total3;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $termohon = DB::table('users')
            ->join('role', 'users.role', '=', 'role.id_role')
            ->whereIn('users.role', [5, 6, 7, 8])
            ->select('users.name', 'role.nama_role')
            ->where('users.is_deleted', 0)
            ->get();

        return view('TTD/ajukan', [
            'totalNotif' => $totalNotif,
            'messages' => $messages,
            'termohon' => $termohon
        ]);
    }
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request->validate([
            'subjek_permohonan' => 'required|min:3|max:50',
            'termohon' => 'required',
            'file_dokumen' => 'required|mimes:pdf'
        ], [
            'subjek_permohonan.required' => 'Mohon masukkan subjek permohonan.',
            'subjek_permohonan.min' => 'Kolom subjek permohonan harus diisi dengan minimal 3 karakter.',
            'subjek_permohonan.max' => 'Kolom subjek permohonan harus diisi dengan maksimal 50 karakter.',
            'termohon.required' => 'Mohon masukkan pilihan termohon.',
            'file_dokumen.required' => 'Dokumen Permohonan harus diunggah.',
            'file_dokumen.mimes' => 'File putusan PN harus berupa file PDF.'
        ]);

        $termohon = DB::table('users')
            ->join('role', 'users.role', '=', 'role.id_role')
            ->select('users.name')
            ->where('nama_role', $request->termohon)
            ->value('name');

        try {
            $termohon = str_replace(' ', '', $termohon);
            $docSP = $request->file('file_dokumen');
            $originalFileName = $docSP->getClientOriginalName();
            $sanitizedFileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($originalFileName, PATHINFO_FILENAME));
            $timestamp = time(); // Mendapatkan timestamp saat ini
            $date = date('Ymd_His', $timestamp); // Format tanggal dan jam

            $docSPName = $date . '_' . $sanitizedFileName . '_' . $termohon . '.pdf';

            $docSP->move(public_path('files/Tanda-Tangan'), $docSPName);

            DB::table('tanda_tangan')->insert([
                'subjek_permohonan' => $request->subjek_permohonan,
                'termohon' => $request->termohon,
                'status' => 'Menunggu',
                'file_dokumen' => $docSPName
            ]);

            // $pejabat = collect(DB::select('CALL view_tandaTangan(?)', [$id]))
            //     ->pluck('name')
            //     ->map(function ($item) {
            //         return str_replace(' ', '', $item);
            //     })->first();

            return redirect()->route('tandatangan')->with('success', 'Data telah dikirimkan.');
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e->getMessage()); 
            // Tangani kesalahan jika terjadi
            return redirect()->route('tandatangan')->with('error', 'Terjadi kesalahan saat mengirimkan data.');
            // dd($e->getMessage());
        }
    }
    public function edit(string $id)
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

        $totalNotif = $total1 + $total2 + $total3;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $termohon = DB::table('users')
            ->join('role', 'users.role', '=', 'role.id_role')
            ->whereIn('users.role', [5, 6, 7, 8])
            ->select('users.name', 'role.nama_role')
            ->where('users.is_deleted', 0)
            ->get();

        $data = DB::select('CALL view_tandaTangan("' . $id . '")');
        return view('TTD/edit', [
            'data' => $data,
            'totalNotif' => $totalNotif,
            'messages' => $messages,
            'termohon' => $termohon
        ]);
    }
    public function update(Request $request, string $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        if ($request->hasFile('file_dokumen')) {

            $request->validate([
                'subjek_permohonan' => 'required|min:3|max:50',
                'termohon' => 'required',
                'file_dokumen' => 'mimes:pdf'
            ], [
                'subjek_permohonan.required' => 'Mohon masukkan subjek permohonan.',
                'subjek_permohonan.min' => 'Kolom subjek permohonan harus diisi dengan minimal 3 karakter.',
                'subjek_permohonan.max' => 'Kolom subjek permohonan harus diisi dengan maksimal 50 karakter.',
                'termohon.required' => 'Mohon masukkan pilihan termohon.',
                'file_dokumen.mimes' => 'File putusan PN harus berupa file PDF.'
            ]);

            $termohon = DB::table('users')
                ->join('role', 'users.role', '=', 'role.id_role')
                ->select('users.name')
                ->where('nama_role', $request->termohon)
                ->value('name');
            $termohon = str_replace(' ', '', $termohon);
            $docSPName = null;
            $docLamaSP = DB::table('tanda_tangan')->where(["id_ttd" => $id])->value('file_dokumen');
            $docSP = $request->file('file_dokumen');
            $originalFileName = $docSP->getClientOriginalName();
            $sanitizedFileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', pathinfo($originalFileName, PATHINFO_FILENAME));
            $timestamp = time(); // Mendapatkan timestamp saat ini
            $date = date('Ymd_His', $timestamp); // Format tanggal dan jam

            $docSPName = $date . '_' . $sanitizedFileName . '_' . $termohon . '.pdf';

            // hapus file lama
            if ($docLamaSP != null) {
                $pathToFile = public_path('files/Tanda-Tangan/' . $docLamaSP);
                // Periksa apakah file lama ada sebelum mencoba menghapusnya
                if (file_exists($pathToFile)) {
                    // Hapus file lama
                    unlink($pathToFile);
                }
            }
            $docSP->move(public_path('files/Tanda-Tangan'), $docSPName);
            DB::table('tanda_tangan')
                ->where('id_ttd', $id)
                ->update([
                    'subjek_permohonan' => $request->subjek_permohonan,
                    'termohon' => $request->termohon,
                    'file_dokumen' => $docSPName
                ]);
            return redirect()->route('tandatangan')->with('success', 'Pengajuan Tanda Tangan Berhasil di Ubah');
        }
        else {
            $request->validate([
                'subjek_permohonan' => 'required|min:3|max:50',
                'termohon' => 'required'
            ], [
                'subjek_permohonan.required' => 'Mohon masukkan subjek permohonan.',
                'subjek_permohonan.min' => 'Kolom subjek permohonan harus diisi dengan minimal 3 karakter.',
                'subjek_permohonan.max' => 'Kolom subjek permohonan harus diisi dengan maksimal 50 karakter.',
                'termohon.required' => 'Mohon masukkan pilihan termohon.'
            ]);

            DB::table('tanda_tangan')
                ->where('id_ttd', $id)
                ->update([
                    'subjek_permohonan' => $request->subjek_permohonan,
                    'termohon' => $request->termohon
                ]);
            return redirect()->route('tandatangan')->with('success', 'Pengajuan Tanda Tangan Berhasil di Ubah');
        }

        
    }
    public function delete(string $id)
    {
        DB::select('CALL delete_tandatangan("' . $id . '")');
        return redirect()->route('tandatangan', $id )->with('success', 'Permohonan Tanda Tangan Berhasil Dihapus!');
    }

    public function setujuTTD(string $id){
        //  set_time_limit(300);
        // Path ke file PDF yang ingin diubah menjadi QR Code

        $file = DB::table('tanda_tangan')->where('id_ttd', $id)->value('file_dokumen');
        $pejabat = collect(DB::select('CALL view_tandaTangan(?)', [$id]))
            ->pluck('name')
            ->map(function ($item) {
                return str_replace(' ', '', $item);
            })->first();
        // $tanggal = DB::table('tanda_tangan')->where('id_ttd', $id)->value('created_at');
        $pathToFile = public_path('files/Tanda-Tangan/' . $file);
        // if (!File::exists($pathToFile)) {
        //     return response()->json(['error' => 'File not found on server', 'path' => $pathToFile], 404);
        // }
        // Membaca isi file
        $fileContents = file_get_contents($pathToFile);
        
        // Generate QR Code dari konten file
        $urlToFile = url('files/Tanda-Tangan/' . $file);
        
        $qrcode = QrCode::format('png')->size(100)->generate($urlToFile);

        // Simpan QR Code ke file
        $outputFile = public_path('files/qrcodes/'.$file.'-'.$pejabat.'.png'); // Anda bisa mengubah path sesuai kebutuhan
        $nameFile = $file. '-' . $pejabat .'.png';
        file_put_contents($outputFile, $qrcode);

        DB::table('tanda_tangan')
            ->where('id_ttd', $id)
            ->update([
                'status' => 'Diterima',
                'qr_code' => $nameFile
        ]);

        // Kembalikan path dari QR Code yang dihasilkan
        return redirect()->route('TTD')->with('success', 'Tanda tangan berhasil dilakukan!');
        // return response()->json(['message' => 'QR Code generated successfully', 'path' => url('files/qrcodes/'.$nameFile)]);
    }

    public function tolakTTD(string $id){
        DB::table('tanda_tangan')
            ->where('id_ttd', $id)
            ->update([
                'status' => 'Ditolak'
            ]);

        // Kembalikan path dari QR Code yang dihasilkan
        return redirect()->route('TTD')->with('success', 'Tanda tangan berhasil ditolak!');
    }

    public function showEditor($id)
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

        $totalNotif = $total1 + $total2 + $total3;
        if ($totalNotif === 0) {
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        // Ambil nama file dari database
        $file = DB::table('tanda_tangan')->where('id_ttd', $id)->value('file_dokumen');
        $image = DB::table('tanda_tangan')->where('id_ttd', $id)->value('qr_code');

        if (!$file || !$image) {
            return response()->json(['error' => 'File or image not found in database'], 404);
        }
        return view('TTD/editor', [
            'totalNotif' => $totalNotif,
            'messages' => $messages,
            'file' => $file, 
            'image' => $image, 
            'id' => $id
        ]);
    }

    public function savePDF(Request $request)
    {
        $request->validate([
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'page' => 'required|numeric', // Menambahkan validasi untuk nomor halaman
            'id' => 'required|numeric'
        ]);

        $id = $request->input('id');
        $x = $request->input('x');
        $y = $request->input('y');
        $pageNum = $request->input('page'); // Mendapatkan nomor halaman dari input

        $image = DB::table('tanda_tangan')->where('id_ttd', $id)->value('qr_code');
        $imagePath = public_path('files/qrcodes/' . $image);

        // Ambil nama file dari database
        $file = DB::table('tanda_tangan')->where('id_ttd', $id)->value('file_dokumen');

        if (!$file) {
            return response()->json(['error' => 'File not found in database'], 404);
        }

        // Path ke file PDF yang ingin dimodifikasi
        $pathToFile = public_path('files/Tanda-Tangan/' . $file);

        // Membuat instance FPDI
        $pdf = new Fpdi();

        // Tambahkan halaman dari file PDF yang ada
        $pageCount = $pdf->setSourceFile($pathToFile);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $pdf->addPage();
            $pdf->useTemplate($templateId, ['adjustPageSize' => true]);

            // Menambahkan gambar ke halaman PDF pada posisi yang ditentukan
            if ($pageNo == $pageNum) { // Menambahkan gambar pada halaman yang sesuai dengan input
                $pdf->Image($imagePath, $x, $y, 22, 22); // Adjust size as needed
            }
        }

        // Simpan file PDF yang dimodifikasi
        $outputFile = public_path('files/Tanda-Tangan/' . $file);
        if (file_exists($outputFile)) {
            // Hapus file lama
            unlink($outputFile);
        }
        $pdf->Output($outputFile, 'F');

        DB::table('tanda_tangan')
            ->where('id_ttd', $id)
            ->update([
                'status_letak' => 1
            ]);

        return redirect()->route('tandatangan')->with('success', 'QRCode berhasil ditambahkan pada dokumen!');

    }



}
