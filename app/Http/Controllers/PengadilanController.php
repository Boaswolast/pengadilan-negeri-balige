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

    //  public function countNotif($notif)
    //  {
         
    //      return $count === 0 ? null : $count;
    //  }

    public function index()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $data = DB::select('CALL viewAll_sertifikatTanah()');
        $data = collect($data);
        return view('Pengadilan/pengadilan',[
            'data' => $data,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    // public function editSertifikat()
    // {
    //     $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
    //     $total1 = $notif1->sum('jumlah');
    //     $messages1 = collect($notif1)->pluck('notification')->all();

    //     $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
    //     $total2 = $notif2->sum('jumlah');
    //     $messages2 = collect($notif2)->pluck('notification')->all(); 

    //     $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
    //     $total3 = $notif3->sum('jumlah');
    //     $messages3 = collect($notif3)->pluck('notification')->all(); 

    //     $totalNotif = $total1 + $total2 + $total3;
    //     if($totalNotif === 0){
    //         $totalNotif = null;
    //     }
    //     $messages = array_merge($messages1, $messages2, $messages3);

    //     return view('Pengadilan/editSertifikatTanah', [
    //         'totalNotif' => $totalNotif, 
    //         'messages' => $messages
    //     ]);
    // }

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
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        $kecamatan = DB::table('districts')->get();
        $kelurahan = DB::table('subdistricts')->get();
        return view('Pengadilan/addDataDiriSertifikat', [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function addTemporarySertifikat(Request $request)
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
    
        // Ambil data sementara dari session
        $temporarySertifikats = session()->get('temporary_sertifikat', []);
    
        // Periksa apakah nik atau email sudah ada
        foreach ($temporarySertifikats as $sertifikat) {
            if ($sertifikat['nik'] == $nik) {
                return redirect()->back()->withErrors(['nik' => 'NIK ini sudah digunakan'])->withInput();
            }
            if ($sertifikat['email'] == $email) {
                return redirect()->back()->withErrors(['email' => 'Email ini sudah digunakan'])->withInput();
            }
            if ($sertifikat['no_telp'] == $no_telp) {
                return redirect()->back()->withErrors(['no_telp' => 'Nomor Telepon ini sudah digunakan'])->withInput();
            }
        }
    
        $temporarySertifikat = [
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
        session()->push('temporary_sertifikat', $temporarySertifikat);
    
        return redirect()->route('addSertifikatPengadilan')->with('success', 'Task Created Successfully!');
    }

    public function showTemporarySertifikat()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $temporarySertifikat = session('temporary_sertifikat', []); 

        // Mengirim data sementara ke tampilan
        return view('Pengadilan/addSertifikatTanah', [
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ])->with('temporarySertifikat', $temporarySertifikat);
    }
     //-- end Data Sementara--

    public function addSertifikat()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $temporarySertifikat = session('temporary_sertifikat', []);

        return view('Pengadilan/addSertifikatTanah', [
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ])->with('temporarySertifikat', $temporarySertifikat);
    }

    public function storeSertifikat(Request $request){
        $request->validate([
            'petitum' => 'required',
            'dokumen_gugatan' => 'required|mimes:pdf,doc,docx',
        ], [
            'petitum.required' => 'Petitum wajib diisi.',
            'dokumen_gugatan.required' => 'Dokumen gugatan wajib diunggah.',
            'dokumen_gugatan.mimes' => 'Dokumen gugatan harus berupa file dengan format: pdf, doc, atau docx.',
        ]);

        $temporarySertifikat = session('temporary_sertifikat', []);

        try{
            DB::beginTransaction();

            // Buat UUID untuk sertifikat
            $dokumenUuid = Str::uuid();

            $dokumen = $request->file('dokumen_gugatan');
            $dokumenName = $dokumen->getClientOriginalName();
            $mimeType = $dokumen->getClientMimeType();
            $dokumenPath = $dokumen->move(public_path('dokumen/Pengadilan'), $dokumenName);

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

    public function addPihak(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        $provinsi = DB::table('provinces')->get();
        $kabupaten = DB::table('cities')->get();
        $kecamatan = DB::table('districts')->get();
        $kelurahan = DB::table('subdistricts')->get();
        return view('Pengadilan/addDataDiriTambahan', [
            'sertifikat_tanah' => $sertifikat,
            'provinsi' => $provinsi, 
            'kabupaten' => $kabupaten, 
            'kecamatan' => $kecamatan, 
            'kelurahan' => $kelurahan, 
            'id' => $id,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function storePihak(Request $request, string $id)
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
        $no_telp = $request->input('no_telp'); // Perbaikan di sini

        $kodeUnik = DB::table('pemblokiran_sertifikat')
            ->where('id_pemblokiran', $id)
            ->pluck('kode_unik')
            ->first();

        // Periksa apakah nik, email, atau no_telp sudah ada dalam tabel data_diri_pihak dengan kodeUnik yang sama
        $existingData = DB::table('data_diri_pihak')
            ->where('kode_unik', $kodeUnik)
            ->where(function ($query) use ($nik, $email, $no_telp) {
                $query->where('nik', $nik)
                    ->orWhere('email', $email)
                    ->orWhere('no_telp', $no_telp);
            })
            ->first();

        if ($existingData) {
            $errors = [];
            if ($existingData->nik == $nik) {
                $errors['nik'] = 'NIK ini sudah didaftarkan';
            }
            if ($existingData->email == $email) {
                $errors['email'] = 'Email ini sudah didaftarkan';
            }
            if ($existingData->no_telp == $no_telp) {
                $errors['no_telp'] = 'Nomor Telepon ini sudah didaftarkan';
            }
            return redirect()->back()->withErrors($errors)->withInput();
        }

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
        $kabupaten = DB::table('cities')->where('city_id', $kabupatenId)->pluck('city_name')->first();
        $kecamatan = DB::table('districts')->where('dis_id', $kecamatanId)->pluck('dis_name')->first();
        $kelurahan = DB::table('subdistricts')->where('subdis_id', $kelurahanId)->pluck('subdis_name')->first();
        $pekerjaan = $request->input('pekerjaan');
        $status_kawin = $request->input('status_kawin');
        $pendidikan = $request->input('pendidikan');

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

        return redirect()->route('detailAllSertifikat', $id)->with('success', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // detail sertifikat
    public function showDataAll(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $dataDiriAll = DB::select('CALL viewAll_sertifikatTanah_dataDiri(?)', array($id));
        $dataGugatan = DB::select('CALL view_sertifikatTanah_gugatan(?)', array($id));
        $dataPetitum = DB::select('CALL view_sertifikatTanah_petitum(?)', array($id));
        $dataStatus = DB::select('CALL view_sertifikatTanah_status(?)', array($id));
        $dataDiriAll = collect($dataDiriAll);
        $dataGugatan = collect($dataGugatan);
        $dataPetitum = collect($dataPetitum);
        $dataStatus = collect($dataStatus);

        $status = DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->get();
        $id = DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->pluck('id_pemblokiran')->first();
        return view('Pengadilan.DetailSertifikat.detailDataSertifikat', [
            'dataDiriAll' => $dataDiriAll,
            'status' => $status, 
            'id' => $id,
            'dataGugatan' => $dataGugatan,
            'dataPetitum' => $dataPetitum,
            'dataStatus' => $dataStatus,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function download(Request $request, $file)
    {
        $filePath = public_path('dokumen/Pengadilan/' . $file);

        return response()->download($filePath);
    }

    public function print(Request $request, $file)
    {
        $path = public_path('dokumen/Pertanahan/' . $file);

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
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', array($id));
        $sertifikat = collect($sertifikat);
        return view('Pengadilan.DetailSertifikat.detailPihakSertifikat', [
            'sertifikat' => $sertifikat, 
            'totalNotif' => $totalNotif, 
            'messages' => $messages
        ]);
    }

    public function showDeleted(string $id)
    {
        DB::select('CALL delete_dataDiri(?)', array($id));
        return redirect()->route('detailAllSertifikat',$id)->with('success', 'Data Peristiwa Berhasil Dihapus!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getKabupaten($provinsi_id)
    {
        $kabupaten = DB::table('cities')->where('prov_id', $provinsi_id)->pluck('city_name', 'city_id');
        return response()->json($kabupaten);
    }

    public function getKecamatan($kabupaten_id)
    {
        $kecamatan = DB::table('districts')->where('city_id', $kabupaten_id)->pluck('dis_name', 'dis_id');
        return response()->json($kecamatan);
    }

    public function getKelurahan($kecamatan_id)
    {
        $kelurahan = DB::table('subdistricts')->where('dis_id', $kecamatan_id)->pluck('subdis_name', 'subdis_id');
        return response()->json($kelurahan);
    }

    public function edit(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        // Ambil data sertifikat
        $sertifikat = DB::select('CALL view_sertifikatTanah_dataDiri(?)', [$id]);
        $sertifikat = collect($sertifikat)->first();

        // Ambil nama provinsi dari sertifikat jika tersedia
        $namaProvinsi = $sertifikat ? $sertifikat->provinsi : null;

        // Ambil ID provinsi berdasarkan nama provinsi
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

        return view('Pengadilan.editSertifikatTanah', [
            'data' => $sertifikat,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'selectedProvinsi' => $selectedProvinsi,
            'selectedKabupaten' => $selectedKabupaten,
            'selectedKecamatan' => $selectedKecamatan,
            'selectedKelurahan' => $selectedKelurahan,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
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
        $kodeUnik = DB::table('pemblokiran_sertifikat')
            ->where('id_pemblokiran', $id)
            ->pluck('kode_unik')
            ->first();

        // Periksa apakah nik, email, atau no_telp sudah ada dalam data lain selain data yang sedang diupdate
        $existingData = DB::table('data_diri_pihak')
            ->where('kode_unik', $kodeUnik)
            ->where(function ($query) use ($nik, $email, $no_telp, $id) {
                $query->where('nik', $nik)
                    ->orWhere('email', $email)
                    ->orWhere('no_telp', $no_telp);
            })
            ->where('id_data_diri', '!=', $id)
            ->first();

        if ($existingData) {
            $errors = [];
            if ($existingData->nik == $nik) {
                $errors['nik'] = 'NIK ini sudah digunakan';
            }
            if ($existingData->email == $email) {
                $errors['email'] = 'Email ini sudah digunakan';
            }
            if ($existingData->no_telp == $no_telp) {
                $errors['no_telp'] = 'Nomor Telepon ini sudah digunakan';
            }
            return redirect()->back()->withErrors($errors)->withInput();
        }

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
                'nik' => $nik,
                'email' => $email,
                'no_telp' => $no_telp,
            ]);

        return redirect()->route('detailSertifikat', ['id' => $id])->with('success', 'Data Berhasil diubah');
    }


    public function editPetitum(string $id)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $editPetitum = DB::select('CALL view_sertifikatTanah_petitum(?)', array($id));
        $editPetitum = collect($editPetitum);
        return view('Pengadilan.editPetitumSertifikat', [
            'editPetitum' => $editPetitum,
            'totalNotif' => $totalNotif, 
            'messages' => $messages
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

        return redirect()->route('detailAllSertifikat', ['id' => $id])->with('success', 'Data Berhasil di Ubah');
    }

    public function updateGugatan(Request $request, string $id)
    {
        $request->validate([
            'dokumen_gugatan' => 'required|mimes:pdf,doc,docx',
            // 'keterangan' => 'required',
        ], [
            'dokumen_gugatan.required' => 'Dokumen gugatan wajib diunggah.',
            'dokumen_gugatan.mimes' => 'Dokumen gugatan harus berupa file dengan format: pdf, doc, atau docx.',
        ]);
        
        $post = DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->first();

        // dd($post);
        if ($post) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('dokumen_gugatan')) {
                // Simpan file dokumen
                $document = $request->file('dokumen_gugatan');
                $documentName = $document->getClientOriginalName();
                $mimeType = $document->getClientMimeType();
                $documentPath = $document->move(public_path('dokumen/Pengadilan'), $documentName);

                $documentPath = basename($documentPath);

                // Update status dan tambahkan path dokumen
                DB::table('pemblokiran_sertifikat')->where('id_pemblokiran', $id)->update([
                    'dokumen_gugatan' => $documentPath,
                ]);

                return redirect()->route('detailAllSertifikat', ['id' => $id])->with('success', 'Data Berhasil di Ubah');
            } else {
                return redirect()->route('indexUser')->with('error', 'Terjadi kesalahan');
            }
        } else {
            return redirect()->route('indexUser')->with('error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::select('CALL delete_pemblokiranSertifikat(?)', array($id));
        return redirect()->route('pengadilan',$id)->with('success', 'Data Peristiwa Berhasil Dihapus!');
        // DB::beginTransaction();
        // try {
        //     $sertifikat = DB::table('pemblokiran_sertifikat')->where('kode_unik', $kode_unik)->first();
    
        //     DB::table('data_diri_pihak')->where('kode_unik', $kode_unik)->delete();
        //     DB::table('pemblokiran_sertifikat')->where('kode_unik', $kode_unik)->delete();
    
        //     DB::commit();
    
        //     return redirect()->route('pengadilan', ['pemblokiran_sertifikat' => $sertifikat])->with('success', 'Data berhasil dihapus');
        // } catch (\Exception $e) {
        //     // Jika terjadi kesalahan, rollback transaksi
        //     DB::rollback();
    
        //     // Tampilkan pesan error atau lakukan penanganan lain sesuai kebutuhan
        //     return redirect()->route('pengadilan')->with('error', 'Gagal menghapus data');
        // }
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
