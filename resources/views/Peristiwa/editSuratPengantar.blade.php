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
                    <span class="breadcrumb-item active">Edit Surat Pengantar</span>
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
        
        <form action="{{route('updateSuratPengantar', $d->id_peristiwa)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="card">
                    <div class="card-body">
                        {{-- <input type="file" id="putusanPN" name="putusanPN"  accept=".pdf" class="form-control" value="{{ old($d->putusan_pn) }}"> --}}
                        
                        <fieldset>
                            {{-- FILE PN --}}
                                @if($d->surat_pengantar)
                                
                                    <div class="row">
                                        <p class="col-4"><b>File: {{ $d->surat_pengantar }} </b></p>
                                        <div class="col-8">
                                            <a href="{{ asset('files/surat-pengantar/' . $d->surat_pengantar) }}" target="_blank">Tinjau</a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-form-label col-lg-3">Surat Pengantar (.pdf)</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <input type="file" name="surat_pengantar" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" required> 
                                                {{-- <input type="file" name="surat_pengantar" class="file-input" required> --}}
                                            </div>
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