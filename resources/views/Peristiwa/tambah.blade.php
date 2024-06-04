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
                    <a href="{{route('peristiwa')}}" class="breadcrumb-item"><i class="ph-user-square"></i></a>
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
                        <form class="wizard-form steps-basic" action="{{route('storePeristiwa')}}" method="POST" enctype="multipart/form-data" novalidate>
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
                                @error('amarPutusan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <h6>Upload Surat</h6>
                            <fieldset>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan PN (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" id="putusanPN" class="form-control @error('putusanPN') is-invalid @enderror" name="putusanPN" accept=".pdf">
                                        @error('putusanPN')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
									</div>
								</div>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan PT (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" id="putusanPT" class="form-control @error('putusanPT') is-invalid @enderror" name="putusanPT" accept=".pdf">
                                        @error('putusanPT')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
									</div>
								</div>
                                <div class="row mb-3">
									<label class="col-form-label col-lg-4">Penetapan/Putusan MA RI (.pdf)</label>
									<div class="col-lg-8">
										<input type="file" class="form-control @error('putusanMA') is-invalid @enderror" name="putusanMA" accept=".pdf">
                                        @error('putusanMA')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
									</div>
								</div>
                            </fieldset>

                            <h6>Surat Pengantar</h6>
                            <fieldset>
                                <div class="card">
                                    <div class="card-body">
                                        <input type="file" id="putusanMA" name="surat_pengantar" class="file-input @error('surat_pengantar') is-invalid @enderror" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" accept=".pdf, .doc, .docx" required>
                                        @error('surat_pengantar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        {{-- <input type="file" name="surat_pengantar" class="file-input" required> --}}
                                    </div>
                                </div>
                            </fieldset>

                            <h6>Request TTD</h6>
                            <fieldset>
                                <div class="card">
                                    <div class="card-body">
                                        <table>
                                            @foreach($termohon as $d)
                                                <tr>
                                                    <td style="width: 230px;">{{ $d->nama_role }}</td>
                                                    <td style="width: 30px;">:</td>
                                                    <td style="width: 300px;">{{ $d->name }}</td>
                                                    <td><button type="button" class="choice-btn btn btn-primary" data-role-name="{{ $d->nama_role }}">Request Tanda Tangan</button></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <input type="hidden" name="reqTTD" id="choiceInput">
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
        document.addEventListener('DOMContentLoaded', function () {
            const fileInputs = [
                document.getElementById('putusanPN'),
                document.getElementById('putusanPT'),
                document.getElementById('putusanMA')
            ];
        
            fileInputs.forEach(input => {
                input.addEventListener('change', function () {
                    checkDuplicateFiles(fileInputs);
                });
            });
        
            function checkDuplicateFiles(inputs) {
                const fileNames = new Set();
                let hasDuplicate = false;
        
                inputs.forEach(input => {
                    const file = input.files[0];
                    if (file) {
                        if (fileNames.has(file.name)) {
                            hasDuplicate = true;
                            document.getElementById(`error-${input.id}`).textContent = `File dengan nama ${file.name} sudah diunggah.`;
                        } else {
                            fileNames.add(file.name);
                            document.getElementById(`error-${input.id}`).textContent = '';
                        }
                    }
                });
        
                return !hasDuplicate;
            }
        
            const form = document.querySelector('form'); // Ganti selector dengan form yang benar
            form.addEventListener('submit', function(event) {
                if (!checkDuplicateFiles(fileInputs)) {
                    event.preventDefault(); // Mencegah pengiriman formulir jika ada duplikasi
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.choice-btn');
            const choiceInput = document.getElementById('choiceInput');
    
            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    buttons.forEach(btn => btn.classList.remove('btn-success'));
                    this.classList.add('btn-success');
                    choiceInput.value = this.getAttribute('data-role-name');
                });
            });
        });
    </script>

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