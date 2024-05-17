@extends('layouts.pengadilan')

@section('content')
<!-- Page header -->
<div class="page-header page-header-light shadow">
    <div class="page-header-content d-lg-flex">
        <div class="d-flex">
            <h4 class="page-title mb-0">
                Home - <span class="fw-normal">Dashboard</span>
            </h4>

            <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>

    <div class="page-header-content d-lg-flex border-top">
        <div class="d-flex">
            <div class="breadcrumb py-2">
                <a href="index.html" class="breadcrumb-item"><i class="ph-house"></i></a>
                <a href="#" class="breadcrumb-item">Home</a>
                <span class="breadcrumb-item active">Dashboard</span>
            </div>

            <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
            </a>
        </div>
    </div>
</div>
<!-- /page header -->
<div class="content">

    <!-- Main charts -->
    <div class="row">

        <div class="col-xl-12">

            <!-- Sales stats -->
            <div class="card">
                <div class="card-header d-sm-flex align-items-sm-center py-sm-0">
                    <h5 class="py-sm-2 my-sm-1">Grafik Kasus</h5>
                </div>

                <div class="card-body pb-0">
                    <div class="row text-center">
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <a href="#" class="bg-indigo bg-opacity-10 text-indigo lh-1 rounded-pill p-2 me-3">
                                    <i class="ph-folder-simple-user"></i>
                                </a>
                                <div>
                                    <div class="fw-semibold">Eksekusi Perkara</div>
                                    <span class="text-muted">{{$eksekusi}} Kasus</span>
                                </div>
                            </div>
                            <div class="w-75 mx-auto mb-3" id="total-online"></div>
                        </div>

                        <div class="col-sm-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <a href="#" class="bg-success bg-opacity-10 text-success lh-1 rounded-pill p-2 me-3">
                                    <i class="ph-newspaper-clipping"></i>
                                </a>
                                <div>
                                    <div class="fw-semibold">Pemblokiran Sertifikat</div>
                                    <span class="text-muted">{{$pemblokiran}} Kasus</span>
                                </div>
                            </div>
                            <div class="w-75 mx-auto mb-3" id="new-visitors"></div>
                        </div>

                        <div class="col-sm-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <a href="#" class="bg-warning bg-opacity-10 text-warning lh-1 rounded-pill p-2 me-3">
                                    <i class="ph-user-square"></i>
                                </a>
                                <div>
                                    <div class="fw-semibold">Peristiwa Penting</div>
                                    <span class="text-muted">{{$peristiwa}} Kasus</span>
                                </div>
                            </div>
                            <div class="w-75 mx-auto mb-3" id="new-sessions"></div>
                        </div>
                    </div>
                </div>

                <div class="chart">
                    {!! $pengadilanChart->container() !!}
                </div>
                {{-- <div class="chart mb-2" id="app_sales"></div> --}}
                {{-- <div class="chart" id="monthly-sales-stats"></div> --}}
            </div>
            <!-- /sales stats -->

        </div>
    </div>
    <!-- /main charts -->
</div>
<script src="{{ $pengadilanChart->cdn() }}"></script>

{{ $pengadilanChart->script() }}
@endsection
