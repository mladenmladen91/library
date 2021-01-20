@extends('layout', ["page_title" => 'Porudžbina-detalji'])

@section('content')


 <div class="row" style="height: 93%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Poručeni proizvodi</h6>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <ul>
                        <li>Ime: <span id="name"></span></li>
                        <li>Email: <span id="email"></span></li>
                        <li>Telefon: <span id="phone"></span></li>
                        <li>Adresa: <span id="address"></span></li>
                        <li>Grad: <span id="city"></span></li>
                        <li>Tip: <span id="type"></span></li>
                        <li>Vid plaćanja: <span id="payment_type"></span></li>
                        <li>Napomena: <span id="note"></span></li>
                        <li>Naziv kompanije: <span id="company_name"></span></li>
                        <li>PIB: <span id="pib"></span></li>
                        <li>PDV: <span id="pdv"></span></li>
                        <li>Ukupna cijena porudžbine: <span id="totalAmount"></span></li>
                    </ul>
                </div>
                <div class="table-responsive">
                    <table class="table" id="main_table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Naziv</th>
                                <th>Količina</th>
                                <th>Šifra</th>
                                <th>Cijena</th>
                                <th>Total</th>
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



<script>
    document.addEventListener('DOMContentLoaded', () => {


        let totalAmount = 0;

        function addTableRow(item) {
			
			let tableBody = document.querySelector("#main_table tbody");

            tableBody.innerHTML += `<tr data-tr="${item.id}"><td>${item.name}</td><td>${item.amount}</td><td>${item.product_code}</td><td>`+(item.price - (item.price * (item.discount / 100))).toFixed(2)+`</td><td>` + (item.total - (item.total * (item.discount / 100))).toFixed(2) + `</td></tr>`;

        }

        //getting data
        window.Flex.Component.Order.Store.Query.getOrder({{$id}}).then((r) => {
            console.log(r.data.order.items);
            document.querySelector('#name').innerText = r.data.order.name;
            document.querySelector('#email').innerText = r.data.order.email;
            document.querySelector('#phone').innerText = r.data.order.phone;
            document.querySelector('#address').innerText = r.data.order.address;
            document.querySelector('#city').innerText = r.data.order.city;
            document.querySelector('#type').innerText = r.data.order.type;
            document.querySelector('#payment_type').innerText = r.data.order.payment_type;
            document.querySelector('#note').innerText = r.data.order.note;
            document.querySelector('#company_name').innerText = r.data.order.company_name;
            document.querySelector('#pib').innerText = r.data.order.pib;
            document.querySelector('#pdv').innerText = r.data.order.pdv;

            r.data.order.items.forEach((item) => {
                totalAmount += (item.total - (item.total * (item.discount / 100)));
                addTableRow(item);
            })
            document.querySelector('#totalAmount').innerText = totalAmount.toFixed(2) + "€";
        })




    })
</script>
@endsection