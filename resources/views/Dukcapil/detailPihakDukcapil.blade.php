@extends('layouts.pertanahan')
@section('content')
 <!-- Page header -->
 <div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Peristiwa Penting - <span class="fw-normal">Detail Permohonan Peristiwa Penting</span>
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{route('dukcapil')}}" class="breadcrumb-item"><i class="ph-handshake"></i></a>
                <a href="{{route('dukcapil')}}" class="breadcrumb-item">Peristiwa Penting</a>
                <a href="{{ url()->previous() }}" class="breadcrumb-item">Detail Permohonan</a>
                <span class="breadcrumb-item active">Detail Pihak</span>
            </div>

            <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
</div>
<!-- /page header -->
<!-- Contextual classes -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Detail Data Pemblokiran Sertifikat Tanah</h5>
        </div>

        <div class="table-responsive">
            @foreach($data as $pihak)
            <table class="table">
                <tbody>
                    <tr class="table-success">
                        <td style="width: 250px">Status Pihak</td>
                        <td style="width: 20px">:</td>
                        <td>{{$pihak->status_pihak}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Pihak</td>
                        <td>:</td>
                        <td>{{$pihak->jenis_pihak}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td>{{$pihak->nama}}</td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td>{{$pihak->tempat_lahir}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{$pihak->tanggal_lahir}}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>:</td>
                        <td>{{$pihak->umur}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{$pihak->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td>Warga Negara</td>
                        <td>:</td>
                        <td>{{$pihak->warga_negara}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$pihak->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>:</td>
                        <td>{{$pihak->provinsi}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Kabupaten/Kota</td>
                        <td>:</td>
                        <td>{{$pihak->kabupaten}}</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>{{$pihak->kecamatan}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Kelurahan/Desa</td>
                        <td>:</td>
                        <td>{{$pihak->kelurahan}}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td>{{$pihak->pekerjaan}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Status Kawin</td>
                        <td>:</td>
                        <td>{{$pihak->status_kawin}}</td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td>{{$pihak->pendidikan}}</td>
                    </tr>
                </tbody>
            </table>
            <h5 class="textTambahan">Informasi Tambahan</h5>
            <table class="table">
                <tbody>
                    <tr class="table-success">
                        <td style="width: 250px">NIK</td>
                        <td style="width: 20px">:</td>
                        <td>{{$pihak->nik}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$pihak->email}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>No Telepon</td>
                        <td>:</td>
                        <td>{{$pihak->no_telp}}</td>
                    </tr>
                </tbody>
            </table>
            @endforeach
        </div>
    </div>
</div>
<!-- /contextual classes -->
@endsection