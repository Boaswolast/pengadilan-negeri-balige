@extends('layouts.pertanahan')
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
                    <span class="breadcrumb-item active">Detail Permohonan Pemblokiran Sertifikat Tanah</span>
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
            <div class="card-header" style="background-color: green">
                <h6 class="mb-0" style="color: white">Unggah Surat Keputusan Pemblokiran Tanah</h6>
            </div>

            <div class="card-body border-top">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <form action="{{route('submitBuktiPemblokiran')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <input type="file" name="dokumen_gugatan" class="file-input">
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <a href="{{route('uploadBuktiPemblokiran')}}" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                                <button type="submit" class="btn btn-success">Upload <i class="ph-paper-plane-tilt ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- /basic setup -->
@endsection