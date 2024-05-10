@extends('layouts.user')
@section('content')

    <!-- Basic setup -->
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">

                    <div class="card-body border-top">
                        @foreach($editDataDiriEksekusi as $data)
                        <form action="{{route('updateDataDiriEksekusi', ['id' => $data->id_data_diri])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Status Pihak:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="status_pihak" required>
                                        <option value="" {{$data->status_pihak === '' ? 'selected' : ''}}>Pilih Status Pihak</option>
                                        <option value="Pemohon" {{$data->status_pihak === 'Pemohon' ? 'selected' : ''}}>Pemohon</option>
                                        <option value="Termohon" {{$data->status_pihak === 'Termohon' ? 'selected' : ''}}>Termohon</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 mt-3">
                                <label class="col-lg-4 col-form-label">Jenis Pihak:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="jenis_pihak" required>
                                        <option value="" {{$data->jenis_pihak === '' ? 'selected' : ''}}>Pilih Pihak</option>
                                        <option value="Perorangan" {{$data->jenis_pihak === 'Perorangan' ? 'selected' : ''}}>Perorangan</option>
                                        <option value="Pemerintah" {{$data->jenis_pihak === 'Pemerintah' ? 'selected' : ''}}>Pemerintah</option>
                                        <option value="Badan Hukum" {{$data->jenis_pihak === 'Badan Hukum' ? 'selected' : ''}}>Badan Hukum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Nama Lengkap:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="{{$data->nama}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tempat Lahir:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{$data->tempat_lahir}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tanggal Lahir:</label>
                                <div class="col-lg-8">
                                    <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="{{$data->tanggal_lahir}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Umur:</label>
                                <div class="col-lg-3">
                                    <input type="number" name="umur" class="form-control" placeholder="Umur" value="{{$data->umur}}">
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-text">Tahun</div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Jenis Kelamin:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="jenis_kelamin" required>
                                        <option value="" {{$data->jenis_kelamin === '' ? 'selected' : ''}}>Pilih Jenis Kelamin</option>
                                        <option value="Laki Laki" {{$data->jenis_kelamin === 'Laki Laki' ? 'selected' : ''}}>Laki-Laki</option>
                                        <option value="Perempuan" {{$data->jenis_kelamin === 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Warga Negara:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="warga_negara" class="form-control" placeholder="Tanggal Lahir" value="{{$data->warga_negara}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Alamat:</label>
                                <div class="col-lg-8">
                                    <textarea rows="3" name="alamat" cols="3" class="form-control" placeholder="Alamat">{{$data->alamat}}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Provinsi:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="provinsi">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsi as $item)
                                            <option value="{{ $item->prov_name }}" {{ $item->prov_name === $item->prov_name ? 'selected' : '' }}>
                                                {{ $item->prov_name }}
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kabupaten:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="kabupaten">
                                        <option value="">Pilih Kabupaten</option>
                                        @foreach($kabupaten as $item)
                                            <option value="{{ $item->city_name }}" {{ $item->city_name === $item->city_name ? 'selected' : '' }}>
                                                {{ $item->city_name }}
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kecamatan:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="kecamatan">
                                        <option value="">Pilih kecamatan</option>
                                        @foreach($kecamatan as $item)
                                            <option value="{{ $item->dis_name }}" {{ $item->dis_name === $item->dis_name ? 'selected' : '' }}>
                                                {{ $item->dis_name }}
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Kelurahan/Desa:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="kelurahan" class="form-control" placeholder="Kelurahan / Desa" value="{{$data->kelurahan}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Pekerjaan:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" value="{{$data->pekerjaan}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Status Kawin:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="status_kawin" required>
                                        <option value="" {{$data->status_kawin === '' ? 'selected' : ''}}>Pilih Status Kawin</option>
                                        <option value="Kawin" {{$data->status_kawin === 'Kawin' ? 'selected' : ''}}>Kawin</option>
                                        <option value="Belum Kawin" {{$data->status_kawin === 'Belum Kawin' ? 'selected' : ''}}>Belum Kawin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Pendidikan:</label>
                                <div class="col-lg-8">
                                    <select class="form-select" name="pendidikan">
                                        <option value="" {{$data->pendidikan === '' ? 'selected' : ''}}>Pilih Pendidikan</option>
                                        <option value="SD" {{$data->pendidikan === 'SD' ? 'selected' : ''}}>Sekolah Dasar (SD)</option>
                                        <option value="SMP" {{$data->pendidikan === 'SMP' ? 'selected' : ''}}>OSekolah Menengah Pertama (SMP)</option>
                                        <option value="SMA" {{$data->pendidikan === 'SMA' ? 'selected' : ''}}>Sekolah Menengah Atas (SMA)</option>
                                        <option value="Sarjana" {{$data->pendidikan === 'Sarjana' ? 'selected' : ''}}>Sarjana (S1)</option>
                                        <option value="Magister" {{$data->pendidikan === 'Magister' ? 'selected' : ''}}>Magister (S2)</option>
                                        <option value="Doktoral" {{$data->pendidikan === 'Doktoral' ? 'selected' : ''}}>Doktoral (S3)</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="garisDataDiri">
                            <h5>Informasi Tambahan</h5>
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">NIK:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="nik" class="form-control" placeholder="NIK" value="{{$data->nik}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Alamat Email:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="email" class="form-control" placeholder="Alamat Email" value="{{$data->email}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Nomor Telepon:</label>
                                <div class="col-lg-8">
                                    <input type="text" name="no_telp" class="form-control" placeholder="No Telepon" value="{{$data->no_telp}}">
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