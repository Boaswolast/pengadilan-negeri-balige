<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $dataAll = collect(DB::select('CALL viewAll_eksekusi_User(?)', [$userId]));
        $dataAll = collect($dataAll);
        return view('User/index',[
            'data' => $dataAll, 
        ]);
    }

    public function eksekusi()
    {
        $userId = Auth::id();

        // Fetching data from stored procedure and converting to collections
        $eksekusiData = collect(DB::select('CALL viewAll_eksekusi_User(?)', [$userId]));

        // Count the number of records for each status
        $countMenunggu = $eksekusiData->where('status_telaah', 'Menunggu')->count();
        $countStatusTelaahDiterima = $eksekusiData->where('status_telaah', 'Diterima')->count();

        $countProsesPembayaranAanmaning = $eksekusiData->filter(function($item) {
            return isset($item->proses) && ($item->proses == 'Pembayaran' || $item->proses == 'Aanmaning');
        })->count();

        $countStatusEksekusiDiproses = $eksekusiData->where('status_eksekusi', 'Diproses')->count();

        $countProses = $countStatusTelaahDiterima + $countProsesPembayaranAanmaning + $countStatusEksekusiDiproses;
        
        $countSelesai = DB::table('eksekusi')->where('users_id', $userId)->where('status_eksekusi', 'Selesai')->count();

        $temporaryPeristiwaUser = session('temporary_peristiwa_user', []);

        return view('User/user', [
            'countMenunggu' => $countMenunggu,
            'countProses' => $countProses,
            'countSelesai' => $countSelesai,
            'temporaryPeristiwaUser' => $temporaryPeristiwaUser,
        ]);
    }

    public function addDataDiriPihak()
    {
        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        $kecamatan = DB::table('districts')->get();
        return view('User/addDataDiriPihak', [
            'provinsi' => $provinsi, 
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function getCitiess($provinsiId)
    {
        $cities = DB::table('cities')->where('prov_id', $provinsiId)->orderBy('city_name', 'asc')->get();
        return response()->json(['cities' => $cities]);
    }

    public function getDistrictss($citiesId)
    {
        $districts = DB::table('districts')->where('city_id', $citiesId)->orderBy('dis_name', 'asc')->get();
        return response()->json(['districts' => $districts]);
    }

    public function getSubDistrictss($districtsId)
    {
        $subDistricts = DB::table('subdistricts')->where('dis_id', $districtsId)->orderBy('subdis_name', 'asc')->get();
        return response()->json(['subDistricts' => $subDistricts]);
    }

    public function addTemporaryPeristiwaUser(Request $request)
     {
         $status_pihak = $request->input('status_pihak');
         $jenis_pihak = $request->input('jenis_pihak');
         $nama = $request->input('nama');
         $tempat_lahir = $request->input('tempat_lahir');
         $tanggal_lahir = $request->input('tanggal_lahir');
         $umur = $request->input('umur');
         $jenis_kelamin = $request->input('jenis_kelamin');
         $warga_negara = $request->input('warga_negara');
         $alamat = $request->input('alamat');
         $provinsi = $request->input('provinsi');
         $kabupaten = $request->input('kabupaten');
         $kecamatan = $request->input('kecamatan');
         $kelurahan = $request->input('kelurahan');
         $pekerjaan = $request->input('pekerjaan');
         $status_kawin = $request->input('status_kawin');
         $pendidikan = $request->input('pendidikan');
         $email = $request->input('email');
         $no_telp = $request->input('no_telp');
         $nik = $request->input('nik');
 
         $temporaryPeristiwaUser = [
             'status_pihak' => $status_pihak,
             'jenis_pihak' => $jenis_pihak,
             'nama' => $nama,
             'tempat_lahir' => $tempat_lahir,
             'tanggal_lahir' => $tanggal_lahir,
             'umur' => $umur,
             'jenis_kelamin' => $jenis_kelamin,
             'warga_negara' => $warga_negara,
             'alamat' => $alamat,
             'provinsi' => $provinsi,
             'kabupaten' => $kabupaten,
             'kecamatan' => $kecamatan,
             'kelurahan' => $kelurahan,
             'pekerjaan' => $pekerjaan,
             'status_kawin' => $status_kawin,
             'pendidikan' => $pendidikan,
             'email' => $email,
             'no_telp' => $no_telp,
             'nik' => $nik,
         ];
         session()->push('temporary_peristiwa_user', $temporaryPeristiwaUser);
 
         return redirect()->route('user')->with('success', 'Task Created Successfully!');
        // dd($request->all());
     }

    public function showTemporaryPeristiwaUser()
    {
        $userId = Auth::id();

        // Fetching data from stored procedure and converting to collections
        $eksekusiData = collect(DB::select('CALL viewAll_eksekusi_User(?)', [$userId]));

        // Count the number of records for each status
        $countMenunggu = $eksekusiData->where('status_telaah', 'Menunggu')->count();
        $countStatusTelaahDiterima = $eksekusiData->where('status_telaah', 'Diterima')->count();

        $countProsesPembayaranAanmaning = $eksekusiData->filter(function($item) {
            return isset($item->proses) && ($item->proses == 'Pembayaran' || $item->proses == 'Aanmaning');
        })->count();

        $countStatusEksekusiDiproses = $eksekusiData->where('status_eksekusi', 'Diproses')->count();

        $countProses = $countStatusTelaahDiterima + $countProsesPembayaranAanmaning + $countStatusEksekusiDiproses;
        
        $countSelesai = DB::table('eksekusi')->where('users_id', $userId)->where('status_eksekusi', 'Selesai')->count();

        $temporaryPeristiwaUser = session('temporary_peristiwa_user', []); 
        return view('User/user', [
            'countMenunggu' => $countMenunggu,
            'countProses' => $countProses,
            'countSelesai' => $countSelesai,
        ])->with('temporaryPeristiwaUser', $temporaryPeristiwaUser);
    }

    public function storeEksekusi(Request $request){
        $request->validate([
            'jenis_eksekusi' => 'required',
            'surat_permohonan' => 'required|mimes:pdf,doc,docx',
            'putusan_pn' => 'required|mimes:pdf,doc,docx',
            'putusan_pt' => 'required|mimes:pdf,doc,docx',
            'putusan_ma' => 'required|mimes:pdf,doc,docx',
        ]);

        $temporarySertifikat = session('temporary_peristiwa_user', []);

        try{
            DB::beginTransaction();

            // Buat UUID untuk sertifikat
            $dokumenUuid = Str::uuid();
            $user_id = Auth::id();

            $telaah_id = DB::table('telaah')->insertGetId([
                'status_telaah' => 'Menunggu',
            ]);

            //dokumen1
            $dokumen1 = $request->file('surat_permohonan');
            $dokumenName1 = $dokumen1->getClientOriginalName();
            $mimeType1 = $dokumen1->getClientMimeType();
            $dokumenPath1 = $dokumen1->move(public_path('dokumen/User/Permohonan'), $dokumenName1);

            $dokumenPath1 = basename($dokumenPath1);

            //dokumen2
            $dokumen2 = $request->file('putusan_pn');
            $dokumenName2 = $dokumen2->getClientOriginalName();
            $mimeType2 = $dokumen2->getClientMimeType();
            $dokumenPath2 = $dokumen2->move(public_path('dokumen/User/PN'), $dokumenName2);

            $dokumenPath2 = basename($dokumenPath2);

            //dokumen3
            $dokumen3 = $request->file('putusan_pt');
            $dokumenName3 = $dokumen3->getClientOriginalName();
            $mimeType3 = $dokumen3->getClientMimeType();
            $dokumenPath3 = $dokumen3->move(public_path('dokumen/User/PT'), $dokumenName3);

            $dokumenPath3 = basename($dokumenPath3);

            //dokumen4
            $dokumen4 = $request->file('putusan_ma');
            $dokumenName4 = $dokumen4->getClientOriginalName();
            $mimeType4 = $dokumen4->getClientMimeType();
            $dokumenPath4 = $dokumen4->move(public_path('dokumen/User/MA'), $dokumenName4);

            $dokumenPath4 = basename($dokumenPath4);

            DB::table('eksekusi')->insert([
                'telaah_id' => $telaah_id,
                'users_id' => $user_id,
                'kode_unik' => $dokumenUuid,
                'jenis_eksekusi' => $request->jenis_eksekusi,
                'surat_permohonan' => $dokumenPath1,
                'putusan_pn' => $dokumenPath2,
                'putusan_pt' => $dokumenPath3,
                'putusan_ma' => $dokumenPath4,
            ]);

            foreach ($temporarySertifikat as $sertifikat) {
                DB::table('data_diri_pihak')->insert([
                    'kode_unik' => $dokumenUuid,
                    'status_pihak' => $sertifikat['status_pihak']?? null,
                    'jenis_pihak' => $sertifikat['jenis_pihak']?? null,
                    'nama' => $sertifikat['nama']?? null,
                    'tempat_lahir' => $sertifikat['tempat_lahir']?? null,
                    'tanggal_lahir' => $sertifikat['tanggal_lahir']?? null,
                    'umur' => $sertifikat['umur']?? null,
                    'jenis_kelamin' => $sertifikat['jenis_kelamin']?? null,
                    'warga_negara' => $sertifikat['warga_negara']?? null,
                    'alamat' => $sertifikat['alamat']?? null,
                    'provinsi' => $sertifikat['provinsi']?? null,
                    'kabupaten' => $sertifikat['kabupaten']?? null,
                    'kecamatan' => $sertifikat['kecamatan']?? null,
                    'kelurahan' => $sertifikat['kelurahan']?? null,
                    'pekerjaan' => $sertifikat['pekerjaan']?? null,
                    'status_kawin' => $sertifikat['status_kawin']?? null,
                    'pendidikan' => $sertifikat['pendidikan']?? null,
                    'email' => $sertifikat['email']?? null,
                    'no_telp' => $sertifikat['no_telp']?? null,
                    'nik' => $sertifikat['nik']?? null,
                    // Anda dapat menambahkan kolom lainnya sesuai kebutuhan
                ]);
            }

            DB::commit();

            session()->forget('temporary_peristiwa_user');

            return redirect()->route('indexUser')->with('success', 'Data telah disimpan.');
        }
        catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage()); 
            // Tangani kesalahan jika terjadi
            // return redirect()->route('user')->with('error', 'Terjadi kesalahan saat menyimpan data.');
            // dd($e->getMessage());
        }
    }

    public function showDataAllEksekusi(string $id)
    {
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
        return view('User.detailEksekusiUser', [
            'dataDiriAll' => $dataDiriAll,
            // 'status' => $status, 
            // 'id' => $id,
            'dataAanmaning' => $dataAanmaning,
            'dataPermohonan' => $dataPermohonan,
            'dataPembayaran' => $dataPembayaran,
            'dataTelaah' => $dataTelaah,
        ]);
    }

    public function show(string $id)
    {
        $eksekusi = DB::select('CALL view_eksekusi_dataDiri(?)', array($id));
        $eksekusi = collect($eksekusi);
        return view('User.detailDataDiriEksekusiUser', [
            'eksekusi' => $eksekusi, 
        ]);
    }

    public function edit(string $id)
    {

        $eksekusi = DB::select('CALL view_eksekusi_dataDiri(?)', array($id));
        $eksekusi = collect($eksekusi);
        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        $kecamatan = DB::table('districts')->get();
        return view('User.editDataDiriEksekusiUser', [
            'editDataDiriEksekusi' => $eksekusi,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('data_diri_pihak')
            ->where('id_data_diri', $id)
            ->update([
                'status_pihak' => $request->status_pihak,
                'jenis_pihak' => $request->jenis_pihak,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'umur' => $request->umur,
                'jenis_kelamin' => $request->jenis_kelamin,
                'warga_negara' => $request->warga_negara,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'pekerjaan' => $request->pekerjaan,
                'status_kawin' => $request->status_kawin,
                'pendidikan' => $request->pendidikan,
                'nik' => $request->nik,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
            ]);

        $eksekusi = DB::table('data_diri_pihak');

        return redirect()->route('indexUser')->with('success', 'Data Berhasil di Ubah');
    }

    public function homeUser()
    {
        return view('User/homeUser');
    }

    public function printResume($file)
    {
        $path = public_path('dokumen/Eksekusi/' . $file);

        // Periksa apakah file ada
        if (!file_exists($path)) {
            return response()->json(['error' => 'File tidak ditemukan'], 404);
        }

        return response()->file($path);
    }

    public function halamanPembayaran(string $id)
    {
        $dataPembayaran = DB::select('CALL view_eksekusi_pembayaran(?)', array($id));
        $dataPembayaran = collect($dataPembayaran);
        return view('User/uploadPembayaran', [
            'dataPembayaran' => $dataPembayaran,
        ]);
    }

    public function pembayaran(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx',
            'keterangan' => 'required',
        ]);
        
        $post = DB::table('pembayaran')->where('id_pembayaran', $id)->first();

        // dd($post);
        if ($post) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('bukti_pembayaran')) {
                // Simpan file dokumen
                $document = $request->file('bukti_pembayaran');
                $documentName = $document->getClientOriginalName();
                $mimeType = $document->getClientMimeType();
                $documentPath = $document->move(public_path('dokumen/Pembayaran'), $documentName);

                $documentPath = basename($documentPath);

                $aanmaningId = DB::table('aanmaning')->insertGetId([
                    'status_aanmaning' => 'Menunggu', 
                ]);

                $status_pembayaran = 'Sudah Bayar';
                $tgl_pembayaran = now();

                // Update status dan tambahkan path dokumen
                DB::table('pembayaran')->where('id_pembayaran', $id)->update([
                    'status_pembayaran' => $status_pembayaran,
                    'tgl_pembayaran' => $tgl_pembayaran,
                    'keterangan' => $request->keterangan,
                    'bukti_pembayaran' => $documentPath
                ]);

                DB::table('eksekusi')->where('pembayaran_id', $id)->update([
                    'proses' => 'Pembayaran',
                    'aanmaning_id' => $aanmaningId
                ]);

                return redirect()->route('indexUser')->with('success', 'Konfirmasi Terkirim');
            } else {
                return redirect()->route('indexUser')->with('error', 'Terjadi kesalahan');
            }
        } else {
            return redirect()->route('indexUser')->with('error', 'Terjadi kesalahan');
        }
    }

    public function halamanUploadUlangPembayaran(string $id)
    {
        $dataPembayaran = DB::select('CALL view_eksekusi_pembayaran(?)', array($id));
        $dataPembayaran = collect($dataPembayaran);
        return view('User/uploadUlangPembayaran', [
            'dataPembayaran' => $dataPembayaran,
        ]);
    }

    public function uploadUlangPembayaran(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx',
            'keterangan' => 'required',
        ]);
        
        $post = DB::table('pembayaran')->where('id_pembayaran', $id)->first();

        // dd($post);
        if ($post) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('bukti_pembayaran')) {
                // Simpan file dokumen
                $document = $request->file('bukti_pembayaran');
                $documentName = $document->getClientOriginalName();
                $mimeType = $document->getClientMimeType();
                $documentPath = $document->move(public_path('dokumen/Pembayaran'), $documentName);

                $documentPath = basename($documentPath);

                $status_pembayaran = 'Sudah Bayar';
                $tgl_pembayaran = now();

                // Update status dan tambahkan path dokumen
                DB::table('pembayaran')->where('id_pembayaran', $id)->update([
                    'status_pembayaran' => $status_pembayaran,
                    'tgl_pembayaran' => $tgl_pembayaran,
                    'keterangan' => $request->keterangan,
                    'bukti_pembayaran' => $documentPath
                ]);

                return redirect()->route('indexUser')->with('success', 'Konfirmasi Terkirim');
            } else {
                return redirect()->route('indexUser')->with('error', 'Terjadi kesalahan');
            }
        } else {
            return redirect()->route('indexUser')->with('error', 'Terjadi kesalahan');
        }
    }

    public function download(Request $request, $file)
    {
        $filePath = public_path('dokumen/Pembayaran/' . $file);

        return response()->download($filePath);
    }
}
