@extends('layout', ["page_title" => 'Popusti'])

@section('content')



<div class="row" style="height: 92%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Popusti</span>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#addMenuModal"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj popust</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Naziv</th>
                                <th>Popust %</th>
                                <th>Važi od</th>
                                <th>Važi do</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj novi popust</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="logoContainer text-left">

                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>

                    <div class="inputWrapper  m-2 ">
                        <label for="name">Naziv</label>
                        <input type="text" id="name" class="form-control" placeholder="Naziv">
                    </div>

                    <div class="inputWrapper  m-2 ">
                        <label for="discount">Visina popusta %</label>
                        <input type="number" min="1" id="discount" class="form-control" placeholder="popust">
                    </div>

                    <div class="inputWrapper  m-2 ">
                        <label for="date_from">Važi od</label>
                        <input type="text" id="date_from" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Važi od">
                    </div>

                    <div class="inputWrapper  m-2 ">
                        <label for="date_to">Važi do</label>
                        <input type="text" id="date_to" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Važi do">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                <button class="btn btn-success" type="button" data-save-menu>Sacuvaj</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateMenuModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Izmijeni Popust</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="logoContainer text-left">

                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>

                    <div class="inputWrapper  m-2 ">
                        <label for="name">Naziv</label>
                        <input type="text" id="name" class="form-control" placeholder="Naziv">
                        <input type="hidden" id="id" name="id" class="form-control">
                    </div>

                    <div class="inputWrapper  m-2 ">
                        <label for="discount">Visina popusta %</label>
                        <input type="number" min="1" id="discount" class="form-control" placeholder="popust">
                    </div>

                    <div class="inputWrapper  m-2 ">
                        <label for="date_from">Važi od</label>
                        <input type="text" id="date_from" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Važi od">
                    </div>

                    <div class="inputWrapper  m-2 ">
                        <label for="date_to">Važi do</label>
                        <input type="text" id="date_to" class="form-control datepicker" data-date-format="yyyy-mm-dd" placeholder="Važi do">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                <button class="btn btn-success" type="button" data-update-menu>Izmeni</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        $('.datepicker').datepicker();


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
                item.name,
                item.discount,
                item.date_from,
                item.date_to,
                `
                            <button class="btn btn-info" data-action="update" data-id="${item.id}" >Izmijeni</button>
                            <button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button>
                    `
            ]).draw(false).node();
            document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                window.Flex.Util.confirmModal({
                    title: `Obrisi meni ${item.name}?`,
                    content: "Da li ste sigurni da zelite da obrisete meni?",
                    data: item,
                    success: (data) => {
                        window.Flex.Component.Discounts.Store.Command.remove(item.id).then(() => {
                            table.row(rowNode).remove().draw();
                        });
                    }
                });
            });
            document.querySelector(`[data-action="update"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                let updateModal = document.querySelector('#updateMenuModal');
                updateModal.querySelector('[name="id"]').value = item.id;
                updateModal.querySelector('#name').value = item.name;
                updateModal.querySelector('#discount').value = item.discount;
                updateModal.querySelector('#date_from').value = item.date_from;
                updateModal.querySelector('#date_to').value = item.date_to;
                $('#updateMenuModal').modal('show');
            });
        }
        window.Flex.Component.Discounts.Store.Query.list().then((r) => {
            r.data.discounts.forEach((item) => {
                addTableRow(table, item);
            })
        })


        document.querySelector('[data-save-menu]').addEventListener('click', () => {
            let name = document.querySelector('#addMenuModal').querySelector('#name').value;
            let discount = document.querySelector('#addMenuModal').querySelector('#discount').value;
            let dateFrom = document.querySelector('#addMenuModal').querySelector('#date_from').value;
            let dateTo = document.querySelector('#addMenuModal').querySelector('#date_to').value;
            window.Flex.Component.Discounts.Store.Command.add({
                name: name,
                discount: discount,
                date_from: dateFrom,
                date_to: dateTo
            }).then((r) => {
                $('#addMenuModal').modal('hide');
                location.reload();
            }).catch((r) => {
                console.log(r);
                let errorDom = document.querySelector('#addMenuModal').querySelector('[data-error-msg]');
                window.Flex.Util.clearElement(errorDom);
                errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom čuvanja popusta. Provjerite sva polja!'));
            });
        });
        document.querySelector('[data-update-menu]').addEventListener('click', () => {
            let name = document.querySelector('#updateMenuModal').querySelector('#name').value;
            let discount = document.querySelector('#updateMenuModal').querySelector('#discount').value;
            let dateFrom = document.querySelector('#updateMenuModal').querySelector('#date_from').value;
            let dateTo = document.querySelector('#updateMenuModal').querySelector('#date_to').value;
            let id = document.querySelector('#updateMenuModal').querySelector('[name="id"]').value;
            window.Flex.Component.Discounts.Store.Command.update({
                name: name,
                discount: discount,
                date_from: dateFrom,
                date_to: dateTo,
                id: id
            }).then((r) => {
                location.reload();
            }).catch((r) => {
                console.log(r);
                let errorDom = document.querySelector('#updateMenuModal').querySelector('[data-error-msg]');
                window.Flex.Util.clearElement(errorDom);
                errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom izmjene popusta. Provjerite sva polja!'));
            });
        });
    })
</script>
@endsection