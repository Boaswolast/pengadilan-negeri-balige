@extends('layouts.user')

@section('content')
<div class="content body-user">

    <script>
        document.getElementById("formDataDiri").addEventListener("submit", function(event) {
            var formIsValid = true;
            var inputs = this.querySelectorAll("input[required]");
            
            inputs.forEach(function(input) {
                if (!input.value) {
                    formIsValid = false;
                    input.classList.add("invalid-input");
                } else {
                    input.classList.remove("invalid-input");
                }
            });
            
            if (!formIsValid) {
                event.preventDefault(); // Mencegah pengiriman formulir jika ada bidang yang tidak valid
            }
        });
    </script>
    <!-- Centered card -->
    <center><h5 class="mt-3" style="color: white">Kirim Ulang Bukti Pembayaran Sesuai dengan SKUM!</h5></center>
    <div class="row">
        <div class="col-lg-8 offset-lg-2 mt-4">
            <div class="card">
                <div class="card-body border-top">
                    @foreach ($dataPembayaran as $data)
                    <div class="row mb-3">
                        <p>Skum &nbsp; :</p>
                        <div class="addGugatan mt-4">
                            <a href="{{url('/downloadSkum', ['file' => $data->skum])}}" type="button" class="btn btn-success">Download SKUM</a>
                        </div>
                        <iframe src="{{ asset('dokumen/Eksekusi/'.$data->skum) }}" width="100%" height="400px" class="mt-3 mb-3"></iframe>
                    </div>
                    <form action="{{route('uploadUlangPembayaran', ['id' => $data->id_pembayaran])}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                    
                        <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Bukti Pembayaran</label>
                            <div class="col-lg-8">
                                <input type="file" name="bukti_pembayaran" data-show-upload="false" data-show-caption="true" data-show-preview="true" class="form-control @error('bukti_pembayaran') is-invalid @enderror" placeholder="Bukti Pembayaran">
                                @error('bukti_pembayaran')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="row mb-3">
                            <label class="col-lg-4 col-form-label">Keterangan</label>
                            <div class="col-lg-8">
                                <textarea rows="3" name="keterangan" cols="3" class="form-control" placeholder="Keterangan"></textarea>
                            </div>
                        </div> --}}

                        <div class="text-end mt-4">
                            <a href="{{route('eksekusi')}}" type="button" class="btn btn-light my-1 me-2" style="width: 120px">Batal</a>
                            <button type="submit" class="btn btn-success">Kirim <i class="ph-paper-plane-tilt ms-2"></i></button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /centered card -->
</div>
@endsection