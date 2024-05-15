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
                    @foreach ($editPetitum as $data)
                        <a href="{{route('pengadilan')}}" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
                        <a href="{{route('pengadilan')}}" class="breadcrumb-item">Sertifikat Tanah</a>
                        <a href="{{route('detailAllSertifikat',['id'=>$data->id_pemblokiran])}}" class="breadcrumb-item">Detail Data Kasus</a>
                        <span class="breadcrumb-item active">Tambah Data Diri Pihak</span>
                    @endforeach
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
        @foreach($editPetitum as $data)
        <form action="{{route('updateSertifikatPetitum', ['id' => $data->id_pemblokiran])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="border-top">
                    <div class="quill-basic" id="quill-editor" name="petitum">{!! $data->petitum !!}</div>
                </div>
            </div>
            <input type="hidden" name="petitum" id="petitum-input" required>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit form <i class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
        </form>
        @endforeach
    </div>

@endsection