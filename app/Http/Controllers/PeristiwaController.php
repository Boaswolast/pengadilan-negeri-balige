<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeristiwaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::select('CALL viewAll_peristiwaPenting()');
        $data = collect($data);
        return view('Peristiwa/index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */

     public function addDataDiri()
    {
        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        $kecamatan = DB::table('districts')->get();
        return view('Peristiwa/tambahPihakTemporary', [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
        ]);
    }

     public function addTemporaryPeristiwa(Request $request)
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
 
         $temporaryPeristiwa = [
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
         session()->push('temporary_peristiwa', $temporaryPeristiwa);
 
         return redirect()->route('addPeristiwa')->with('success', 'Data Diri Pihak Berhasil Ditambah!');
        // dd($request->all());
     }

    public function showTemporaryPeristiwa()
    {
        // Mengambil data sementara dari sesi
        $temporaryPeristiwa = session('temporary_peristiwa', []); 

        // Mengirim data sementara ke tampilan
        return view('Peristiwa/tambah')->with('temporaryPeristiwa', $temporaryPeristiwa);
    }

    public function create()
    {
        $temporaryPeristiwa = session('temporary_peristiwa', []);

        // Mengirim data sementara ke tampilan
        return view('Peristiwa/tambah')->with('temporaryPeristiwa', $temporaryPeristiwa);

        // $provinsi = DB::table('provinces')->get();
        // $kota = DB::table('cities')->get();
        // return view('Peristiwa/tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amarPutusan' => 'required',
            'surat_pengantar' => 'required|mimes:pdf,doc,docx',
        ]);

        $temporaryPeristiwa = session('temporary_peristiwa', []);

        try{
            DB::beginTransaction();

            // Buat UUID untuk peristiwa
            $dokumenUuid = Str::uuid();

            $dokumen = $request->file('dokumen_gugatan');
            $dokumenName = $dokumen->getClientOriginalName();
            $mimeType = $dokumen->getClientMimeType();
            $dokumenPath = $dokumen->storeAs($dokumenName);

            DB::table('pemblokiran_peristiwa')->insert([
                'kode_unik' => $dokumenUuid,
                'petitum' => $request->petitum,
                'dokumen_gugatan' => $dokumenPath,
            ]);

            foreach ($temporaryPeristiwa as $peristiwa) {
                DB::table('data_diri_pihak')->insert([
                    'kode_unik' => $dokumenUuid,
                    'status_pihak' => $peristiwa['status_pihak']?? null,
                    'jenis_pihak' => $peristiwa['jenis_pihak']?? null,
                    'nama' => $peristiwa['nama']?? null,
                    'tempat_lahir' => $peristiwa['tempat_lahir']?? null,
                    'tanggal_lahir' => $peristiwa['tanggal_lahir']?? null,
                    'umur' => $peristiwa['umur']?? null,
                    'jenis_kelamin' => $peristiwa['jenis_kelamin']?? null,
                    'warga_negara' => $peristiwa['warga_negara']?? null,
                    'alamat' => $peristiwa['alamat']?? null,
                    'provinsi' => $peristiwa['provinsi']?? null,
                    'kabupaten' => $peristiwa['kabupaten']?? null,
                    'kecamatan' => $peristiwa['kecamatan']?? null,
                    'kelurahan' => $peristiwa['kelurahan']?? null,
                    'pekerjaan' => $peristiwa['pekerjaan']?? null,
                    'status_kawin' => $peristiwa['status_kawin']?? null,
                    'pendidikan' => $peristiwa['pendidikan']?? null,
                    'email' => $peristiwa['email']?? null,
                    'no_telp' => $peristiwa['no_telp']?? null,
                    'nik' => $peristiwa['nik']?? null,
                    // Anda dapat menambahkan kolom lainnya sesuai kebutuhan
                ]);
            }

            DB::commit();

            session()->forget('temporary_peristiwa');

            return redirect()->route('pengadilan')->with('success', 'Data telah disimpan.');
        }
        catch (\Exception $e) {
            DB::rollback();
            // dd($e->getMessage()); 
            // Tangani kesalahan jika terjadi
            return redirect()->route('addPeristiwaPengadilan')->with('error', 'Terjadi kesalahan saat menyimpan data.');
            // dd($e->getMessage());
        }
    }

    public function getCities($provinsiId)
    {
        $cities = DB::table('cities')->where('prov_id', $provinsiId)->orderBy('city_name', 'asc')->get();
        return response()->json(['cities' => $cities]);
    }

    public function getDistricts($citiesId)
    {
        $districts = DB::table('districts')->where('city_id', $citiesId)->orderBy('dis_name', 'asc')->get();
        return response()->json(['districts' => $districts]);
    }

    public function getSubDistricts($districtsId)
    {
        $subDistricts = DB::table('subdistricts')->where('dis_id', $districtsId)->orderBy('subdis_name', 'asc')->get();
        return response()->json(['subDistricts' => $subDistricts]);
    }

    public function createPihak(string $id)
    {
        $provinsi = DB::table('provinces')->get();
        return view('Peristiwa/tambahPihak', ['provinsi' => $provinsi, 'id' => $id]);
    }

    public function storePihak(Request $request, string $id)
    {
        $provinsiId = $request->input('provinsi');
        $kabupatenId = $request->input('kabupaten');
        $kecamatanId = $request->input('kecamatan');
        $kelurahanId = $request->input('kelurahan');
        $kodeUnik = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('kode_unik')->first();

        $status_pihak = $request->input('status_pihak');
         $jenis_pihak = $request->input('jenis_pihak');
         $nama = $request->input('nama');
         $tempat_lahir = $request->input('tempat_lahir');
         $tanggal_lahir = $request->input('tanggal_lahir');
         $umur = $request->input('umur');
         $jenis_kelamin = $request->input('jenis_kelamin');
         $warga_negara = $request->input('warga_negara');
         $alamat = $request->input('alamat');
         $provinsi = DB::table('provinces')->where('prov_id', $provinsiId)->pluck('prov_name')->first();
         $kabupaten =  DB::table('cities')->where('city_id', $kabupatenId)->pluck('city_name')->first();
         $kecamatan =  DB::table('districts')->where('dis_id', $kecamatanId)->pluck('dis_name')->first();
         $kelurahan =  DB::table('subdistricts')->where('subdis_id', $kelurahanId)->pluck('subdis_name')->first();
         $pekerjaan = $request->input('pekerjaan');
         $status_kawin = $request->input('status_kawin');
         $pendidikan = $request->input('pendidikan');
         $email = $request->input('email');
         $no_telp = $request->input('no_telp');
         $nik = $request->input('nik');
 
        DB::table('data_diri_pihak')->insert([
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
             'kode_unik' => $kodeUnik,
             'created_by' => 'Admin'
         ]);
         // Simpan data dalam session atau variabel sementara
        //  session()->push('temporary_peristiwa', $temporaryPeristiwa);
 
         return redirect()->route('detailPeristiwa',$id)->with('success', 'Task Created Successfully!');
    }

    public function editPihak(string $idDiri, string $id)
    {
        $data = DB::table('data_diri_pihak')
                ->join('provinces', 'data_diri_pihak.provinsi', '=', 'provinces.prov_name')
                ->join('cities', 'data_diri_pihak.kabupaten', '=', 'cities.city_name')
                ->join('districts', 'data_diri_pihak.kecamatan', '=', 'districts.dis_name')
                ->where('id_data_diri', $idDiri)
                ->select('data_diri_pihak.*','provinces.prov_id','cities.city_id','districts.dis_id')
                ->get();
        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        // return $data;
        return view('Peristiwa/editPihak', ['provinsi' => $provinsi, 'id' => $id, 'data' => $data, 'kabupaten' => $kabupaten]);
    }

    public function updatePihak(string $idDiri, string $id, Request $request){
        $provinsiId = $request->input('provinsi');
        $kabupatenId = $request->input('kabupaten');
        $kecamatanId = $request->input('kecamatan');
        $kelurahanId = $request->input('kelurahan');

        $status_pihak = $request->input('status_pihak');
         $jenis_pihak = $request->input('jenis_pihak');
         $nama = $request->input('nama');
         $tempat_lahir = $request->input('tempat_lahir');
         $tanggal_lahir = $request->input('tanggal_lahir');
         $umur = $request->input('umur');
         $jenis_kelamin = $request->input('jenis_kelamin');
         $warga_negara = $request->input('warga_negara');
         $alamat = $request->input('alamat');
         $provinsi = DB::table('provinces')->where('prov_id', $provinsiId)->pluck('prov_name')->first();
         $kabupaten =  DB::table('cities')->where('city_id', $kabupatenId)->pluck('city_name')->first();
         $kecamatan =  DB::table('districts')->where('dis_id', $kecamatanId)->pluck('dis_name')->first();
         $kelurahan =  DB::table('subdistricts')->where('subdis_id', $kelurahanId)->pluck('subdis_name')->first();
         $pekerjaan = $request->input('pekerjaan');
         $status_kawin = $request->input('status_kawin');
         $pendidikan = $request->input('pendidikan');
         $email = $request->input('email');
         $no_telp = $request->input('no_telp');
         $nik = $request->input('nik');
 
        DB::table('data_diri_pihak')
            ->where('id_data_diri', $idDiri)
            ->update([
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
             'nik' => $nik
         ]);
         return redirect()->route('detailPeristiwa',$id,)->with('success', 'Data Diri Pihak Berhasil Diubah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::select('CALL viewAll_peristiwaPenting_dataDiri(?)', array($id));
        $data = collect($data);
        $kodeUnik = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('kode_unik')->first();
        $id = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('id_peristiwa')->first();
        return view('Peristiwa/detail',['data' => $data, 'kodeUnik' => $kodeUnik, 'id' => $id]);
    }

    public function showPihak(string $id)
    {
        $data = DB::select('CALL view_peristiwaPenting_dataDiri(?)', array($id));
        $data = collect($data);
        return view('Peristiwa/detailPihak',['data' => $data]);
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

    public function deletePihak(string $idDiri, string $id)
    {
        DB::select('CALL delete_dataDiri("'.$idDiri.'")');
        return redirect()->route('detailPeristiwa',$id,)->with('success', 'Data Diri Pihak Berhasil Dihapus!');
    }
}
