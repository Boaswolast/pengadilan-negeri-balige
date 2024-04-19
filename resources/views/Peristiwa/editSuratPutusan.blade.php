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
                    
                    <a href="{{route('peristiwa')}}" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
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
        {{-- @foreach($editPetitum as $data) --}}
        <form action="{{route('updateSuratPutusan', $d->id_peristiwa)}}" method="POST">
            @csrf
            @method('PUT')
            {{-- <fieldset>
                <div class="card">
                    <div class="card-body"> --}}
                        {{-- <label for="putusanPN"><b>Putusan PN (.pdf)</b></label> --}}
                        {{-- <input type="file" name="putusanPN" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" required> --}}
                        {{-- <input type="file" name="putusan_pn" class="file-input form-control-sm" multiple="multiple" data-input-group-class="input-group-sm" data-show-upload="false" data-show-caption="true" data-show-preview="true" required> --}}
                        {{-- <input type="file" name="putusan">
                    </div>
                </div>
            </fieldset> --}}
            <h6>Upload Surat</h6>
                            <fieldset>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan PN (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" class="form-control" name="putusan_PN">
									</div>
								</div>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan PT (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" class="form-control" name="putusanPT">
									</div>
								</div>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan MA RI (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" class="form-control" name="putusanMA">
									</div>
								</div>
                            </fieldset>
            {{-- <div class="card">
                <div class="border-top">
                    <div class="quill-basic" id="quill-editor" name="amar_putusan">{!! $d->putusan_pn !!}</div>
                </div>
            </div>
            <input type="hidden" name="amar_putusan" id="petitum-input" required value="{!! $d->putusan_pn !!}"> --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan Perubahan<i class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
        </form>
        
    </div>
    @endforeach
@endsection