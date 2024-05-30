@extends('layouts.pengadilan')
@section('content')
 <!-- Page header -->
 <div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Detail Permohonan Peristiwa Penting
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{route('peristiwa')}}" class="breadcrumb-item"><i class="ph-user-square"></i></a>
                <a href="{{route('peristiwa')}}" class="breadcrumb-item">Peristiwa Penting</a>
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
    <style>
        .Filter {
            padding-top: 10px;
            /* margin-top: 20px */
            margin-right: 10px;
        }
    </style>
    
    <script>
        const DatatableBasic = function() {
    
    
            //
            // Setup module components
            //
    
            // Basic Datatable examples
            const _componentDatatableBasic = function() {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }
    
                // Setting datatable defaults
                $.extend($.fn.dataTable.defaults, {
                    autoWidth: false,
                    columnDefs: [{
                        orderable: false,
                        width: 100,
                        targets: [4]
                    }],
                    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                    language: {
                        search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                        searchPlaceholder: 'Type to filter...',
                        lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                        paginate: {
                            'first': 'First',
                            'last': 'Last',
                            'next': document.dir == "rtl" ? '&larr;' : '&rarr;',
                            'previous': document.dir == "rtl" ? '&rarr;' : '&larr;'
                        }
                    }
                });
    
                // Basic datatable
                $('.datatable-basic').DataTable();
    
                // Alternative pagination
                $('.datatable-pagination').DataTable({
                    pagingType: "simple",
                    language: {
                        paginate: {
                            'next': document.dir == "rtl" ? 'Next &larr;' : 'Next &rarr;',
                            'previous': document.dir == "rtl" ? '&rarr; Prev' : '&larr; Prev'
                        }
                    }
                });
    
                // Datatable with saving state
                $('.datatable-save-state').DataTable({
                    stateSave: true
                });
    
                // Scrollable datatable
                const table = $('.datatable-scroll-y').DataTable({
                    autoWidth: true,
                    scrollY: 300
                });
    
                // Resize scrollable table when sidebar width changes
                $('.sidebar-control').on('click', function() {
                    table.columns.adjust().draw();
                });
            };
    
    
            //
            // Return objects assigned to module
            //
    
            return {
                init: function() {
                    _componentDatatableBasic();
                }
            }
        }();
    
    
        // Initialize module
        // ------------------------------
    
        document.addEventListener('DOMContentLoaded', function() {
            DatatableBasic.init();
        });
    </script>
    <div class="col-lg-12">
        <div class="card card-body ">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#pihak" class="nav-link active">Pihak</a></li>
                <li class="nav-item"><a href="#amarPutusan" class="nav-link">Amar Putusan</a></li>
                <li class="nav-item"><a href="#surat" class="nav-link">Surat Putusan</a></li>
                <li class="nav-item"><a href="#suratPengantar" class="nav-link">Surat Pengantar</a></li>
                <li class="nav-item"><a href="#status" class="nav-link">Status</a></li>
            </ul>

            <div id="pihak" class="tab-content active">
                @foreach($dataPengantar as $d)
                @if ($d->status_id == 1)  
                    <div class="addGugatan mt-4">
                        <a href="{{route('addPihakPeristiwa',$id)}}" type="button" class="btn btn-success">Tambah Pihak</a>
                    </div>
                @endif
                @endforeach
                <table class="table datatable-basic table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pihak</th>
                            <th>Status Pihak</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($data->count() > 0)
                        @foreach ($data as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->nama}}</td>
                            <td>{{$d->status_pihak}}</td>
                            <td>{{$d->email}}</td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{route('detailPihakPeristiwa', ['id' => $d->id_data_diri])}}" class="dropdown-item text-info">
                                                <i class="ph-eye me-2"></i>
                                                Detail
                                            </a>
                                            <a href="{{route('editPihakPeristiwa', ['idDiri' => $d->id_data_diri])}}" class="dropdown-item text-secondary">
                                                <i class="ph-pencil me-2"></i>
                                                Edit
                                            </a>
                                            <a href="{{route('deletePihakPeristiwa', ['id' => $d->id_data_diri])}}" type="button" class="dropdown-item text-danger" onclick="return DeleteDataDiriPeristiwa(event)">
                                                <i class="ph-trash me-2"></i>
                                                Hapus
                                            </a>
                                            {{-- <a href="" class="dropdown-item text-danger" onclick="confirmDeletePihak('{{ $d->id_data_diri }}', '{{ $id }}')">
                                                <i class="ph-trash me-2"></i>
                                                Hapus
                                            </a> --}}
                                            {{-- <form action="{{route('deletePihakPeristiwa',['idDiri' => $d->id_data_diri, $id])}}" type="button" method="POST" class="dropdown-item text-danger">
                                                    <i class="ph-trash me-2"></i>
                                                    @csrf
                                                    @method('put')
                                                    <button class="dropdown-item text-danger" style="margin-left: -20px" type="submit">Hapus</button>
                                                </form> --}}
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    @else
                        <tr>
                            <td class="text-center" colspan="6">Data Kosong</td>
                        </tr>
                    @endif 
                       
                    </tbody>
                </table>
            </div>
            {{-- Amar Putusan --}}
            <div id="amarPutusan" class="tab-content">
                @foreach($dataAmar as $d)
                @if ($d->status_id == 1)    
                    <div class="addGugatan mt-4">
                        <a href="{{route('editAmarPutusan', ['id' => $d->id_peristiwa])}}" type="button" class="btn btn-primary"><i class="ph-pencil me-2"></i>Edit</a>
                    </div>
                @endif
                    <div class="mt-4">{!! $d->amar_putusan !!}</div>
                @endforeach
            </div>
            {{-- Surat Putusan --}}
            <div id="surat" class="tab-content">
                @foreach($dataPutusan as $d)
                @if ($d->status_id == 1)    
                    <div class="addGugatan mt-4">
                        <a href="{{route('editSuratPutusan', ['id' => $d->id_peristiwa])}}" type="button" class="btn btn-primary"><i class="ph-pencil me-2"></i>Edit</a>
                    </div>
                @endif
                    <div class="mt-4">
                        <h6>Putusan PN</h6>
                        @if($d->putusan_pn!=null)
                            <div>
                                <iframe src="{{ asset('files/putusanPN/'.$d->putusan_pn) }}" width="100%" height="400px"></iframe>
                            </div>
                        @else
                            <p>Tidak Ada Data</p>
                        @endif
                    </div>

                    <div class="mt-4">
                        <h6>Putusan PT</h6>
                        @if($d->putusan_pt!=null)
                            <div>
                                <iframe src="{{ asset('files/putusanPT/'.$d->putusan_pt) }}" width="100%" height="400px"></iframe>
                            </div>
                        @else
                            <p>Tidak Ada Data</p>
                        @endif
                    </div>

                    <div class="mt-4">
                        <h6>Putusan MA</h6>
                        @if($d->putusan_ma!=null)
                            <div>
                                <iframe src="{{ asset('files/putusanMA/'.$d->putusan_ma) }}" width="100%" height="400px"></iframe>
                            </div>
                        @else
                            <p>Tidak Ada Data</p>
                        @endif
                    </div>
                @endforeach
            </div>
            {{-- Surat Pengantar --}}
            <div id="suratPengantar" class="tab-content">
                @foreach($dataPengantar as $d)
                @if ($d->status_id == 1) 
                    <div class="addGugatan mt-4">
                        <a href="{{route('editSuratPengantar', ['id' => $d->id_peristiwa])}}" type="button" class="btn btn-primary"><i class="ph-pencil me-2"></i>Edit</a>
                    </div>
                @endif
                <div class="mt-4">
                    @php
                        $fileExtension = pathinfo($d->surat_pengantar, PATHINFO_EXTENSION);
                        $fileUrl = asset('files/surat-pengantar/'.$d->surat_pengantar);
                    @endphp
                    
                    @if ($fileExtension == 'pdf')
                        <iframe src="{{ $fileUrl }}" width="100%" height="600px"></iframe>
                    @else
                        <p>File tidak dapat ditampilkan secara langsung. Silakan unduh untuk melihatnya.</p>
                        <a href="{{ $fileUrl }}" class="btn btn-primary">Unduh file</a>
                    @endif
                </div>
                @endforeach
            </div>
            {{-- Status --}}
            <div id="status" class="tab-content">
                <div class="table-responsive mt-4">
                    <table class="table">
                        <tbody>
                            @foreach($dataStatus as $data)
                            <tr class="table-success">
                                <td style="width: 200px">Tanggal Permohonan</td>
                                <td style="width: 30px;">:</td>
                                <td>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Diproses</td>
                                <td>:</td>
                                @if($data->tgl_diproses != null)
                                    <td>{{ \Carbon\Carbon::parse($data->tgl_diproses)->translatedFormat('l, d F Y') }}</td>
                                @else
                                    <td>-</td>
                                @endif
                            </tr>
                            <tr class="table-success">
                                <td>Tanggal selesai</td>
                                <td>:</td>
                                @if($data->tgl_selesai != null)
                                    <td>{{ \Carbon\Carbon::parse($data->tgl_selesai)->translatedFormat('l, d F Y') }}</td>
                                @else
                                    <td>-</td>
                                @endif
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
    function confirmDeletePihak(idPihak, id) {
        const url = '/peristiwa/pihak/delete/' + idPihak + '/' + id;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        ajaxDelete(url, csrfToken);
    }

    // function confirmDeletePihak(idPihak, id) {
    //     Swal.fire({
    //         title: 'Apakah anda yakin ingin menghapus pihak ini?',
    //         showCancelButton: true,
    //         cancelButtonText: `Batal`,
    //         confirmButtonText: `Hapus`,
    //         icon: 'warning'
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed) {
    //             window.location.href = '/peristiwa/pihak/delete/' + idPihak + '/' + id;
    //         } else if (result.isDenied) {
    //             Swal.fire('Penghapusan pihak dibatalkan', '', 'info')
    //         }
    //     })
    // }
    
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

<script>
    function DeleteDataDiriPeristiwa(event) {
        // Mengambil URL dari tombol
        const url = event.target.href;

        // Menampilkan pesan konfirmasi Sweet Alert dengan gaya tambahan
        Swal.fire({
            title: 'Apakah Anda yakin menghapus Permohonan Pemblokiran Sertifikat Tanah ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
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

@endsection
