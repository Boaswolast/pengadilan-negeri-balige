{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>Registrasi</title>
	<link href="{{asset('assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('layout/assets/css/ltr/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('assets/demo/demo_configurator.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('assets/js/app.js')}}"></script>

	<!-- Generate Sendiri -->
	<link href="{{asset('assets/style.css')}}" id="stylesheet" rel="stylesheet" type="text/css">

</head>

<body>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					<!-- Login form -->
					<form method="POST" action="{{ route('register') }}">
                        @csrf
						<div class="card kartu">
							<div class="card-body">
								<div class="text-center mb-3">
									<div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
										<img src="{{asset('assets/images/logo_pengadilan.png')}}" class="h-48px" alt="">
									</div>
									<h5 class="mb-0">Registrasi Akun</h5>
									<span class="d-block text-muted">Masukkan dan ingat data anda dengan benar</span>
								</div>

                                <div class="mb-3">
									<label class="form-label">Nama</label>
									<div class="form-control-feedback form-control-feedback-start">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nama" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-control-feedback-icon">
											<i class="ph-identification-card text-muted"></i>
										</div>
                                    </div>
                                </div>

								<div class="mb-3">
									<label class="form-label">Email</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
										<div class="form-control-feedback-icon">
											<i class="ph-user-circle text-muted"></i>
										</div>
									</div>
								</div>

								<div class="mb-3">
									<label class="form-label">Password</label>
									<div class="form-control-feedback form-control-feedback-start">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
										<div class="form-control-feedback-icon">
											<i class="ph-lock text-muted"></i>
										</div>
									</div>
								</div>

                                <div class="mb-3">
									<label class="form-label">Konfir Password</label>
									<div class="form-control-feedback form-control-feedback-start">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confir Password" required autocomplete="new-password">
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-lock text-muted"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success w-100">
                                        {{ __('Register') }}
                                    </button>
                                </div>
							</div>
						</div>
					</form>
					<!-- /login form -->

				</div>
				<!-- /content area -->


				<!-- Footer -->
				<div class="navbar navbar-sm navbar-footer border-top">
					<div class="container-fluid">
						<span>Copyright &copy; 2024 PA-III 01. All rights reserved</span>
					</div>
				</div>
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>

