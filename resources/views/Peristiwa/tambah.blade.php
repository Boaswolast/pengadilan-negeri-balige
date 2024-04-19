@extends('layouts.pengadilan')
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Tambah Pencatatan Peristiwa Penting
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
                    <span class="breadcrumb-item active">Tambah Catatan</span>
                </div>

                <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                    <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Basic setup -->
    <div class="content">
        <div class="card">
            {{-- <div class="card-header">
                <h6 class="mb-0">Tambah Kasus</h6>
            </div> --}}

            <div class="card-body border-top">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <form class="wizard-form steps-basic" action="{{route('storePeristiwa')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h6>Data Diri</h6>
                            <fieldset>
                                <div class="addKasus">
                                    <a href="{{route('addDataDiriPeristiwa')}}" type="button" class="btn btn-success">Tambah Pihak</a>
                                </div>
                                <!-- Both borders -->
                                <div class="card">
                                    {{-- <div class="card-header">
                                        <h6 class="mb-0">Pemblokiran Sertifikat Tanah</h5>
                                    </div> --}}

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pihak</th>
                                                    <th>Status Pihak</th>
                                                    <th>Alamat Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!@empty(session('temporary_peristiwa')))
                                                    @foreach(session('temporary_peristiwa') as $peristiwa)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{ $peristiwa['nama'] ?? '' }}</td>
                                                        <td>{{ $peristiwa['status_pihak'] ?? '' }}</td>
                                                        <td>{{ $peristiwa['email'] ?? '' }}</td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" style="text-align: center">Tidak ada data yang tersedia.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /both borders -->
                                
                            </fieldset>

                            <h6>Amar Putusan</h6>
                            <fieldset>
                                <div class="card">
                                    <div class="border-top">
                                        <div class="quill-basic" id="quill-editor" name="amarPutusan"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="amarPutusan" id="petitum-input" required>
                            </fieldset>

                            <h6>Upload Surat</h6>
                            <fieldset>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan PN (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" class="form-control" name="putusanPN">
									</div>
								</div>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan PT (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" class="form-control" name="putusanPT">
									</div>
								</div>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan MA RI (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" class="form-control" name="putusanMA">
									</div>
								</div>
                            </fieldset>

                            <h6>Surat Pengantar</h6>
                            <fieldset>
                                <div class="card">
                                    <div class="card-body">
                                        <input type="file" name="surat_pengantar" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" required>
                                        {{-- <input type="file" name="surat_pengantar" class="file-input" required> --}}
                                    </div>
                                </div>
                            </fieldset>

                            <h6>Request TTD</h6>
                            <fieldset>
                                <div class="card">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td style="width: 230px;">Ketua Pengadilan Negeri</td>
                                                <td style="width: 30px;">:</td>
                                                <td style="width: 300px;">Dr. Makmur Pakpahan, S.H., M.H.</td>
                                                <td><button type="button" class="choice-btn btn btn-primary" value="ketua">Request Tanda Tangan</button></td>
                                            </tr>
                                            <tr>
                                                <td>Wakil Ketua Pengadilan Negeri</td>
                                                <td>:</td>
                                                <td>Anita Silitonga S.H.,M.H.</td>
                                                <td><button type="button" class="choice-btn btn btn-primary" value="wakil">Request Tanda Tangan</button></td>
                                            </tr>
                                            <tr>
                                                <td>Panitra Pengadilan Negeri</td>
                                                <td>:</td>
                                                <td>Leotua Hatoguan Tampubolon, S.H., M.H.</td>
                                                <td><button type="button" class="choice-btn btn btn-primary" value="panitra">Request Tanda Tangan</button></td>
                                            </tr>
                                            <tr>
                                                <td>Sekretaris Pengadilan Negeri</td>
                                                <td>:</td>
                                                <td>Daniel Donny Hutapea, S.Kom.</td>
                                                <td><button type="button" class="choice-btn btn btn-primary" value="sekretaris">Request Tanda Tangan</button></td>
                                            </tr>
                                        </table>
                                        {{-- <form action="/submit-choice" method="post"> --}}
                                        <input type="hidden" name="reqTTD" id="choiceInput">
                                        {{-- <input type="submit" value="Simpan"> --}}
                                    {{-- </form> --}}
                                        {{-- <input type="file" name="dokumen_gugatan" class="file-input" required> --}}
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- /basic setup -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const choiceButtons = document.querySelectorAll('.choice-btn');
        let choiceInput = document.getElementById('choiceInput');
        
        // Temukan tombol dengan nilai "panitra"
        const defaultButton = document.querySelector('.choice-btn[value="panitra"]');
        
        // Tambahkan kelas active ke tombol default
        defaultButton.classList.add('active');
        defaultButton.style.backgroundColor = 'white';
        defaultButton.style.color = '#0d6efd';
        choiceInput.value = defaultButton.value;

        choiceButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Reset style for all buttons
                choiceButtons.forEach(function(btn) {
                    btn.classList.remove('active'); // Hapus kelas active dari semua tombol
                    btn.style.backgroundColor = '';
                    btn.style.color = '';
                });
                // Highlight the clicked button
                this.classList.add('active'); // Tambahkan kelas active ke tombol yang diklik
                this.style.backgroundColor = 'white';
                this.style.color = '#0d6efd';
                // Set the value of the hidden input field
                choiceInput.value = this.value;
                // Show the submit button
            });
        });
    });
</script>
@endsection