@extends('layout', ["page_title" => 'Kategorije knjiga'])

@section('content')


<div class="row" style="height: 92%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Lista kategorija</span>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj kategorijui</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="main_table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Naziv</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj novu kategoriju</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="logoContainer text-left">

                    </div>
                    <div class="inputWrapper  m-2 ">
                        <label for="title">Naziv *</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Naziv">
                    </div>

                    </from>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                <button class="btn btn-success" type="button" data-save-category>Sačuvaj</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Izmijeni kategoriju</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">

                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
                    <div class="inputWrapper  m-2 ">
                        <input type="hidden" name="id" id="id" />
                        <label for="title">Naziv *</label>
                        <input class="form-control" type="text" name="name" id="edit-name" placeholder="Naziv">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                <button class="btn btn-success" type="button" data-update-category>Izmijeni</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/js/standard.js"></script>
<script src="/js/category.js"></script>

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

        function addTableRow(item, table) {
            let tableBody = document.querySelector("#main_table tbody");
            let rowNode = table.row.add([
                item.id,
                item.name,
                `<button class="btn btn-info" data-action="update" data-id="${item.id}" >Izmijeni</button>
                            <button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button></td></tr>
                        
                    `
            ]).draw(false).node();
            document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                window.Flex.Util.confirmModal({
                    title: `Obrisi kategoriju ${item.name}?`,
                    content: "Da li ste sigurni da zelite da obrisete kategoriju?",
                    data: item,
                    success: (data) => {
                        deleteCategory(item.id);
                    }
                });
            });
            document.querySelector(`[data-action="update"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                let updateModal = document.querySelector('#updateCategoryModal');
                updateModal.querySelector('[name="id"]').value = item.id;
                updateModal.querySelector('#edit-name').value = item.name;
                $('#updateCategoryModal').modal('show');
            });
        }

        getCategories().then(response => {
            response.categories.forEach((item) => {
                addTableRow(item, table);
            });
        });


        document.querySelector('[data-save-category]').addEventListener('click', () => {
            let name = document.querySelector('#addCategoryModal').querySelector('#name').value;
            addCategory(name);
        });
        document.querySelector('[data-update-category]').addEventListener('click', () => {
            let name = document.querySelector('#updateCategoryModal').querySelector('#edit-name').value;
            let id = document.querySelector('#updateCategoryModal').querySelector('[name="id"]').value;
            updateCategory(name, id);
        });
    })
</script>
@endsection