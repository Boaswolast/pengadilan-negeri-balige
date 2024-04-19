@extends('layouts.pengadilan')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Peristiwa Penting
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="index.html" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
                <span class="breadcrumb-item active">Peristiwa Penting</span>
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
            <a href="{{route('addPeristiwa')}}" type="button" class="btn btn-success">Tambah Catatan</a>
        </div>
        <div class="card">
            {{-- <div class="card-header">
                <h5 class="mb-0">Tabel User</h5>
            </div> --}}

            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Penggugat/Pemohon</th>
                        <th>Tergugat</th>
                        <th>Tanggal Permohonan</th>
                        <th>Status Permohonan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count() > 0)
                        @foreach ($data as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{!! nl2br(e($d->penggugat)) !!}</td>
                            <td>{!! nl2br(e($d->tergugat)) !!}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tanggal_permohonan)->translatedFormat('d F Y') }}</td>
                            <td>{{$d->status_permohonan}}</td>
                            {{--<td>{{$sertifikat->status}}</td> --}}
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{route('detailPeristiwa',['id'=>$d->id_peristiwa_penting])}}" class="dropdown-item text-info">
                                                {{-- <a href="{{route('detailSertifikat', ['id' => $sertifikat->id])}}" class="dropdown-item text-info"> --}}
                                                    <i class="ph-eye me-2"></i>
                                                    Detail
                                                </a>
                                                {{-- <a href="{{route('editSertifikat', ['id' => $sertifikat->id])}}" class="dropdown-item text-secondary">
                                                    <i class="ph-pencil me-2"></i>
                                                    Edit
                                                </a> --}}
                                                <form action="{{route('deletedPeristiwa', ['id' => $d->id_peristiwa_penting])}}" type="button" method="POST" class="dropdown-item text-danger">
                                                    <i class="ph-trash me-2"></i>
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item text-danger" style="margin-left: -20px" type="submit">Hapus</button>
                                                </form>
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
@endsection