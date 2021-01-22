@extends('layout', ["page_title" => 'Korisnici-dodavanje'])

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Knjige</h1>
	</div>

</div>
<!-- /.container-fluid -->

<div class="row justify-content-center">
	<div class="col-lg-12 col-12 p-4" id="main_content">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Dodaj knjigu</h6>
			</div>
			<div class="card-body">
				<form id="create-form">
					<div class="logoContainer text-left">

					</div>
					<div class="inputWrapper  m-2 text-danger" data-error-msg>
					</div>
					<div class="row">
						<div class="col-3">
							<div class="m-2">
								<label for="title">Naslov*</label>
								<input class="form-control" type="text" name="title" id="title" placeholder="Naslov">
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">Autor</label>
								<input class="form-control" type="text" name="author" id="author" placeholder="Autor">
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">Izdavač</label>
								<input class="form-control" type="text" name="publisher" id="publisher" placeholder="Izdavač">
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">Štampao</label>
								<input class="form-control" type="text" name="print" id="printer" placeholder="Štampao">
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">Status</label>
								<select class="form-control" name="status" id="status">
									<option value="0">Izdata</option>
									<option value="1">Slobodna</option>
								</select>
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">Kategorija</label>
								<select class="form-control" name="category_id" id="category_id">
								</select>
							</div>
						</div>

					</div>



					<div class="inputWrapper  m-2 ">
						<button class="btn btn-success" id="save-book" type="button" data-save-book>Sačuvaj</button>
					</div>
				</form>
			</div>
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
<script src="/js/category.js"></script>
<script src="/js/book.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', () => {

		getCategories().then(response => {
			let options = "";
			response.categories.forEach((item) => {
				options += "<option value='" + item.id + "'>" + item.name + "</option>";
			});
			$("#category_id").html(options);
		});

		// creating user logic
		document.querySelector('#save-book').addEventListener('click', (e) => {
			e.preventDefault()
			let name = document.querySelector('#title').value;

			if (name === "") {
				alert('Popunite obavezne podatke!');
			} else {
				addBook($("#create-form")[0]);
			}
		});



	})
</script>
@endsection