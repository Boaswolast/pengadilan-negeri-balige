@extends('layouts.user')
@section('content')

<script>
    document.getElementById("formDataDiri").addEventListener("submit", function(event) {
        var formIsValid = true;
        var inputs = this.querySelectorAll("input[required]");
        
        inputs.forEach(function(input) {
            if (!input.value) {
                formIsValid = false;
                input.classList.add("invalid-input");
            } else {
                input.classList.remove("invalid-input");
            }
        });
        
        if (!formIsValid) {
            event.preventDefault(); // Mencegah pengiriman formulir jika ada bidang yang tidak valid
        }
    });
</script>
    <div class="content body-user">

        <!-- Centered card -->
        <div class="row">
            <div class="col-lg-8 offset-lg-2 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Tambah Data Diri Pihak</h5>
                    </div>
                    <div class="card-body border-top">
                        <form action="{{route('addTemporaryPeristiwaUser')}}" method="POST" id="formDataDiri" novalidate>
                            @csrf
                            <div class="row mb-3 mt-3">
                                <label class="col-lg-4 col-form-label">Status Pihak:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('status_pihak') is-invalid @enderror" name="status_pihak" title="Mohon memilih bagian ini" required>
                                        <option value="">Pilih Status Pihak</option>
                                        <option value="Pemohon" @selected(old('status_pihak') == 'Pemohon')>Pemohon</option>
                                        <option value="Termohon" @selected(old('status_pihak') == 'Termohon')>Termohon</option>
                                    </select>
                                    @error('status_pihak')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label class="col-lg-4 col-form-label">Jenis Pihak:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('jenis_pihak') is-invalid @enderror" name="jenis_pihak" title="Pilihlah sesuai jenis pihak anda" value="{{ old('jenis_pihak') }}" required>
                                        <option value="">Pilih Pihak</option>
                                        <option value="Perorangan" @selected(old('jenis_pihak') == 'Perorangan')>Perorangan</option>
                                        <option value="Pemerintah" @selected(old('jenis_pihak') == 'Pemerintah')>Pemerintah</option>
                                        <option value="Badan Hukum" @selected(old('jenis_pihak') == 'Badan Hukum')>Badan Hukum</option>
                                    </select>
                                    @error('jenis_pihak')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3 mt-3">
                                <label class="col-lg-4 col-form-label">Nama Lengkap:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" pattern="[A-Za-z\s]+" value="{{ old('nama') }}"  required>
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tempat Lahir:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
                                    @error('tempat_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tanggal Lahir:</label>
                                <div class="col-lg-8">
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Umur:</label>
                                <div class="col-lg-3">
                                    <input type="number" name="umur" id="umur" class="form-control @error('umur') is-invalid @enderror" placeholder="Umur" value="{{ old('umur') }}" required>
                                    @error('umur')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-text">Tahun</div>
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Jenis Kelamin:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki Laki"  @selected(old('jenis_kelamin') == 'Laki Laki')>Laki-Laki</option>
                                        <option value="Perempuan"  @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Warga Negara:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="warga_negara" class="form-control @error('warga_negara') is-invalid @enderror" placeholder="Warga Negara" value="{{ old('warga_negara') }}" required>
                                    @error('warga_negara')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Alamat:</label>
                                <div class="col-lg-8">
                                    <textarea rows="3" name="alamat" cols="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Provinsi:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi">
                                        <option value="#" disabled selected>Pilih Provinsi</option>
                                        @foreach($provinsi as $item)
                                            <option value="{{$item->prov_id}}" @selected(old('provinsi') == $item->prov_id)>{{$item->prov_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kabupaten/Kota:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('kabupaten') is-invalid @enderror" name="kabupaten" id= "kabupaten">
                                        <option value="#" disabled selected>Pilih Kabupaten/Kota</option>
                                        @if(old('provinsi'))
                                            @foreach($kabupaten as $item)
                                                @if($item->prov_id == old('provinsi'))
                                                    <option value="{{$item->city_id}}" @selected(old('kabupaten') == $item->city_id)>{{$item->city_name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kabupaten')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kecamatan:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('kecamatan') is-invalid @enderror" name="kecamatan" id= "kecamatan" value="{{ old('kecamatan') }}">
                                        <option value="#" disabled selected>Pilih Kecamatan</option>
                                        @if(old('kabupaten'))
                                            @foreach($kecamatan as $item)
                                                @if($item->city_id == old('kabupaten'))
                                                    <option value="{{$item->dis_id}}" @selected(old('kecamatan') == $item->dis_id)>{{$item->dis_name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kecamatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kelurahan:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('kelurahan') is-invalid @enderror" name="kelurahan" id= "kelurahan" value="{{ old('kelurahan') }}">
                                        <option value="#" disabled selected>Pilih Kelurahan</option>
                                        @if(old('kecamatan'))
                                            @foreach($kelurahan as $item)
                                                @if($item->dis_id == old('kecamatan'))
                                                    <option value="{{$item->subdis_id}}" @selected(old('kelurahan') == $item->subdis_id)>{{$item->subdis_name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kelurahan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Pekerjaan:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" placeholder="Pekerjaan" value="{{ old('pekerjaan') }}" required>
                                    @error('pekerjaan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Satatus Kawin:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('status_kawin') is-invalid @enderror" name="status_kawin" required>
                                        <option value="">Pilih Status Kawin</option>
                                        <option value="Kawin" @selected(old('status_kawin') == 'Kawin')>Kawin</option>
                                        <option value="Belum Kawin" @selected(old('status_kawin') == 'Belum Kawin')>Belum Kawin</option>
                                    </select>
                                    @error('status_kawin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Pendidikan:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('pendidikan') is-invalid @enderror" name="pendidikan" value="{{ old('pendidikan') }}" required>
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="SD" @selected(old('pendidikan') == 'SD')>Sekolah Dasar (SD)</option>
                                        <option value="SMP" @selected(old('pendidikan') == 'SMP')>Sekolah Menengah Pertama (SMP)</option>
                                        <option value="SMA" @selected(old('pendidikan') == 'SMA')>Sekolah Menengah Atas (SMA)</option>
                                        <option value="Sarjana" @selected(old('pendidikan') == 'Sarjana')>Sarjana (S1)</option>
                                        <option value="Magister" @selected(old('pendidikan') == 'Magister')>Magister (S2)</option>
                                        <option value="Doktoral" @selected(old('pendidikan') == 'Doktoral')>Doktoral (S3)</option>
                                    </select>
                                    @error('pendidikan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <hr class="garisDataDiri">
                            <h6 style="margin-bottom: 40px">Informasi Tambahan</h6>
    
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">NIK:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" value="{{ old('nik') }}" required>
                                    <span id="nik-error" class="text-danger" style="display: none;"></span>
                                    @error('nik')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Email:</label>
                                <div class="col-lg-8">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">No Telepon:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor Telepon" value="{{ old('no_telp') }}" required>
                                    @error('no_telp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{route('addSertifikatPengadilan')}}" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                                <button type="submit" class="btn btn-success">Tambah <i class="ph-paper-plane-tilt ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /centered card -->

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nik').on('input', function() {
                var nik = $(this).val();
                var errorMessage = '';
                
                // Validasi apakah NIK diisi
                if (!nik) {
                    errorMessage = 'Kolom NIK harus diisi';
                } 
                // Validasi apakah NIK berupa angka
                else if (!/^\d+$/.test(nik)) {
                    errorMessage = 'Kolom NIK harus diisi dengan angka';
                } 
                // Validasi apakah NIK terdiri dari 16 angka
                else if (nik.length !== 16) {
                    errorMessage = 'Kolom NIK harus diisi dengan 16 angka';
                }
    
                // Tampilkan atau sembunyikan pesan error
                if (errorMessage) {
                    $('#nik-error').text(errorMessage);
                    $('#nik-error').show();
                } else {
                    $('#nik-error').hide();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tanggalLahirInput = document.getElementById('tanggal_lahir');
            const umurInput = document.getElementById('umur');
        
            tanggalLahirInput.addEventListener('change', function () {
                const tanggalLahir = new Date(this.value);
                const today = new Date();
                let umur = today.getFullYear() - tanggalLahir.getFullYear();
                const monthDifference = today.getMonth() - tanggalLahir.getMonth();
        
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < tanggalLahir.getDate())) {
                    umur--;
                }
        
                umurInput.value = umur;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#provinsi').change(function() {
                var provinsiId = $(this).val(); 
    
                $.ajax({
                    url: '/get-citiess/' + provinsiId,
                    method: 'GET',
                    success: function(response) {
                        $('#kabupaten').empty();
                        $('#kabupaten').append('<option value="#" disabled selected>Pilih Kabupaten/Kota</option>');
    
                        $.each(response.cities, function(key, city) {
                            $('#kabupaten').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
    
            $('#kabupaten').change(function() {
                var kabupatenId = $(this).val(); // Mendapatkan nilai ID provinsi yang dipilih
    
                // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
                $.ajax({
                    url: '/get-districtss/' + kabupatenId,
                    method: 'GET',
                    success: function(response) {
                        // Menghapus semua opsi kota sebelum menambahkan yang baru
                        $('#kecamatan').empty();
                        $('#kecamatan').append('<option value="#" disabled selected>Pilih Kecamatan</option>');
    
                        // Menambahkan opsi kota berdasarkan respons dari server
                        $.each(response.districts, function(key, district) {
                            $('#kecamatan').append('<option value="' + district.dis_id + '">' + district.dis_name + '</option>');
                        });
                    },
                    error: function(xhr) {
                        // Menangani kesalahan jika terjadi
                        console.log(xhr.responseText);
                    }
                });
            });
    
            $('#kecamatan').change(function() {
                var kecamatanId = $(this).val(); // Mendapatkan nilai ID provinsi yang dipilih
    
                // Mengirimkan permintaan AJAX untuk mendapatkan daftar kota berdasarkan provinsi yang dipilih
                $.ajax({
                    url: '/get-subdistrictss/' + kecamatanId,
                    method: 'GET',
                    success: function(response) {
                        $('#kelurahan').empty();
                        $('#kelurahan').append('<option value="#" disabled selected>Pilih Kelurahan</option>');
    
                        $.each(response.subDistricts, function(key, subdistrict) {
                            $('#kelurahan').append('<option value="' + subdistrict.subdis_id + '">' + subdistrict.subdis_name + '</option>');
                        });
    
                        // $('#pilih').disable();
                    },
                    error: function(xhr) {
                        // Menangani kesalahan jika terjadi
                        console.log(xhr.responseText);
                    }
                });
            });
        });   
    </script>
@endsection