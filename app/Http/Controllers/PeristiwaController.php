<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PeristiwaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $data = DB::select('CALL viewAll_peristiwaPenting()');
        $data = collect($data);
        return view('Peristiwa/index',[
            'data' => $data,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

     public function addDataDiri()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        $kecamatan = DB::table('districts')->get();
        return view('Peristiwa/tambahPihakTemporary', [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
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
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);
        // Mengambil data sementara dari sesi
        $temporaryPeristiwa = session('temporary_peristiwa', []); 

        // Mengirim data sementara ke tampilan
        return view('Peristiwa/tambah', ['totalNotif' => $totalNotif, 'messages' => $messages])->with('temporaryPeristiwa', $temporaryPeristiwa);
    }

    public function create()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $temporaryPeristiwa = session('temporary_peristiwa', []);

        // Mengirim data sementara ke tampilan
        return view('Peristiwa/tambah', ['totalNotif' => $totalNotif, 'messages' => $messages])->with('temporaryPeristiwa', $temporaryPeristiwa);

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
        'putusanPN' => 'nullable|mimes:pdf',
        'putusanPT' => 'nullable|mimes:pdf',
        'putusanMA' => 'nullable|mimes:pdf',
        'reqTTD' => 'required'
    ],[
        'amarPutusan.required' => 'Mohon masukkan amar putusan.',
        'surat_pengantar.required' => 'Surat pengantar harus diunggah.',
        'surat_pengantar.mimes' => 'Surat pengantar harus berupa file PDF, DOC, atau DOCX.',
        'putusanPN.mimes' => 'File putusan PN harus berupa file PDF.',
        'putusanPT.mimes' => 'File putusan PT harus berupa file PDF.',
        'putusanMA.mimes' => 'File putusan MA harus berupa file PDF.',
        'reqTTD.required' => 'Permintaan tanda tangan harus dipilih.'
    ]);


        $temporaryPeristiwa = session('temporary_peristiwa', []);

        try{
            DB::beginTransaction();

            // Buat UUID untuk peristiwa
            $dokumenUuid = Str::uuid();
            $docPNName = null;
            $docPTName = null;
            $docMAName = null;
            
            if ($request->hasFile('putusanPN')) {
                // Ada file yang diunggah, lanjutkan proses
                $docPN = $request->file('putusanPN');
                $docPNName =  time() . '.' . $docPN->getClientOriginalName(); // Nama file unik dengan timestamp
                // $mimeType = $docPN->getClientMimeType();
                // $dokumenPathPN = $docPN->storeAs($docPNName);
                $docPN->move(public_path('files/putusanPN'), $docPNName);
            }

            if ($request->hasFile('putusanPT')) {
                // Ada file yang diunggah, lanjutkan proses
                $docPT = $request->file('putusanPT');
                $docPTName = time() . '.' . $docPT->getClientOriginalName();
                // $mimeType1 = $docPT->getClientMimeType();
                // $dokumenPathPT = $docPT->storeAs($docPTName);
                $docPT->move(public_path('files/putusanPT'), $docPTName);
            }

            if ($request->hasFile('putusanMA')) {
                // Ada file yang diunggah, lanjutkan proses
                $docMA = $request->file('putusanMA');
                $docMAName = time() . '.' . $docMA->getClientOriginalName();
                // $mimeType2 = $docMA->getClientMimeType();
                // $dokumenPathMA = $docMA->storeAs($docMAName);
                $docMA->move(public_path('files/putusanMA'), $docMAName);
            }

            $docSurat = $request->file('surat_pengantar');
            $docSuratName = time() . '.' . $docSurat->getClientOriginalName();
            // $mimeType3 = $docSurat->getClientMimeType();
            $dokumenPathSurat = $docSurat->storeAs($docSuratName);
            $docSurat->move(public_path('files/surat-pengantar'), $docSuratName);

            DB::table('peristiwa_penting')->insert([
                'kode_unik' => $dokumenUuid,
                'amar_putusan' => $request->amarPutusan,
                'putusan_pn' => $docPNName,
                'putusan_pt' => $docPTName,
                'putusan_ma' => $docMAName,
                'surat_pengantar' => $dokumenPathSurat,
                'tanda_tangan' => $request->requestTTD,
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
                    'nik' => $peristiwa['nik']?? null
                ]);
            }

            DB::commit();

            session()->forget('temporary_peristiwa');

            return redirect()->route('peristiwa')->with('success', 'Data telah disimpan.');
        }
        catch (\Exception $e) {
            DB::rollback();
            // dd($e->getMessage()); 
            // Tangani kesalahan jika terjadi
            return redirect()->route('peristiwa')->with('error', 'Terjadi kesalahan saat menyimpan data.');
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
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $provinsi = DB::table('provinces')->get();
        return view('Peristiwa/tambahPihak', [
            'provinsi' => $provinsi, 
            'id' => $id,
            'totalNotif' => $totalNotif,
            'messages' => $messages]);
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
 
         return redirect()->route('detailPeristiwa',$id)->with('success', 'Task Created Successfully!');
    }

    public function editPihak(string $idDiri, string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

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
        return view('Peristiwa/editPihak', [
            'provinsi' => $provinsi, 
            'id' => $id, 
            'data' => $data, 
            'kabupaten' => $kabupaten,
            'totalNotif' => $totalNotif, 
            'messages' => $messages]);
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
         return redirect()->route('detailPeristiwa',$id)->with('success', 'Data Diri Pihak Berhasil Diubah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $data = DB::select('CALL viewAll_peristiwaPenting_dataDiri(?)', array($id));
        $dataAmar = DB::select('CALL view_peristiwaPenting_amarPutusan(?)', array($id));
        $dataPutusan = DB::select('CALL view_peristiwaPenting_suratPutusan(?)', array($id));
        $dataPengantar = DB::select('CALL view_peristiwaPenting_suratPengantar(?)', array($id));
        $dataStatus = DB::select('CALL view_peristiwaPenting_status(?)', array($id));
        $data = collect($data);
        $dataAmar = collect($dataAmar);
        $dataPutusan = collect($dataPutusan);
        $dataPengantar = collect($dataPengantar);
        $dataStatus = collect($dataStatus);
        
        $kodeUnik = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('kode_unik')->first();
        $id = DB::table('peristiwa_penting')->where('id_peristiwa', $id)->pluck('id_peristiwa')->first();
        return view('Peristiwa/detail',[
            'data' => $data, 
            'kodeUnik' => $kodeUnik, 
            'id' => $id,
            'dataAmar' => $dataAmar,
            'dataPutusan' => $dataPutusan,
            'dataPengantar' => $dataPengantar,
            'dataStatus' => $dataStatus,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function showPihak(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $data = DB::select('CALL view_peristiwaPenting_dataDiri(?)', array($id));
        $data = collect($data);
        return view('Peristiwa/detailPihak',[
            'data' => $data,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
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

    // EDIT AMAR PUTUSAN
    public function editAmarPutusan(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $data = DB::select('CALL view_peristiwaPenting_amarPutusan("'.$id.'")');
        return view('Peristiwa/editAmarPutusan', [
            'data' => $data,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function updateAmarPutusan(Request $request, string $id)
    {
        // dd($request->all());
        DB::table('peristiwa_penting')
            ->where('id_peristiwa', $id)    
            ->update([
                'amar_putusan' => $request->amar_putusan,
            ]);

        return redirect()->route('detailPeristiwa',$id)->with('success', 'Amar Putusaan Berhasil di Ubah');
    }

    // EDIT SURAT PUTUSAN
    public function editSuratPutusan(string $id)
<<<<<<< HEAD
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

=======
    {   
>>>>>>> ae3098345f9010c1ac5dcaca76b7b1b67b03f197
        $data = DB::select('CALL view_peristiwaPenting_suratPutusan("'.$id.'")');
        return view('Peristiwa/editSuratPutusan', [
            'data' => $data, 
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function updateSuratPutusan(string $id, Request $request)
    {
        $request->validate([
            'putusanPN' => 'nullable|mimes:pdf',
            'putusanPT' => 'nullable|mimes:pdf',
            'putusanMA' => 'nullable|mimes:pdf'
        ],[
            'putusanPN.mimes' => 'File putusan PN harus berupa file PDF.',
            'putusanPT.mimes' => 'File putusan PT harus berupa file PDF.',
            'putusanMA.mimes' => 'File putusan MA harus berupa file PDF.'
        ]);
        
        $docMAName = null;
            
        if ($request->hasFile('putusanPN')) {
            $docPNName = null;
            $docLama = DB::table('peristiwa_penting')->where(["id_peristiwa" => $id])->value('putusan_pn');
            $docPN = $request->file('putusanPN');
            $docPNName =  time() . '.' . $docPN->getClientOriginalName(); // Nama file unik dengan timestamp
                
            // hapus file lama
            if ($docLama!=null) {
                $pathToFile = public_path('files/putusanPN/' . $docLama);

                    // Periksa apakah file lama ada sebelum mencoba menghapusnya
                if (file_exists($pathToFile)) {
                    // Hapus file lama
                    unlink($pathToFile);
                }
            }
            $docPN->move(public_path('files/putusanPN'), $docPNName);

            DB::table('peristiwa_penting')
            ->where('id_peristiwa', $id)    
            ->update([
                'putusan_pn' => $docPNName
            ]);

        }

        if ($request->hasFile('putusanPT')) {
            $docPTName = null;
            $docLamaPT = DB::table('peristiwa_penting')->where(["id_peristiwa" => $id])->value('putusan_pt');
            $docPT = $request->file('putusanPT');
            $docPTName =  time() . '.' . $docPT->getClientOriginalName(); // Nama file unik dengan timestamp
                
            // hapus file lama
            if ($docLamaPT!=null) {
                $pathToFile = public_path('files/putusanPT/' . $docLamaPT);

                    // Periksa apakah file lama ada sebelum mencoba menghapusnya
                if (file_exists($pathToFile)) {
                    // Hapus file lama
                    unlink($pathToFile);
                }
            }
            $docPT->move(public_path('files/putusanPT'), $docPTName);
            DB::table('peristiwa_penting')
            ->where('id_peristiwa', $id)    
            ->update([
                'putusan_pt' => $docPTName
            ]);
        }

        if ($request->hasFile('putusanMA')) {
            $docMAName = null;
            $docLamaMA = DB::table('peristiwa_penting')->where(["id_peristiwa" => $id])->value('putusan_ma');
            $docMA = $request->file('putusanMA');
            $docMAName =  time() . '.' . $docMA->getClientOriginalName(); // Nama file unik dengan timestamp
                
            // hapus file lama
            if ($docLamaMA!=null) {
                $pathToFile = public_path('files/putusanMA/' . $docLamaMA);

                    // Periksa apakah file lama ada sebelum mencoba menghapusnya
                if (file_exists($pathToFile)) {
                    // Hapus file lama
                    unlink($pathToFile);
                }
            }
            $docMA->move(public_path('files/putusanMA'), $docMAName);
            DB::table('peristiwa_penting')
            ->where('id_peristiwa', $id)    
            ->update([
                'putusan_ma' => $docMAName
            ]);
        }

        return redirect()->route('detailPeristiwa',$id)->with('success', 'Amar Putusaan Berhasil di Ubah');
    }

    public function editSuratPengantar(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);

        $data = DB::select('CALL view_peristiwaPenting_suratPengantar("'.$id.'")');
        return view('Peristiwa/editSuratPengantar', [
            'data' => $data,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function updateSuratPengantar(string $id, Request $request)
    {
        $request->validate([
        'surat_pengantar' => 'required|mimes:pdf,doc,docx'
    ],[
        'surat_pengantar.required' => 'Surat pengantar harus diunggah.',
        'surat_pengantar.mimes' => 'Surat pengantar harus berupa file PDF, DOC, atau DOCX.',
    ]);

    if ($request->hasFile('surat_pengantar')) {
            $docSPName = null;
            $docLamaSP = DB::table('peristiwa_penting')->where(["id_peristiwa" => $id])->value('surat_pengantar');
            $docSP = $request->file('surat_pengantar');
            $docSPName =  time() . '.' . $docSP->getClientOriginalName(); // Nama file unik dengan timestamp
                
            // hapus file lama
            if ($docLamaSP!=null) {
                $pathToFile = public_path('files/surat-pengantar/' . $docLamaSP);

                    // Periksa apakah file lama ada sebelum mencoba menghapusnya
                if (file_exists($pathToFile)) {
                    // Hapus file lama
                    unlink($pathToFile);
                }
            }
            $docSP->move(public_path('files/surat-pengantar'), $docSPName);
            DB::table('peristiwa_penting')
            ->where('id_peristiwa', $id)    
            ->update([
                'surat_pengantar' => $docSPName
            ]);
        }

        return redirect()->route('detailPeristiwa',$id)->with('success', 'Surat Pengantar Berhasil di Ubah');

    return  dd($request->surat_pengantar->getClientOriginalName());

        // try{
        //     DB::beginTransaction();

        //     $docPNName = null;
        //     $docPTName = null;
        //     $docMAName = null;
            
        //     if ($request->hasFile('putusanPN')) {
        //         // Ada file yang diunggah, lanjutkan proses
        //         $docPN = $request->file('putusanPN');
        //         $docPNName =  time() . '.' . $docPN->getClientOriginalName(); // Nama file unik dengan timestamp
        //         // $mimeType = $docPN->getClientMimeType();
        //         // $dokumenPathPN = $docPN->storeAs($docPNName);
        //         $docPN->move(public_path('files/putusanPN'), $docPNName);
        //     }

        //     if ($request->hasFile('putusanPT')) {
        //         // Ada file yang diunggah, lanjutkan proses
        //         $docPT = $request->file('putusanPT');
        //         $docPTName = time() . '.' . $docPT->getClientOriginalName();
        //         // $mimeType1 = $docPT->getClientMimeType();
        //         // $dokumenPathPT = $docPT->storeAs($docPTName);
        //         $docPT->move(public_path('files/putusanPT'), $docPTName);
        //     }

        //     if ($request->hasFile('putusanMA')) {
        //         // Ada file yang diunggah, lanjutkan proses
        //         $docMA = $request->file('putusanMA');
        //         $docMAName = time() . '.' . $docMA->getClientOriginalName();
        //         // $mimeType2 = $docMA->getClientMimeType();
        //         // $dokumenPathMA = $docMA->storeAs($docMAName);
        //         $docMA->move(public_path('files/putusanMA'), $docMAName);
        //     }

        //     $docSurat = $request->file('surat_pengantar');
        //     $docSuratName = time() . '.' . $docSurat->getClientOriginalName();
        //     // $mimeType3 = $docSurat->getClientMimeType();
        //     $dokumenPathSurat = $docSurat->storeAs($docSuratName);
        //     $docSurat->move(public_path('files/surat-pengantar'), $docSuratName);

        //     DB::table('peristiwa_penting')->insert([
        //         'kode_unik' => $dokumenUuid,
        //         'amar_putusan' => $request->amarPutusan,
        //         'putusan_pn' => $docPNName,
        //         'putusan_pt' => $docPTName,
        //         'putusan_ma' => $docMAName,
        //         'surat_pengantar' => $dokumenPathSurat,
        //         'tanda_tangan' => $request->requestTTD,
        //     ]);

        //     foreach ($temporaryPeristiwa as $peristiwa) {
        //         DB::table('data_diri_pihak')->insert([
        //             'kode_unik' => $dokumenUuid,
        //             'status_pihak' => $peristiwa['status_pihak']?? null,
        //             'jenis_pihak' => $peristiwa['jenis_pihak']?? null,
        //             'nama' => $peristiwa['nama']?? null,
        //             'tempat_lahir' => $peristiwa['tempat_lahir']?? null,
        //             'tanggal_lahir' => $peristiwa['tanggal_lahir']?? null,
        //             'umur' => $peristiwa['umur']?? null,
        //             'jenis_kelamin' => $peristiwa['jenis_kelamin']?? null,
        //             'warga_negara' => $peristiwa['warga_negara']?? null,
        //             'alamat' => $peristiwa['alamat']?? null,
        //             'provinsi' => $peristiwa['provinsi']?? null,
        //             'kabupaten' => $peristiwa['kabupaten']?? null,
        //             'kecamatan' => $peristiwa['kecamatan']?? null,
        //             'kelurahan' => $peristiwa['kelurahan']?? null,
        //             'pekerjaan' => $peristiwa['pekerjaan']?? null,
        //             'status_kawin' => $peristiwa['status_kawin']?? null,
        //             'pendidikan' => $peristiwa['pendidikan']?? null,
        //             'email' => $peristiwa['email']?? null,
        //             'no_telp' => $peristiwa['no_telp']?? null,
        //             'nik' => $peristiwa['nik']?? null
        //         ]);
        //     }

        //     DB::commit();

        //     session()->forget('temporary_peristiwa');

        //     return redirect()->route('peristiwa')->with('success', 'Data telah disimpan.');
        // }
        // catch (\Exception $e) {
        //     DB::rollback();
        //     // dd($e->getMessage()); 
        //     // Tangani kesalahan jika terjadi
        //     return redirect()->route('peristiwa')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        //     // dd($e->getMessage());
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return 'salo';
        DB::select('CALL delete_peristiwaPenting("'.$id.'")');
        return redirect()->route('peristiwa',$id,)->with('success', 'Data Peristiwa Berhasil Dihapus!');
    }

    public function deletePihak(string $idDiri, string $id)
    {
        DB::select('CALL delete_dataDiri("'.$idDiri.'")');
        return redirect()->route('detailPeristiwa',$id,)->with('success', 'Data Diri Pihak Berhasil Dihapus!');
    }
}
