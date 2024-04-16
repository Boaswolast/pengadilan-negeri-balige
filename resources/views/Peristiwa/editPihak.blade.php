@extends('layouts.pengadilan')
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Edit Data Diri Pihak
                </h4>

                <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{route('peristiwa')}}" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
                    <a href="{{route('peristiwa')}}" class="breadcrumb-item">Peristiwa Penting</a>
                    <a href="{{route('detailPeristiwa',$id)}}" class="breadcrumb-item">Detail</a>
                    <span class="breadcrumb-item active">Data Diri</span>
                </div>

                <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Centered card -->
    <div class="row">
        <div class="col-lg-8 offset-lg-2 mt-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Data Diri</h5>
                </div>
                <div class="card-body border-top">
                    @foreach($data as $d)
                    <form action="{{route('updatePihakPeristiwa',['idDiri' => $d->id_data_diri, $id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Status Pihak:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="status_pihak">
                                    <option value="#">Pilih Status Pihak</option>
                                    <option value="Penggugat" {{ $d->status_pihak == 'Penggugat' ? 'selected':''}}>Penggugat</option>
                                    <option value="Tergugat" {{ $d->status_pihak == 'Tergugat'  ? 'selected':''}}>Tergugat</option>
                                    <option value="Intervensi" {{ $d->status_pihak == 'Intervensi' ? 'selected':'' }}>Intervensi</option>
                                    <option value="Turut Tergugat" {{ $d->status_pihak == 'Turut Tergugat' ? 'selected':'' }}>Turut Tergugat</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Jenis Pihak:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="jenis_pihak">
                                    <option value="#">Pilih Pihak</option>
                                    <option value="Perorangan" {{ $d->jenis_pihak == 'Perorangan' ? 'selected':'' }}>Perorangan</option>
                                    <option value="Pemerintah" {{ $d->jenis_pihak == 'Pemerintah'? 'selected':'' }}>Pemerintah</option>
                                    <option value="Badan Hukum" {{ $d->jenis_pihak == 'Badan Hukum' ? 'selected':'' }}>Badan Hukum</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Nama Lengkap:</label>
                            <div class="col-lg-8">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap"  value="{{ $d->nama }}">
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Tempat Lahir:</label>
                            <div class="col-lg-8">
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir"  value="{{ $d->tempat_lahir }}">
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Tanggal Lahir:</label>
                            <div class="col-lg-8">
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir"  value="{{ $d->tanggal_lahir }}">
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Umur:</label>
                            <div class="col-lg-3">
                                <input type="number" name="umur" class="form-control" placeholder="Umur"  value="{{ $d->umur }}">
                            </div>
                            <div class="col-lg-4">
                                <div class="form-text">Tahun</div>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Jenis Kelamin:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="jenis_kelamin">
                                    <option value="#">Pilih Jenis Kelamin</option>
                                    <option value="Laki Laki" {{ $d->jenis_kelamin == 'Laki-Laki' ? 'selected':'' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ $d->jenis_kelamin == 'Perempuan' ? 'selected':'' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Warga Negara:</label>
                            <div class="col-lg-8">
                                <input type="text" name="warga_negara" class="form-control" placeholder="Warga Negara"  value="{{ $d->warga_negara }}">
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Alamat:</label>
                            <div class="col-lg-8">
                                <textarea rows="3" name="alamat" cols="3" class="form-control" placeholder="Alamat">{{ $d->alamat }}</textarea>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Provinsi:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="provinsi" id="provinsi">
                                    <option value="" >Pilih Provinsi</option>
                                    {{-- @foreach($provinsi as $item)
                                        <option value="{{$item->prov_id}}" {{$item->prov_id == $d->prov_id ? 'selected':''}}>{{$item->prov_name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Kabupaten/Kota:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="kabupaten" id= "kabupaten">
                                    <option value="#" disabled selected>Pilih Kabupaten/Kota</option>
                                    {{-- @foreach($kabupaten as $item)
                                        <option value="{{$item->city_id}}" {{$item->city_id == $d->city_id ? 'selected':''}}>{{$item->city_name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Kecamatan:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="kecamatan" id= "kecamatan">
                                    <option value="#" disabled selected>Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Kelurahan:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="kelurahan" id= "kelurahan">
                                    <option value="#" disabled selected>Pilih Kelurahan</option>
                                    {{-- @foreach($kelurahan as $item)
                                        <option value="{{$item->id}}">{{$item->subdis_name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Pekerjaan:</label>
                            <div class="col-lg-8">
                                <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" value="{{ $d->pekerjaan }}">
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Satatus Kawin:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="status_kawin">
                                    <option value="#" disabled>Pilih Status Kawin</option>
                                    <option value="Kawin" {{ $d->status_kawin == 'Kawin' ? 'selected':'' }}>Kawin</option>
                                    <option value="Belum Kawin" {{ $d->status_kawin == "Belum Kawin" ? 'selected':'' }}>Belum Kawin</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Pendidikan:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="pendidikan">
                                    <option value="" disabled>Pilih Pendidikan</option>
                                    <option value="SD" {{ $d->pendidikan == 'SD' ? 'selected':'' }}>Sekolah Dasar (SD)</option>
                                    <option value="SMP" {{ $d->pendidikan == 'SMP' ? 'selected':'' }}>Sekolah Menengah Pertama (SMP)</option>
                                    <option value="SMA" {{ $d->pendidikan == 'SMA' ? 'selected':'' }}>Sekolah Menengah Atas (SMA)</option>
                                    <option value="Sarjana" {{ $d->pendidikan == 'Sarjana' ? 'selected':'' }}>Sarjana (S1)</option>
                                    <option value="Magister" {{ $d->pendidikan == 'Magister' ? 'selected':'' }}>Magister (S2)</option>
                                    <option value="Doktoral" {{ $d->pendidikan == 'Doktoral' ? 'selected':'' }}>Doktoral (S3)</option>
                                </select>
                            </div>
                        </div>
                         <div class="card-header mt-3">
                                <h6 class="mb-0">Informasi Tambahan</h6>
                            </div>
                            <div class="card-body"></div>

                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Email:</label>
                            <div class="col-lg-8">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $d->email }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">No Telepon:</label>
                            <div class="col-lg-8">
                                <input type="text" name="no_telp" class="form-control" placeholder="No Telepon" value="{{ $d->no_telp }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">NIK:</label>
                            <div class="col-lg-8">
                                <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{ $d->nik }}">
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{route('detailPeristiwa',$id)}}" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                            <button type="submit" class="btn btn-success">Tambah <i class="ph-paper-plane-tilt ms-2"></i></button>
                        </div>
                    </form> @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
//     $(document).ready(function() {

//          var provinsiId = $('#provinsi').val(); // Mendapatkan nilai ID provinsi yang dipilih
//          console.log(provinsiId);
         
//         //  var kecamatanId = $('#kecamatan').val();
    
//     // UNTUK AMBIL KOTA
//     // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
// //     $.ajax({
// //     url: '/get-cities/' + provinsiId,
// //     method: 'GET',
// //     success: function(response) {
// //         // Menghapus semua opsi kota sebelum menambahkan yang baru
// //         // $('#kabupaten').empty();

// //         // Menambahkan opsi kota berdasarkan respons dari server
// //         $.each(response.cities, function(key, city) {
// //             $('#kabupaten').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
// //         });

// //         // Set opsi terpilih berdasarkan data yang sudah tersimpan
// //         $('#kabupaten').val({{ $d->city_id }});

// //         // Memperbarui nilai kabupatenId setelah opsi kota diperbarui
// //         var kabupatenId = $('#kabupaten').val();
// //         console.log("Ini kabupaten ID setelah perubahan: " + kabupatenId);
// //     },
// //     error: function(xhr) {
// //         // Menangani kesalahan jika terjadi
// //         console.log(xhr.responseText);
// //     }
// // });

// // // Event listener untuk perubahan nilai pada form provinsi
// // $('#provinsi').change(function() {
// //     var provinsiId = $(provinsi).val(); // Mendapatkan nilai ID provinsi yang dipilih

// //     // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
// //     $.ajax({
// //         url: '/get-cities/' + provinsiId,
// //         method: 'GET',
// //         success: function(response) {
// //             // Menghapus semua opsi kota sebelum menambahkan yang baru
// //             $('#kabupaten').empty();
// //             $(`#kabupaten`).append('<option value="#" disabled selected>Pilih Kabupaten/Kota</option>');

// //             // Menambahkan opsi kota berdasarkan respons dari server
// //             $.each(response.cities, function(key, city) {
// //                 $('#kabupaten').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
// //             });
// //         },
// //         error: function(xhr) {
// //             // Menangani kesalahan jika terjadi
// //             console.log(xhr.responseText);
// //         }
// //     });
// // });


// $('#provinsi').change(function() {
//             var provinsiId = $(this).val(); // Mendapatkan nilai ID provinsi yang dipilih

//             // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
//             $.ajax({
//                 url: '/get-cities/' + provinsiId,
//                 method: 'GET',
//                 success: function(response) {
//                     // Menghapus semua opsi kota sebelum menambahkan yang baru
//                     // $('#kabupaten').empty();

//                     // Menambahkan opsi kota berdasarkan respons dari server
//                     $.each(response.cities, function(key, city) {
//                         $('#kabupaten').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
//                     });
//                 },
//                 error: function(xhr) {
//                     // Menangani kesalahan jika terjadi
//                     console.log(xhr.responseText);
//                 }
//             });
//         });

//     // var kabupatenId = $('#kabupaten').val({{ $d->city_id }}); 

//     // $('#provinsi').change();

//         // Event listener untuk perubahan nilai pada form provinsi
//         // $('#provinsi').change(function() {
//         //     var provinsiId = $(provinsi).val(); // Mendapatkan nilai ID provinsi yang dipilih

//         //     // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
//         //     $.ajax({
//         //         url: '/get-cities/' + provinsiId,
//         //         method: 'GET',
//         //         success: function(response) {
//         //             // Menghapus semua opsi kota sebelum menambahkan yang baru
//         //             $('#kabupaten').empty();
//         //             $(`#kabupaten`).append('<option value="#" disabled selected>Pilih Kabupaten/Kota</option>');
//         //             // Menambahkan opsi kota berdasarkan respons dari server
//         //             $.each(response.cities, function(key, city) {
                        
//         //                 $('#kabupaten').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
//         //             });
//         //         },
//         //         error: function(xhr) {
//         //             // Menangani kesalahan jika terjadi
//         //             console.log(xhr.responseText);
//         //         }
//         //     });
//         // });
        
//         // var kabupatenId = $('#kabupaten').val(); 
//         // console.log(kabupatenId);

//         // UNTUK AMBIL KECAMATAN
//         // var kabupatenId = $('#kabupaten').val();
//         // var kabupatenId = $('#kabupaten').val();
//     // $.ajax({
//     //     url: '/get-districts/' + kabupatenId,
//     //     method: 'GET',
//     //     success: function(response) {
//     //         // Menghapus semua opsi kota sebelum menambahkan yang baru
//     //         // $('#kabupaten').empty();

//     //         // Menambahkan opsi kota berdasarkan respons dari server
//     //         $.each(response.districts, function(key, district) {
//     //             $('#kecamatan').append('<option value="' + district.dis_id + '">' + district.dis_name + '</option>');
//     //         });

//     //         console.log(kabupatenId);

//     //         // Set opsi terpilih berdasarkan data yang sudah tersimpan
//     //         $('#kecamatan').val({{ $d->dis_id }});

//     //         $('#kabupaten').change(function() {
//     //         var kabupatenId = $(this).val(); // Mendapatkan nilai ID provinsi yang dipilih
            
//     //         // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
//     //         $.ajax({
//     //             url: '/get-districts/' + kabupatenId,
//     //             method: 'GET',
//     //             success: function(response) {
//     //                 // Menghapus semua opsi kota sebelum menambahkan yang baru
//     //                 // $('#kecamatan').empty();

//     //                 // Menambahkan opsi kota berdasarkan respons dari server
//     //                 $.each(response.districts, function(key, district) {
//     //                     $('#kecamatan').append('<option value="' + district.dis_id + '">' + district.dis_name + '</option>');
//     //                 });
//     //             },
//     //             error: function(xhr) {
//     //                 // Menangani kesalahan jika terjadi
//     //                 console.log(xhr.responseText);
//     //             }
//     //         });
//     //     });
//     //     },
//     //     error: function(xhr) {
//     //         // Menangani kesalahan jika terjadi
//     //         console.log(xhr.responseText);
//     //     }
//     // });
    

        
// $('#kabupaten').change(function() {
//             var kabupatenId = $(this).val(); // Mendapatkan nilai ID provinsi yang dipilih

//             // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
//             $.ajax({
//                 url: '/get-districts/' + kabupatenId,
//                 method: 'GET',
//                 success: function(response) {
//                     // Menghapus semua opsi kota sebelum menambahkan yang baru
//                     // $('#kecamatan').empty();

//                     // Menambahkan opsi kota berdasarkan respons dari server
//                     $.each(response.districts, function(key, district) {
//                         $('#kecamatan').append('<option value="' + district.dis_id + '">' + district.dis_name + '</option>');
//                     });
//                 },
//                 error: function(xhr) {
//                     // Menangani kesalahan jika terjadi
//                     console.log(xhr.responseText);
//                 }
//             });
//         });


//         $('#kecamatan').change(function() {
//             var kecamatanId = $(this).val(); // Mendapatkan nilai ID provinsi yang dipilih

//             // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
//             $.ajax({
//                 url: '/get-subdistricts/' + kecamatanId,
//                 method: 'GET',
//                 success: function(response) {
//                     // Menghapus semua opsi kota sebelum menambahkan yang baru
//                     // $('#kelurahan').disable();
                    

//                     // Menambahkan opsi kota berdasarkan respons dari server
//                     $.each(response.subDistricts, function(key, subdistrict) {
//                         $('#kelurahan').append('<option value="' + subdistrict.subdis_id + '">' + subdistrict.subdis_name + '</option>');
//                     });

//                     // $('#pilih').disable();
//                 },
//                 error: function(xhr) {
//                     // Menangani kesalahan jika terjadi
//                     console.log(xhr.responseText);
//                 }
//             });
//         });
//         $('#provinsi').change();
//         // $('#kabupaten').change();
//         // $('#kelurahan').change();
//     });

    
</script>
    <!-- /centered card -->
@endsection