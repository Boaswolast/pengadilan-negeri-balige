@extends('layouts.pengadilan')
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Sertifikat Tanah - Detail Data Kasus - <span class="fw-normal">Edit Data Diri Kasus</span>
                </h4>

                <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    @foreach ($sertifikat_tanah as $data)
                    <a href="{{route('pengadilan')}}" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
                    <a href="{{route('pengadilan')}}" class="breadcrumb-item">Sertifikat Tanah</a>
                    <a href="{{route('detailAllSertifikat',['id'=>$data->id_pemblokiran])}}" class="breadcrumb-item">Detail Data Kasus</a>
                    <span class="breadcrumb-item active">Edit Data Diri Pihak</span>
                    @endforeach
                </div>

                <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Basic setup -->
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">

                    <div class="card-body border-top">
                        @foreach($sertifikat_tanah as $data)
                        <form action="{{route('updateSertifikat', ['id' => $data->id_data_diri])}}" method="POST" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Status Pihak:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="status_pihak" title="Pilihlah sesuai status pihak anda" required>
                                        <option value="" {{$data->status_pihak === '' ? 'selected' : ''}}>Pilih Status Pihak</option>
                                        <option value="Penggugat" {{$data->status_pihak === 'Penggugat' ? 'selected' : ''}}>Penggugat</option>
                                        <option value="Tergugat" {{$data->status_pihak === 'Tergugat' ? 'selected' : ''}}>Tergugat</option>
                                        <option value="Intervensi" {{$data->status_pihak === 'Intervensi' ? 'selected' : ''}}>Intervensi</option>
                                        <option value="Turut Tergugat" {{$data->status_pihak === 'Turut Tergugat' ? 'selected' : ''}}>Turut Tergugat</option>
                                    </select>
                                    @error('status_pihak')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label class="col-lg-4 col-form-label">Jenis Pihak:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="jenis_pihak" title="Pilihlah sesuai jenis pihak anda" required>
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
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" pattern="[A-Za-z\s]+" title="Hanya huruf yang diizinkan" value="{{$data->nama}}">
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tempat Lahir:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" title="Mohon mengisi bagian ini" value="{{$data->tempat_lahir}}">
                                    @error('tempat_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tanggal Lahir:</label>
                                <div class="col-lg-8">
                                    <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" title="Mohon mengisi bagian ini" value="{{$data->tanggal_lahir}}">
                                    @error('tanggal_lahir')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Umur:</label>
                                <div class="col-lg-3">
                                    <input type="number" name="umur" class="form-control" placeholder="Umur" title="Mohon mengisi bagian ini" value="{{$data->umur}}">
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
                                    <select class="form-select" name="jenis_kelamin" title="Mohon memilih bagian ini" required>
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
                                    <input type="text" name="warga_negara" class="form-control" placeholder="Tanggal Lahir" title="Mohon mengisi bagian ini" value="{{$data->warga_negara}}">
                                    @error('warga_negara')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Alamat:</label>
                                <div class="col-lg-8">
                                    <textarea rows="3" name="alamat" cols="3" class="form-control" placeholder="Alamat" title="Mohon mengisi bagian ini">{{$data->alamat}}</textarea>
                                    @error('alamat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Provinsi:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="provinsi" title="Mohon memilih bagian ini">
                                        <option value="">Pilih Provinsi</option>
                                        
                                        @foreach($provinsi as $item)
                                            <option value="{{ $item->prov_name }}" {{ $item->prov_name === $item->prov_name ? 'selected' : '' }}>
                                                {{ $item->prov_name }}
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
                                    <select class="form-select" name="kabupaten" title="Mohon memilih bagian ini">
                                        <option value="">Pilih Kabupaten</option>
                                        @foreach($kabupaten as $item)
                                            <option value="{{ $item->city_name }}" {{ $item->city_name === $item->city_name ? 'selected' : '' }}>
                                                {{ $item->city_name }}
                                        @endforeach
                                    </select>
                                    @error('kabupaten')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kecamatan:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="kecamatan" title="Mohon memilih bagian ini">
                                        <option value="">Pilih kecamatan</option>
                                        @foreach($kecamatan as $item)
                                            <option value="{{ $item->dis_name }}" {{ $item->dis_name === $item->dis_name ? 'selected' : '' }}>
                                                {{ $item->dis_name }}
                                        @endforeach
                                    </select>
                                    @error('kecamatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kelurahan/Desa:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="kelurahan" title="Mohon memilih bagian ini">
                                        <option value="">Pilih kelurahan</option>
                                        @foreach($kelurahan as $item)
                                            <option value="{{ $item->subdis_name }}" {{ $item->subdis_name === $item->subdis_name ? 'selected' : '' }}>
                                                {{ $item->subdis_name }}
                                        @endforeach
                                    </select>
                                    @error('kelurahan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Pekerjaan:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" title="Mohon mengisi bagian ini" value="{{$data->pekerjaan}}">
                                    @error('pekerjaan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Status Kawin:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="status_kawin" title="Mohon memilih bagian ini" required>
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
                                    <select class="form-select" name="pendidikan" title="Mohon memilih bagian ini">
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
                                    <input type="text" name="nik" class="form-control" placeholder="NIK" title="Mohon mengisi bagian ini" value="{{$data->nik}}">
                                    @error('nik')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Alamat Email:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="email" class="form-control" placeholder="Alamat Email" title="Mohon mengisi bagian ini" value="{{$data->email}}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Nomor Telepon:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="no_telp" class="form-control" placeholder="No Telepon" title="Mohon mengisi bagian ini" value="{{$data->no_telp}}">
                                    @error('no_telp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic setup -->
@endsection