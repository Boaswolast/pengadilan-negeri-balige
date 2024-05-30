@extends('layouts.user')
@section('content')

    <!-- Basic setup -->
    <div class="content body-user">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">

                    <div class="card-body border-top">
                        {{-- @foreach($editDataDiriEksekusi as $data) --}}
                        <form action="{{route('updateDataDiriEksekusi', ['id' => $data->id_data_diri])}}" method="POST" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Status Pihak:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('status_pihak') is-invalid @enderror" name="status_pihak" title="Mohon memilih bagian ini" required>
                                        <option value="" {{$data->status_pihak === '' ? 'selected' : ''}}>Pilih Status Pihak</option>
                                        <option value="Pemohon" {{$data->status_pihak === 'Pemohon' ? 'selected' : ''}}>Pemohon</option>
                                        <option value="Termohon" {{$data->status_pihak === 'Termohon' ? 'selected' : ''}}>Termohon</option>
                                    </select>
                                    @error('status_pihak')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label class="col-lg-4 col-form-label">Jenis Pihak:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('jenis_pihak') is-invalid @enderror" name="jenis_pihak" title="Mohon memilih bagian ini" required>
                                        <option value="" {{$data->jenis_pihak === '' ? 'selected' : ''}}>Pilih Pihak</option>
                                        <option value="Perorangan" {{$data->jenis_pihak === 'Perorangan' ? 'selected' : ''}}>Perorangan</option>
                                        <option value="Pemerintah" {{$data->jenis_pihak === 'Pemerintah' ? 'selected' : ''}}>Pemerintah</option>
                                        <option value="Badan Hukum" {{$data->jenis_pihak === 'Badan Hukum' ? 'selected' : ''}}>Badan Hukum</option>
                                    </select>
                                    @error('jenis_pihak')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Nama Lengkap:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" pattern="[A-Za-z\s]+" title="Hanya huruf yang diizinkan" value="{{$data->nama}}">
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tempat Lahir:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" title="Mohon mengisi bagian ini" value="{{$data->tempat_lahir}}">
                                    @error('tempat_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tanggal Lahir:</label>
                                <div class="col-lg-8">
                                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Tanggal Lahir" title="Mohon mengisi bagian ini" value="{{$data->tanggal_lahir}}">
                                    @error('tanggal_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Umur:</label>
                                <div class="col-lg-3">
                                    <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" placeholder="Umur" title="Mohon mengisi bagian ini" value="{{$data->umur}}">
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
                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" title="Mohon memilih bagian ini" required>
                                        <option value="" {{$data->jenis_kelamin === '' ? 'selected' : ''}}>Pilih Jenis Kelamin</option>
                                        <option value="Laki Laki" {{$data->jenis_kelamin === 'Laki Laki' ? 'selected' : ''}}>Laki-Laki</option>
                                        <option value="Perempuan" {{$data->jenis_kelamin === 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Warga Negara:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="warga_negara" class="form-control @error('warga_negara') is-invalid @enderror" placeholder="Tanggal Lahir" title="Mohon mengisi bagian ini" value="{{$data->warga_negara}}">
                                    @error('warga_negara')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Alamat:</label>
                                <div class="col-lg-8">
                                    <textarea rows="3" name="alamat" cols="3" class="form-control @error('alamat') is-invalid @enderror" title="Mohon mengisi bagian ini" placeholder="Alamat">{{$data->alamat}}</textarea>
                                    @error('alamat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Provinsi:</label>
                                <div class="col-lg-8">
                                    <select id="provinsi" class="form-select @error('provinsi') is-invalid @enderror" name="provinsi" title="Mohon memilih bagian ini">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $item)
                                            <option value="{{ $item->prov_id }}" {{ old('provinsi', $selectedProvinsi ?? '') == $item->prov_id ? 'selected' : '' }}>
                                                {{ $item->prov_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kabupaten:</label>
                                <div class="col-lg-8">
                                    <select id="kabupaten" class="form-select @error('kabupaten') is-invalid @enderror" name="kabupaten" title="Mohon memilih bagian ini">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                    @error('kabupaten')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kecamatan:</label>
                                <div class="col-lg-8">
                                    <select id="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror" name="kecamatan" title="Mohon memilih bagian ini">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    @error('kecamatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kelurahan/Desa:</label>
                                <div class="col-lg-8">
                                    <select id="kelurahan" class="form-select @error('kelurahan') is-invalid @enderror" name="kelurahan" title="Mohon memilih bagian ini">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                    @error('kelurahan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Pekerjaan:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" placeholder="Pekerjaan" title="Mohon mengisi bagian ini" value="{{$data->pekerjaan}}">
                                    @error('pekerjaan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Status Kawin:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('status_kawin') is-invalid @enderror" name="status_kawin" title="Mohon memilih bagian ini" required>
                                        <option value="" {{$data->status_kawin === '' ? 'selected' : ''}}>Pilih Status Kawin</option>
                                        <option value="Kawin" {{$data->status_kawin === 'Kawin' ? 'selected' : ''}}>Kawin</option>
                                        <option value="Belum Kawin" {{$data->status_kawin === 'Belum Kawin' ? 'selected' : ''}}>Belum Kawin</option>
                                    </select>
                                    @error('status_kawin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Pendidikan:</label>
                                <div class="col-lg-8">
                                    <select class="form-select @error('pendidikan') is-invalid @enderror" name="pendidikan" title="Mohon memilih bagian ini">
                                        <option value="" {{$data->pendidikan === '' ? 'selected' : ''}}>Pilih Pendidikan</option>
                                        <option value="SD" {{$data->pendidikan === 'SD' ? 'selected' : ''}}>Sekolah Dasar (SD)</option>
                                        <option value="SMP" {{$data->pendidikan === 'SMP' ? 'selected' : ''}}>OSekolah Menengah Pertama (SMP)</option>
                                        <option value="SMA" {{$data->pendidikan === 'SMA' ? 'selected' : ''}}>Sekolah Menengah Atas (SMA)</option>
                                        <option value="Sarjana" {{$data->pendidikan === 'Sarjana' ? 'selected' : ''}}>Sarjana (S1)</option>
                                        <option value="Magister" {{$data->pendidikan === 'Magister' ? 'selected' : ''}}>Magister (S2)</option>
                                        <option value="Doktoral" {{$data->pendidikan === 'Doktoral' ? 'selected' : ''}}>Doktoral (S3)</option>
                                    </select>
                                    @error('pendidikan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr class="garisDataDiri">
                            <h5>Informasi Tambahan</h5>
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">NIK:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" title="Mohon mengisi bagian ini" value="{{$data->nik}}">
                                    @error('nik')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Alamat Email:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" title="Mohon mengisi bagian ini" value="{{$data->email}}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Nomor Telepon:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="No Telepon" title="Mohon mengisi bagian ini" value="{{$data->no_telp}}">
                                    @error('no_telp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
                            </div>
                        </form>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic setup -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var selectedKabupaten = "{{ old('kabupaten', $selectedKabupaten ?? '') }}";
            var selectedKecamatan = "{{ old('kecamatan', $selectedKecamatan ?? '') }}";
            var selectedKelurahan = "{{ old('kelurahan', $selectedKelurahan ?? '') }}";
        
            function loadKabupaten(provinsiID) {
                if (provinsiID) {
                    $.ajax({
                        url: '/getKabupaten/' + provinsiID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
                            $.each(data, function(key, value) {
                                $('#kabupaten').append('<option value="'+ key +'" ' + (selectedKabupaten == key ? 'selected' : '') + '>'+ value +'</option>');
                            });
                            if (selectedKabupaten) {
                                $('#kabupaten').val(selectedKabupaten).trigger('change');
                            }
                        }
                    });
                } else {
                    $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
                }
            }
        
            function loadKecamatan(kabupatenID) {
                if (kabupatenID) {
                    $.ajax({
                        url: '/getKecamatan/' + kabupatenID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
                            $.each(data, function(key, value) {
                                $('#kecamatan').append('<option value="'+ key +'" ' + (selectedKecamatan == key ? 'selected' : '') + '>'+ value +'</option>');
                            });
                            if (selectedKecamatan) {
                                $('#kecamatan').val(selectedKecamatan).trigger('change');
                            }
                        }
                    });
                } else {
                    $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
                }
            }
        
            function loadKelurahan(kecamatanID) {
                if (kecamatanID) {
                    $.ajax({
                        url: '/getKelurahan/' + kecamatanID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');
                            $.each(data, function(key, value) {
                                $('#kelurahan').append('<option value="'+ key +'" ' + (selectedKelurahan == key ? 'selected' : '') + '>'+ value +'</option>');
                            });
                            if (selectedKelurahan) {
                                $('#kelurahan').val(selectedKelurahan);
                            }
                        }
                    });
                } else {
                    $('#kelurahan').empty().append('<option value="">Pilih Kelurahan</option>');
                }
            }
        
            $('#provinsi').change(function() {
                var provinsiID = $(this).val();
                loadKabupaten(provinsiID);
            });
        
            $('#kabupaten').change(function() {
                var kabupatenID = $(this).val();
                loadKecamatan(kabupatenID);
            });
        
            $('#kecamatan').change(function() {
                var kecamatanID = $(this).val();
                loadKelurahan(kecamatanID);
            });
        
            var selectedProvinsi = $('#provinsi').val();
            if (selectedProvinsi) {
                loadKabupaten(selectedProvinsi);
            }
        
            if (selectedKabupaten) {
                loadKecamatan(selectedKabupaten);
            }
        
            if (selectedKecamatan) {
                loadKelurahan(selectedKecamatan);
            }
        });
    </script>
@endsection