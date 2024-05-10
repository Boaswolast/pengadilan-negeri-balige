@extends('layouts.user')
@section('content')
<!-- Contextual classes -->
<div class="content body-user">
    <div class="card mt-5">
        <div class="card-header">
            <h5 class="mb-0">Detail Data Eksekusi Perkara</h5>
        </div>

        <div class="table-responsive">
            @foreach($eksekusi as $data)
            <table class="table">
                <tbody>
                    <tr class="table-success">
                        <td style="width: 250px">Status Pihak</td>
                        <td style="width: 20px">:</td>
                        <td>{{$data->status_pihak}}</td>
                    </tr>
                    <tr>
                        <td>Jenis Pihak</td>
                        <td>:</td>
                        <td>{{$data->jenis_pihak}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td>{{$data->nama}}</td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td>{{$data->tempat_lahir}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{$data->tanggal_lahir}}</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>:</td>
                        <td>{{$data->umur}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{$data->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td>Warga Negara</td>
                        <td>:</td>
                        <td>{{$data->warga_negara}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$data->alamat}}</td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>:</td>
                        <td>{{$data->provinsi}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Kabupaten/Kota</td>
                        <td>:</td>
                        <td>{{$data->kabupaten}}</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>{{$data->kecamatan}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Kelurahan/Desa</td>
                        <td>:</td>
                        <td>{{$data->kelurahan}}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td>{{$data->pekerjaan}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>Status Kawin</td>
                        <td>:</td>
                        <td>{{$data->status_kawin}}</td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td>{{$data->pendidikan}}</td>
                    </tr>
                </tbody>
            </table>
            <h5 class="textTambahan">Informasi Tambahan</h5>
            <table class="table">
                <tbody>
                    <tr class="table-success">
                        <td style="width: 250px">NIK</td>
                        <td style="width: 20px">:</td>
                        <td>{{$data->nik}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{$data->email}}</td>
                    </tr>
                    <tr class="table-success">
                        <td>No Telepon</td>
                        <td>:</td>
                        <td>{{$data->no_telp}}</td>
                    </tr>
                </tbody>
            </table>
            @endforeach
        </div>
    </div>
</div>
<!-- /contextual classes -->
@endsection