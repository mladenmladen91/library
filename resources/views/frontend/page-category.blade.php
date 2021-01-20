@extends('layout', ["page_title" => 'Stranica- kategorije'])

@section('content')


<div class="row" style="height: 93%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Lista Kategorija</span>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#addPageCatModal"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj Kategoriju</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:5%">ID</th>
                                <th>Naziv</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="addPageCatModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj novu kategoriju</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open() }}
                <div class="logoContainer text-left">

                </div>
                <div class="inputWrapper  m-2 text-danger" data-error-msg>
                </div>
                <div class="inputWrapper  m-2 ">
                    {{ Form::label('name', 'Naziv') }}
                    {{ Form::text('name', '', array('placeholder' => 'Naziv', 'class' => 'form-control')) }}
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                <button class="btn btn-success" type="button" data-save-page>Sacuvaj</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updatePageCatModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Izmeni kategoriju</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open() }}
                <div class="logoContainer text-left">

                </div>
                <div class="inputWrapper  m-2 text-danger" data-error-msg>
                </div>
                <div class="inputWrapper  m-2 ">
                    {{ Form::hidden('id') }}
                    {{ Form::label('name', 'Naziv') }}
                    {{ Form::text('name', '', array('placeholder' => 'Naziv', 'class' => 'form-control')) }}
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                <button class="btn btn-success" type="button" data-update-page>Izmeni</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let table = $('#dataTable').DataTable({
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

            let rowNode = table.row.add([
                item.id,
                item.name,
                `
                            <button class="btn btn-info" data-action="update" data-id="${item.id}" >Izmijeni</button>
                             <button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button>
                    `
            ]).draw(false).node();
            document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                window.Flex.Util.confirmModal({
                    title: `Obrisi kategoriju ${item.name}?`,
                    content: "Da li ste sigurni da zelite da obrisete kategoriju?",
                    data: item,
                    success: (data) => {
                        window.Flex.Component.PageCategory.Store.Command.remove(item.id).then(() => {
                            table.row(rowNode).remove().draw();
                        });
                    }
                });
            });
            document.querySelector(`[data-action="update"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                let updateModal = document.querySelector('#updatePageCatModal');
                updateModal.querySelector('[name="id"]').value = item.id;
                updateModal.querySelector('#name').value = item.name;
                $('#updatePageCatModal').modal('show');
            });
        }
        window.Flex.Component.PageCategory.Store.Query.list().then((r) => {
            r.data.categories.forEach((item) => {
                addTableRow(table, item);
            })

        })


        document.querySelector('[data-save-page]').addEventListener('click', () => {
            let name = document.querySelector('#addPageCatModal').querySelector('#name').value;
            window.Flex.Component.PageCategory.Store.Command.add({
                name: name,
            }).then((r) => {
                console.log(r);
                $('#addPageCatModal').modal('hide');
                addTableRow(table, r.data.data.categories);
            }).catch((r) => {
                let errorDom = document.querySelector('#addPageCatModal').querySelector('[data-error-msg]');
                window.Flex.Util.clearElement(errorDom);
                errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom cuvanja menija'));
            });
        });
        document.querySelector('[data-update-page]').addEventListener('click', () => {
            let name = document.querySelector('#updatePageCatModal').querySelector('#name').value;
            let id = document.querySelector('#updatePageCatModal').querySelector('[name="id"]').value;
            window.Flex.Component.PageCategory.Store.Command.update(id, name).then((r) => {
                location.reload();
            }).catch((r) => {
                console.log(r);
                let errorDom = document.querySelector('#updatePageCatModal').querySelector('[data-error-msg]');
                window.Flex.Util.clearElement(errorDom);
                errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom cuvanja menija'));
            });
        });
    })
</script>
@endsection