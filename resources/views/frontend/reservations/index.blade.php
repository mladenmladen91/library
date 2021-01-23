@extends('layout', ["page_title" => 'Rezervacije'])

@section('content')


<div class="row" style="height: 92%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Lista rezervacija</span>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj rezervaciju</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="main_table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ime korisnika</th>
                                <th>Ime knjige</th>
                                <th>Datum</th>
                                <th>Period izdavanja</th>
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

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj novu rezervaciju</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="create-form">
                    <div class="logoContainer text-left">

                    </div>
                    <div class="inputWrapper  m-2 ">
                        <label for="title">Period*</label>
                        <select class="form-control" name="period" id="period">
                            <option value="7">7 dana</option>
                            <option value="15">15 dana</option>
                            <option value="15">30 dana</option>
                        </select>
                    </div>
                    <div class="inputWrapper  m-2 ">
                        <label for="title">Korisnik*</label>
                        <select class="form-control" name="user_id" id="user_id"></select>
                    </div>
                    <div class="inputWrapper  m-2 ">
                        <label for="title">Knjiga*</label>
                        <select class="form-control" name="book_id" id="book_id"></select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                <button class="btn btn-success" type="button" data-save-reservation>Sačuvaj</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/js/standard.js"></script>
<script src="/js/reservation.js"></script>

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
            let activation = '';
            if (item.approved === 0) {
                activation = `<button class="btn btn-info" data-action="activate" data-id="${item.id}">Dozvoli</button>`;
            }
            let rowNode = table.row.add([
                item.id,
                item.name,
                item.title,
                item.date,
                item.period + " dana",
                activation +
                `<button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button></td></tr>
                        
                    `
            ]).draw(false).node();
            document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                window.Flex.Util.confirmModal({
                    title: `Obrisi rezervaciju?`,
                    content: "Da li ste sigurni da zelite da obrisete rezervaciju?",
                    data: item,
                    success: (data) => {
                        deleteReservation(item.id);
                    }
                });
            });
            if (item.approved === 0) {
                document.querySelector(`[data-action="activate"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                    activateReservation(item.id, item.book_id);
                });
            }

        }

        getUsersAndBooks().then(response => {
            let optionString = "";
            response.users.forEach((item) => {
                optionString += "<option value='" + item.id + "'>" + item.name + "</option>";
            });
            $("#user_id").html(optionString);

            let optionString2 = "";
            response.books.forEach((item) => {
                optionString2 += "<option value='" + item.id + "'>" + item.title + "</option>";
            });
            $("#book_id").html(optionString2);
        });

        getReservations(0).then(response => {
            response.reservations.forEach((item) => {
                addTableRow(item, table);
            });
        });

        //paginate table
        document.querySelector('#dataTable_previous').addEventListener("click", () => {
            let current_page = document.querySelector('#page_number');
            let current_value = parseInt(current_page.innerText);

            if (current_value - 1 > 0) {
                getReservations(current_value - 2).then(response => {
                    table.clear().draw();
                    response.reservations.forEach((item) => {
                        addTableRow(item, table);
                        document.querySelector('#page_number').innerText = current_value - 1;
                    });

                });
            }
        });

        document.querySelector('#dataTable_next').addEventListener("click", () => {
            let current_page = document.querySelector('#page_number');
            let current_value = parseInt(current_page.innerText);

            getReservations(current_value).then(response => {
                table.clear().draw();
                response.reservations.forEach((item) => {
                    addTableRow(item, table);
                });

                document.querySelector('#page_number').innerText = current_value + 1;

            })

        });


        document.querySelector('[data-save-reservation]').addEventListener('click', () => {
            addReservation($("#create-form")[0]);
        });

    })
</script>
@endsection