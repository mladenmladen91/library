@extends('layout', ["page_title" => 'Porudžbine'])

@section('content')



<div class="row" style="height: 93%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista porudžbina</h6>
            </div>
           
			<div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                             <tr>
                                <th>ID</th>
                                <th>Ime</th>
                                <th>Vid plaćanja</th>
                                <th>Datum</th>
                                <th>Total</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>

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
            let totalAmount = 0;
            item.items.forEach((stavka) => {
                totalAmount += (stavka.total - (stavka.total * (stavka.discount / 100)));
            });



            /*let tableBody = document.querySelector("#main_table tbody");

            tableBody.innerHTML += `<tr data-tr="${item.id}"><td>` + item.name + "<br>" + item.email + "<br>" + item.phone + `</td><td>` + item.address + "<br>" + item.city + `</td><td>${item.payment_type}</td><td>${item.updated_at}</td><td>` + totalAmount.toFixed(2) + "€" + `</td><td><a class="btn btn-info" href="/admin/orders/details/` + item.id + `">Detalji</a><button style="margin-left:10px" class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button></td></tr>`;*/
			
			let rowNode = table.row.add([
                item.name + "<br>" + item.email + "<br>" + item.phone + `</td><td>` + item.address + "<br>" + item.city,
                item.address + "<br>" + item.city,
                item.payment_type,
                item.updated_at,
			     totalAmount.toFixed(2) + "€",
                `
                            <a class="btn btn-info" href="/admin/orders/details/` + item.id + `">Detalji</a><button style="margin-left:10px" class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button>
                    `
            ]).draw(false).node();

            document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                window.Flex.Util.confirmModal({
                    title: `Obrisi porudžbinu?`,
                    content: "Da li ste sigurni da zelite da obrišete porudžbinu?",
                    data: item,
                    success: (data) => {
                        window.Flex.Component.Order.Store.Command.remove(item.id).then(() => {
                            table.row(rowNode).remove().draw();
                        });
                    }
                });
            });
        }
		
		

        //getting data
        window.Flex.Component.Order.Store.Query.list(0).then((r) => {
            r.data.orders.forEach((item) => {
                addTableRow(table, item);
            })

        })

        //paginate table
        document.querySelector('#dataTable_previous').addEventListener("click", () => {
            let current_page = document.querySelector('#page_number');
            let current_value = parseInt(current_page.innerText);
            if (current_value - 1 > 0) {

                window.Flex.Component.Order.Store.Query.list((current_value - 2) * 20).then((r) => {
                    table.clear().draw();

                    r.data.orders.forEach((item) => {
                        addTableRow(table, item);
                    })

                    document.querySelector('#page_number').innerText = current_value - 1;


                })

            }
        });

        document.querySelector('#dataTable_next').addEventListener("click", () => {
            let current_page = document.querySelector('#page_number');
            let current_value = parseInt(current_page.innerText);
    
            window.Flex.Component.Order.Store.Query.list(current_value * 20).then((r) => {
                table.clear().draw();
                r.data.orders.forEach((item) => {
                    addTableRow(table, item);
                })

                document.querySelector('#page_number').innerText = current_value + 1;


            })

        });


    })
</script>
@endsection