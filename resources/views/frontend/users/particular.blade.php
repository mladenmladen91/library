@extends('layout', ["page_title" => 'Knjige'])

@section('content')


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
								<th>Izdavač</th>
								<th>Štampao</th>
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


<div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog">
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
						<input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}" />
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

@endsection

@section('scripts')

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
			let button = "";
			if (item.status === 0) {
				status = "izdata";
			}
			if (item.status === 1) {
				button = `<button class="btn btn-info" data-action="reserve" data-id="${item.id}">Rezerviši</button>`
			}
			let rowNode = table.row.add([
				item.title,
				item.author,
				item.publisher,
				item.print,
				item.category,
				status,
				button
			]).draw(false).node();
			if (item.status === 1) {
				// reserve button
				document.querySelector(`[data-action="reserve"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
					let updateModal = document.querySelector('#updateCategoryModal');
					updateModal.querySelector('#book_id').value = item.id;
					$('#updateCategoryModal').modal('show');
				});
			}

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

		// saving reservation logistic
        document.querySelector('[data-save-reserve]').addEventListener('click', () => {
			reserveBook($("#reserve-form")[0]);
        });

	})
</script>
@endsection