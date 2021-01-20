@extends('layout', ["page_title" => 'Meniji'])

@section('content')


<div class="row" style="height: 92%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
            <div class="card-header py-3">
                <span class="m-0 font-weight-bold text-primary">Lista Menija</span>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#addMenuModal"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj Meni</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="main_table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Naziv</th>
                                <th>Kategorija</th>
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

<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodaj novi meni</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open() }}
                <div class="logoContainer text-left">
                    <p class="lead">
                        Meniji se pozicioniraju na strani u zavisnosti od kategorije.
                        Naziv menija sluzi kako bi lakse prepoznali meni koji dodajemo.
                    </p>
                </div>
                <div class="inputWrapper  m-2 text-danger" data-error-msg>
                </div>
                <div class="inputWrapper  m-2 ">
                    {{ Form::label('name', 'Naziv') }}
                    {{ Form::text('name', '', array('placeholder' => 'Naziv', 'class' => 'form-control')) }}
                </div>
                <div class="inputWrapper  m-2">
                    {{ Form::label('position', 'Kategorija') }}
                    {{ Form::select('position', [
                            0 => "Glavni Meni",
                            1 => "Meni na vrhu",
                            2 => "Lijevi meni",
                            3 => "Desni Meni",
                            4 => "Meni u podnožju - Lijevo",
                            5 => "Meni u podnožju - Desno"
                        ], 0, ['class' => "form-control"]) }}
                </div>
                {{ Form::close() }}
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
                <h5 class="modal-title" id="exampleModalLabel">Izmeni meni</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open() }}
                <div class="logoContainer text-left">
                    <p class="lead">
                        Meniji se pozicioniraju na strani u zavisnosti od kategorije.
                        Naziv menija sluzi kako bi lakse prepoznali meni koji dodajemo.
                        Promena pozicije menija utice na izgled same stranice!
                    </p>
                </div>
                <div class="inputWrapper  m-2 text-danger" data-error-msg>
                </div>
                <div class="inputWrapper  m-2 ">
                    {{ Form::hidden('id') }}
                    {{ Form::label('name', 'Naziv') }}
                    {{ Form::text('name', '', array('placeholder' => 'Naziv', 'class' => 'form-control')) }}
                </div>
                <div class="inputWrapper  m-2">
                    {{ Form::label('position', 'Kategorija') }}
                    {{ Form::select('position', [
                            0 => "Glavni Meni",
                            1 => "Meni na vrhu",
                            2 => "Lijevi meni",
                            3 => "Desni Meni",
                            4 => "Meni u podnožju - Lijevo",
                            5 => "Meni u podnožju - Desno"
                        ], 0, ['class' => "form-control"]) }}
                </div>
                {{ Form::close() }}
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



<script>
    document.addEventListener('DOMContentLoaded', () => {


        function addTableRow(item) {
            let tableBody = document.querySelector("#main_table tbody");

            let position = 'ne definisana';
            switch (parseInt(item.position)) {
                case 0:
                    position = "Glavni Meni";
                    break;
                case 1:
                    position = "Meni na vrhu";
                    break;
                case 2:
                    position = "Lijevi meni";
                    break;
                case 3:
                    position = "Desni Meni";
                    break;
                case 4:
                    position = "Meni u podnožju - Lijevo";
                    break;
                case 5:
                    position = "Meni u podnožju - Desno";
                    break;
            }

            tableBody.innerHTML += `<tr data-tr="${item.id}"><td>${item.name}</td><td>${position}</td><td><a class="btn btn-info" href="/admin/menu/items/${item.id}" >Stavke menija</a>
                            <button class="btn btn-info" data-action="update" data-id="${item.id}" >Izmijeni</button>
                            <button class="btn btn-danger" data-action="remove" data-id="${item.id}">Obriši</button></td></tr>
                        
                    `

            document.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                window.Flex.Util.confirmModal({
                    title: `Obrisi meni ${item.name}?`,
                    content: "Da li ste sigurni da zelite da obrisete meni?",
                    data: item,
                    success: (data) => {
                        window.Flex.Component.Menu.Store.Command.remove(item.id).then(() => {
                            document.querySelector(`[data-tr="${item.id}"]`).remove();
                        });
                    }
                });
            });
            document.querySelector(`[data-action="update"][data-id="${item.id}"]`).addEventListener('click', (i, j) => {
                let updateModal = document.querySelector('#updateMenuModal');
                updateModal.querySelector('[name="id"]').value = item.id;
                updateModal.querySelector('#name').value = item.name;
                updateModal.querySelector('#position').value = item.position;
                $('#updateMenuModal').modal('show');
            });
        }
        window.Flex.Component.Menu.Store.Query.list().then((r) => {
            r.data.menus.forEach((item) => {
                addTableRow(item);
            })
        })


        document.querySelector('[data-save-menu]').addEventListener('click', () => {
            let name = document.querySelector('#addMenuModal').querySelector('#name').value;
            let position = document.querySelector('#addMenuModal').querySelector('#position').value;
            window.Flex.Component.Menu.Store.Command.add({
                name: name,
                position: position
            }).then((r) => {
                $('#addMenuModal').modal('hide');
                addTableRow(r.data.data.item);
            }).catch((r) => {
                let errorDom = document.querySelector('#addMenuModal').querySelector('[data-error-msg]');
                window.Flex.Util.clearElement(errorDom);
                errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom cuvanja menija'));
            });
        });
        document.querySelector('[data-update-menu]').addEventListener('click', () => {
            let name = document.querySelector('#updateMenuModal').querySelector('#name').value;
            let position = document.querySelector('#updateMenuModal').querySelector('#position').value;
            let id = document.querySelector('#updateMenuModal').querySelector('[name="id"]').value;
            window.Flex.Component.Menu.Store.Command.update(id, name, position).then((r) => {

                location.reload();
            }).catch((r) => {
                let errorDom = document.querySelector('#updateMenuModal').querySelector('[data-error-msg]');
                window.Flex.Util.clearElement(errorDom);
                errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom cuvanja menija'));
            });
        });
    })
</script>
@endsection