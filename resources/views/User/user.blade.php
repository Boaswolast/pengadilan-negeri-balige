@extends('layouts.user')

@section('content')
<div class="body-user">
    <!-- Basic setup -->
    <div class="content card-user">
        <div class="row">
            <div class="col-xl-9">
    
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Kasus Perkara</h6>
                    </div>
        
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <form class="wizard-form steps-basic" action="{{route('storeSertifikat')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h6>Data Diri Terlibat</h6>
                                    <fieldset>
                                        <div class="addKasus">
                                            <a href="{{route('addDataDiriPihak')}}" type="button" class="btn btn-success">Tambah Pihak</a>
                                        </div>
                                        <!-- Both borders -->
                                        <div class="card">
                                            <div class="card-header" style="background-color: green">
                                                <h5 class="mb-0" style="color: white">Sampaikan Eksekusi Perkara Anda</h5>
                                            </div>
        
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Pihak</th>
                                                            <th>Status Pihak</th>
                                                            <th>Alamat</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>#</td>
                                                            <td>#</td>
                                                            <td>#</td>
                                                            <td>#</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /both borders -->
                                        
                                    </fieldset>
        
                                    <h6>Jenis Eksekusi</h6>
                                    <fieldset>
                                        <div class="row mb-3 mt-4">
                                            <label class="col-lg-4 col-form-label">Jenis Eksekusi:</label>
                                            <div class="col-lg-8">
                                                <select class="form-select" name="jenis_kelamin" required>
                                                    <option value="">Pilih Jenis Eksekusi</option>
                                                    <option value="Laki Laki">Eksekusi Rill/Pengosongan</option>
                                                    <option value="Perempuan">Eksekusi Lelang</option>
                                                </select>
                                            </div>
                                            <div class="mt-4">
                                                <h6>Hal Yang Harus Dipersiapkan</h6>
                                                <ol>
                                                    <li>Surat Permohonan Eksekusi</li>
                                                    <li>Fotocopy Putusan Pengadilan Negeri</li>
                                                    <li>Fotocopy Putusan Pengadilan Tinggi</li>
                                                    <li>Fotocopy Putusan Mahkamah Agung</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </fieldset>
        
                                    <h6>Dokumen Permohonan</h6>
                                    <fieldset>
                                        <div class="card">
                                            <h6 class="upload-header">Surat Permohonana</h6>
                                            <div class="card-body">
                                                <input type="file" name="dokumen_gugatan" class="file-input" required>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <h6 class="upload-header">Putusan Pengadilan Negeri</h6>
                                            <div class="card-body">
                                                <input type="file" name="dokumen_gugatan" class="file-input" required>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <h6 class="upload-header">Putusan Pengadilan Tinggi</h6>
                                            <div class="card-body">
                                                <input type="file" name="dokumen_gugatan" class="file-input" required>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <h6 class="upload-header">Putusan Mahkamah Agung</h6>
                                            <div class="card-body">
                                                <input type="file" name="dokumen_gugatan" class="file-input" required>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
    
            <div class="col-xl-3">
    
                <!-- Sales stats -->
                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                        <h6 class="py-sm-2 my-sm-1">{{ Auth::user()->name }}</h6>
                        <div class="mt-2 mt-sm-0 ms-sm-auto">
                            <a href="#" type="button" class="btn btn-light">Lihat Laporan</a>
                        </div>
                    </div>
    
                    <div class="card-body pb-0">
                        <div class="row text-left">
                            <p>Email</p>
                        </div>
                    </div>

                    <div class="card-body pb-0">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="mb-3">
                                    <p class="mb-0">Terverifikasi</p>
                                    <div class="text-muted fs-sm">0</div>
                                </div>
                            </div>
    
                            <div class="col-4">
                                <div class="mb-3">
                                    <p class="mb-0">Diproses</p>
                                    <div class="text-muted fs-sm">0</div>
                                </div>
                            </div>
    
                            <div class="col-4">
                                <div class="mb-3">
                                    <p class="mb-0">Selesai</p>
                                    <div class="text-muted fs-sm">0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /sales stats -->
    
            </div>
        </div>
    </div>  
    <!-- /basic setup -->
</div>
@endsection