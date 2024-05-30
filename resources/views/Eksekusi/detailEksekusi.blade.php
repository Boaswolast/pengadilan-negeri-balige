@extends('layouts.pengadilan')
@section('content')
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Detail Permohonan Eksekusi Perkara
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
                <span class="breadcrumb-item active">Detail</span>
            </div>

            <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
</div>
<!-- /page header -->

<div class="content">
    <div class="col-lg-12 mt-3">
        <div class="card card-body ">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#pihak" class="nav-link active">Pihak</a></li>
                <li class="nav-item"><a href="#permohonan" class="nav-link">Dokumen Permohonan</a></li>
                <li class="nav-item"><a href="#telaah" class="nav-link">Telaah</a></li>
                <li class="nav-item"><a href="#pembayaran" class="nav-link">Pembayaran</a></li>
                <li class="nav-item"><a href="#aanmaning" class="nav-link">Aanmaning</a></li>
                <li class="nav-item"><a href="#pelaksanaan" class="nav-link">Pelaksanaan</a></li>
                <li class="nav-item"><a href="#status" class="nav-link">Status</a></li>
            </ul>

            <div id="pihak" class="tab-content active">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pihak</th>
                            <th>Status Pihak</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!@empty($dataDiriAll))
                        @foreach($dataDiriAll as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->status_pihak}}</td>
                            <td>{{$data->email}}</td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>
        
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{route('detailDataDiriEksekusiAdmin', ['id' => $data->id_data_diri])}}" class="dropdown-item text-info">
                                                <i class="ph-eye me-2"></i>
                                                Detail Data Diri
                                            </a>
                                            {{-- <a href="{{route('editDataDiriEksekusi', ['id' => $data->id_data_diri])}}" class="dropdown-item text-secondary">
                                                <i class="ph-pencil me-2"></i>
                                                Edit
                                            </a> --}}
                                            {{-- <form action="{{route('showDeleted', ['id' => $data->id_data_diri])}}" type="button" method="POST" class="dropdown-item text-danger">
                                                <i class="ph-trash me-2"></i>
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item text-danger" style="margin-left: -20px" type="submit">Hapus</button>
                                            </form>  --}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" style="text-align: center">Tidak ada data yang tersedia.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div id="permohonan" class="tab-content">
                @foreach($dataPermohonan as $data)
                    <h3 class="mt-3">Surat Permohonana Eksekusi</h3>
                    @php
                        $fileExtension = pathinfo($data->surat_permohonan, PATHINFO_EXTENSION);
                        $fileUrl = asset('dokumen/User/Permohonan/'.$data->surat_permohonan);
                    @endphp
                    
                    @if ($fileExtension == 'pdf')
                        <iframe src="{{ $fileUrl }}" width="100%" height="600px"></iframe>
                    @else
                        <p>File tidak dapat ditampilkan secara langsung. Silakan unduh untuk melihatnya.</p>
                        <a href="{{ $fileUrl }}" class="btn btn-primary">Unduh file</a>
                    @endif
                    {{-- <iframe src="{{ asset('dokumen/User/Permohonan/'.$data->surat_permohonan) }}" width="100%" height="400px"></iframe> --}}
                    {{-- <a href="{{url('/downloadBPN', $data->dokumen_gugatan)}}"><button class="btn btn-success">Download</button></a>
                    <a href="{{url('/printBPN', $data->dokumen_gugatan)}}"><button class="btn btn-primary">View</button></a> --}}

                    <h3 class="mt-3">Putusan Pengadilan Negeri</h3>
                    @if (!empty($data->putusan_pn))
                        <iframe src="{{ asset('dokumen/User/PN/'.$data->putusan_pn) }}" width="100%" height="400px"></iframe>
                    @else
                        <p>Data Putusan Pengadilan Negeri tidak tersedia.</p>
                    @endif

                    <h3 class="mt-3">Putusan Pengadilan Tinggi</h3>
                    @if (!empty($data->putusan_pt))
                        <iframe src="{{ asset('dokumen/User/PT/'.$data->putusan_pt) }}" width="100%" height="400px"></iframe>
                    @else
                        <p>Data Putusan Pengadilan Tinggi tidak tersedia.</p>
                    @endif

                    <h3 class="mt-3">Putusan Mahkamah Agung</h3>
                    @if (!empty($data->putusan_ma))
                        <iframe src="{{ asset('dokumen/User/MA/'.$data->putusan_ma) }}" width="100%" height="400px"></iframe>
                    @else
                        <p>Data Putusan Mahkamah Agung tidak tersedia.</p>
                    @endif
                @endforeach
            </div>

            <div id="telaah" class="tab-content mt-4">
                @foreach($dataTelaah as $data)
                @if (!empty($data->tgl_telaah))
                    <table class="table">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Telaah</td>
                                <td>:</td>
                                <td>{{$data->tgl_telaah}}</td>
                            </tr>
                            <tr>
                                <td>Status Telaah</td>
                                <td>:</td>
                                <td>{{$data->status_telaah}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                            <tr>
                                <td>Resume Telaah</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <iframe src="{{ asset('dokumen/Eksekusi/'.$data->resume) }}" width="100%" height="400px" class="mt-3"></iframe>
                @else
                <center><h4 class="mt-6">Proses Telaah masih dalam status menunggu. Lakukan <br>
                     Proses Terhadap Telaah Kasus Ini</h4></center>

                <div class="btnAanmaning mt-4">
                    <a href="#" class="btn btn-success" type="button" onclick="confirmActionTelaah(event, '{{ $data->id_telaah }}')">Lakukan Aksi</a>
                </div>
                @endif      
                @endforeach
            </div>

            <div id="pembayaran" class="tab-content">
                @foreach($dataPembayaran as $data)

                @if ($data->status_pembayaran == 'Diterima' || $data->status_pembayaran == 'Selesai')
                    <table class="table mt-4">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Pembayaran</td>
                                <td>:</td>
                                <td>{{$data->tgl_pembayaran}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data->status_pembayaran}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                            <tr>
                                <td>Skum</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ asset('dokumen/Eksekusi/'.$data->skum) }}" class="btn btn-primary">Unduh Skum</a>
                    <iframe src="{{ asset('dokumen/Eksekusi/'.$data->skum) }}" width="100%" height="400px" class="mt-3"></iframe>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Bukti Pembayaran</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="addGugatan mt-4">
                        <a href="{{url('/download', ['file' => $data->bukti_pembayaran])}}" type="button" class="btn btn-success">Download</a>
                    </div>
                    <iframe src="{{ asset('dokumen/Pembayaran/'.$data->bukti_pembayaran) }}" width="100%" height="400px" class="mt-3"></iframe>
                
                    @elseif($data->status_pembayaran == 'Ditolak')
                    <center><h4 class="mt-3">Pembayaran ini ditolak.</h4></center>
                    <table class="table mt-4">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Pembayaran</td>
                                <td>:</td>
                                <td>{{$data->tgl_pembayaran}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data->status_pembayaran}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                            <tr>
                                <td>Skum</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <iframe src="{{ asset('dokumen/Eksekusi/'.$data->skum) }}" width="100%" height="400px" class="mt-3"></iframe>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Bukti Pembayaran</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="addGugatan mt-4">
                        <a href="{{url('/download', ['file' => $data->bukti_pembayaran])}}" type="button" class="btn btn-success">Download</a>
                    </div>
                    <iframe src="{{ asset('dokumen/Pembayaran/'.$data->bukti_pembayaran) }}" width="100%" height="400px" class="mt-3"></iframe>

                @elseif($data->status_pembayaran == 'Sudah Bayar')
                <center><h4 class="mt-3">Pembayaran ini sedang dalam proses pemeriksaan oleh pengadilan negeri balige. silahkan konfirmasi<br>
                    jika data yang dikirimkan sesuai</h4></center>

                <div class="addGugatan mt-4">
                    <a href="{{route('terimaPembayaran', ['id' => $data->id_pembayaran])}}" type="button" class="btn btn-success" onclick="return confirmTerima(event)">Terima</a>
                    <a href="#" class="btn btn-danger" type="button" onclick="confirmTolak(event, {{ $data->id_pembayaran }})">Tolak</a>
                </div>
                <table class="table mt-4">
                    <tbody>
                        <tr class="table-success">
                            <td style="width: 300px">Tanggal Pembayaran</td>
                            <td>:</td>
                            <td>{{$data->tgl_pembayaran}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{$data->status_pembayaran}}</td>
                        </tr>
                        <tr class="table-success">
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{$data->keterangan}}</td>
                        </tr>
                        <tr>
                            <td>Skum</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <iframe src="{{ asset('dokumen/Eksekusi/'.$data->skum) }}" width="100%" height="400px" class="mt-3"></iframe>
                <div class="addGugatan mt-4">
                    <a href="{{url('/download', ['file' => $data->bukti_pembayaran])}}" type="button" class="btn btn-success">Download</a>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Bukti Pembayaran</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <iframe src="{{ asset('dokumen/Pembayaran/'.$data->bukti_pembayaran) }}" width="100%" height="400px" class="mt-3"></iframe>

                @else
                <center><h4 class="mt-5">Proses Telaah Belum Dilakukan</h4></center>
                @endif      
                @endforeach
            </div>

            <div id="aanmaning" class="tab-content">
                @foreach($dataPembayaran as $data)
                    @if ($data->status_pembayaran == 'Sudah Bayar')
                    <center><h4 class="mt-5">Proses Aanmaning masih dalam status Menunggu Proses Pembayaran. </h4></center>

                    @elseif ($data->status_pembayaran == 'Diterima')
                    <center><h4 class="mt-5">Proses Aanmaning masih dalam status Menunggu. Silahkan <br> 
                        tetapkan tanggal Aanmaning dan surat Pemanggilan!</h4></center>

                    <center><div class="mt-3">  
                        @foreach($dataAanmaning as $data)
                            <a href="{{route('halamanAanmaning', ['id' => $data->id_aanmaning])}}" type="button" class="btn btn-success">Tetapkan</a>
                        @endforeach
                    </div></center>
                    @endif
                @endforeach
                @foreach($dataAanmaning as $data)
                    @if ($data->status_aanmaning == 'Diproses')
                    <center>
                        <h4 class="mt-3">Proses Aanmaning masih dalam status Diproses. Silahkan <br>
                        Ubah Status Aanmaning (Diterima/Ditolak)!</h4>
                        <p>Diterima berarti damai, ditolak berarti proses lanjut ke tahap eksekusi</p>
                    </center>
    
                    <div class="btnAanmaning mt-4">
                        <a href="#" class="btn btn-success" type="button" onclick="terimaAanmaning(event, {{ $data->id_aanmaning }})">Diterima</a>
                        <a href="#" class="btn btn-danger" type="button" onclick="tolakAanmaning(event, {{ $data->id_aanmaning }})">Ditolak</a>
                    </div>
                    <div class="addGugatan mt-4">
                        <a href="{{route('halamanEditAanmaning', ['id' => $data->id_aanmaning])}}" type="button" class="btn btn-primary"><i class="ph-pencil me-2"></i>Edit</a>
                    </div>
                    <table class="table mt-4">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Aanmaning</td>
                                <td>:</td>
                                <td>{{$data->tgl_aanmaning}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data->status_aanmaning}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                            <tr>
                                <td>Surat Pemanggilan</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <iframe src="{{ asset('dokumen/Aanmaning/'.$data->surat_pemanggilan) }}" width="100%" height="400px" class="mt-3"></iframe>     

                    @elseif ($data->status_aanmaning == 'Diterima' || $data->status_aanmaning == 'Ditolak' || $data->status_aanmaning == 'Selesai')

                    <table class="table mt-4">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Aanmaning</td>
                                <td>:</td>
                                <td>{{$data->tgl_aanmaning}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data->status_aanmaning}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                            <tr>
                                <td>Surat Pemanggilan</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <iframe src="{{ asset('dokumen/Aanmaning/'.$data->surat_pemanggilan) }}" width="100%" height="400px" class="mt-3"></iframe>                 
                    @endif
                @endforeach
            </div>

            <div id="pelaksanaan" class="tab-content">
                @foreach($dataAanmaning as $data)
                    @if ($data->status_aanmaning == 'Diterima')
                    <center>
                        <h4 class="mt-3">Proses Eksekusi Tidak Dilaksanakan Karena Hasil <br>
                             Aanmangin Adalah Diterima (Damai)</h4>
                    </center>
                    
                    @elseif($data->status_aanmaning == 'Ditolak')
                    <center>
                        <h4 class="mt-3">Hasil Aanmaning Adalah Ditolak, Maka Segera Tetapkan <br>
                             Pelaksanaan Eksekusi</h4>
                    </center>
                    <div class="btnAanmaning mt-4">
                        <a href="{{route('halamanEksekusi', ['id' => $data->id_eksekusi])}}" type="button" class="btn btn-success">Tetapkan</a>
                    </div>

                    @elseif ($data->status_aanmaning == 'Selesai' && $data->status_eksekusi == 'Diproses')
                    <center>
                        <h4 class="mt-3">Proses Eksekusi Masih Dalam Status Diproses. Silahkan <br>
                             Ubah Status Eksekusi Jika Sudah Selesai!</h4>
                        <p>Menyelesaikan proses eksekusi berarti menyelesaikan permohonan eksekusi</p>
                    </center>
                    <div class="btnAanmaning mt-4">
                        <a href="#" class="btn btn-success" type="button" onclick="selesaiKasus(event, {{ $data->id_eksekusi }})">Selesai</a>
                    </div>
                    <div class="addGugatan mt-4">
                        <a href="{{route('halamanEditEksekusi', ['id' => $data->id_eksekusi])}}" type="button" class="btn btn-primary"><i class="ph-pencil me-2"></i>Edit</a>
                    </div>

                    <table class="table mt-4">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Eksekusi</td>
                                <td>:</td>
                                <td>{{$data->tgl_eksekusi}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data->status_eksekusi}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{$data->keterangan_eksekusi}}</td>
                            </tr>
                            <tr>
                                <td>Penetapan Eksekusi</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <iframe src="{{ asset('dokumen/Penetapan/'.$data->penetapan_eksekusi) }}" width="100%" height="400px" class="mt-3"></iframe>
                    @elseif ($data->status_eksekusi == 'Selesai')
                    <table class="table mt-4">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Eksekusi</td>
                                <td>:</td>
                                <td>{{$data->tgl_eksekusi}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data->status_eksekusi}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Keterangan</td>
                                <td>:</td>
                                <td>{{$data->keterangan_eksekusi}}</td>
                            </tr>
                            <tr>
                                <td>Penetapan Eksekusi</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <iframe src="{{ asset('dokumen/Penetapan/'.$data->penetapan_eksekusi) }}" width="100%" height="400px" class="mt-3"></iframe>
                    @endif
                @endforeach
            </div>

            <div id="status" class="tab-content">
                <div class="table-responsive mt-4">
                    <table class="table">
                        <tbody>
                            @foreach($dataAanmaning as $data)
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Permohonan</td>
                                <td>:</td>
                                <td>{{$data->tgl_permohonan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h5 class="mt-4">Status Telaah</h5>
                    <table class="table">
                        <tbody>
                            @foreach($dataTelaah as $data)
                            <tr class="table-success">
                                <td style="width: 300px">Status Telaah</td>
                                <td>:</td>
                                <td>{{$data->status_telaah}}</td>
                            </tr>
                            <tr>
                                <td style="width: 300px">Tanggal Telaah</td>
                                <td>:</td>
                                <td>{{$data->tgl_telaah}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h5 class="mt-4">Status Aanmaning</h5>
                    <table class="table">
                        <tbody>
                            @foreach($dataPembayaran as $data)
                            <tr class="table-success">
                                <td style="width: 300px">Status Pembayaran</td>
                                <td>:</td>
                                <td>{{$data->status_pembayaran}}</td>
                            </tr>
                            <tr>
                                <td style="width: 300px">Tanggal Pembayaran</td>
                                <td>:</td>
                                <td>{{$data->tgl_pembayaran}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h5 class="mt-4">Status Aanmaning</h5>
                    <table class="table">
                        <tbody>
                            @foreach($dataAanmaning as $data)
                            <tr class="table-success">
                                <td style="width: 300px">Status Aanmaning</td>
                                <td>:</td>
                                <td>{{$data->status_aanmaning}}</td>
                            </tr>
                            <tr>
                                <td style="width: 300px">Tanggal Aanmaning</td>
                                <td>:</td>
                                <td>{{$data->tgl_aanmaning}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h5 class="mt-4">Status Eksekusi</h5>
                    <table class="table">
                        <tbody>
                            @foreach($dataAanmaning as $data)
                            <tr class="table-success">
                                <td style="width: 300px">Status Eksekusi</td>
                                <td>:</td>
                                <td>{{$data->status_eksekusi}}</td>
                            </tr>
                            <tr>
                                <td style="width: 300px">Tanggal Eksekusi</td>
                                <td>:</td>
                                <td>{{$data->tgl_eksekusi}}</td>
                            </tr>
                            <tr>
                                <td style="width: 300px">Eksekusi Selesai</td>
                                <td>:</td>
                                <td>{{$data->tgl_selesai}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Define the JavaScript function with telaahId parameter
    function confirmActionTelaah(event, telaahId) {
        // Menampilkan pesan konfirmasi Sweet Alert dengan pilihan konfirmasi atau tolak
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pilih opsi 'Konfirmasi' atau 'Tolak'.",
            icon: 'warning',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonColor: '#4caf50', // Warna hijau untuk tombol konfirmasi
            cancelButtonColor: '#f44336', // Warna merah untuk tombol tolak
            confirmButtonText: 'Konfirmasi',
            cancelButtonText: 'Tolak', // Mengganti teks tombol tolak
            customClass: {
                confirmButton: 'btn btn-success', // Gaya tambahan untuk tombol konfirmasi
                cancelButton: 'btn btn-danger' // Gaya tambahan untuk tombol tolak
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL konfirmasi jika pengguna mengonfirmasi
                window.location.href = "{{ route('halamanKonfirmasiData', ['id' => ':telaahId']) }}".replace(':telaahId', telaahId);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Redirect ke URL penolakan jika pengguna menolak
                window.location.href = "{{ route('halamanTolakData', ['id' => ':telaahId']) }}".replace(':telaahId', telaahId);
            }
        });

        // Mencegah tindakan default dari event klik
        event.preventDefault();
    }
</script>

<script>
    function confirmTerima(event) {
        // Mengambil URL dari tombol
        const url = event.target.href;

        // Menampilkan pesan konfirmasi Sweet Alert dengan gaya tambahan
        Swal.fire({
            title: 'Apakah Anda Yakin Menerima Pembayaran Ini?',
            text: "Proses status tidak dapat diubah kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50', // Warna hijau untuk tombol konfirmasi
            confirmButtonText: 'Terima',
            cancelButtonText: 'Batal', // Mengganti teks tombol batal
            customClass: {
                confirmButton: 'btn btn-success', // Gaya tambahan untuk tombol konfirmasi
                cancelButton: 'btn btn-light' // Gaya tambahan untuk tombol batal
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL jika pengguna mengonfirmasi
                window.location.href = url;
            } else {
                // Mencegah tindakan default jika pengguna membatalkan
                event.preventDefault();
            }
        });

        // Mencegah tindakan default dari event klik
        event.preventDefault();
    }
</script>

<script>
    function confirmTolak(event, id) {
        Swal.fire({
            title: 'Apakah Anda Yakin Menerima Pembayaran Ini?',
            text: "Proses status tidak dapat diubah kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            confirmButtonText: 'Terima',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-light'
            },
            input: 'text',
            inputPlaceholder: 'Keterangan',
            inputAttributes: {
                style: 'font-size: 16px; padding: 10px; border-radius: 5px;'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirim data ke server
                const keterangan = result.value;
                $.ajax({
                    url: '/tolakPembayaran/' + id,
                    method: 'POST',
                    data: {
                        keterangan: keterangan
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success');
                        // Redirect ke halaman 'eksekusi' setelah berhasil
                        window.location.href = '{{ route("eksekusi") }}';
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', xhr.responseText, 'error');
                    }
                });
            } else {
                event.preventDefault();
            }
        });

        event.preventDefault();
    }
</script>

<script>
    function confirmTolak(event, id) {
        Swal.fire({
            title: 'Apakah Anda Yakin Menerima Pembayaran Ini?',
            text: "Proses status tidak dapat diubah kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            confirmButtonText: 'Terima',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-light'
            },
            input: 'text',
            inputPlaceholder: 'Keterangan',
            inputAttributes: {
                style: 'font-size: 16px; padding: 10px; border-radius: 5px;'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirim data ke server
                const keterangan = result.value;
                $.ajax({
                    url: '/tolakPembayaran/' + id,
                    method: 'POST',
                    data: {
                        keterangan: keterangan
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success');
                        // Redirect ke halaman 'eksekusi' setelah berhasil
                        window.location.href = '{{ route("eksekusi") }}';
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', xhr.responseText, 'error');
                    }
                });
            } else {
                event.preventDefault();
            }
        });

        event.preventDefault();
    }
</script>

<script>
    function terimaAanmaning(event, id) {
        Swal.fire({
            title: 'Apakah Anda Yakin Aanmaning Diterima?',
            text: "Proses status tidak dapat diubah kembali.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            confirmButtonText: 'Diterima',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-light'
            },
            input: 'text',
            inputPlaceholder: 'Keterangan',
            inputAttributes: {
                style: 'font-size: 16px; padding: 10px; border-radius: 5px;'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirim data ke server
                const keterangan = result.value;
                $.ajax({
                    url: '/terimaAanmaning/' + id,
                    method: 'POST',
                    data: {
                        keterangan: keterangan
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success');
                        // Redirect ke halaman 'eksekusi' setelah berhasil
                        window.location.href = '{{ route("eksekusi") }}';
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', xhr.responseText, 'error');
                    }
                });
            } else {
                event.preventDefault();
            }
        });

        event.preventDefault();
    }
</script>

<script>
    function tolakAanmaning(event, id) {
        Swal.fire({
            title: 'Apakah Anda Yakin Aanmaning Ditolak?',
            text: "Proses status tidak dapat diubah kembali. Aanmaning yang ditolak akan lanjut ke tahap eksekusi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            confirmButtonText: 'Ditolak',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-light'
            },
            input: 'text',
            inputPlaceholder: 'Keterangan',
            inputAttributes: {
                style: 'font-size: 16px; padding: 10px; border-radius: 5px;'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirim data ke server
                const keterangan = result.value;
                $.ajax({
                    url: '/tolakAanmaning/' + id,
                    method: 'POST',
                    data: {
                        keterangan: keterangan
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success');
                        // Redirect ke halaman 'eksekusi' setelah berhasil
                        window.location.href = '{{ route("eksekusi") }}';
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', xhr.responseText, 'error');
                    }
                });
            } else {
                event.preventDefault();
            }
        });

        event.preventDefault();
    }
</script>

<script>
    function selesaiKasus(event, id) {
        Swal.fire({
            title: 'Apakah Anda Yakin Eksekusi Telah Selesai?',
            text: "Proses status tidak dapat diubah kembali.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4caf50',
            confirmButtonText: 'Diterima',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-light'
            },
            input: 'text',
            inputPlaceholder: 'Keterangan',
            inputAttributes: {
                style: 'font-size: 16px; padding: 10px; border-radius: 5px;'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, kirim data ke server
                const keterangan = result.value;
                $.ajax({
                    url: '/selesaiKasus/' + id,
                    method: 'POST',
                    data: {
                        keterangan: keterangan
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire('Success', response.message, 'success');
                        // Redirect ke halaman 'eksekusi' setelah berhasil
                        window.location.href = '{{ route("eksekusi") }}';
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', xhr.responseText, 'error');
                    }
                });
            } else {
                event.preventDefault();
            }
        });

        event.preventDefault();
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tabs = document.querySelectorAll('.nav-tabs a');
        
        // Function to show content based on selected tab
        function showTabContent(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.style.display = 'none';
            });
            // Show the content of the selected tab
            document.querySelector(tabId).style.display = 'block';
        }

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                var targetId = this.getAttribute('href');
                var targetElement = document.querySelector(targetId);

                document.querySelectorAll('.nav-link').forEach(function(navLink) {
                    navLink.classList.remove('active');
                });
                this.classList.add('active');

                // Show content based on selected tab
                showTabContent(targetId);
            });
        });

        // Set initial active tab content to 'Pihak' when the page loads
        var initialTab = document.querySelector('.nav-tabs .nav-link[href="#pihak"]');
        initialTab.classList.add('active');
        showTabContent('#pihak');
    });
</script>


@endsection
