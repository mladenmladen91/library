@extends('layout', ["page_title" => 'Korisnici'])

@section('content')

<div class="row" style="height: 97.5%;">
	<div class="col-lg-12 p-4" style="height: 100%;">
		<div class="card shadow mb-4" style="height: 100%;">
			<div class="card-header py-2 px-4">
				<div class="row">

					<div class="col-4"><a href="{{route('user.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ml-4"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj korisnika</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="main_table" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Ime i prezime</th>
								<th>Rola</th>
								<th>Adresa</th>
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


@endsection

@section('scripts')

<script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/standard.js"></script>
<script src="/js/user.js"></script>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		// datatables initializing
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






		// function for filling the table with the data
		function addTableRow(table, item) {
			let activation = '';
			if (item.activation === 0) {
				activation = `<button class="btn btn-info" data-action="activate" data-id="${item.id}">Aktiviraj</button>`;
			}
			let rowNode = table.row.add([
				item.name,
				item.role,
				item.address,
				`
                            <button class="btn btn-info" data-action="update" data-id="${item.id}" onClick="window.location='/admin/user/edit/` + item.id + `'" >Izmijeni</button>
							<button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button>
					` + activation
			]).draw(false).node();
			// adding remove listener for deleting particular data 
			document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
				window.Flex.Util.confirmModal({
					title: `Obrisi korisnika ${item.name}?`,
					content: "Da li ste sigurni da zelite da obrisete korisnika?",
					data: item,
					success: (data) => {
						deleteUser(item.id);
					}
				});
			});
			if (item.activation === 0) {
				document.querySelector(`[data-action="activate"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
					activateUser(item.id);
				});
			}

		}
		// calling function for collecting data for the first page
		getUsers(0).then(response => {
			response.users.forEach((item) => {
				addTableRow(table, item);
			});
		});





		//paginate table
		// getting data for the previous page
		document.querySelector('#dataTable_previous').addEventListener("click", () => {

			let current_page = document.querySelector('#page_number');
			let current_value = parseInt(current_page.innerText);

			if (current_value - 1 > 0) {
				table.clear().draw();
				getUsers(current_value - 2).then(response => {
					response.users.forEach((item) => {
						addTableRow(table, item);
					});
				});

				document.querySelector('#page_number').innerText = current_value - 1;

			}
		});
		// getting data for the next page
		document.querySelector('#dataTable_next').addEventListener("click", () => {
			let current_page = document.querySelector('#page_number');
			let current_value = parseInt(current_page.innerText);

			table.clear().draw();
			getUsers(current_value).then(response => {
				response.users.forEach((item) => {
					addTableRow(table, item);
				});
			});

			document.querySelector('#page_number').innerText = current_value + 1;
		});

	})
</script>
@endsection