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
                        <form class="wizard-form steps-basic" action="{{route('storeSertifikat')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h6>Data Diri</h6>
                            <fieldset>
                                <div class="addKasus">
                                    <a href="{{route('addDataDiriSertifikat')}}" type="button" class="btn btn-success">Tambah Pihak</a>
                                </div>
                                <!-- Both borders -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Pemblokiran Sertifikat Tanah</h5>
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
                                                @if(!@empty(session('temporary_sertifikat')))
                                                @foreach(session('temporary_sertifikat') as $sertifikat)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $sertifikat['nama'] ?? '' }}</td>
                                                    <td>{{ $sertifikat['status_pihak'] ?? '' }}</td>
                                                    <td>{{ $sertifikat['alamat'] ?? '' }}</td>
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
                                </div>
                                <!-- /both borders -->
                                
                            </fieldset>

                            <h6>Petitum</h6>
                            <fieldset>
                                <div class="card">
                                    <div class="border-top">
                                        <div class="quill-basic" id="quill-editor" name="petitum"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="petitum" id="petitum-input">
                            </fieldset>

                            <h6>Permohonan</h6>
                            <fieldset>
                                <div class="card">
                                    <div class="card-body">
                                        <input type="file" name="dokumen_gugatan" class="file-input">
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