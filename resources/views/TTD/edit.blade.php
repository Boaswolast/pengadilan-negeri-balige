@extends('layouts.pengadilan')
@section('content')


    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Edit Pengajuan Tanda Tangan
                </h4>

                <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="tandatangan" class="breadcrumb-item"><i class="ph-note-pencil"></i></a>
                    <a href="{{route('tandatangan')}}" class="breadcrumb-item">Tanda Tangan</a>
                    <span class="breadcrumb-item active">Edit Pengajuan</span>
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
        <div class="card card-body">
        @foreach($data as $d)
        <form action="{{route('updateTTD', $d->id_ttd)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- @foreach($data as $d) --}}
                <div class="row mb-3 mt-3">
                            <label class="col-lg-3 col-form-label">Subjek Permohonan:</label>
                            <div class="col-lg-9">
                                <input type="text" name="subjek_permohonan" class="form-control" placeholder="Subjek Permohonan" value="{{ $d->subjek_permohonan }}" required>
                                @error('subjek_permohonan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <label class="col-lg-3 col-form-label">Termohon:</label>
                            <div class="col-lg-9">
                                <select class="form-select" name="termohon" title="Pilihlah Pejabat PN Balige" value="{{ old('termohon') }}" required>
                                    @foreach($termohon as $t)
                                    <option value="{{ $t->nama_role }}" {{ $d->termohon == $t->nama_role ? 'selected':''}}>{{ $t->nama_role }} | {{ $t->name }}</option>
                                    @endforeach
                                    {{-- <option value="Ketua" {{ $d->termohon == 'Ketua' ? 'selected':''}}>Ketua</option>
                                    <option value="Wakil Ketua" {{ $d->termohon == 'Wakil Ketua' ? 'selected':''}}>Wakil Ketua</option>
                                    <option value="Panitera" {{ $d->termohon == 'Panitera' ? 'selected':''}}>Panitera</option>
                                    <option value="Sekretaris" {{ $d->termohon == 'Sekretaris' ? 'selected':''}}>Sekretaris</option> --}}
                                </select>
                                @error('termohon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                            <label class="col-7 col-form-label">Dokumen Permohonan: (.pdf)</label>
                            <div class="row">
                                {{-- <label class="col-7 col-form-label">Dokumen Permohonan: (.pdf)</label> --}}
                                        <p class="col-6"><b>File: {{ $d->file_dokumen }} </b></p>
                                        <div class="col-6 text-end" >
                                            <a href="{{ asset('files/Tanda-Tangan/' . $d->file_dokumen) }}" target="_blank">Tinjau</a>
                                        </div>
                                    </div>
                            
                            <input type="file" name="file_dokumen" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" accept=".pdf">
                                @error('file_dokumen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

            {{-- <div class="card">
                <div class="border-top">
                    <div class="quill-basic" id="quill-editor" name="amar_putusan">{!! $d->amar_putusan !!}</div>
                </div>
            </div>
            <input type="hidden" name="amar_putusan" id="petitum-input" required value="{!! $d->amar_putusan !!}"> --}}
            <div class="text-end">
                <a href="{{route('tandatangan')}}" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Perubahan<i class="ph-paper-plane-tilt ms-2"></i></button>
            </div>
        </form>
        </div>
    </div>
    @endforeach
@endsection