<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $data = DB::table('sertifikat_tanah')->get();
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
    public function addSertifikat()
    {
        return view('Pengadilan/addSertifikatTanah');
    }

    public function storeSertifikat(Request $request)
    {
        $request->validate([
            'status_pihak' => '',
            'jenis_pihak' => '',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'umur' => 'required',
            'jenis_kelamin' => 'required',
            'warga_negara' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'pekerjaan' => 'required',
            'status_kawin' => 'required',
            'pendidikan' => 'required',
            'petitum' => 'required',
            'permohonan' => 'required',
        ]);

        $data = [
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
            'permohonan' => $request->permohonan,
        ];

        DB::table('sertifikat_tanah')->insert($data);

        return redirect()->route('pengadilan');
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sertifikat = DB::table('sertifikat_tanah')->where('id', $id)->first();
        return view('Pengadilan.detailSertifikatTanah', ['sertifikat_tanah' => $sertifikat]);
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
                'permohonan' => $request->permohonan,
            ]);

        $sertifikat = DB::table('sertifikat_tanah')->find($id);

        return redirect()->route('pengadilan', ['sertifikat_tanah' => $sertifikat]);
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
