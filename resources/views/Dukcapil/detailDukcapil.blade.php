@extends('layouts.pertanahan')
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
<div class="content">
    <div class="col-lg-12">
        <div class="card card-body ">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#pihak" class="nav-link active">Pihak</a></li>
                <li class="nav-item"><a href="#amar_putusan" class="nav-link">Amar Putusan</a></li>
                <li class="nav-item"><a href="#surat" class="nav-link">Surat</a></li>
                <li class="nav-item"><a href="#surat_pengantar" class="nav-link">Surat Pengantar</a></li>
                <li class="nav-item"><a href="#status" class="nav-link">Status</a></li>
            </ul>

            <div id="pihak" class="tab-content active">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pihak</th>
                            <th>Status Pihak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!@empty($data))
                        @foreach($data as $pihak)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$pihak->nama}}</td>
                            <td>{{$pihak->status_pihak}}</td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>
        
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{route('detailDataDiriDukcapil', ['id' => $pihak->id_data_diri])}}" class="dropdown-item text-info">
                                                <i class="ph-eye me-2"></i>
                                                Detail Data Diri
                                            </a>
                                            {{-- <a href="{{route('editSertifikat', ['id' => $data->id_data_diri])}}" class="dropdown-item text-secondary">
                                                <i class="ph-pencil me-2"></i>
                                                Edit
                                            </a>
                                            <form action="{{route('showDeleted', ['id' => $data->id_data_diri])}}" type="button" method="POST" class="dropdown-item text-danger">
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
            <div id="amar_putusan" class="tab-content">
                @foreach($dataAmar as $data)
                    <div class="mt-5">{!! $data->amar_putusan !!}</div>
                @endforeach
            </div>
            <div id="surat" class="tab-content">
                <h3>Gugatan Content</h3>
                @foreach($dataPutusan as $data)
                <div>
                    <h5>Putusan PN</h5>
                    @if($data->putusan_pn!=null)
                        <div>
                            <iframe src="{{ asset('files/putusanPN/'.$data->putusan_pn) }}" width="100%" height="400px"></iframe>
                        </div>
                    @else
                        <p>Tidak Ada Data</p>
                    @endif
                </div>
                <div>
                    <h5 class="mt-3">Putusan PT</h5>
                    @if($data->putusan_pt!=null)
                        <div>
                            <iframe src="{{ asset('files/putusanPT/'.$data->putusan_pt) }}" width="100%" height="400px"></iframe>
                        </div>
                    @else
                        <p>Tidak Ada Data</p>
                    @endif
                </div>
                <div>
                    <h5 class="mt-3">Putusan MA RI</h5>
                    @if($data->putusan_ma!=null)
                        <div>
                            <iframe src="{{ asset('files/putusanMA/'.$data->putusan_ma) }}" width="100%" height="400px"></iframe>
                        </div>
                    @else
                        <p>Tidak Ada Data</p>
                    @endif
                </div>
                @endforeach
            </div>
            <div id="surat_pengantar" class="tab-content">
                <h3>Gugatan Content</h3>
                @foreach($dataPengantar as $data)
                    @php
                        $fileExtension = pathinfo($data->surat_pengantar, PATHINFO_EXTENSION);
                        $fileUrl = asset('files/surat-pengantar/'.$data->surat_pengantar);
                    @endphp
                    
                    @if ($fileExtension == 'pdf')
                        <iframe src="{{ $fileUrl }}" width="100%" height="600px"></iframe>
                    @else
                        <p>File tidak dapat ditampilkan secara langsung. Silakan unduh untuk melihatnya.</p>
                        <a href="{{ $fileUrl }}" class="btn btn-primary">Unduh file</a>
                    @endif
                    {{-- <iframe src="{{ asset('files/surat-pengantar/'.$data->surat_pengantar) }}" width="100%" height="600px"></iframe> --}}
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
                                <td style="width: 300px">Tanggal Ditanda Tangani</td>
                                <td>:</td>
                                <td>{{$data->created_at}}</td>
                            </tr>
                            <tr  class="table-success">
                                <td>Tanggal Diproses</td>
                                <td>:</td>
                                <td>{{$data->tgl_diproses}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal selesai</td>
                                <td>:</td>
                                <td>{{$data->tgl_selesai}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="addKasus mt-4">
                    @foreach($dataPengantar as $id)
                    @if ($id->status_id == 1)
                        <a href="{{route('diprosesCapil', ['id' => $id->id_peristiwa])}}" type="button" class="btn btn-success">Proses Kasus</a>
                    @endif
                        <a href="{{route('konfirmasiCapil', ['id' => $id->id_peristiwa])}}" type="button" class="btn btn-success">Kasus Selesai</a>
                    @endforeach
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


@endsection
