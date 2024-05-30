@extends('layouts.pengadilan')
@section('content')
 <!-- Page header -->
 <div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Detail Permohonan Tanda Tangan
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
                    <a href="{{route('tandatangan')}}" class="breadcrumb-item">Tanda Tangan</a>
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
<div class="card card-body">
    <div class="breadcrumb py-2 mb-2">
                <a href="{{route('tandatangan')}}" class="breadcrumb-item"><b>< Kembali</b></a>
            </div>
        {{-- <div id="status" class="tab-content"> --}}
                <div class="table-responsive mt-2">
                    <table class="table">
                        <tbody>
                            @foreach($data as $d)
                            <tr class="table-success">
                                <td style="width: 200px">Status Permohonan</td>
                                <td style="width: 30px;">:</td>
                                <td>{{ $d->status }}</td>
                            </tr>
                            <tr>
                                <td>Subjek Permohonan</td>
                                <td>:</td>
                                <td>{{ $d->subjek_permohonan }}</td>
                            </tr>
                            <tr class="table-success">
                                <td style="width: 200px">Tanggal Permohonan</td>
                                <td style="width: 30px;">:</td>
                                <td>{{ \Carbon\Carbon::parse($d->tgl_permohonan)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Pihak Termohon</td>
                                <td>:</td>
                                <td>{{ $d->name }} ({{ $d->termohon }})</td>
                            </tr>
                            <tr class="table-success">
                                <td>Dokumen Permohonan</td>
                                <td colspan="2">:</td>
                            </tr>
                            <tr>
                                <td colspan="3"><div class="mt-4">
                                    @php
                                        $fileExtension = pathinfo($d->file_dokumen, PATHINFO_EXTENSION);
                                        $fileUrl = asset('files/Tanda-Tangan/'.$d->file_dokumen);
                                    @endphp
                                    
                                    @if ($fileExtension == 'pdf')
                                        <iframe src="{{ $fileUrl }}" width="100%" height="600px"></iframe>
                                    @else
                                        <p>File tidak dapat ditampilkan secara langsung. Silakan unduh untuk melihatnya.</p>
                                        <a href="{{ $fileUrl }}" class="btn btn-primary">Unduh file</a>
                                    @endif
                                </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
