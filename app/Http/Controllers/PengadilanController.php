<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengadilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $data = DB::table('pemblokiran_sertifikat')->get();
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
        return view('Pengadilan/addDataDiriSertifikat');
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
            'permohonan' => 'required',
        ]);

        $temporarySertifikat = session('temporary_sertifikat', []);

        try{
            DB::beginTransaction();

            // Buat UUID untuk sertifikat
            $dokumenUuid = Str::uuid();

            DB::table('dokumen_tanah')->insert([
                'kode_unik' => $dokumenUuid,
                'petitum' => $request->petitum,
                'dokumen_gugatan' => $request->dokumen_gugatan,
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
            return redirect()->route('pengadilan')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
    public function showDataAll()
    {
        return view('Pengadilan.DetailSertifikat.detailDataSertifikat');
    }

    public function show(string $id)
    {
        $sertifikat = DB::table('sertifikat_tanah')->where('id', $id)->first();
        return view('Pengadilan.DetailSertifikat.detailPihakSertifikat', ['sertifikat_tanah' => $sertifikat]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sertifikat = DB::table('sertifikat_tanah')->where('id', $id)->first();
        return view('Pengadilan.editSertifikatTanah', ['sertifikat_tanah' => $sertifikat]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('sertifikat_tanah')
            ->where('id', $id)
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
                'petitum' => $request->petitum,
                'dokumen_gugatan' => $request->dokumen_gugatan,
            ]);

        $sertifikat = DB::table('sertifikat_tanah')->find($id);

        return redirect()->route('pengadilan', ['sertifikat_tanah' => $sertifikat])->with('success', 'Data Berhasil di Tambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sertifikat = DB::table('sertifikat_tanah')->where('id', $id)->delete();
        return redirect()->route('pengadilan', ['sertifikat_tanah' => $sertifikat]);
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
