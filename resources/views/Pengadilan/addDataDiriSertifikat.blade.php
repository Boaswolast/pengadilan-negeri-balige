@extends('layouts.pengadilan')
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
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Sertifikat Tanah - Tambah Kasus - <span class="fw-normal">Tambah Data Diri</span>
                </h4>

                <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{route('home')}}" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="#" class="breadcrumb-item">Sertifikat Tanah</a>
                    <a href="#" class="breadcrumb-item">Tambah Kasus</a>
                    <span class="breadcrumb-item active">Tambah Data Diri</span>
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
                    <h5 class="mb-0">Tambah Data Diri</h5>
                </div>
                <div class="card-body border-top">
                    <form action="{{route('addTemporarySertifikat')}}" method="POST" id="formDataDiri">
                        @csrf
                        <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Status Pihak:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="status_pihak" required>
                                    <option value="">Pilih Status Pihak</option>
                                    <option value="Penggugat">Penggugat</option>
                                    <option value="Tergugat">Tergugat</option>
                                    <option value="Intervensi">Intervensi</option>
                                    <option value="Turut Tergugat">Turut Tergugat</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Jenis Pihak:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="jenis_pihak" required>
                                    <option value="">Pilih Pihak</option>
                                    <option value="Perorangan">Perorangan</option>
                                    <option value="Pemerintah">Pemerintah</option>
                                    <option value="Badan Hukum">Badan Hukum</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Nama Lengkap:</label>
                            <div class="col-lg-8">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Tempat Lahir:</label>
                            <div class="col-lg-8">
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Tanggal Lahir:</label>
                            <div class="col-lg-8">
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" required>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Umur:</label>
                            <div class="col-lg-3">
                                <input type="number" name="umur" class="form-control" placeholder="Umur" required>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-text">Tahun</div>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Jenis Kelamin:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Warga Negara:</label>
                            <div class="col-lg-8">
                                <input type="text" name="warga_negara" class="form-control" placeholder="Warga Negara" required>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Alamat:</label>
                            <div class="col-lg-8">
                                <textarea rows="3" name="alamat" cols="3" class="form-control" placeholder="Alamat" required></textarea>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Provinsi:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="provinsi" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinsi as $item)
                                        <option value="{{$item->prov_name}}">{{$item->prov_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Kabupaten:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="kabupaten" required>
                                    <option value="">Pilih Kabupaten</option>
                                    @foreach($kabupaten as $item)
                                        <option value="{{$item->city_name}}">{{$item->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Kecamatan:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="kecamatan" required>
                                    <option value="">Pilih kecamatan</option>
                                    @foreach($kecamatan as $item)
                                        <option value="{{$item->dis_name}}">{{$item->dis_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Kelurahan/Desa:</label>
                            <div class="col-lg-8">
                                <input type="text" name="kelurahan" class="form-control" placeholder="Kelurahan / Desa" required>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Pekerjaan:</label>
                            <div class="col-lg-8">
                                <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" required>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Satatus Kawin:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="status_kawin" required>
                                    <option value="">Pilih Status Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Pendidikan:</label>
                            <div class="col-lg-8">
                                <select class="form-select" name="pendidikan" required>
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SD">Sekolah Dasar (SD)</option>
                                    <option value="SMP">OSekolah Menengah Pertama (SMP)</option>
                                    <option value="SMA">Sekolah Menengah Atas (SMA)</option>
                                    <option value="Sarjana">Sarjana (S1)</option>
                                    <option value="Magister">Magister (S2)</option>
                                    <option value="Doktoral">Doktoral (S3)</option>
                                </select>
                            </div>
                        </div>

                        <hr class="garisDataDiri">
                        <h6 style="margin-bottom: 40px">Informasi Tambahan</h6>

                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">NIK:</label>
                            <div class="col-lg-8">
                                <input type="text" name="nik" class="form-control" placeholder="NIK" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Email:</label>
                            <div class="col-lg-8">
                                <input type="email" name="email" class="form-control" placeholder="Alamat Email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">No Telepon:</label>
                            <div class="col-lg-8">
                                <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon" required>
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
@endsection