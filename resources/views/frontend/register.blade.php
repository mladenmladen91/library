<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="@yield('page_description', $page_description ?? '')" />
	<meta name="author" content="">

	<title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>
	<link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

	<!-- Custom fonts for this template-->
	<link href="vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="vendor/startbootstrap-sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

	<link href="vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link href="/css/login.css" rel="stylesheet">

	{{-- Includable CSS --}}
	{{-- @yield('styles')--}}
</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper" style="height: 100vh">



		<!-- Main Content -->
		<div id="loginPage" class="container d-flex align-items-center justify-content-center flex-column">
			@if(Session::has('registerOnHold'))
			<div class="alert alert-danger">
				{{ Session::get('registerOnHold')}}
			</div>
			{{Session::forget('registerOnHold')}}
			@endif
			<div class="text-center">
				<form method="POST" action="{{ route('register') }}">
					@csrf

					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">Ime</label>

						<div class="col-md-6">
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

							@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="password-confirm" class="col-md-4 col-form-label text-md-right">Potvrdi password</label>

						<div class="col-md-6">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Register') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- End of Main Content -->

	</div>
	<!-- End of Content Wrapper -->


	<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/dist/jquery.min.js"></script>
	<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="vendor/jquery.easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="vendor/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="vendor/chart.js/dist/Chart.min.js"></script>

	<script src="vendor/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

</body>

</html>