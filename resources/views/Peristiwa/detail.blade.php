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
                <a href="{{route('peristiwa')}}" class="breadcrumb-item"><i class="ph-newspaper-clipping"></i></a>
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
                <div class="addGugatan mt-4">
                    <a href="{{route('addPihakPeristiwa',$id)}}" type="button" class="btn btn-success">Tambah Pihak</a>
                </div>
                <table class="table datatable-basic table-bordered mt-3">
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
                                            <a href="{{route('editPihakPeristiwa', ['id' => $d->id_data_diri])}}" class="dropdown-item text-secondary">
                                                <i class="ph-pencil me-2"></i>
                                                Edit
                                            </a>
                                            <form action="#" type="button" method="POST" class="dropdown-item text-danger">
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
                        
                        {{-- <tr>
                            <td>2</td>
                            <td>p</td>
                            <td>3</td>
                            <td>3</td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>
        
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#" class="dropdown-item text-info">
                                                <i class="ph-eye me-2"></i>
                                                Detail
                                            </a>
                                            <a href="#" class="dropdown-item text-secondary">
                                                <i class="ph-pencil me-2"></i>
                                                Edit
                                            </a>
                                            <form action="#" type="button" method="POST" class="dropdown-item text-danger">
                                                <i class="ph-trash me-2"></i>
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item text-danger" type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr> --}}
                       
                    </tbody>
                </table>
            </div>
            <div id="petitum" class="tab-content">
                <h3>Petitum Content</h3>
                <p>Content for Petitum tab goes here.</p>
            </div>
            <div id="gugatan" class="tab-content">
                <h3>Gugatan Content</h3>
                <p>Content for Gugatan tab goes here.</p>
            </div>
            <div id="status" class="tab-content">
                <div class="table-responsive mt-4">
                    <table class="table">
                        <tbody>
                            <tr class="table-success">
                                <td style="width: 300px">Tanggal Permohonan</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tanggal Diproses</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr class="table-success">
                                <td>Tanggal selesai</td>
                                <td>:</td>
                                <td></td>
                            </tr>
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
