@extends('layouts.pengadilan')
@section('content')
 <!-- Page header -->
 <div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Sertifikat Tanah - <span class="fw-normal">Detail Permohonan Pemblokiran Sertifikat Tanah</span>
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
                <span class="breadcrumb-item active">Detail</span>
            </div>

            <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
</div>
<!-- /page header -->
<div class="content">
    <div class="col-lg-12">
        <div class="card card-body ">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#datadiri" class="nav-link active">Data Diri</a></li>
                <li class="nav-item"><a href="#petitum" class="nav-link">Petitum</a></li>
                <li class="nav-item"><a href="#gugatan" class="nav-link">Gugatan</a></li>
                <li class="nav-item"><a href="#status" class="nav-link">Status</a></li>
            </ul>

            <div id="datadiri" class="tab-content active">
                <div class="addGugatan mt-4">
                    <!-- <a href="{{route('addSertifikatPengadilan')}}" type="button" class="btn btn-success">Tambah Pihak</a> -->
                </div>
                <!-- <table class="table table-bordered mt-3"></table> -->
                    <!-- Centered card -->
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Data Diri</h5>
                            </div>
                            <div class="card-body border-top">
                                <form action="{{route('addTemporarySertifikat')}}" method="POST">
                                    @csrf
                                    <div class="row mb-3 mt-3">
                                        <label class="col-lg-4 col-form-label">Status Pihak:</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="nama" class="form-control" placeholder="Status Pihak">
                                        </div>
                                    </div>

                                    <div class="row mb-3 mt-3">
                                        <label class="col-lg-4 col-form-label">Jenis Pihak:</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="nama" class="form-control" placeholder="Jenis Pihak">
                                        </div>
                                    </div>

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
                                                <option value="#">Pilih Jenis Kelamin</option>
                                                <option value="Laki Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Warga Negara:</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="warga_negara" class="form-control" placeholder="Warga Negara">
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
                                                <option value="#">Pilih Provinsi</option>

                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Kabupaten:</label>
                                        <div class="col-lg-8">
                                            <select class="form-select" name="kabupaten">
                                                <option value="#">Pilih Kabupaten</option>

                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Kecamatan:</label>
                                        <div class="col-lg-8">
                                            <select class="form-select" name="kecamatan">
                                                <option value="#">Pilih kecamatan</option>

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
                                                <option value="Kawin">Kawin</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Pendidikan:</label>
                                        <div class="col-lg-8">
                                            <select class="form-select" name="pendidikan">
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

                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">Email:</label>
                                        <div class="col-lg-8">
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">No Telepon:</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="no_telp" class="form-control" placeholder="No Telepon">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-lg-4 col-form-label">NIK:</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="nik" class="form-control" placeholder="NIK">
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
            <div id="gugatan" class="tab-content">
                <h3>Gugatan Content</h3>
                <p>Content for Gugatan tab goes here.</p>
            </div>
            <div id="status" class="tab-content">
                <div class="table-responsive mt-4">
                    <table class="table">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Permohonan</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tanggal Diproses</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr class="table-success">
                                <td>Tanggal selesai</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <!-- Tombol Konfirmasi Pemblokiran -->
                            <div class="konfirmasiPemblokiran position-fixed bottom-0 end-0 mb-5 me-5">
                                <a href="{{route('addSKBPN')}}" type="button" class="btn btn-success">Konfirmasi Pemblokiran</a>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tabs = document.querySelectorAll('.nav-tabs a');
        
        // Function to show content based on selected tab
        function showTabContent(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.style.display = 'none';
            });
            // Show the content of the selected tab
            document.querySelector(tabId).style.display = 'block';
        }

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                var targetId = this.getAttribute('href');
                var targetElement = document.querySelector(targetId);

                document.querySelectorAll('.nav-link').forEach(function(navLink) {
                    navLink.classList.remove('active');
                });
                this.classList.add('active');

                // Show content based on selected tab
                showTabContent(targetId);
            });
        });

        // Set initial active tab content to 'Pihak' when the page loads
        var initialTab = document.querySelector('.nav-tabs .nav-link[href="#datadiri"]');
        initialTab.classList.add('active');
        showTabContent('#datadiri');
    });
</script>


@endsection
