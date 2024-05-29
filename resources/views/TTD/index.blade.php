@extends('layouts.pengadilan')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Permohonan Tanda Tangan
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
                <span class="breadcrumb-item active">Tanda Tangan</span>
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
        <div class="addGugatan mb-3">
            <a href="{{route('addTandaTangan')}}" type="button" class="btn btn-success">Ajukan Tanda Tangan</a>
        </div>
        <div class="card">
            {{-- <div class="card-header">
                <h5 class="mb-0">Tabel User</h5>
            </div> --}}

            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Subjek Permohonan</th>
                        <th>Termohon</th>
                        <th>Tanggal Permohonan</th>
                        <th>Atur TTD</th>
                        <th>Status Permohonan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count() > 0)
                        @foreach ($data as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $d->subjek_permohonan }}</td>
                            <td>{{ $d->termohon }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tgl_permohonan)->translatedFormat('d F Y') }}</td>
                            @if($d->status_letak == 'Selesai')
                                <td>Selesai</td>
                            @elseif($d->status_letak == 'Belum' && $d->status=='Menunggu')
                                <td>-</td>
                            @elseif($d->status_letak == 'Belum' && $d->status=='Ditolak')
                                <td>-</td>
                            @else
                            <td>
                                <a href="{{route('pdfEditor', $d->id_ttd)}}">Belum</a>
                            </td>
                            @endif
                            @if($d->status == 'Diterima')
                                <td class="text-success">Diterima</td>
                            @elseif($d->status == 'Ditolak')
                                <td class="text-danger">Ditolak</td>
                            @else
                            <td>{{$d->status}}</td>
                            @endif
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{route('detailTTD',['id'=>$d->id_ttd])}}" class="dropdown-item text-info">
                                                    <i class="ph-eye me-2"></i>
                                                    Detail
                                                        </a>
                                                        @if($d->status == 'Menunggu')
                                                        <a href="{{route('editTTD',['id'=>$d->id_ttd])}}" class="dropdown-item text-info">
                                                            <i class="ph-pencil me-2"></i>
                                                            Edit
                                                        </a>
                                                        <a href="{{route('deleteTTD', ['id' => $d->id_ttd])}}" type="button" class="dropdown-item text-danger" onclick="return DeleteTTD(event)">
                                                            <i class="ph-trash me-2"></i>
                                                            Hapus
                                                        </a>
                                                    @endif
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
    </div>
        <!-- /basic datatable -->
</div>
<script>
    function confirmDeletePihak(id) {
        const url = '/peristiwa/delete/' + id;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        console.log(url);
        ajaxDelete(url, csrfToken);
    }
</script>

<script>
    function DeleteTTD(event) {
        // Mengambil URL dari tombol
        const url = event.target.href;

        // Menampilkan pesan konfirmasi Sweet Alert dengan gaya tambahan
        Swal.fire({
            title: 'Apakah Anda yakin menghapus Permohonan Tanda Tangan ini?',
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