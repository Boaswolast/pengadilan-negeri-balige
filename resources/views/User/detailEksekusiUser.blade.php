@extends('layouts.User')
@section('content')
<div class="content body-user">
    <div class="col-lg-12 mt-5">
        <div class="card card-body ">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#pihak" class="nav-link active">Pihak</a></li>
                <li class="nav-item"><a href="#permohonan" class="nav-link">Dokumen Permohonan</a></li>
                <li class="nav-item"><a href="#telaah" class="nav-link">Telaah</a></li>
                <li class="nav-item"><a href="#pembayaran" class="nav-link">Pembayaran</a></li>
                <li class="nav-item"><a href="#aanmaning" class="nav-link">Aanmaning</a></li>
                <li class="nav-item"><a href="#eksekusi" class="nav-link">Eksekusi</a></li>
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
                                            <a href="{{route('detailDataDiriEksekusi', ['id' => $data->id_data_diri])}}" class="dropdown-item text-info">
                                                <i class="ph-eye me-2"></i>
                                                Detail Data Diri
                                            </a>
                                            <a href="{{route('editDataDiriEksekusi', ['id' => $data->id_data_diri])}}" class="dropdown-item text-secondary">
                                                <i class="ph-pencil me-2"></i>
                                                Edit
                                            </a>
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
                    <iframe src="{{ asset('dokumen/User/Permohonan/'.$data->surat_permohonan) }}" width="100%" height="400px"></iframe>
                    {{-- <a href="{{url('/downloadBPN', $data->dokumen_gugatan)}}"><button class="btn btn-success">Download</button></a>
                    <a href="{{url('/printBPN', $data->dokumen_gugatan)}}"><button class="btn btn-primary">View</button></a> --}}

                    <h3 class="mt-3">Putusan Pengadilan Negeri</h3>
                    <iframe src="{{ asset('dokumen/User/PN/'.$data->putusan_pn) }}" width="100%" height="400px"></iframe>

                    <h3 class="mt-3">Putusan Pengadilan Tinggi</h3>
                    <iframe src="{{ asset('dokumen/User/PT/'.$data->putusan_pt) }}" width="100%" height="400px"></iframe>

                    <h3 class="mt-3">Putusan Mahkamah Agung</h3>
                    <iframe src="{{ asset('dokumen/User/MA/'.$data->putusan_ma) }}" width="100%" height="400px"></iframe>
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
                <center><h4 class="mt-6">Proses Telaah masih dalam status menunggu. Tunggu <br>
                     hingga pengadilan negeri melaksanakan telaah!</h4></center>
                @endif      
                @endforeach
            </div>

            @foreach($dataTelaah as $data)
            @if ($data->status_telaah == 'Diterima')
            <div id="pembayaran" class="tab-content mt-4">
                @foreach($dataPembayaran as $data)
                @if ($data->status_pembayaran == 'Diterima')
                    <table class="table">
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
                        <a href="{{url('/downloadUser', ['file' => $data->bukti_pembayaran])}}" type="button" class="btn btn-success">Download</a>
                    </div>
                    <iframe src="{{ asset('dokumen/Pembayaran/'.$data->bukti_pembayaran) }}" width="100%" height="400px" class="mt-3"></iframe>

                @elseif($data->status_pembayaran == 'Sudah Bayar')
                <center><h4 class="mt-4">Pembayaran Anda Sedang dalam proses pemeriksaan oleh pengadilan negeri balige. silahkan tunggu  <br>
                    untuk melanjutkan ketahap aanmaaning</h4></center>
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
                    <a href="{{url('/downloadUser', ['file' => $data->bukti_pembayaran])}}" type="button" class="btn btn-success">Download</a>
                </div>
                <iframe src="{{ asset('dokumen/Pembayaran/'.$data->bukti_pembayaran) }}" width="100%" height="400px" class="mt-3"></iframe>

                @elseif($data->status_pembayaran == 'Ditolak')
                <center><h4 class="mt-4">Pembayaran Anda Ditolak, Silahkan Upload Ulang Bukti Pembayaran Sesuai Instruksi di Keterangan!</h4></center>
                <a href="{{route('halamanUploadUlangPembayaran', ['id' => $data->id_eksekusi])}}" type="button" class="btn btn-primary mb-4" style="float: right"><i class="ph-pencil me-2"></i>Edit</a>
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
                    <a href="{{url('/downloadUser', ['file' => $data->bukti_pembayaran])}}" type="button" class="btn btn-success">Download</a>
                </div>
                <iframe src="{{ asset('dokumen/Pembayaran/'.$data->bukti_pembayaran) }}" width="100%" height="400px" class="mt-3"></iframe>

                @else
                <center><h4 class="mt-4">Proses Pembayaran masih dalam status menunggu. <br>
                    Silahkan lakukan Pembayaran sesuai dengan isi SKUM sesegera mungkin <br>
                    Kemudian kirim bukti pembayaran!</h4></center>

                    <center><div class="mt-3">
                        <a href="{{route('halamanPembayaran', ['id' => $data->id_eksekusi])}}" type="button" class="btn btn-success">Kirim Bukti Pembayaran</a>
                    </div></center>

                    <table class="table mt-4">
                        <tbody>
                            <tr class="table-success">
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data->status_pembayaran}}</td>
                            </tr>
                            <tr>
                                <td>SKUM</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <iframe src="{{ asset('dokumen/Eksekusi/'.$data->skum) }}" width="100%" height="400px" class="mt-3"></iframe>
                @endif      
                @endforeach
            </div>
            @elseif($data->status_telaah == 'Ditolak')
            <center><h4 class="mt-5">Proses telaah anda ditolak silahkan melakukan ulang registrasi</h4></center>
            @endif
            @endforeach

            <div id="aanmaning" class="tab-content">
                @foreach($dataAanmaning as $data)
                @if (!empty($data->tgl_aanmaning))
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

            <div id="eksekusi" class="tab-content">
                @foreach($dataAanmaning as $data)
                    @if ($data->status_aanmaning == 'Diterima')
                    <center>
                        <h4 class="mt-3">Proses Eksekusi Tidak Dilaksanakan Karena Hasil <br>
                             Aanmangin Adalah Diterima (Damai)</h4>
                    </center>
                    
                    @elseif($data->status_aanmaning == 'Ditolak')
                    <center>
                        <h4 class="mt-3">Hasil aanmaning adalah ditolak, maka Eksekusi akan segera <br>
                            dilakukan. Tunggu proses selanjutnya dari Pengadilan Negeri</h4>
                    </center>

                    @elseif ($data->status_aanmaning == 'Selesai' && $data->status_eksekusi == 'Diproses')
                    <center>
                        <h4 class="mt-3">Proses Eksekusi masih dalam status Diproses. Silahkan <br>
                            Tunggu Sesuai Penetapan Eksekusi</h4>
                        <p>Jika proses eksekusi selesai berarti permohonan eksekusi juga telah selesai</p>
                    </center>

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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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
