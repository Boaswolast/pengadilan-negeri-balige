@extends('layouts.pengadilan')
@section('content')
 <!-- Page header -->
 <div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Sertifikat Tanah - <span class="fw-normal">Detail Data Kasus</span>
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{route('pengadilan')}}" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
                <a href="{{route('pengadilan')}}" class="breadcrumb-item">Sertifikat Tanah</a>
                <span class="breadcrumb-item active">Detail Data Kasus</span>
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
        <div class="card card-body">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#pihak" class="nav-link active">Pihak</a></li>
                <li class="nav-item"><a href="#petitum" class="nav-link">Petitum</a></li>
                <li class="nav-item"><a href="#gugatan" class="nav-link">Gugatan</a></li>
                <li class="nav-item"><a href="#status" class="nav-link">Status</a></li>
            </ul>

            <div id="pihak" class="tab-content active">
                @foreach($status as $data)
                    @if ($data->status_id == 4)
                        <div class="addGugatan mt-4">
                            <a href="{{route('addPihakPengadilan',$id)}}" type="button" class="btn btn-success">Tambah Pihak</a>
                        </div>
                    @endif
                @endforeach
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pihak</th>
                            <th>Status Pihak</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!@empty($dataDiriAll))
                        @foreach($dataDiriAll as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->status_pihak}}</td>
                            <td>{{$data->email}}</td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>
        
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{route('detailSertifikat', ['id' => $data->id_data_diri])}}" class="dropdown-item text-info">
                                                <i class="ph-eye me-2"></i>
                                                Detail
                                            </a>
                                            <a href="{{route('editSertifikat', ['id' => $data->id_data_diri])}}" class="dropdown-item text-secondary">
                                                <i class="ph-pencil me-2"></i>
                                                Edit
                                            </a>
                                            <a href="{{route('showDeleted', ['id' => $data->id_data_diri])}}" type="button" class="dropdown-item text-danger" onclick="return DeleteDataDiriSertifikat(event)">
                                                <i class="ph-trash me-2"></i>
                                                Hapus
                                            </a>
                                            {{-- <form action="{{route('showDeleted', ['id' => $data->id_data_diri])}}" type="button" method="POST" class="dropdown-item text-danger">
                                                <i class="ph-trash me-2"></i>
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item text-danger" style="margin-left: -20px" type="submit">Hapus</button>
                                            </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" style="text-align: center">Tidak ada data yang tersedia.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div id="petitum" class="tab-content">
                @foreach($dataPetitum as $data)
                @foreach($status as $data)
                    @if ($data->status_id == 4)
                    <div class="addGugatan mt-4">
                        <a href="{{route('editSertifikatPetitum', ['id' => $data->id_pemblokiran])}}" type="button" class="btn btn-primary"><i class="ph-pencil me-2"></i>Edit</a>
                    </div>
                    @endif
                @endforeach
                    <div class="mt-4">{!! $data->petitum !!}</div>
                @endforeach
            </div>
            <div id="gugatan" class="tab-content">
                @foreach($dataGugatan as $data)
                    <iframe class="mt-4" src="{{ asset('dokumen/Pengadilan/'.$data->dokumen_gugatan) }}" width="100%" height="400px"></iframe>
                    {{-- <a href="{{url('/download', $data->dokumen_gugatan)}}"><button class="btn btn-success">Download</button></a>
                    <a href="{{url('/print', $data->dokumen_gugatan)}}"><button class="btn btn-primary">View</button></a> --}}
                @endforeach
            </div>
            <div id="status" class="tab-content">
                <div class="table-responsive mt-4">
                    <table class="table">
                        <tbody>
                            @foreach($dataStatus as $data)
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Permohonan</td>
                                <td>:</td>
                                <td>{{$data->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Diproses</td>
                                <td>:</td>
                                <td>{{$data->tgl_diproses}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Tanggal selesai</td>
                                <td>:</td>
                                <td>{{$data->tgl_selesai}}</td>
                            </tr>
                            @endforeach
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
        var initialTab = document.querySelector('.nav-tabs .nav-link[href="#pihak"]');
        initialTab.classList.add('active');
        showTabContent('#pihak');
    });
</script>

<script>
    function DeleteDataDiriSertifikat(event) {
        // Mengambil URL dari tombol
        const url = event.target.href;

        // Menampilkan pesan konfirmasi Sweet Alert dengan gaya tambahan
        Swal.fire({
            title: 'Apakah Anda yakin menghapus Permohonan Pemblokiran Sertifikat Tanah ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal', // Mengganti teks tombol batal
            customClass: {
                confirmButton: 'btn btn-success', // Gaya tambahan untuk tombol konfirmasi
                cancelButton: 'btn btn-light' // Gaya tambahan untuk tombol batal
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL jika pengguna mengonfirmasi
                window.location.href = url;
            } else {
                // Mencegah tindakan default jika pengguna membatalkan
                event.preventDefault();
            }
        });

        // Mencegah tindakan default dari event klik
        event.preventDefault();
    }
</script>

@endsection
