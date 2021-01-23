@extends('layout', ["page_title" => 'Istorija rezervacija'])

@section('content')


<div class="row" style="height: 92%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Lista rezervacija</span>
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
								<th>Status</th>
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
			let status = "";
			if(item.approved == 1){
				status = "Dozvoljena";
			}else{
				status = "Na čekanju";
			}
            let rowNode = table.row.add([
                item.id,
                item.name,
                item.title,
                item.date,
                item.period + " dana",
				status
             ]).draw(false).node();
          

        }


        getHistory({{auth()->user()->id}}).then(response => {
            response.reservations.forEach((item) => {
                addTableRow(item, table);
            });
        });

        

    })
</script>
@endsection