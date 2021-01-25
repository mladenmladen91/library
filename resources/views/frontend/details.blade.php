<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="@yield('page_description', $page_description ?? '')" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="author" content="">

	<title></title>
	<link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

	<!-- Custom fonts for this template-->
	<link href="/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="/vendor/startbootstrap-sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

	<link href="/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

	<!-- Main Quill library -->
	<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
	<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

	<!-- Theme included stylesheets -->
	<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
	<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
	<style>
		button,
		a {
			font-family: Arial, Helvetica, sans-serif;
		}

		.btn {
			min-height: 37px !important;
			padding-top: 7px !important;
			padding-bottom: 7px !important;
			padding-left: 10px !important;
			padding-right: 10px !important;
		}

		.btn-info,
		.btn-primary {
			background-color: #069447 !important;
		}

		.btn-danger {
			background-color: #ff3d00 !important;
		}

		td {
			color: #434343;
			font-size: 16px;
		}

		.sidebar ul {
			list-style-type: none;
		}

		.sidebar li a {
			font-size: 12px !important;
			text-decoration: none;
		}

		.collapse li {
			margin-top: 15px;
		}

		table {
			width: 100% !important;
		}

		@media(max-width: 600px) {
			table {
				width: 700px !important;
				overflow-x: scroll;
			}

			#accordionSidebar li {
				padding-left: 3px !important;
			}

			#accordionSidebar li span {
				padding-left: 5px !important;
			}

			.collapse {
				padding-left: 10px !important;
			}
		}
	</style>
</head>

<body id="page-top">
	<div class="logout m-4" style="display:none">
		<button class="btn btn-primary" id="logout">Logout</button>
	</div>
	<div class="col-12 m-2"><a class="btn btn-info" href="/">Početna</a></div>
	<div class="col-12 text-center" style="margin-top: 50px;">
		<h1 id="title"></h1>
	</div>
	<div class="row" style="height: 97.5%;">
		<div class="col-lg-12 p-4" style="height: 100%;">
			<div class="card shadow mb-4" style="height: 100%;">

				<div class="card-body">
					<div class="row text-center">
						<div class="col-lg-4 mb-2 text-center">
							<label><b>Author</b></label>
							<p id="author"></p>
						</div>
						<div class="col-lg-4 mb-2 text-center">
							<label><b>Izdavač</b></label>
							<p id="publisher"></p>
						</div>
						<div class="col-lg-4 mb-2 text-center">
							<label><b>Štampao</b></label>
							<p id="print"></p>
						</div>
						<div class="col-lg-4 mb-2 text-center">
							<label><b>Status</b></label>
							<p id="status"></p>
						</div>
						<div class="col-lg-12" id="reserve_holder">

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Rezerviši knjigu</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="reserve-form" action="" method="POST">

							<div class="inputWrapper  m-2 text-danger" data-error-msg>
							</div>
							<div class="inputWrapper  m-2 ">
								<input type="hidden" name="user_id" id="user_id" value="" />
								<input type="hidden" name="book_id" id="book_id" value="" />
								<label for="title">Period *</label>
								<select class="form-control" type="text" name="period">
									<option value="7">7 dana</option>
									<option value="15">15 dana</option>
									<option value="30">30 dana</option>
								</select>
							</div>

						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
						<button class="btn btn-success" type="button" data-save-reserve>Rezerviši</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Login</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="login-form" action="" method="POST">

							<div class="inputWrapper  m-2 text-danger" id="login-error">
							</div>
							<div class="inputWrapper  m-2 ">
								<label for="title">E-mail*</label>
								<input class="form-control" name="email" id="email" />
							</div>
							<div class="inputWrapper  m-2 ">
								<label for="title">Password*</label>
								<input type="password" class="form-control" name="password" id="password" />
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
						<button class="btn btn-success" type="button" data-login>Login</button>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="/vendor/jquery/dist/jquery.min.js"></script>
	<script src="/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="/vendor/jquery.easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="/vendor/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"></script>


	{{--Includable JS--}}
	@yield('scripts')
</body>

</html>

<script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/standard.js"></script>
<script src="/js/book.js"></script>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		// getting data for user
		let general = 0;
		getBook({{$id}}).then(response => {
			$("title").text(response.book.title);
			$("#title").text(response.book.title);
			$("#author").text(response.book.author);
			$("#publisher").text(response.book.publisher);
			$("#print").text(response.book.print);
			let status = "izdata";
			if (response.book.status == 1) {
				status = "slobodna";
			}
			general = response.book.status;

			$("#status").text(status);
			// filling the book data
			let reserveContent = "";
			if (localStorage.getItem("token")) {
				if (general === 1) {
					reserveContent = "<a style='cursor:pointer;color:blue' data-toggle='modal' data-target='#reservationModal'>Rezerviši knjigu</a>";
				} else {
					reserveContent = "<p>Knjiga nije dostupna!</p>";
				}
				let user = JSON.parse(localStorage.getItem('user'));
				$("#user_id").val(user.id);
				$("#book_id").val(response.book.id);
				$(".logout").css({
					"display": "block"
				});
				document.querySelector('#logout').addEventListener('click', () => {
					logout();
				});
			} else {
				reserveContent = "<p><a style='cursor:pointer;color:blue' data-toggle='modal' data-target='#loginModal'>Ulogujte se</a> ili <a href='/register'>registrujte</a> da bi rezervisali knjigu</p>"
			}
			$("#reserve_holder").html(reserveContent);
		});


		// login logic
		document.querySelector('[data-login]').addEventListener('click', () => {
			let email = document.querySelector('#loginModal').querySelector('#email').value;
			let password = document.querySelector('#loginModal').querySelector('#password').value;
			if (email != "" && password != "") {
				login($("#login-form")[0]);
			} else {
				alert("Popunite potrebne podatke!");
			}
		});

		// sending reservation request
		// saving reservation logistic
		document.querySelector('[data-save-reserve]').addEventListener('click', () => {
			reserveBook($("#reserve-form")[0]);
		});
	})
</script>