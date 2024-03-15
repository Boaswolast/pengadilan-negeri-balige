@extends('layouts.pengadilan')
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Sertifikat Tanah - <span class="fw-normal">Tambah Kasus</span>
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
                    <span class="breadcrumb-item active">Tambah Kasus</span>
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
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Tambah Kasus</h6>
            </div>

            <div class="card-body border-top">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <form class="wizard-form steps-basic" action="{{'storeSertifikat'}}" method="POST">
                            @csrf
                            <h6>Data Diri</h6>
                            <fieldset>
                                <div class="row mb-3 mt-3">
                                    <label class="col-lg-4 col-form-label">Nama Lengkap:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Tempat Lahir:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Tanggal Lahir:</label>
                                    <div class="col-lg-8">
                                        <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Umur:</label>
                                    <div class="col-lg-3">
                                        <input type="number" name="umur" class="form-control" placeholder="Umur">
                                    </div>
                                    <div class="col-lg-4">
										<div class="form-text">Tahun</div>
									</div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Jenis Kelamin:</label>
                                    <div class="col-lg-8">
                                        <select class="form-select" name="jenis_kelamin">
                                            <option value="opt1">Pilih Jenis Kelamin</option>
                                            <option value="opt2">Option 2</option>
                                            <option value="opt3">Option 3</option>
                                            <option value="opt4">Option 4</option>
                                            <option value="opt5">Option 5</option>
                                            <option value="opt6">Option 6</option>
                                            <option value="opt7">Option 7</option>
                                            <option value="opt8">Option 8</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Warga Negara:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="warga_negara" class="form-control" placeholder="Tanggal Lahir">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Alamat:</label>
									<div class="col-lg-8">
										<textarea rows="3" name="alamat" cols="3" class="form-control" placeholder="Alamat"></textarea>
									</div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Provinsi:</label>
                                    <div class="col-lg-8">
                                        <select class="form-select" name="provinsi">
                                            <option value="opt1">Pilih Provinsi</option>
                                            <option value="opt2">Option 2</option>
                                            <option value="opt3">Option 3</option>
                                            <option value="opt4">Option 4</option>
                                            <option value="opt5">Option 5</option>
                                            <option value="opt6">Option 6</option>
                                            <option value="opt7">Option 7</option>
                                            <option value="opt8">Option 8</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Kabupaten:</label>
                                    <div class="col-lg-8">
                                        <select class="form-select" name="kabupaten">
                                            <option value="opt1">Pilih Kabupaten</option>
                                            <option value="opt2">Option 2</option>
                                            <option value="opt3">Option 3</option>
                                            <option value="opt4">Option 4</option>
                                            <option value="opt5">Option 5</option>
                                            <option value="opt6">Option 6</option>
                                            <option value="opt7">Option 7</option>
                                            <option value="opt8">Option 8</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Kecamatan:</label>
                                    <div class="col-lg-8">
                                        <select class="form-select" name="kecamatan">
                                            <option value="opt1">Pilih kecamatan</option>
                                            <option value="opt2">Option 2</option>
                                            <option value="opt3">Option 3</option>
                                            <option value="opt4">Option 4</option>
                                            <option value="opt5">Option 5</option>
                                            <option value="opt6">Option 6</option>
                                            <option value="opt7">Option 7</option>
                                            <option value="opt8">Option 8</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Kelurahan/Desa:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="kelurahan" class="form-control" placeholder="Kelurahan / Desa">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Pekerjaan:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Satatus Kawin:</label>
                                    <div class="col-lg-8">
                                        <select class="form-select" name="status_kawin">
                                            <option value="opt1">Pilih Status Kawin</option>
                                            <option value="opt2">Option 2</option>
                                            <option value="opt3">Option 3</option>
                                            <option value="opt4">Option 4</option>
                                            <option value="opt5">Option 5</option>
                                            <option value="opt6">Option 6</option>
                                            <option value="opt7">Option 7</option>
                                            <option value="opt8">Option 8</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-lg-4 col-form-label">Pendidikan:</label>
                                    <div class="col-lg-8">
                                        <select class="form-select" name="pendidikan">
                                            <option value="opt1">Pilih Pendidikan</option>
                                            <option value="opt2">Option 2</option>
                                            <option value="opt3">Option 3</option>
                                            <option value="opt4">Option 4</option>
                                            <option value="opt5">Option 5</option>
                                            <option value="opt6">Option 6</option>
                                            <option value="opt7">Option 7</option>
                                            <option value="opt8">Option 8</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <h6>Petitum</h6>
                            <fieldset>
                                <div class="card">
                                    <div>
										<textarea rows="15" cols="3" name="petitum" class="form-control" placeholder="Alamat"></textarea>
									</div>
                                </div>
                            </fieldset>

                            <h6>Permohonan</h6>
                            <fieldset>
                                <div class="card">
                                    <div class="card-body">
                                        <input type="file" name="permohonan" class="file-input">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /basic setup -->
@endsection