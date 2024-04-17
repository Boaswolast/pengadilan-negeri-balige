<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;

class PengadilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::select('CALL viewAll_sertifikatTanah()');
        $data = collect($data);
        return view('Pengadilan/pengadilan',['data' => $data]);
    }

    public function editSertifikat()
    {
        return view('Pengadilan/editSertifikatTanah');
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
    //Data Sementara
    public function addDataDiri()
    {
        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        $kecamatan = DB::table('districts')->get();
        return view('Pengadilan/addDataDiriSertifikat', [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }

     public function addTemporarySertifikat(Request $request)
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
 
         $temporarySertifikat = [
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
         // Simpan data dalam session atau variabel sementara
         session()->push('temporary_sertifikat', $temporarySertifikat);
 
         return redirect()->route('addSertifikatPengadilan')->with('success', 'Task Created Successfully!');
        // dd($request->all());
     }

    public function showTemporarySertifikat()
    {
        // Mengambil data sementara dari sesi
        $temporarySertifikat = session('temporary_sertifikat', []); 

        // Mengirim data sementara ke tampilan
        return view('Pengadilan/addSertifikatTanah')->with('temporarySertifikat', $temporarySertifikat);
    }
     //-- end Data Sementara--

    public function addSertifikat()
    {
        $temporarySertifikat = session('temporary_sertifikat', []);

        // Mengirim data sementara ke tampilan
        return view('Pengadilan/addSertifikatTanah')->with('temporarySertifikat', $temporarySertifikat);
    }

    public function storeSertifikat(Request $request){
        $request->validate([
            'petitum' => 'required',
            'dokumen_gugatan' => 'required|mimes:pdf,doc,docx',
        ]);

        $temporarySertifikat = session('temporary_sertifikat', []);

        try{
            DB::beginTransaction();

            // Buat UUID untuk sertifikat
            $dokumenUuid = Str::uuid();

            $dokumen = $request->file('dokumen_gugatan');
            $dokumenName = $dokumen->getClientOriginalName();
            $mimeType = $dokumen->getClientMimeType();
            $dokumenPath = $dokumen->storeAs('public/dokumen', $dokumenName);

            $dokumenPath = basename($dokumenPath);

            DB::table('pemblokiran_sertifikat')->insert([
                'kode_unik' => $dokumenUuid,
                'petitum' => $request->petitum,
                'dokumen_gugatan' => $dokumenPath,
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

            session()->forget('temporary_sertifikat');

            return redirect()->route('pengadilan')->with('success', 'Data telah disimpan.');
        }
        catch (\Exception $e) {
            DB::rollback();
            // dd($e->getMessage()); 
            // Tangani kesalahan jika terjadi
            return redirect()->route('addSertifikatPengadilan')->with('error', 'Terjadi kesalahan saat menyimpan data.');
            // dd($e->getMessage());
        }
    }
    // public function storeSertifikat(Request $request)
    // {
    //     $request->validate([
    //         'petitum' => 'required',
    //         'dokumen_gugatan' => 'required',
    //     ]);

    //     $temporarySertifikat = session('temporary_sertifikat', []);

    //     $insertData = [];
    //     // Loop melalui setiap item data dan masukkan ke dalam database
    //     foreach ($temporarySertifikat as $sertifikat) {
    //         $sertifikatData = [
    //             'status_pihak' => $sertifikat['status_pihak']?? null,
    //             'jenis_pihak' => $sertifikat['jenis_pihak']?? null,
    //             'nama' => $sertifikat['nama']?? null,
    //             'tempat_lahir' => $sertifikat['tempat_lahir']?? null,
    //             'tanggal_lahir' => $sertifikat['tanggal_lahir']?? null,
    //             'umur' => $sertifikat['umur']?? null,
    //             'jenis_kelamin' => $sertifikat['jenis_kelamin']?? null,
    //             'warga_negara' => $sertifikat['warga_negara']?? null,
    //             'alamat' => $sertifikat['alamat']?? null,
    //             'provinsi' => $sertifikat['provinsi']?? null,
    //             'kabupaten' => $sertifikat['kabupaten']?? null,
    //             'kecamatan' => $sertifikat['kecamatan']?? null,
    //             'kelurahan' => $sertifikat['kelurahan']?? null,
    //             'pekerjaan' => $sertifikat['pekerjaan']?? null,
    //             'status_kawin' => $sertifikat['status_kawin']?? null,
    //             'pendidikan' => $sertifikat['pendidikan']?? null,
    //             // Anda dapat menambahkan kolom lainnya sesuai kebutuhan
    //         ];

    //         $insertData = array_merge($insertData, $sertifikatData);
    //     }

    //     $requestData= [
    //         'petitum' => $request->petitum,
    //         'dokumen_gugatan' => $request->dokumen_gugatan,
    //     ];

    //     $insertData = array_merge($insertData, $requestData);

    //     try {
    //         DB::table('sertifikat_tanah')->insert($insertData);
    
    //         // Hapus data sementara dari sesi setelah data berhasil disimpan ke database
    //         session()->forget('temporary_sertifikat');
    
    //         return redirect()->route('pengadilan')->with('success', 'Data telah disimpan.');
    //     } catch (\Exception $e) {
    //         // Tangani kesalahan jika terjadi
    //         return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    //     }
    //     // dd($request->all());
    // }

    /**
     * Display the specified resource.
     */
    // detail sertifikat
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
        return view('Pengadilan.DetailSertifikat.detailDataSertifikat', [
            'dataDiriAll' => $dataDiriAll,
            'dataGugatan' => $dataGugatan,
            'dataPetitum' => $dataPetitum,
            'dataStatus' => $dataStatus,
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
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        return view('Pengadilan.DetailSertifikat.detailPihakSertifikat', ['sertifikat' => $sertifikat]);
    }

    public function showDeleted(string $id)
    {
        $sertifikatDeleted = DB::table('data_diri_pihak')->where('id_data_diri', $id)->delete();
        return redirect()->route('pengadilan')->with('success', 'Data berhasil dihapus');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        $kecamatan = DB::table('districts')->get();
        return view('Pengadilan.editSertifikatTanah', [
            'sertifikat_tanah' => $sertifikat,
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

        $sertifikat = DB::table('data_diri_pihak');

        return redirect()->route('detailSertifikat', ['id' => $id])->with('success', 'Data Berhasil di Ubah');
    }


    public function editPetitum(string $id)
    {
        $editPetitum = DB::select('CALL view_sertifikatTanah_petitum(?)', array($id));
        $editPetitum = collect($editPetitum);
        return view('Pengadilan.editPetitumSertifikat', [
            'editPetitum' => $editPetitum,
        ]);
    }

    public function updatePetitum(Request $request, string $id)
    {
        // dd($request->all());
        DB::table('pemblokiran_sertifikat')
            ->where('id_pemblokiran', $id)    
            ->update([
                'petitum' => $request->petitum,
            ]);

        $petitumSertifikat = DB::table('pemblokiran_sertifikat');

        return redirect()->route('pengadilan')->with('success', 'Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_unik)
    {
        DB::beginTransaction();
        try {
            $sertifikat = DB::table('pemblokiran_sertifikat')->where('kode_unik', $kode_unik)->first();
    
            DB::table('data_diri_pihak')->where('kode_unik', $kode_unik)->delete();
            DB::table('pemblokiran_sertifikat')->where('kode_unik', $kode_unik)->delete();
    
            DB::commit();
    
            return redirect()->route('pengadilan', ['pemblokiran_sertifikat' => $sertifikat])->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();
    
            // Tampilkan pesan error atau lakukan penanganan lain sesuai kebutuhan
            return redirect()->route('pengadilan')->with('error', 'Gagal menghapus data');
        }
        // $sertifikat = DB::table('sertifikat_tanah')->where('id', $id)->delete();
    }

    //coba coba
    public function temporary(){
        return view ('Pengadilan/coba');
    }

    public function showTemporaryData()
    {
        // Mengambil data sementara dari sesi
        $temporaryData = session('temporary_data', []);

        // Mengirim data sementara ke tampilan
        return view('Pengadilan/dataCoba')->with('temporaryData', $temporaryData);
    }

    public function addTemporaryData(Request $request)
    {
        $data = $request->input('data');
        $data2 = $request->input('data2');

        $temporaryData = [
            'data' => $data,
            'data2' => $data2,
        ];
        // Simpan data dalam session atau variabel sementara
        session()->push('temporary_data', $temporaryData);

        return redirect()->route('showTemporaryData')->with('success', 'Data telah ditambahkan sementara.');
    }

    public function saveData()
    {
        $temporaryData = session('temporary_data', []);
        
        if (!empty($temporaryData)) {
            // Loop melalui setiap item data dan masukkan ke dalam database
            $insertData = [];
            foreach ($temporaryData as $data) {
                if (isset($data['data']) && isset($data['data2'])) {
                    $insertData[] = [
                        'data' => $data['data'],
                        'data2' => $data['data2'],
                        // Anda dapat menambahkan kolom lainnya sesuai kebutuhan
                    ];
                }
            }

            DB::table('coba')->insert($insertData);
    
            // Hapus data sementara dari sesi setelah data berhasil disimpan ke database
            session()->forget('temporary_data');
    
            return redirect()->route('pengadilan')->with('success', 'Data telah disimpan.');
        } else {
            // Tidak ada data sementara yang tersimpan dalam sesi
            return redirect()->route('pengadilan')->with('error', 'Tidak ada data sementara untuk disimpan.');
        }
    }
}
