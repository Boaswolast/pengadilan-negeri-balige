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
    public function create()
    {
        $provinsi = DB::table('provinces')->get();
        $kota = DB::table('cities')->get();
        return view('Peristiwa/tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function storePihak(string $id, Request $request)
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
             'kode_unik' => $kodeUnik,
             'created_by' => 'Admin'
         ];
         // Simpan data dalam session atau variabel sementara
         session()->push('temporary_sertifikat', $temporarySertifikat);
 
         return redirect()->route('detailPeristiwa',$id)->with('success', 'Task Created Successfully!');
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
}
