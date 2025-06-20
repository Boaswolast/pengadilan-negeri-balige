<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
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
        $kelurahan = DB::table('subdistricts')->get();
        return view('User/addDataDiriPihak', [
            'provinsi' => $provinsi, 
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
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
        $request->validate([
            'status_pihak' => 'required',
            'jenis_pihak' => 'required',
            'nama' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'tempat_lahir' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'tanggal_lahir' => 'required',
            'umur' => 'required|integer|min:1',
            'jenis_kelamin' => 'required',
            'warga_negara' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'pekerjaan' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'status_kawin' => 'required',
            'pendidikan' => 'required',
            'nik' => 'required|numeric|digits:16',
            'email' => 'required|email',
            'no_telp' => 'required|numeric|digits_between:11,13',
            // Validasi lainnya sesuai kebutuhan
        ],[
            'status_pihak.required' => 'Kolom Status Pihak harus diisi',
            'jenis_pihak.required' => 'Kolom Jenis Pihak harus diisi',
            'nama.required' => 'Kolom Nama harus diisi',
            'nama.regex' => 'Kolom Nama hanya boleh berisi huruf dan spasi',
            'tempat_lahir.required' => 'Kolom Tempat Lahir harus diisi',
            'tempat_lahir.regex' => 'Kolom Tempat Lahir hanya boleh berisi huruf dan spasi',
            'tanggal_lahir.required' => 'Kolom Tanggal Lahir harus diisi',
            'umur.required' => 'Kolom Umur harus diisi',
            'umur.min' => 'Kolom Umur harus diisi dengan angka positif',
            'jenis_kelamin.required' => 'Kolom Jenis Kelamin harus diisi',
            'warga_negara.required' => 'Kolom Warga Negara harus diisi',
            'warga_negara.regex' => 'Kolom Warga Negara hanya boleh berisi huruf dan spasi',
            'alamat.required' => 'Kolom Alamat harus diisi',
            'provinsi.required' => 'Kolom Provinsi harus diisi',
            'kabupaten.required' => 'Kolom Kabupaten harus diisi',
            'kecamatan.required' => 'Kolom Kecamatan harus diisi',
            'kelurahan.required' => 'Kolom Kelurahan harus diisi',
            'pekerjaan.required' => 'Kolom Pekerjaan harus diisi',
            'pekerjaan.regex' => 'Kolom Pekerjaan hanya boleh berisi huruf dan spasi',
            'status_kawin.required' => 'Kolom Status Kawin harus diisi',
            'pendidikan.required' => 'Kolom Pendidikan harus diisi',
            'nik.required' => 'Kolom NIK harus diisi',
            'nik.numeric' => 'Kolom NIK harus diisi dengan angka',
            'nik.digits' => 'Kolom NIK harus diisi dengan 16 angka',
            'email.required' => 'Kolom email harus diisi',
            'email.email' => 'Kolom email harus diisi dengan format yang valid',
            'no_telp.required' => 'Kolom nomor telepon harus diisi',
            'no_telp.numeric' => 'Kolom nomor telepon harus diisi dengan angka',
            'no_telp.digits_between' => 'Kolom nomor telepon harus diisi dengan 11 hingga 13 angka',
        ]);
    
        // Ambil input dari request
        $nik = $request->input('nik');
        $email = $request->input('email');
        $no_telp = $request->input('no_telp');
        $provinsiId = $request->input('provinsi');
        $kabupatenId = $request->input('kabupaten');
        $kecamatanId = $request->input('kecamatan');
        $kelurahanId = $request->input('kelurahan');
    
        // Ambil data sementara dari session
        $temporaryPeristiwaUsers = session()->get('temporary_peristiwa_user', []);
    
        // Periksa apakah nik, email, atau no_telp sudah ada dalam data sementara
        foreach ($temporaryPeristiwaUsers as $peristiwa) {
            if ($peristiwa['nik'] == $nik) {
                return redirect()->back()->withErrors(['nik' => 'NIK ini sudah digunakan'])->withInput();
            }
            if ($peristiwa['email'] == $email) {
                return redirect()->back()->withErrors(['email' => 'Email ini sudah digunakan'])->withInput();
            }
            if ($peristiwa['no_telp'] == $no_telp) {
                return redirect()->back()->withErrors(['no_telp' => 'Nomor Telepon ini sudah digunakan'])->withInput();
            }
        }
    
        // Siapkan data untuk disimpan ke session
        $temporaryPeristiwaUser = [
            'status_pihak' => $request->input('status_pihak'),
            'jenis_pihak' => $request->input('jenis_pihak'),
            'nama' => $request->input('nama'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'umur' => $request->input('umur'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'warga_negara' => $request->input('warga_negara'),
            'alamat' => $request->input('alamat'),
            'provinsi' => DB::table('provinces')->where('prov_id', $provinsiId)->pluck('prov_name')->first(),
            'kabupaten' => DB::table('cities')->where('city_id', $kabupatenId)->pluck('city_name')->first(),
            'kecamatan' => DB::table('districts')->where('dis_id', $kecamatanId)->pluck('dis_name')->first(),
            'kelurahan' => DB::table('subdistricts')->where('subdis_id', $kelurahanId)->pluck('subdis_name')->first(),
            'pekerjaan' => $request->input('pekerjaan'),
            'status_kawin' => $request->input('status_kawin'),
            'pendidikan' => $request->input('pendidikan'),
            'email' => $email,
            'no_telp' => $no_telp,
            'nik' => $nik,
        ];
    
        // Simpan data dalam session
        session()->push('temporary_peristiwa_user', $temporaryPeristiwaUser);
    
        return redirect()->route('user')->with('success', 'Task Created Successfully!');
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
        // Custom validation
        $validator = Validator::make($request->all(), [
            'jenis_eksekusi' => 'required',
            'surat_permohonan' => 'required|mimes:pdf,doc,docx',
            'putusan_pn' => 'nullable|mimes:pdf',
            'putusan_pt' => 'nullable|mimes:pdf',
            'putusan_ma' => 'nullable|mimes:pdf',
        ], [
            'jenis_eksekusi.required' => 'Jenis eksekusi wajib diisi.',
            'surat_permohonan.required' => 'Surat permohonan wajib diunggah.',
            'surat_permohonan.mimes' => 'Surat permohonan harus berupa file dengan format: pdf, doc, atau docx.',
            'putusan_pn.mimes' => 'Putusan PN harus berupa file dengan format: pdf.',
            'putusan_pt.mimes' => 'Putusan PT harus berupa file dengan format: pdf.',
            'putusan_ma.mimes' => 'Putusan MA harus berupa file dengan format: pdf.',
        ]);

        $files = [
            $request->file('surat_permohonan'),
            $request->file('putusan_pn'),
            $request->file('putusan_pt'),
            $request->file('putusan_ma'),
        ];
    
        $fileNames = [];
        foreach ($files as $file) {
            if ($file) {
                $fileName = $file->getClientOriginalName();
                if (in_array($fileName, $fileNames)) {
                    return back()->withErrors(['File dengan nama ' . $fileName . ' sudah diunggah.'])->withInput();
                }
                $fileNames[] = $fileName;
            }
        }
    
        // Custom rule to check that at least one of the three files is provided
        $validator->after(function ($validator) use ($request) {
            if (!$request->hasFile('putusan_pn') && !$request->hasFile('putusan_pt') && !$request->hasFile('putusan_ma')) {
                $validator->errors()->add('putusan_pn', 'Setidaknya salah satu dari putusan PN, PT, atau MA harus diunggah.');
            }
        });
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Rest of your code
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
            $dokumenName1 = time() . '.' . $dokumen1->getClientOriginalName();
            $mimeType1 = $dokumen1->getClientMimeType();
            $dokumenPath1 = $dokumen1->move(public_path('dokumen/User/Permohonan'), $dokumenName1);
            $dokumenPath1 = basename($dokumenPath1);
    
            //dokumen2
            $dokumenPath2 = null;
            if ($request->hasFile('putusan_pn')) {
                $dokumen2 = $request->file('putusan_pn');
                $dokumenName2 = time() . '.' . $dokumen2->getClientOriginalName();
                $mimeType2 = $dokumen2->getClientMimeType();
                $dokumenPath2 = $dokumen2->move(public_path('dokumen/User/PN'), $dokumenName2);
                $dokumenPath2 = basename($dokumenPath2);
            }
    
            //dokumen3
            $dokumenPath3 = null;
            if ($request->hasFile('putusan_pt')) {
                $dokumen3 = $request->file('putusan_pt');
                $dokumenName3 = time() . '.' . $dokumen3->getClientOriginalName();
                $mimeType3 = $dokumen3->getClientMimeType();
                $dokumenPath3 = $dokumen3->move(public_path('dokumen/User/PT'), $dokumenName3);
                $dokumenPath3 = basename($dokumenPath3);
            }
    
            //dokumen4
            $dokumenPath4 = null;
            if ($request->hasFile('putusan_ma')) {
                $dokumen4 = $request->file('putusan_ma');
                $dokumenName4 = time() . '.' . $dokumen4->getClientOriginalName();
                $mimeType4 = $dokumen4->getClientMimeType();
                $dokumenPath4 = $dokumen4->move(public_path('dokumen/User/MA'), $dokumenName4);
                $dokumenPath4 = basename($dokumenPath4);
            }
    
            DB::table('eksekusi')->insert([
                'telaah_id' => $telaah_id,
                'users_id' => $user_id,
                'kode_unik' => $dokumenUuid,
                'jenis_eksekusi' => $request->jenis_eksekusi,
                'surat_permohonan' => $dokumenPath1,
                'putusan_pn' => $dokumenPath2,
                'putusan_pt' => $dokumenPath3,
                'putusan_ma' => $dokumenPath4,
                'is_read_byPN' => 1
            ]);
    
            foreach ($temporarySertifikat as $sertifikat) {
                DB::table('data_diri_pihak')->insert([
                    'kode_unik' => $dokumenUuid,
                    'status_pihak' => $sertifikat['status_pihak'] ?? null,
                    'jenis_pihak' => $sertifikat['jenis_pihak'] ?? null,
                    'nama' => $sertifikat['nama'] ?? null,
                    'tempat_lahir' => $sertifikat['tempat_lahir'] ?? null,
                    'tanggal_lahir' => $sertifikat['tanggal_lahir'] ?? null,
                    'umur' => $sertifikat['umur'] ?? null,
                    'jenis_kelamin' => $sertifikat['jenis_kelamin'] ?? null,
                    'warga_negara' => $sertifikat['warga_negara'] ?? null,
                    'alamat' => $sertifikat['alamat'] ?? null,
                    'provinsi' => $sertifikat['provinsi'] ?? null,
                    'kabupaten' => $sertifikat['kabupaten'] ?? null,
                    'kecamatan' => $sertifikat['kecamatan'] ?? null,
                    'kelurahan' => $sertifikat['kelurahan'] ?? null,
                    'pekerjaan' => $sertifikat['pekerjaan'] ?? null,
                    'status_kawin' => $sertifikat['status_kawin'] ?? null,
                    'pendidikan' => $sertifikat['pendidikan'] ?? null,
                    'email' => $sertifikat['email'] ?? null,
                    'no_telp' => $sertifikat['no_telp'] ?? null,
                    'nik' => $sertifikat['nik'] ?? null,
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

        $eksekusi = DB::select('CALL view_eksekusi_dataDiri(?)', [$id]);
        $eksekusi = collect($eksekusi)->first();
        
        $namaProvinsi = $eksekusi ? $eksekusi->provinsi : null;

        $selectedProvinsi = null;
        if ($namaProvinsi) {
            $provinsiData = DB::table('provinces')->where('prov_name', $namaProvinsi)->first();
            if ($provinsiData) {
                $selectedProvinsi = $provinsiData->prov_id;
            }
        }

        // Ambil data kabupaten berdasarkan ID provinsi
        $selectedKabupaten = null;
        if ($selectedProvinsi) {
            $kabupatenData = DB::table('cities')->where('prov_id', $selectedProvinsi)->first();
            if ($kabupatenData) {
                $selectedKabupaten = $kabupatenData->city_id;
            }
        }

        // Ambil data kecamatan berdasarkan ID kabupaten
        $selectedKecamatan = null;
        if ($selectedKabupaten) {
            $kecamatanData = DB::table('districts')->where('city_id', $selectedKabupaten)->first();
            if ($kecamatanData) {
                $selectedKecamatan = $kecamatanData->dis_id;
            }
        }

        // Ambil data kelurahan berdasarkan ID kecamatan
        $selectedKelurahan = null;
        if ($selectedKecamatan) {
            $kelurahanData = DB::table('subdistricts')->where('dis_id', $selectedKecamatan)->first();
            if ($kelurahanData) {
                $selectedKelurahan = $kelurahanData->subdis_id;
            }
        }

        // Ambil daftar provinsi
        $provinsi = DB::table('provinces')->get();

        // Ambil daftar kabupaten jika ada
        $kabupaten = [];
        if ($selectedProvinsi) {
            $kabupaten = DB::table('cities')->where('prov_id', $selectedProvinsi)->get();
        }

        // Ambil daftar kecamatan jika ada
        $kecamatan = [];
        if ($selectedKabupaten) {
            $kecamatan = DB::table('districts')->where('city_id', $selectedKabupaten)->get();
        }

        // Ambil daftar kelurahan jika ada
        $kelurahan = [];
        if ($selectedKecamatan) {
            $kelurahan = DB::table('subdistricts')->where('dis_id', $selectedKecamatan)->get();
        }
        return view('User.editDataDiriEksekusiUser', [
            'data' => $eksekusi,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'selectedProvinsi' => $selectedProvinsi,
            'selectedKabupaten' => $selectedKabupaten,
            'selectedKecamatan' => $selectedKecamatan,
            'selectedKelurahan' => $selectedKelurahan,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status_pihak' => 'required',
            'jenis_pihak' => 'required',
            'nama' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'tempat_lahir' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'tanggal_lahir' => 'required',
            'umur' => 'required|integer|min:1',
            'jenis_kelamin' => 'required',
            'warga_negara' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'alamat' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'pekerjaan' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'status_kawin' => 'required',
            'pendidikan' => 'required',
            'nik' => 'required|numeric|digits:16',
            'email' => 'required|email',
            'no_telp' => 'required|numeric|digits_between:11,13',
            // Validasi lainnya sesuai kebutuhan
        ],[
            'status_pihak.required' => 'Kolom Status Pihak harus diisi',
            'jenis_pihak.required' => 'Kolom Jenis Pihak harus diisi',
            'nama.required' => 'Kolom Nama harus diisi',
            'nama.regex' => 'Kolom Nama hanya boleh berisi huruf dan spasi',
            'tempat_lahir.required' => 'Kolom Tempat Lahir harus diisi',
            'tempat_lahir.regex' => 'Kolom Tempat Lahir hanya boleh berisi huruf dan spasi',
            'tanggal_lahir.required' => 'Kolom Tanggal Lahir harus diisi',
            'umur.required' => 'Kolom Umur harus diisi',
            'umur.min' => 'Kolom Umur harus diisi dengan angka positif',
            'jenis_kelamin.required' => 'Kolom Jenis Kelamin harus diisi',
            'warga_negara.required' => 'Kolom Warga Negara harus diisi',
            'warga_negara.regex' => 'Kolom Warga Negara hanya boleh berisi huruf dan spasi',
            'alamat.required' => 'Kolom Alamat harus diisi',
            'provinsi.required' => 'Kolom Provinsi harus diisi',
            'kabupaten.required' => 'Kolom Kabupaten harus diisi',
            'kecamatan.required' => 'Kolom Kecamatan harus diisi',
            'kelurahan.required' => 'Kolom Kelurahan harus diisi',
            'pekerjaan.required' => 'Kolom Pekerjaan harus diisi',
            'pekerjaan.regex' => 'Kolom Pekerjaan hanya boleh berisi huruf dan spasi',
            'status_kawin.required' => 'Kolom Status Kawin harus diisi',
            'pendidikan.required' => 'Kolom Pendidikan harus diisi',
            'nik.required' => 'Kolom NIK harus diisi',
            'nik.numeric' => 'Kolom NIK harus diisi dengan angka',
            'nik.digits' => 'Kolom NIK harus diisi dengan 16 angka',
            'email.required' => 'Kolom email harus diisi',
            'email.email' => 'Kolom email harus diisi dengan format yang valid',
            'no_telp.required' => 'Kolom nomor telepon harus diisi',
            'no_telp.numeric' => 'Kolom nomor telepon harus diisi dengan angka',
            'no_telp.digits_between' => 'Kolom nomor telepon harus diisi dengan 11 hingga 13 angka',
        ]);

        $nik = $request->input('nik');
        $email = $request->input('email');
        $no_telp = $request->input('no_telp');
        $provinsiId = $request->input('provinsi');
        $kabupatenId = $request->input('kabupaten');
        $kecamatanId = $request->input('kecamatan');
        $kelurahanId = $request->input('kelurahan');

        // Ambil kode_unik terkait dengan id
        $kodeUnik = DB::table('data_diri_pihak')
            ->where('id_data_diri', $id)
            ->pluck('kode_unik')
            ->first();

        // Periksa apakah nik, email, atau no_telp sudah ada dalam data dengan kode_unik yang sama, kecuali data dengan id yang sedang diupdate
        $existingRecord = DB::table('data_diri_pihak')
            ->where('kode_unik', $kodeUnik)
            ->where(function($query) use ($nik, $email, $no_telp) {
                $query->where('nik', $nik)
                    ->orWhere('email', $email)
                    ->orWhere('no_telp', $no_telp);
            })
            ->where('id_data_diri', '!=', $id)
            ->first();

        if ($existingRecord) {
            if ($existingRecord->nik == $nik) {
                return redirect()->back()->withErrors(['nik' => 'NIK ini sudah digunakan'])->withInput();
            }
            if ($existingRecord->email == $email) {
                return redirect()->back()->withErrors(['email' => 'Email ini sudah digunakan'])->withInput();
            }
            if ($existingRecord->no_telp == $no_telp) {
                return redirect()->back()->withErrors(['no_telp' => 'Nomor Telepon ini sudah digunakan'])->withInput();
            }
        }

        // Update data dalam database
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
                'provinsi' => DB::table('provinces')->where('prov_id', $provinsiId)->pluck('prov_name')->first(),
                'kabupaten' => DB::table('cities')->where('city_id', $kabupatenId)->pluck('city_name')->first(),
                'kecamatan' => DB::table('districts')->where('dis_id', $kecamatanId)->pluck('dis_name')->first(),
                'kelurahan' => DB::table('subdistricts')->where('subdis_id', $kelurahanId)->pluck('subdis_name')->first(),
                'pekerjaan' => $request->pekerjaan,
                'status_kawin' => $request->status_kawin,
                'pendidikan' => $request->pendidikan,
                'nik' => $request->nik,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
            ]);

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
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format: png, jpg, jpeg, pdf, doc, atau docx.',
        ]);
        
        $post = DB::table('pembayaran')->where('id_pembayaran', $id)->first();

        // dd($post);
        if ($post) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('bukti_pembayaran')) {
                // Simpan file dokumen
                $document = $request->file('bukti_pembayaran');
                $documentName = time() . '.' . $document->getClientOriginalName();
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
                    // 'keterangan' => $request->keterangan,
                    'bukti_pembayaran' => $documentPath
                ]);

                DB::table('eksekusi')->where('pembayaran_id', $id)->update([
                    'proses' => 'Pembayaran',
                    'aanmaning_id' => $aanmaningId,
                    'is_read_byPN' => 3
                ]);

                return redirect()->route('indexUser')->with('success', 'Bukti Pembayaran Berhasil Dikirimkan');
            } else {
                return redirect()->route('indexUser')->with('error', 'Bukti Pembayaran Batal Dikirimkan');
            }
        } else {
            return redirect()->route('indexUser')->with('error', 'Bukti Pembayaran Batal Dikirimkan');
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
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diunggah.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format: png, jpg, jpeg, pdf, doc, atau docx.',
        ]);
        
        $post = DB::table('pembayaran')->where('id_pembayaran', $id)->first();

        // dd($post);
        if ($post) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('bukti_pembayaran')) {
                // Simpan file dokumen
                $document = $request->file('bukti_pembayaran');
                $documentName = time() . '.' . $document->getClientOriginalName();
                $mimeType = $document->getClientMimeType();
                $documentPath = $document->move(public_path('dokumen/Pembayaran'), $documentName);

                $documentPath = basename($documentPath);

                $status_pembayaran = 'Sudah Bayar';
                $tgl_pembayaran = now();

                // Update status dan tambahkan path dokumen
                DB::table('pembayaran')->where('id_pembayaran', $id)->update([
                    'status_pembayaran' => $status_pembayaran,
                    'tgl_pembayaran' => $tgl_pembayaran,
                    // 'keterangan' => $request->keterangan,
                    'bukti_pembayaran' => $documentPath
                ]);

                DB::table('eksekusi')->where('pembayaran_id', $id)->update([
                    'is_read_byPN' => 3
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

    public function downloadSkum(Request $request, $file)
    {
        $filePath = public_path('dokumen/Eksekusi/' . $file);

        return response()->download($filePath);
    }

    public function destroy(string $id)
    {
        DB::select('CALL delete_eksekusi(?)', array($id));
        return redirect()->route('pengadilan',$id)->with('success', 'Data Eksekusi Berhasil Dihapus!');
    }

    public function showDeleted(string $id)
    {
        DB::select('CALL delete_dataDiri(?)', array($id));
        return redirect()->route('detailAllSertifikat',$id)->with('success', 'Data Diri Eksekusi Berhasil Dihapus!');
    }
}
