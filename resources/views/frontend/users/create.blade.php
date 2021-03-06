@extends('layout', ["page_title" => 'Korisnici-dodavanje'])

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Korisnici</h1>
	</div>

</div>
<!-- /.container-fluid -->

<div class="row justify-content-center">
	<div class="col-lg-12 col-12 p-4" id="main_content">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Dodaj korisnika</h6>
			</div>
			<div class="card-body">
				<form enctype="multipart/form-data" id="create-form">
					<div class="logoContainer text-left">

					</div>
					<div class="inputWrapper  m-2 text-danger" data-error-msg>
					</div>
					<div class="row">
						<div class="col-3">
							<div class="m-2">
								<label for="title">Naziv *</label>
								<input class="form-control" type="text" name="name" id="name" placeholder="Ime i prezime">
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">E-mail *</label>
								<input class="form-control" type="email" name="email" id="email" placeholder="E-mail">
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">Šifra *</label>
								<input class="form-control" name="password" type="password" id="password" placeholder="Šifra">
								<input type="hidden" name="role_id" value="2" />
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">Adresa</label>
								<input class="form-control" name="address" type="text" id="address" placeholder="Adresa">
							</div>
						</div>
						<div class="col-3">
							<div class="m-2">
								<label for="title">Fotografija</label>
								<input class="form-control" name="image" type="file" id="image">
							</div>
						</div>


					</div>



					<div class="inputWrapper  m-2 ">
						<button class="btn btn-success" id="save-user" type="button" data-save-page>Sačuvaj</button>
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
<script src="/js/standard.js"></script>
<script src="/js/user.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', () => {

		// creating user logic
		document.querySelector('#save-user').addEventListener('click', (e) => {
			e.preventDefault()
			let name = document.querySelector('#name').value;
			let email = document.querySelector('#email').value;
			let password = document.querySelector('#password').value;

			if (name === "" || email === "" || password === "") {
				alert('Popunite potrebne podatke!');
			} else {
				addUser($("#create-form")[0]);
			}
		});



	})
</script>
@endsection