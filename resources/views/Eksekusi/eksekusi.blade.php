@extends('layouts.pengadilan')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Permohonan Eksekusi Perkara
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{route('eksekusi')}}" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
                <span class="breadcrumb-item active">Eksekusi Perkara</span>
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
                        targets: [5]
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
    <!-- Main charts -->
    <div class="row">
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Kasus Eksekusi Perkara</h5>
            </div>

            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pemohon</th>
                        <th>Termohon</th>
                        <th>Tanggal Permohonan</th>
                        <th>Proses</th>
                        <th>Status Permohonan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count() > 0)
                        @foreach ($data as $eksekusi)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$eksekusi->pemohon}}</td>
                            <td>{{$eksekusi->termohon}}</td>
                            <td>{{$eksekusi->tanggal_permohonan}}</td>
                            <td>{{$eksekusi->proses}}</td>
                            <td>
                                {{$eksekusi->status}}
                                @if ($eksekusi->status == null)
                                    <div>
                                        Masih ada proses yang belum diselesaikan
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{route('detailAllEksekusiAdmin', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                <i class="ph-eye me-2"></i>
                                                Detail
                                            </a>
                                            @if ($eksekusi->proses == 'Telaah')
                                            {{-- @foreach ($data as $eksekusi) --}}
                                            <a href="#" class="dropdown-item text-primary" onclick="confirmAction(event, '{{ $eksekusi->telaah_id }}')">
                                                <i class="ph-pencil-line me-2"></i>
                                                Ubah Status
                                            </a>
                                            {{-- @endforeach --}}
                                            @elseif($eksekusi->proses == 'Pembayaran')
                                                <a href="#" class="dropdown-item text-primary">
                                                    <i class="ph-trash me-2"></i>
                                                    Ubah Status
                                                </a>
                                            @elseif($eksekusi->proses == 'Aanmaning')
                                                <a href="#" class="dropdown-item text-primary">
                                                    <i class="ph-trash me-2"></i>
                                                    Ubah Status
                                                </a>
                                            @endif
                                            {{-- <a href="{{route('editSertifikat', ['id' => $sertifikat->id])}}" class="dropdown-item text-secondary">
                                                <i class="ph-pencil me-2"></i>
                                                Edit
                                            </a> --}}
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
    </div>
        <!-- /basic datatable -->
</div>

<script>
    // Define the JavaScript function with telaahId parameter
    function confirmAction(event, telaahId) {
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



@endsection