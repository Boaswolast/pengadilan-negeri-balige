@extends('layouts.pengadilan')
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Ajukan Tanda Tangan
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
                    <span class="breadcrumb-item active">Ajukan</span>
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
                <div class="card-body border-top">
                    <form action="{{route('storeTTD')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3 mt-3">
                            <label class="col-lg-3 col-form-label">Subjek Permohonan:</label>
                            <div class="col-lg-9">
                                <input type="text" name="subjek_permohonan" class="form-control" placeholder="Subjek Permohonan" value="{{ old('subjek_permohonan') }}"  required>
                                @error('subjek_permohonan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <label class="col-lg-3 col-form-label">Termohon:</label>
                            <div class="col-lg-9">
                                <select class="form-select" name="termohon" title="Pilihlah Pejabat PN Balige" value="{{ old('termohon') }}" required>
                                    <option value="">Pilih Pejabat PN Balige</option>
                                    @foreach($termohon as $d)
                                    <option value="{{ $d->nama_role }}">{{ $d->nama_role }} | {{ $d->name }}</option>
                                    @endforeach
                                    {{-- <option value="Wakil Ketua">Wakil Ketua</option>
                                    <option value="Panitera">Panitera</option>
                                    <option value="Sekretaris">Sekretaris</option> --}}
                                </select>
                                @error('termohon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label class="col-lg-4 col-form-label">Dokumen Permohonan: (.pdf)</label>
                            <input type="file" name="file_dokumen" class="file-input" multiple="multiple" data-show-upload="false" data-show-caption="true" data-show-preview="true" accept=".pdf" required>
                                @error('file_dokumen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="text-end mt-4">
                            <a href="" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                            <button type="submit" class="btn btn-success"  style="width: 120px">Kirim</button>
                        </div>
                    </form>
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