@extends('layouts.pengadilan')
@section('content')


    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Edit Amar Putusan
                </h4>

                <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
        @foreach($data as $d)
        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    
                    <a href="{{route('peristiwa')}}" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
                    <a href="{{route('peristiwa')}}" class="breadcrumb-item">Peristiwa Penting</a>
                    <a href="{{route('detailPeristiwa', $d->id_peristiwa)}}" class="breadcrumb-item">Detail</a>
                    <span class="breadcrumb-item active">Edit Amar Putusan</span>
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
        {{-- @foreach($editPetitum as $data) --}}
        <form action="{{route('updateAmarPutusan', $d->id_peristiwa)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="border-top">
                    <div class="quill-basic" id="quill-editor" name="amar_putusan">{!! $d->amar_putusan !!}</div>
                </div>
            </div>
            <input type="hidden" name="amar_putusan" id="petitum-input" required value="{!! $d->amar_putusan !!}">
            <div class="text-end">
                <a href="{{route('detailPeristiwa', $d->id_peristiwa)}}" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan<i class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
        </form>
        
    </div>
    @endforeach
@endsection