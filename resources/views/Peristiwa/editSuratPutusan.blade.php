@extends('layouts.pengadilan')
@section('content')


    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Edit Surat Putusan
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
                    
                    <a href="{{route('peristiwa')}}" class="breadcrumb-item"><i class="ph-user-square"></i></a>
                    <a href="{{route('peristiwa')}}" class="breadcrumb-item">Peristiwa Penting</a>
                    <a href="{{route('detailPeristiwa', $d->id_peristiwa)}}" class="breadcrumb-item">Detail</a>
                    <span class="breadcrumb-item active">Edit Surat Putusan</span>
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
        <form action="{{route('updateSuratPutusan', $d->id_peristiwa)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="card">
                    <div class="card-body">
                        {{-- <input type="file" id="putusanPN" name="putusanPN"  accept=".pdf" class="form-control" value="{{ old($d->putusan_pn) }}"> --}}
                        
                        <fieldset>
                            {{-- FILE PN --}}
                                @if($d->putusan_pn)
                                    <div class="row">
                                        <p class="col-3"><b>File: {{ $d->putusan_pn }} </b></p>
                                        <div class="col-9">
                                            <a href="{{ asset('files/putusanPN/' . $d->putusan_pn) }}" target="_blank">Tinjau</a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-form-label col-lg-3">Penetapan/Putusan PN (.pdf)</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="putusanPN" accept=".pdf">
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <p>Tidak Ada Data Tersimpan Sebelumnya</p>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-form-label col-lg-3">Penetapan/Putusan PN (.pdf)</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="putusanPN" accept=".pdf">
                                        </div>
                                    </div>
                                @endif

                                {{-- FILE PT --}}
                                @if($d->putusan_pt)
                                    <div class="row">
                                        <p class="col-3"><b>File: {{ $d->putusan_pt }}</b></p>
                                        <div class="col-9">
                                            <a href="{{ asset('files/putusanPN/' . $d->putusan_pt) }}" target="_blank">Tinjau</a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-form-label col-lg-3">Penetapan/Putusan PT (.pdf)</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="putusanPT" accept=".pdf">
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <p>Tidak Ada Data Tersimpan Sebelumnya</p>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-form-label col-lg-3">Penetapan/Putusan PT (.pdf)</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="putusanPT" accept=".pdf">
                                        </div>
                                    </div>
                                @endif

                                {{-- FILE MA --}}
                                @if($d->putusan_ma)
                                    <div class="row">
                                        <p class="col-3"><b>File: {{ $d->putusan_ma }}</b></p>
                                        <div class="col-9">
                                            <a href="{{ asset('files/putusanMA/' . $d->putusan_ma) }}" target="_blank">Tinjau</a>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-form-label col-lg-3">Penetapan/Putusan MA RI (.pdf)</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="putusanMA" accept=".pdf">
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <p>Tidak Ada Data Tersimpan Sebelumnya</p>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-form-label col-lg-3">Penetapan/Putusan MA (.pdf)</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="putusanMA" accept=".pdf">
                                        </div>
                                    </div>
                                @endif

                            </fieldset>
                    </div>
                </div>
            </fieldset>
            <div class="text-end">
                <a href="{{route('detailPeristiwa', $d->id_peristiwa)}}" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan<i class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
        </form>
        
    </div>
    @endforeach
@endsection