@extends('layout', ["page_title" => 'Stranice'])

@section('content')



<div class="row" style="height: 95%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Lista stranica</span>
                <a href="{{route('admin.page.add')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj stranicu</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Naziv</th>
                                <th style="width:10%">Kategorija</th>
                                <th>Stranica ažurirana</th>
                                <th>Opis</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>

                    </table>
                </div>
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
                item.title,
                item.category_id,
                item.updated_at,
                item.description,
                `
                            <a href="/admin/page/edit/` + item.id + `" class="btn btn-info" data-action="update" data-id="${item.id}" >Izmijeni</a>
                             <button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button>
                    `
            ]).draw(false).node();
            document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                window.Flex.Util.confirmModal({
                    title: `Obrisi stranicu ${item.title}?`,
                    content: "Da li ste sigurni da zelite da obrisete stranicu?",
                    data: item,
                    success: (data) => {
                        window.Flex.Component.Page.Store.Command.remove(item.id).then(() => {
                            table.row(rowNode).remove().draw();
                        });
                    }
                });
            });

        }
        window.Flex.Component.Page.Store.Query.list().then((r) => {
            r.data.pages.forEach((item) => {
                addTableRow(table, item);
            })

        })




    })
</script>
@endsection