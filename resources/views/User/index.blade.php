@extends('layouts.user')

@section('content')
<div class="content body-user">

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
                        targets: [6]
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
        <div class="addGugatan mt-3">
            <a href="{{route('user')}}" type="button" class="btn btn-light" style="color: green">Ajukan Eksekusi Baru</a>
        </div>
        <div class="col-xl-12">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Tabel User</h5>
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
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{route('detailAllEksekusi', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                    <i class="ph-eye me-2"></i>
                                                    Detail
                                                </a> 
                                                {{-- @if ($eksekusi->status == 'Ditolak')
                                                    <a href="{{route('detailAllEksekusi', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                        <i class="ph-eye me-2"></i>
                                                        Detail
                                                    </a>   --}}
                                                @if($eksekusi->status == 'Menunggu')
                                                    <a href="{{route('detailAllEksekusi', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                        <i class="ph-eye me-2"></i>
                                                        Detail
                                                    </a> 
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ph-trash me-2"></i>
                                                        Delete
                                                    </a> 
                                                @elseif($eksekusi->status_telaah == 'Diterima')
                                                    <a href="{{route('detailAllEksekusi', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                        <i class="ph-eye me-2"></i>
                                                        Detail
                                                    </a> 
                                                    <a href="#" class="dropdown-item text-info">
                                                        <i class="ph-trash me-2"></i>
                                                        Upload Bukti Pembayaran
                                                    </a> 
                                                {{-- @elseif ($eksekusi->status_pembayaran == 'Sudah Bayar')
                                                    <a href="{{route('detailAllEksekusi', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                        <i class="ph-eye me-2"></i>
                                                        Detail
                                                    </a>   --}}
                                                {{-- @elseif ($eksekusi->status_pembayaran == 'Diterima')
                                                    <a href="{{route('detailAllEksekusi', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                        <i class="ph-eye me-2"></i>
                                                        Detail
                                                    </a> 
                                                @elseif ($eksekusi->status_pembayaran == 'Diterima')
                                                    <a href="{{route('detailAllEksekusi', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                        <i class="ph-eye me-2"></i>
                                                        Detail
                                                    </a>   --}}
                                                @elseif($eksekusi->status == null)
                                                    <a href="{{route('detailAllEksekusi', ['id' => $eksekusi->id_eksekusi])}}" class="dropdown-item text-info">
                                                        <i class="ph-eye me-2"></i>
                                                        Detail
                                                    </a> 
                                                    <a href="#" class="dropdown-item text-danger">
                                                        <i class="ph-trash me-2"></i>
                                                        Delete
                                                    </a> 
                                                @endif
                                                
                                                {{-- <a href="{{route('editSertifikat', ['id' => $sertifikat->id])}}" class="dropdown-item text-secondary">
                                                    <i class="ph-pencil me-2"></i>
                                                    Edit
                                                </a> --}}
                                                {{-- <form action="{{route('deletedSertifikat', ['kode_unik' => $sertifikat->kode_unik])}}" type="button" method="POST" class="dropdown-item text-danger">
                                                    <i class="ph-trash me-2"></i>
                                                    @csrf
                                                    @method('delete')
                                                    <button class="dropdown-item text-danger" style="margin-left: -20px" type="submit">Hapus</button>
                                                </form> --}}
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
    </div>
        <!-- /basic datatable -->
</div>
@endsection