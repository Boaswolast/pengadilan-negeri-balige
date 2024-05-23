@extends('layouts.pengadilan')
@section('content')

<script>
    document.getElementById("formDataDiri").addEventListener("submit", function(event) {
        var formIsValid = true;
        var inputs = this.querySelectorAll("input[required]");
        
        inputs.forEach(function(input) {
            if (!input.value) {
                formIsValid = false;
                input.classList.add("invalid-input");
            } else {
                input.classList.remove("invalid-input");
            }
        });
        
        if (!formIsValid) {
            event.preventDefault(); // Mencegah pengiriman formulir jika ada bidang yang tidak valid
        }
    });
</script>
<div class="content">
    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Eksekusi Perkara - <span class="fw-normal">Tetapkan Eksekusi</span>
                </h4>

                <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{route('eksekusi')}}" class="breadcrumb-item"><i class="ph-folder-simple-user"></i></a>
                    <a href="{{route('eksekusi')}}" class="breadcrumb-item">Eksekusi Perkara</a>
                    <a href="javascript:history.back()" class="breadcrumb-item">Detail Eksekusi</a>
                    <span class="breadcrumb-item active">Tetapkan Eksekusi</span>
                </div>

                <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Centered card -->
    <div class="row">
        <div class="col-lg-8 offset-lg-2 mt-4">
            <div class="card">
                <div class="card-body border-top">
                    @foreach ($eksekusi as $id)
                        <form action="{{route('tetapkanEksekusi', ['id' => $id->id_eksekusi])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Tanggal Eksekusi</label>
                                <div class="col-lg-8">
                                    <input type="date" name="tgl_eksekusi" class="form-control" placeholder="Tannggal Eksekusi" required>
                                </div>
                            </div>
                        
                            <div class="row mb-3">
                                <label class="col-lg-4 col-form-label">Penetapan Eksekusi</label>
                                <div class="col-lg-8">
                                    <input type="file" name="penetapan_eksekusi" class="form-control" data-show-upload="false" data-show-caption="true" data-show-preview="true" accept=".pdf, .doc, .docx" placeholder="Penetapan Eksekusi">
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{route('eksekusi')}}" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                                <button type="submit" class="btn btn-success">Tetapkan <i class="ph-paper-plane-tilt ms-2"></i></button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /centered card -->
</div>
@endsection