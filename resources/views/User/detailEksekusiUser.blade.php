@extends('layouts.User')
@section('content')
<div class="content body-user">
    <div class="col-lg-12 mt-5">
        <div class="card card-body ">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#pihak" class="nav-link active">Pihak</a></li>
                <li class="nav-item"><a href="#permohonan" class="nav-link">Dokumen Permohonan</a></li>
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

            <div id="pelaksanaan" class="tab-content">
                {{-- @foreach($dataPetitum as $data)
                    <div class="mt-5">{!! $data->petitum !!}</div>
                @endforeach --}}
            </div>

            <div id="status" class="tab-content">
                <div class="table-responsive mt-4">
                    {{-- <table class="table">
                        <tbody>
                            @foreach($dataStatus as $data)
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Permohonan</td>
                                <td>:</td>
                                <td>{{$data->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Diproses</td>
                                <td>:</td>
                                <td>{{$data->tgl_diproses}}</td>
                            </tr>
                            <tr class="table-success">
                                <td>Tanggal selesai</td>
                                <td>:</td>
                                <td>{{$data->tgl_selesai}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
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
