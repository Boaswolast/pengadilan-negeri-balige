
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="{{ asset('assets/images/logo_pengadilan.png') }}">
	<title>Pengadilan Negeri Balige</title>

	<!-- Global stylesheets -->
	<link href="{{asset('assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('layout/assets/css/ltr/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('assets/demo/demo_configurator.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('assets/js/vendor/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('assets/js/vendor/visualization/d3/d3_tooltip.js')}}"></script>

	<script src="{{asset('layout/assets/js/app.js')}}"></script>
	<script src="{{asset('assets/demo/pages/dashboard.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/streamgraph.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/sparklines.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/lines.js')}}"></script>	
	<script src="{{asset('assets/demo/charts/pages/dashboard/areas.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/donuts.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/bars.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/progress.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/heatmaps.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/pies.js')}}"></script>
	<script src="{{asset('assets/demo/charts/pages/dashboard/bullets.js')}}"></script>
	<!-- /theme JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('assets_layout/js/app.js') }}"></script>
	<script src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('assets/js/vendor/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('assets/js/vendor/forms/wizards/steps.min.js')}}"></script>
	<script src="{{asset('assets/js/vendor/forms/validation/validate.min.js')}}"></script>
	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('assets/demo/pages/form_wizard.js')}}"></script>
	<script src="{{asset('assets/js/vendor/uploaders/fileinput/fileinput.min.js')}}"></script>
	<script src="{{asset('assets/js/vendor/uploaders/fileinput/plugins/sortable.min.js')}}"></script>
	<script src="{{asset('assets/demo/pages/uploader_bootstrap.js')}}"></script>
	<script src="{{ asset('assets/js/delete_alert.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('assets/demo/pages/form_select2.js') }}"></script>
	<!-- /theme JS files -->

	<!-- quill -->
	<script src="{{asset('assets/js/vendor/editors/quill/quill.min.js')}}"></script>
	<script src="{{asset('assets/demo/pages/editor_quill.js')}}"></script>
	<!-- /quill -->

	<!-- alert -->
	<script src="{{asset('assets/js/vendor/notifications/sweet_alert.min.js')}}"></script>
	<script src="{{asset('assets/demo/pages/extra_sweetalert.js')}}"></script>
	<!-- //alert -->

	<!-- modal -->
	<script src="{{asset('assets/js/vendor/notifications/bootbox.min.js')}}"></script>
	<script src="{{asset('assets/demo/pages/components_modals.js')}}"></script>

	<!-- Generate Sendiri -->
	<link href="{{asset('assets/style.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
	

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10" style="background-color: white">
		<div class="container-fluid">
			<div class="d-flex d-lg-none me-2">
				<button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
					<i class="ph-list"></i>
				</button>
			</div>

			<div class="navbar-brand flex-1 flex-lg-1">
				<a href="{{route('home')}}" class="d-inline-flex align-items-center">
					<img src="{{asset('assets/images/logo_pengadilan.png')}}" class="w-30px h-80px rounded-pill ms-4" alt="">
					<img src="{{asset('assets/images/logo_text_pengadilan-light.png')}}" class="w-30px h-40px d-none d-sm-inline-block h-16px ms-2" alt="">
				</a>
			</div>

            <div class="navbar-brand flex-1 flex-lg-1">
				<a href="{{route('homeUser')}}" class="d-inline-flex align-items-center headerUser">Beranda</a>
                <a href="{{route('home')}}" class="d-inline-flex align-items-center headerUser">Peristiwa Penting</a>
                <a href="{{route('indexUser')}}" class="d-inline-flex align-items-center headerUser">Eksekusi Perkara</a>
			</div>

			<ul class="nav flex-row justify-content-end order-1 order-lg-2">

				<li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
					<a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
						<div class="status-indicator-container">
							<img src="{{asset('assets/images/demo/users/face11.jpg')}}" class="w-32px h-32px rounded-pill" alt="">
							<span class="status-indicator bg-success"></span>
						</div>
						<span class="d-none d-lg-inline-block mx-lg-2" style="color: black; font-size:20px; font-weight: 500;">{{ Auth::user()->name }}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						<a href="#" class="dropdown-item">
							<i class="ph-user-circle me-2"></i>
							My profile
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="ph-gear me-2"></i>
							Account settings
						</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="ph-sign-out me-2"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
                @yield('content')
				@include('sweetalert::alert')
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

	<!-- Demo config -->
	<div class="offcanvas offcanvas-end" tabindex="-1" id="demo_config">
		<div class="position-absolute top-50 end-100 visible">
			<button type="button" class="btn btn-primary btn-icon translate-middle-y rounded-end-0" data-bs-toggle="offcanvas" data-bs-target="#demo_config">
				<i class="ph-gear"></i>
			</button>
		</div>

		<div class="offcanvas-header border-bottom py-0">
			<h5 class="offcanvas-title py-3">Demo configuration</h5>
			<button type="button" class="btn btn-light btn-sm btn-icon border-transparent rounded-pill" data-bs-dismiss="offcanvas">
				<i class="ph-x"></i>
			</button>
		</div>

		<div class="offcanvas-body">
			<div class="fw-semibold mb-2">Color mode</div>
			<div class="list-group mb-3">
				<label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-2">
					<div class="d-flex flex-fill my-1">
						<div class="form-check-label d-flex me-2">
							<i class="ph-sun ph-lg me-3"></i>
							<div>
								<span class="fw-bold">Light theme</span>
								<div class="fs-sm text-muted">Set light theme or reset to default</div>
							</div>
						</div>
						<input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="light" checked>
					</div>
				</label>

				<label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-2">
					<div class="d-flex flex-fill my-1">
						<div class="form-check-label d-flex me-2">
							<i class="ph-moon ph-lg me-3"></i>
							<div>
								<span class="fw-bold">Dark theme</span>
								<div class="fs-sm text-muted">Switch to dark theme</div>
							</div>
						</div>
						<input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="dark">
					</div>
				</label>

				<label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-0">
					<div class="d-flex flex-fill my-1">
						<div class="form-check-label d-flex me-2">
							<i class="ph-translate ph-lg me-3"></i>
							<div>
								<span class="fw-bold">Auto theme</span>
								<div class="fs-sm text-muted">Set theme based on system mode</div>
							</div>
						</div>
						<input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="auto">
					</div>
				</label>
			</div>
		</div>
	</div>
	<!-- /demo config -->

</body>
</html>