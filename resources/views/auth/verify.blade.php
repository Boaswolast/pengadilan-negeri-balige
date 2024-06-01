@extends('layouts.user')

@section('content')
<div class="content body-user">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="color: green">
                        <h4>Verifikasi Email Anda</h4>
                    </div>
    
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Tautan verifikasi Akun Anda Telah Dikirim ke Alamat Email Anda
                            </div>
                        @endif
    
                        Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.
                        Jika Anda tidak menerima email,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk meminta tautan verifikasi kembali') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
