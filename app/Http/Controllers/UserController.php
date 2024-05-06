<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $temporaryPeristiwaUser = session('temporary_peristiwa_user', []);
        return view('User/user')->with('temporaryPeristiwaUser', $temporaryPeristiwaUser);
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
 
         return redirect()->route('showTemporaryPeristiwaUser')->with('success', 'Task Created Successfully!');
        // dd($request->all());
     }

    public function showTemporaryPeristiwaUser()
    {
        $temporaryPeristiwaUser = session('temporary_peristiwa_user', []); 
        return view('User/user')->with('temporaryPeristiwaUser', $temporaryPeristiwaUser);
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

            //dokumen1
            $dokumen1 = $request->file('surat_permohonan');
            $dokumenName1 = $dokumen1->getClientOriginalName();
            $mimeType1 = $dokumen1->getClientMimeType();
            $dokumenPath1 = $dokumen1->storeAs('public/dokumen', $dokumenName1);

            $dokumenPath1 = basename($dokumenPath1);

            //dokumen2
            $dokumen2 = $request->file('putusan_pn');
            $dokumenName2 = $dokumen2->getClientOriginalName();
            $mimeType2 = $dokumen2->getClientMimeType();
            $dokumenPath2 = $dokumen2->storeAs('public/dokumen', $dokumenName2);

            $dokumenPath2 = basename($dokumenPath2);

            //dokumen3
            $dokumen3 = $request->file('putusan_pt');
            $dokumenName3 = $dokumen3->getClientOriginalName();
            $mimeType3 = $dokumen3->getClientMimeType();
            $dokumenPath3 = $dokumen3->storeAs('public/dokumen', $dokumenName3);

            $dokumenPath3 = basename($dokumenPath3);

            //dokumen4
            $dokumen4 = $request->file('putusan_ma');
            $dokumenName4 = $dokumen4->getClientOriginalName();
            $mimeType4 = $dokumen4->getClientMimeType();
            $dokumenPath4 = $dokumen4->storeAs('public/dokumen', $dokumenName4);

            $dokumenPath4 = basename($dokumenPath4);

            DB::table('eksekusi')->insert([
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

            return redirect()->route('user')->with('success', 'Data telah disimpan.');
        }
        catch (\Exception $e) {
            DB::rollback();
            // dd($e->getMessage()); 
            // Tangani kesalahan jika terjadi
            return redirect()->route('user')->with('error', 'Terjadi kesalahan saat menyimpan data.');
            // dd($e->getMessage());
        }
    }

    public function homeUser()
    {
        return view('User/homeUser');
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
     * Display the specified resource.
     */
    public function show(string $id)
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
