@extends('layouts.pengadilan')
@section('content')
 <!-- Page header -->
 <div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Detail Pihak Peristiwa Penting
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">@foreach($data as $d)
                <a href="{{route('peristiwa')}}" class="breadcrumb-item"><i class="ph-user-square"></i></a>
                <a href="{{route('peristiwa')}}" class="breadcrumb-item">Peristiwa Penting</a>
                <a href="{{route('detailPeristiwa',['id'=>$d->id_peristiwa])}}" class="breadcrumb-item">Detail</a>
                <span class="breadcrumb-item active">Data Diri</span>
            </div>

            <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
</div>
<!-- /page header -->
<div class="content">
    <style>
        .Filter {
            padding-top: 10px;
            /* margin-top: 20px */
            margin-right: 10px;
        }
        th:nth-child(1),
        td:nth-child(1) {
            width: 25%; /* Lebar kolom kedua */
        }
        
        th:nth-child(2),
        td:nth-child(2) {
            width: 10%; /* Lebar kolom kedua */
        }
    </style>
    <div class="card p-3">
        
        <div class="breadcrumb py-2 mb-2">
                <a href="{{route('detailPeristiwa',['id'=>$d->id_peristiwa])}}" class="breadcrumb-item"><b>< Kembali</b></a>
            </div>

						<div class="table-responsive">
							<table class="table" style="width: 80%;">
			                    <tbody>
			                        <tr class="table-success">
			                            <td>Status Pihak</td>
			                            <td>:</td>
			                            <td>{{ $d->status_pihak }}</td>
			                        </tr>
			                        <tr>
			                            <td>Jenis Pihak</td>
			                            <td>:</td>
			                            <td>{{ $d->jenis_pihak }}</td>
			                        </tr>
                                    <tr class="table-success">
			                            <td>Nama Lengkap</td>
			                            <td>:</td>
			                            <td>{{ $d->nama }}</td>
			                        </tr>
			                        <tr>
			                            <td>Tempat Lahir</td>
			                            <td>:</td>
			                            <td>{{ $d->tempat_lahir }}</td>
			                        </tr>
                                    <tr class="table-success">
			                            <td>Tanggal Lahir</td>
			                            <td>:</td>
			                            <td>{{ \Carbon\Carbon::parse($d->tanggal_lahir)->translatedFormat('d F Y') }}</td>
			                        </tr>
			                        <tr>
			                            <td>Umur</td>
			                            <td>:</td>
			                            <td>{{ $d->umur }}</td>
			                        </tr>
                                    <tr class="table-success">
			                            <td>Jenis Kelamin</td>
			                            <td>:</td>
			                            <td>{{ $d->jenis_kelamin }}</td>
			                        </tr>
			                        <tr>
			                            <td>Warga Negara</td>
			                            <td>:</td>
			                            <td>{{ $d->warga_negara }}</td>
			                        </tr>
                                    <tr class="table-success">
			                            <td>Alamat</td>
			                            <td>:</td>
			                            <td>{{ $d->alamat }}</td>
			                        </tr>
			                        <tr>
			                            <td>Provinsi</td>
			                            <td>:</td>
			                            <td>{{ $d->provinsi }}</td>
			                        </tr>
                                    <tr class="table-success">
			                            <td>Kabupaten</td>
			                            <td>:</td>
			                            <td>{{ $d->kabupaten }}</td>
			                        </tr>
			                        <tr>
			                            <td>Kecamatan</td>
			                            <td>:</td>
			                            <td>{{ $d->kecamatan }}</td>
			                        </tr>
                                    <tr class="table-success">
			                            <td>Kelurahan</td>
			                            <td>:</td>
			                            <td>{{ $d->kelurahan }}</td>
			                        </tr>
			                        <tr>
			                            <td>Pekerjaan</td>
			                            <td>:</td>
			                            <td>{{ $d->pekerjaan }}</td>
			                        </tr>
                                    <tr class="table-success">
			                            <td>Status Kawin</td>
			                            <td>:</td>
			                            <td>{{ $d->status_kawin }}</td>
			                        </tr>
			                        <tr>
			                            <td>Pendidikan</td>
			                            <td>:</td>
			                            <td>{{ $d->pendidikan }}</td>
			                        </tr>
			                        
			                    </tbody>
			                </table>
                    
                            <div class="card-header mt-3">
                                <h6 class="mb-0">Informasi Tambahan</h6>
                            </div>
                            <div class="card-body"></div>
                            <table class="table" style="width: 80%;">
			                    <tbody>
			                        <tr class="table-success">
			                            <td>NIK</td>
			                            <td>:</td>
			                            <td>{{ $d->nik }}</td>
			                        </tr>
			                        <tr>
			                            <td>Alamat Email</td>
			                            <td>:</td>
			                            <td>{{ $d->email }}</td>
			                        </tr>
                                    <tr class="table-success">
			                            <td>No Telp</td>
			                            <td>:</td>
			                            <td>{{ $d->no_telp }}</td>
			                        </tr>
			                        
			                    </tbody>
			                </table>
						</div>
					</div>
    </div>@endforeach
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
        var initialTab = document.querySelector('.nav-tabs .nav-link[href="#pihak"]');
        initialTab.classList.add('active');
        showTabContent('#pihak');
    });
</script>


@endsection
