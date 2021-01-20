@extends('layout', ["page_title" => 'Proizvodi-dodavanje fotografija'])

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Fotografije</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addImageModal"><i
                    class="fas fa-plus fa-sm text-white-50" ></i> Dodaj fotografiju</a>
        </div>

    </div>
    <!-- /.container-fluid -->

    <div class="row">
        <div class="col-lg-12 p-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista Fotografija</h6>
                </div>
                <div class="card-body">
					<div class="row" id="row">
					  <div data-id="1" class="col-3">test1</div>
						<div data-id="2" class="col-3">test2</div>
						<div data-id="3" class="col-3">test3</div>
						<div data-id="4" class="col-3">test4</div>
						<div data-id="5" class="col-3">test5</div>
					</div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
							 	
                            <tr>
								
								<th>Redni broj</th>
								<th>Fotografija</th>
								<th>ID</th>
								<th>Akcije</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
								<th>Redni broj</th>
								<th>Fotografija</th>
								<th>ID</th>
								<th>Akcije</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dodaj novu fotografiju</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="image-form" action="" method="post" name="addImagesToPAges" enctype="multipart/form-data">
                    <div class="logoContainer text-left">
                        
                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
                    <div class="inputWrapper  m-2 ">
                        <label for="image-file">Fajl</label>
						<input id="image-id" type="hidden" name="product_id" value="{{$id}}">
                        <input id="image-file" type="file" name="images[]">
                    </div>
				
                    
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                    <button class="btn btn-success" type="button" data-save-image>Sacuvaj</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
		

	
// sorting categories			
function updateToDatabase(idArray){
	    let categories = [];
	    for(let i = 0;i < idArray.length; i++){
			let category = {
				"id": idArray[i]
			};
			categories.push(category);
		}
	    
    	console.log(categories);
    	}
 var target =  $("#row");   
target.sortable({
  items: "div.col-3",
  update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData);
            }
        
        
    });	

        document.addEventListener('DOMContentLoaded', () => {
            let table = $('#dataTable').DataTable({
				rowReorder: true,
				order: [0,"asc"]
			});
	 // function for sorting and extracting id
	  table.on( 'row-reorder', function ( e, diff, edit ) {
		let imageArray = [];   
        for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
            var rowData = table.row( diff[i].node ).data();
			let image_id = parseInt(rowData[2]);
			let imageMember = {
				"id": image_id
			};
			imageArray.push(imageMember);
        }
		  window.Flex.Component.Product.Store.Command.sortImages(imageArray).then((r) => {
					console.log(r);
          }).catch((r) => {
                    alert('error');
           }); 
		   
          
    } );
			
			// listing images
            window.Flex.Component.Product.Store.Query.imageList({{$id}}).then((r) => {
				r.data.products.forEach((item) => {
                    addTableRow(table, item);
                }) 
			 }) 
			
			
            function addTableRow(table, item) {
                
			
                
                let rowNode = table.row.add([
					`${item.order_number}`,
                    `<img style="height: 60px;width:auto" src="/${item.image}" />`,
					`${item.id}`,
                    `
                            <button class="btn btn-danger" data-action="remove" data-id="${item.id}" >Obriši</button>
                    `
                ]).draw(false).node();
				// removing images
               rowNode.querySelector(`[data-action="remove"][data-id="${item.id}"]`).addEventListener('click', (i,j) => {
					console.log("test");
                    window.Flex.Util.confirmModal({
                        title: `Obrisi stranicu ${item.image}?`,
                        content: "Da li ste sigurni da zelite da obrisete fotografiju?",
                        data: item,
                        success: (data) => {
                            window.Flex.Component.Product.Store.Command.removeImage(item.id, item.image).then(() => {
                                table.row(rowNode).remove().draw();
                            });
                        }
                    });
                }); 
               
            }
			
		
			
			
			 

         //adding images
            document.querySelector('[data-save-image]').addEventListener('click', () => {
                window.Flex.Component.Product.Store.Command.addImage($("#image-form")[0]).then((r) => {
					location.reload();
				}).catch((r) => {
                    let errorDom = document.querySelector('#addImageModal').querySelector('[data-error-msg]');
                    window.Flex.Util.clearElement(errorDom);
                    errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom čuvanja fotografije'));
                });
            });
          
        })
    </script>
@endsection