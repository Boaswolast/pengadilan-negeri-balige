@extends('layouts.pengadilan')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Pemblokiran Sertifikat Tanah</h5>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pihak</th>
                    <th>Status Pihak</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if(!@empty())
                @foreach() --}}
                <tr>
                    <td>2</td>
                    <td>3</td>
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
                </tr>
                {{-- @endforeach
                @else
                <tr>
                    <td colspan="4" style="text-align: center">Tidak ada data yang tersedia.</td>
                </tr>
                @endif --}}
            </tbody>
        </table>
    </div>
</div>
@endsection