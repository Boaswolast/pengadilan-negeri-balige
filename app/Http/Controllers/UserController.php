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
 
         return redirect()->route('addDataDiriPihak')->with('success', 'Task Created Successfully!');
        // dd($request->all());
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
