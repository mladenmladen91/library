@extends('layout', ["page_title" => 'Proizvod-izmjena'])

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Proizvodi</h1>
        </div>

    </div>
    <!-- /.container-fluid -->
<ul class="nav  nav-tabs">
    <li class="active nav-item"><a class="active nav-link" data-toggle="tab" href="#change">Sadržaj</a></li>
    <li class="nav-item" ><a class="nav-link" data-toggle="tab" href="#gallery">Galerija</a></li>		 
   </ul>
    <div class="row justify-content-center">
	<div class="tab-content col-12">	
        <div id="change" class="col-lg-12 col-12 p-4 tab-pane in active">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Izmijeni proizvod</h6>
                </div>
                <div class="card-body">
                   <form>
                    <div class="logoContainer text-left">
                        
                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
                   <div class="row">
					    <div class="col-6">
						  <div class="m-2">
						<label for="title">Naziv</label>
						<input class="form-control" type="text" id="name" placeholder="Naziv">
                           </div>  
						</div>
						<div class="col-6">
						     <div class="m-2">
						       <label for="slug">Slug</label>
						       <input class="form-control" type="text" id="slug" placeholder="Slug">
					         </div>
						 </div>
						  
						  <div class="col-6">
						     <div class="inputWrapper  m-2 ">
						 <label for="price">Cijena €</label>
						<input class="form-control" type="text" id="price" placeholder="cijena">
					</div> 
						 </div>
						  
						  <div class="col-6">
						     <div class="inputWrapper  m-2 ">
						 <label for="product_code">Šifra</label>
						<input class="form-control" type="text" id="product_code" placeholder="šifra">
					</div>
						  </div>	  
					<div class="col-6">
						     <div class="inputWrapper  m-2 ">
						 <label for="color">Boja</label>
						<input class="form-control" type="text" id="color" placeholder="Boja">
					</div> 		  
							  
						 </div>
							  
					<div class="col-6">		  
				<div class="inputWrapper  m-2 ">
						<label for="unit">Jedinica</label>
						 <select class="form-control" id="unit">
							 <option value="0" selected>Komad</option>
							 <option value="1">Kg</option>
			             </select>
					</div> 
					  
					   </div>
						  
					<div class="col-6">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Kategorija</label>
						 <select class="form-control" data-category-select id="category_id">
			             </select>
					</div> 
					  
					   </div>	  
						  
					<div class="col-6">
						<div class="inputWrapper  m-2 ">
						<label for="discount_id">Popust</label>
						<select class="form-control" id="discount_id">
						   <option value="0">Bez popusta</option>	
						 @foreach($discounts as $discount)	
						   <option value="{{$discount->id}}">{{$discount->name}}</option>
						 @endforeach	
						</select>
					</div>
				
					   </div>	  
					<div class="col-6">
					   <div class="inputWrapper  m-2 ">
						 <label for="special_offer">Specijalna ponuda</label>
						 <input type="checkbox" id="special_offer">
					</div>
					 </div>	
					     
						  
					   </div>
					  <div class="inputWrapper  m-2 ">
						 <label for="description">Opis</label>
						<textarea class="form-control" id="description" placeholder="opis"></textarea>
					</div> 
					   
					   
					<div class="col-3">   
					<div class="mb-2"><label >Veličine <span id="add_size" style="color:blue;cursor:pointer">Dodaj+</span></label></div>
					<div class="sizes_holder"> 
				@foreach($stocks as $stock)		
					<div class="inputWrapper size_container">
						<input  type="text" class="form-control size_name mb-2" value="{{$stock->size}}" placeholder="veličina">
						<input type="number" min="0" class="form-control size_amount" value="{{$stock->amount}}"  placeholder="količina">
					</div>
				@endforeach		
				    </div> 		
					   </div>   
					
					<div class="inputWrapper  m-2 ">   
					  <button class="btn btn-success" type="button" data-update-page>Ažuriraj proizvod</button>
					  <a href="{{route('admin.product')}}" class="btn btn-info" style="color:white">Odustani od izmjena</a>	
					 </div>		
                    </form>
                </div>
            </div>
        </div>
		
		<div id="gallery" class="tab-pane fade" >
		     <div class="row">
		<div class="col-12 m-2 p-4">
            
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#addImageModal"><i
                    class="fas fa-plus fa-sm text-white-50" ></i> Dodaj fotografiju</a>
        </div>		 
        <div class="col-lg-12 p-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista Fotografija</h6>
                </div>
                <div class="card-body">
					<div class="row" id="row">
					 
					</div>
                </div>
            </div>
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
                        <input id="image-file" type="file" name="images[]" multiple>
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
			
		
		
        document.addEventListener('DOMContentLoaded', () => {
			
// sorting images		
function updateToDatabase(idArray){
	    let categories = [];
	    for(let i = 0;i < idArray.length; i++){
			let category = {
				"id": idArray[i]
			};
			categories.push(category);
		}
	    
	    window.Flex.Component.Product.Store.Command.sortImages(categories).then((r) => {
					console.log(r);
          }).catch((r) => {
                    alert('error');
           });
    	
    	}
 var target =  $("#row");   
target.sortable({
  items: "div.col-3",
  update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData);
            }
        
        
    });				
			
            
           // function for slugifying titles		
	function slugify(string) {
  const a = 'àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;'
  const b = 'aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------'
  const p = new RegExp(a.split('').join('|'), 'g')

  return string.toString().toLowerCase()
    .replace(/\s+/g, '-') // Replace spaces with -
    .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
    .replace(/&/g, '-and-') // Replace & with 'and'
    .replace(/[^\w\-]+/g, '') // Remove all non-word characters
    .replace(/\-\-+/g, '-') // Replace multiple - with single -
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, '') // Trim - from end of text
}

// function for listing categories tree 
function children(item, selectDOM){
	let optionDOM = document.createElement("option");
	
	if(item.id=={{$category_id}}){
		optionDOM.setAttribute("selected",true);
	}
	
	optionDOM.value = item.id;
	//optionDOM.appendChild(document.createTextNode(item.name));
	let plus = "";
	if(item.children.length > 0){
		plus = " +";
	}
	if(item.parent_id > 0){
		optionDOM.appendChild(document.createTextNode("-"+item.name+plus));
	}else{
		optionDOM.appendChild(document.createTextNode(item.name+plus));
	}
	selectDOM.appendChild(optionDOM);
	if(item.children.length > 0){
		item.children.forEach((item)=>{
			        children(item, selectDOM);
				});
	}
}	
			
			

// slugifying titles		
$('#name').on('input', function() {
	let slug = slugify($(this).val());
	$("#slug").val(slug);
});
			
//removing sizes
$(".size_container span").click(function(){
	$(this).closest(".size_container").remove();
});			
		
// adding sizes
$("#add_size").click(function(){
	$(".sizes_holder").append('<div class="inputWrapper m-2 size_container"><input  type="text" class="form-control size_name mb-2" placeholder="veličina"><input type="number" min="1" class="form-control size_amount"  placeholder="količina"></div>');
});	
			
			
			// listing categories
			window.Flex.Component.Product.Store.Query.listCategory().then((r)=>{
				
				let categorySelectorDOM = document.querySelector('[data-category-select]');
				r.data.categories.forEach((item)=>{
					children(item, categorySelectorDOM);
				});
				
				
				/*categorySelectorDOM.options[0].setAttribute('selected', true);
		        selectCat = categorySelectorDOM.options[0].value;*/
				
				
				
			})
			
            
            
		     
			// getting data from product_id
			window.Flex.Component.Product.Store.Query.getProduct({{$id}}).then((r)=>{
				
				 let rowDOM = document.querySelector('#row');
			   r.data.images.forEach((item) => {
               let divDOM = document.createElement("div");
	            divDOM.className += "col-3";
	            divDOM.style.position = 'relative';
				divDOM.style.marginBottom = '30px';   
				divDOM.setAttribute("data-id", item.id);   
				let imageDOM = document.createElement("img"); 
				imageDOM.setAttribute("src", "/"+item.image);
				imageDOM.setAttribute("width", "100%"); 
				imageDOM.setAttribute("height", "auto");    
				 divDOM.appendChild(imageDOM);
				 rowDOM.appendChild(divDOM); 
				   
				 let xButtonDOM = document.createElement('span');
				  xButtonDOM.style.position = 'absolute'; 
				  xButtonDOM.style.top = '20px'; 
				  xButtonDOM.style.right = '40px';  
				  xButtonDOM.style.color = 'red';
				  xButtonDOM.style.cursor = 'pointer'; 
				  xButtonDOM.style.fontSize = '20px';
				  xButtonDOM.style.fontWeight = 'bold'; 
				  xButtonDOM.style.zIndex = '100';
				  xButtonDOM.innerText = 'X'; 
				  divDOM.appendChild(xButtonDOM); 
				  // removing image on x click 
				  xButtonDOM.addEventListener('click', (i,j) => {
					    window.Flex.Component.Product.Store.Command.removeImage(item.id, item.image).then(() => {
                                xButtonDOM.closest(".col-3").remove();
                            });
                    });
                });
				
				document.querySelector('#name').value = r.data.product.name;
                let slug = document.querySelector('#slug').value = r.data.product.slug;
				/*$("#category_id option").each(function(){
						if($(this).val() == r.data.product.category_id){
							$(this).attr("selected","selected");
						}
				});*/
				document.querySelector('#price').value= r.data.product.price;
				document.querySelector('#color').value = r.data.product.color;
				document.querySelector('#product_code').value = r.data.product.product_code;
				document.querySelector('#description').value= r.data.product.description;
				document.querySelector('#unit').value;
				$("#unit option").each(function(){
						if($(this).val() == r.data.product.unit){
							$(this).attr("selected","selected");
						}
				});
				$("#discount_id option").each(function(){
						if($(this).val() == r.data.product.discount_id){
							$(this).attr("selected","selected");
						}
				});
				
				if(r.data.product.special_offer === 1){
					document.querySelector('#special_offer').checked = true;
				}
				
			});
			
			

              document.querySelector('[data-update-page]').addEventListener('click', () => {
                let name = document.querySelector('#name').value;
                let slug = document.querySelector('#slug').value;
				let categoryId = document.querySelector('#category_id').value;
				let price = document.querySelector('#price').value;
				let color = document.querySelector('#color').value;
				let productCode = document.querySelector('#product_code').value;
				let description = document.querySelector('#description').value;
				let unit = document.querySelector('#unit').value;
				let discountId = document.querySelector('#discount_id').value;
				let specialOffer = (document.querySelector('#special_offer').checked == true) ? 1:0;
				console.log(slug+"-"+unit);
				let selected = [];
				$(".size_container").each(function(){
					let size = $(this).find(".size_name").val();
					let amount = $(this).find(".size_amount").val();
					
					if(size.trim() != "" && amount.trim != ""){
						let sizeObj = {
						   size: size,
						   amount: amount	
						};
						selected.push(sizeObj);
					}
				});



				if(name === ""){
					alert('Popunite potrebne podatke!');
				}else{
			

               window.Flex.Component.Product.Store.Command.update({
                    name: name,
                    slug: slug,
				    price: price,
					category_id: categoryId,
					description: description,
				    product_code: productCode,
				    color: color,
				    unit: unit,
				    discount_id: discountId,
				    sizes: JSON.stringify(selected),
				    special_offer : specialOffer,
				    product_id: {{$id}}
                }).then((r) => {
				   alert("Uspješno sačuvano!");	
                }).catch((r) => {
                    alert("Greška u čuvanju!");
                });
					
				} 
            });
			
			
			//adding image
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