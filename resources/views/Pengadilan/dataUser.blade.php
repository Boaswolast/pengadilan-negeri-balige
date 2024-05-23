@extends('layouts.pengadilan')
@section('content')
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
 <!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Daftar Akun
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{route('dataUser')}}" class="breadcrumb-item"><i class="ph-users-three"></i></a>
                <a href="{{route('dataUser')}}" class="breadcrumb-item">Daftar Akun</a>
                <span class="breadcrumb-item active">Ketua Pengadilan</span>
            </div>

            <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
</div>
<!-- /page header -->
<div class="content">
    <div class="addGugatan mt-2">
        <a href="{{route('registerAdmin')}}" type="button" class="btn btn-success">Tambah Akun</a>
    </div>
    <div class="col-lg-12 mt-3">
        <div class="card card-body">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#masyarakat" class="nav-link active">Masyarakat</a></li>
                <li class="nav-item"><a href="#ketua" class="nav-link">Ketua Pengadilan</a></li>
                <li class="nav-item"><a href="#wakil" class="nav-link">Wakil Ketua Pengadilan</a></li>
                <li class="nav-item"><a href="#panitera" class="nav-link">Panitera Pengadilan</a></li>
                <li class="nav-item"><a href="#panitera" class="nav-link">Sekretaris Pengadilan</a></li>
            </ul>

            <div id="masyarakat" class="tab-content active">
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Akun Didaftarkan</th>
                            <th>Akun Dinonaktifkan</th>
                            <th>Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countMasyarakat)
                            @foreach ($dataMasyarakat as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->tgl_mulai}}</td>
                                <td>{{$user->tgl_akhir}}</td>
                                <td>
                                    @if ($user->is_active == 0)
                                        <p>Aktif</p>
                                    @else
                                        <p>Tidak Aktif</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @if ($user->is_active == 0)
                                                <a href="{{route('nonAktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserNonaktif(event)">
                                                    <i class="ph-pencil me-2"></i>
                                                    Non-Aktifkan Akun
                                                </a>
                                                @else
                                                <a href="{{route('aktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserAktif(event)">
                                                    <i class="ph-pencil me-2"></i>
                                                    Aktifkan Akun
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach 
                        @else
                            <tr class="mt-4">
                                <td class="text-center" colspan="6">Data Kosong</td>
                            </tr>
                        @endif 
                    </tbody>
                </table>
            </div>
            <div id="ketua" class="tab-content">
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countKetua)
                            @foreach ($dataKetua as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->is_active == 0)
                                        <p>Aktif</p>
                                    @else
                                        <p>Tidak Aktif</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
                                            @if (auth()->user()->role == 2)
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @if ($user->is_active == 0)
                                                    <a href="{{route('nonAktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserNonaktif(event)">
                                                        <i class="ph-pencil me-2"></i>
                                                        Non-Aktifkan Akun
                                                    </a>
                                                    @else
                                                    <a href="{{route('aktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserAktif(event)">
                                                        <i class="ph-pencil me-2"></i>
                                                        Aktifkan Akun
                                                    </a>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item text-info">Tidak ada aksi</a>
                                                </div>
                                            @endif
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
            <div id="wakil" class="tab-content">
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countWakil)
                            @foreach ($dataWakil as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->is_active == 0)
                                        <p>Aktif</p>
                                    @else
                                        <p>Tidak Aktif</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
    
                                            @if (auth()->user()->role == 2)
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @if ($user->is_active == 0)
                                                    <a href="{{route('nonAktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserNonaktif(event)">
                                                        <i class="ph-pencil me-2"></i>
                                                        Non-Aktifkan Akun
                                                    </a>
                                                    @else
                                                    <a href="{{route('aktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserAktif(event)">
                                                        <i class="ph-pencil me-2"></i>
                                                        Aktifkan Akun
                                                    </a>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item text-info">Tidak ada aksi</a>
                                                </div>
                                            @endif
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
            <div id="panitera" class="tab-content">
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countPanitera)
                            @foreach ($dataPanitera as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->is_active == 0)
                                        <p>Aktif</p>
                                    @else
                                        <p>Tidak Aktif</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
    
                                            @if (auth()->user()->role == 2)
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @if ($user->is_active == 0)
                                                    <a href="{{route('nonAktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserNonaktif(event)">
                                                        <i class="ph-pencil me-2"></i>
                                                        Non-Aktifkan Akun
                                                    </a>
                                                    @else
                                                    <a href="{{route('aktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserAktif(event)">
                                                        <i class="ph-pencil me-2"></i>
                                                        Aktifkan Akun
                                                    </a>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item text-info">Tidak ada aksi</a>
                                                </div>
                                            @endif
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
            <div id="sekretaris" class="tab-content">
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($countSekretaris)
                            @foreach ($dataSekretaris as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->is_active == 0)
                                        <p>Aktif</p>
                                    @else
                                        <p>Tidak Aktif</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
    
                                            @if (auth()->user()->role == 2)
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @if ($user->is_active == 0)
                                                    <a href="{{route('nonAktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserNonaktif(event)">
                                                        <i class="ph-pencil me-2"></i>
                                                        Non-Aktifkan Akun
                                                    </a>
                                                    @else
                                                    <a href="{{route('aktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserAktif(event)">
                                                        <i class="ph-pencil me-2"></i>
                                                        Aktifkan Akun
                                                    </a>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" class="dropdown-item text-info">Tidak ada aksi</a>
                                                </div>
                                            @endif
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
        var initialTab = document.querySelector('.nav-tabs .nav-link[href="#masyarakat"]');
        initialTab.classList.add('active');
        showTabContent('#masyarakat');
    });
</script>

<script>
    function UserAktif(event) {
        // Mengambil URL dari tombol
        const url = event.target.href;

        // Menampilkan pesan konfirmasi Sweet Alert dengan gaya tambahan
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Mengaktifkan Akun Ini Kembali?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
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
    function UserNonaktif(event) {
        // Mengambil URL dari tombol
        const url = event.target.href;

        // Menampilkan pesan konfirmasi Sweet Alert dengan gaya tambahan
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Menonaktifkan Akun Ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
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


{{-- @extends('layouts.pengadilan')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Akun User
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="{{route('dataUser')}}" class="breadcrumb-item"><i class="ph-users-three"></i></a>
                <span class="breadcrumb-item active">Akun User</span>
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
    <!-- Main charts -->
    <div class="row">
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Tabel Akun</h5>
            </div>

            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status Akun</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($count)
                        @foreach ($dataUser as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if ($user->is_active == 0)
                                    <p>Aktif</p>
                                @else
                                    <p>Tidak Aktif</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            @if ($user->is_active == 0)
                                            <a href="{{route('nonAktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserNonaktif(event)">
                                                <i class="ph-pencil me-2"></i>
                                                Non-Aktifkan Akun
                                            </a>
                                            @else
                                            <a href="{{route('aktif', ['id' => $user->id])}}" class="dropdown-item text-info" onclick="return UserAktif(event)">
                                                <i class="ph-pencil me-2"></i>
                                                Aktifkan Akun
                                            </a>
                                            @endif
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
    function UserAktif(event) {
        // Mengambil URL dari tombol
        const url = event.target.href;

        // Menampilkan pesan konfirmasi Sweet Alert dengan gaya tambahan
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Mengaktifkan Akun Ini Kembali?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
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
    function UserNonaktif(event) {
        // Mengambil URL dari tombol
        const url = event.target.href;

        // Menampilkan pesan konfirmasi Sweet Alert dengan gaya tambahan
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Menonaktifkan Akun Ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
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
@endsection --}}