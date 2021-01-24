<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="@yield('page_description', $page_description ?? '')" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="author" content="">

	<title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>
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
	<div class="col-12 text-center" style="margin-top: 50px;">
		<h1>Knjige</h1>
	</div>
	<!-- modal for product sorting -->
	<div id="sortModal" style="position:fixed;z-index:100;top:0;left:0;height:100%;width:100%;background:rgba(0,0,0,.5);display:none">
		<div style="background:white; border-radius:10px;position:absolute;top:50%; left:50%;width:50%; transform: translate(-50%,-50%); height:700px">
			<div class="col-12 text-center p-4" style="border-bottom: 1px solid gray">
				<select id="category_sort" class="form-control" style="width: 30%;margin:auto; display:block">
					<option selected value="">Status</option>
					<option value="1">Slobodna</option>
					<option value="0">Rezervisana</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row" style="height: 97.5%;">
		<div class="col-lg-12 p-4" style="height: 100%;">
			<div class="card shadow mb-4" style="height: 100%;">
				<div class="card-header py-2 px-4">
					<div class="row">
						<div class="col-2"><select id="status" class="form-control" style="width: 100%;margin:auto; display:block">
								<option selected value="2">Status</option>
								<option value="1">Slobodna</option>
								<option value="0">Rezervisana</option>
							</select></div>
						<div class="col-2"><input id="book_search" class="form-control float-right" type="text" placeholder="Pretraži knjige"></div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table" id="main_table" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Naziv</th>
									<th>Autor</th>
									<th>Kategorija</th>
									<th>Status</th>
									<th>Akcije</th>
								</tr>
							</thead>
							<tbody>
							</tbody>

						</table>
					</div>
					<ul class="pagination">
						<li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
						<li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link" id="page_number">1</a></li>
						<li class="paginate_button page-item next disabled" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>
					</ul>
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
	<script src="/js/flex.js"></script>

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

		let table = $('#main_table').DataTable({
			"bInfo": false,
			"paging": false,
			"ordering": false,
			"searching": false,
			"oLanguage": {
				"sZeroRecords": "",
				"sEmptyTable": ""
			}
		});





		function addTableRow(table, item) {
			let status = "slobodna";
			if (item.status === 0) {
				status = "izdata";
			}
			let rowNode = table.row.add([
				item.title,
				item.author,
				item.category,
				status,
				`
                            <button class="btn btn-info" onClick="window.location='/book/details/` + item.id + `'" >Detalji</button>
                     `
			]).draw(false).node();


		}

		getPages(0, "", 2).then(response => {
			response.books.forEach((item) => {
				addTableRow(table, item);
			});
		});

		//paginate table
		document.querySelector('#dataTable_previous').addEventListener("click", () => {
			let current_page = document.querySelector('#page_number');
			let current_value = parseInt(current_page.innerText);

			let status = $("#status").val();
			let search_param = $("#book_search").val();

			if (current_value - 1 > 0) {
				getPages(current_value - 2, search_param, status).then(response => {
					table.clear().draw();
					response.books.forEach((item) => {
						addTableRow(table, item);
						document.querySelector('#page_number').innerText = current_value - 1;
					});

				});
			}
		});

		document.querySelector('#dataTable_next').addEventListener("click", () => {
			let current_page = document.querySelector('#page_number');
			let current_value = parseInt(current_page.innerText);

			let status = $("#status").val();
			let search_param = $("#book_search").val();
			getPages(current_value, search_param, status).then(response => {
				table.clear().draw();
				response.books.forEach((item) => {
					addTableRow(table, item);
				});

				document.querySelector('#page_number').innerText = current_value + 1;

			})

		});
		// event on typing in search form for books
		$('#book_search').on('input', function() {
			let search_param = $(this).val();
			let status = $("#status").val();

			getPages(0, search_param, status).then(response => {
				table.clear().draw();
				response.books.forEach((item) => {
					addTableRow(table, item);
				});
			});

		});

		// getting books depending on status 
		$("#status").change(function() {
			let status = $(this).val();
			let search_param = $("#book_search").val();
			getPages(0, search_param, status).then(response => {
				table.clear().draw();
				response.books.forEach((item) => {
					addTableRow(table, item);
				});
			});

		});



	})
</script>