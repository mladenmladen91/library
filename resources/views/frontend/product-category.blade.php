@extends('layout', ["page_title" => 'Proizvodi-kategorije'])

@section('content')



 <div class="row" style="height: 92%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
			
                <div class="card-header py-3">
                    <div class="row">
					<div class="col-2"><select class="form-control" id="product_category_select">
						  <option value="">Odaberi kategorije</option>
						@foreach($categories as $category)
						   <option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
						</select></div>
					<div class="col-4"><a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPageModal"><i
                    class="fas fa-plus fa-sm text-white-50" ></i> Dodaj kategoriju</a>
					</div>
				</div>
                </div>
                <div class="card-body" id="data-holder">
			
                 
					
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addPageModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dodaj novu kategoriju</h5>
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
						<input class="form-control" type="text" id="name" placeholder="Naziv">
						<input type="hidden" name="id" id="id">
                     </div>
					 <div class="inputWrapper  m-2 ">
						 <label for="slug">Slug</label>
						<input class="form-control" type="text" id="slug" placeholder="Slug">
						 <input id="language_id" type="hidden" value="1">
                    </div>
						
					<div class="inputWrapper  m-2 ">
						<label for="category_id">Roditeljska kategorija</label>
						<select class="form-control" id="parent_id" data-category-select>
						    <option value="">-----</option>
						</select>
					</div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                    <button class="btn btn-success" type="button" data-save-category>Sacuvaj</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updatePageModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Izmeni kategoriju</h5>
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
						<input class="form-control" type="text" id="name2" placeholder="Naziv">
						<input type="hidden" name="id" id="id">
                     </div>
					 <div class="inputWrapper  m-2 ">
						 <label for="slug">Slug</label>
						<input class="form-control" type="text" id="slug2" placeholder="Slug">
						
                    </div>
						
					<div class="inputWrapper  m-2 ">
						<label for="discount_id">Popust</label>
						<select class="form-control" id="discount_id">
						   <option value="0">Bez popusta</option>	
						 @foreach($discounts as $discount)	
						   <option value="{{$discount->id}}">{{$discount->name}}</option>
						 @endforeach	
						</select>
					</div>	
						
					<div class="inputWrapper  m-2 ">
						<label for="category_id">Roditeljska kategorija</label>
						<select class="form-control" id="parent_id2" data-category-select>
						    <option value="">-----</option>
						</select>
					</div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                    <button class="btn btn-success" type="button" data-update-category>Izmeni</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
		
document.addEventListener('DOMContentLoaded', () => {
// function for slugifying names
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
		
$('#name').on('input', function() {
	let slug = slugify($(this).val());
	$("#slug").val(slug);
});
	
$('#name2').on('input', function() {
	let slug = slugify($(this).val());
	$("#slug2").val(slug);
});	
		
			
// sorting categories			
function updateToDatabase(idArray){
	    let categories = [];
	    for(let i = 0;i < idArray.length; i++){
			let category = {
				"id": idArray[i]
			};
			categories.push(category);
		}
	    
    	 window.Flex.Component.ProductCategory.Store.Command.sortCategories(categories).then((r) => {
					
          }).catch((r) => {
                    alert('error');
           });
    	}
 var target =  $(".card-body");   
target.sortable({
  items: "div.tester",
  update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData)
            }
        
        
    });				
			
		// function for listing categories tree 
function children(item, selectDOM){
	let optionDOM = document.createElement("option");
	optionDOM.value = item.id;
	let plus = "";
	if (item.children) {
	if(item.children.length > 0){
		plus = " +";
	}
	}
	if(item.parent_id > 0){
		optionDOM.appendChild(document.createTextNode("-"+item.name+plus));
	}else{
		optionDOM.appendChild(document.createTextNode(item.name+plus));
	}
	selectDOM.appendChild(optionDOM);
	if (item.children) {
	if(item.children.length > 0){
		item.children.forEach((item)=>{
			        children(item, selectDOM);
				});
	}
	}
}
			
// listing elements in the main table			
function children2(item, tableDOM, parentDOM = null){
	
	
	let divDOM = document.createElement("div");
	divDOM.className += "tester mb-4";
	divDOM.setAttribute("data-id", item.id);
	
	// creating column name and dropdown
	let aDOM = document.createElement("a");
	aDOM.className += "mr-4";
	aDOM.setAttribute("data-toggle", "collapse");
	aDOM.setAttribute("href", "#multiCollapseExample"+item.id);
	aDOM.setAttribute("role", "button");
	aDOM.setAttribute("aria-expanded", "false");
	aDOM.setAttribute("aria-controls", "#multiCollapseExample"+item.id);
	aDOM.style.color = "#434343";
	aDOM.style.textDecoration = "none";
	aDOM.style.linHeight = "1.7";
	aDOM.style.fontWeight = "400";
	
	aDOM.innerHTML= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15" class="fill mr-10"><path d="m464.883 64.267h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z"></path><path d="m464.883 208.867h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z"></path><path d="m464.883 353.467h-417.766c-25.98 0-47.117 21.137-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.012-21.137-47.149-47.117-47.149z"></path></svg>'+" "+item.name;
	
	divDOM.appendChild(aDOM);
	
	// creating delete button
	let cDOM = document.createElement("button");
	cDOM.className += "btn btn-danger float-right";
	cDOM.setAttribute("data-action", "remove");
	cDOM.setAttribute("data-id", item.id);
	cDOM.appendChild(document.createTextNode("Obriši"));
	cDOM.addEventListener('click', (i,j) => {
                    window.Flex.Util.confirmModal({
                        title: `Obriši kategoriju ${item.name}?`,
                        content: "Da li ste sigurni da zelite da obrisete kategoriju?",
                        data: item,
                        success: (data) => {
                            window.Flex.Component.ProductCategory.Store.Command.remove(item.id).then(() => {
                                location.reload();
                            });
                        }
                    });
                });
	divDOM.appendChild(cDOM);
	
	// creating change button
	let dDOM = document.createElement("button");
	dDOM.className += "btn btn-info float-right mr-2";
	dDOM.setAttribute("data-action", "update");
	dDOM.setAttribute("data-id", item.id);
	dDOM.appendChild(document.createTextNode("Izmijeni"));
	dDOM.addEventListener('click', (i,j) => {
                    let updateModal = document.querySelector('#updatePageModal');
                    updateModal.querySelector('[name="id"]').value = item.id;
                    updateModal.querySelector('#name2').value = item.name;
					updateModal.querySelector('#slug2').value = item.slug;
					$("#updatePageModal #parent_id2 option").each(function(){
						if($(this).val() == item.parent_id){
							$(this).attr("selected","selected");
						}
					});
		      
		            $("#updatePageModal #discount_id option").each(function(){
						if($(this).val() == item.discount_id){
							$(this).attr("selected","selected");
						}
					});
		       
                    $('#updatePageModal').modal('show');
                });
	divDOM.appendChild(dDOM);
	
   /* if(parentDOM != null){
	   parentDOM.appendChild(divDOM);
	}else{ */
	   tableDOM.appendChild(divDOM);
	/*}
	
	
	
	if(item.children.length > 0){
		let collapseDOM = document.createElement("div");
	    collapseDOM.className += "multi-collapse";
		collapseDOM.setAttribute("id", "multiCollapseExample"+item.id); 
		style="padding-left:30px;margin-top:20px"
		collapseDOM.style.paddingLeft = '30px';
		collapseDOM.style.marginTop = '20px';
		divDOM.appendChild(collapseDOM);
		item.children.forEach((item)=>{
			        children2(item, tableDOM, collapseDOM);
				});
	} */
}			
		
			//adding categories to the field
			window.Flex.Component.Product.Store.Query.listCategory().then((r)=>{
				
				let categorySelectorDOM = document.querySelector('#parent_id');
				let categorySelector2DOM = document.querySelector('#parent_id2');
				let tableDom = document.querySelector('#data-holder');
				r.data.categories.forEach((item)=>{
					children(item, categorySelectorDOM);
					children(item, categorySelector2DOM);
					children2(item, tableDom);
				});
				
				 
			})

    
            document.querySelector('[data-save-category]').addEventListener('click', () => {
                let name = document.querySelector('#addPageModal').querySelector('#name').value;
                let slug = document.querySelector('#addPageModal').querySelector('#slug').value;
				let parentId = document.querySelector('#addPageModal').querySelector('#parent_id').value;

                window.Flex.Component.ProductCategory.Store.Command.add({
                    name: name,
                    slug: slug,
					parent_id: parentId
				}).then((r) => {
					
                    $('#addPageModal').modal('hide');
                    location.reload();
					
                }).catch((r) => {
                    let errorDom = document.querySelector('#addPageModal').querySelector('[data-error-msg]');
                    window.Flex.Util.clearElement(errorDom);
                    errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom cuvanja kategorije'));
                });
            });
            document.querySelector('[data-update-category]').addEventListener('click', () => {
                let name = document.querySelector('#updatePageModal').querySelector('#name2').value;
                let slug = document.querySelector('#updatePageModal').querySelector('#slug2').value;
				let parentId = document.querySelector('#updatePageModal').querySelector('#parent_id2').value;
				let discountId = document.querySelector('#updatePageModal').querySelector('#discount_id').value;
				let pageId = parseInt(document.querySelector('#updatePageModal').querySelector('[name="id"]').value);
			
                window.Flex.Component.ProductCategory.Store.Command.update({
                    name: name,
                    slug: slug,
					parent_id: parentId,
					discount_id: discountId,
					id: pageId
				}).then((r) => {
                     location.reload();
                }).catch((r) => {
					let errorDom = document.querySelector('#updatePageModal').querySelector('[data-error-msg]');
                    window.Flex.Util.clearElement(errorDom);
                    errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom cuvanja kategorije'));
                });
            });
	
	        // getting children for menu items
		$("#product_category_select").change(function(){
			let id = $(this).val();
			let tableDom = document.querySelector('#data-holder');
			if(id == ""){
				window.Flex.Component.Product.Store.Query.listCategory().then((r)=>{
				tableDom.innerHTML = "";
				let categorySelectorDOM = document.querySelector('#parent_id');
				let categorySelector2DOM = document.querySelector('#parent_id2');
				r.data.categories.forEach((item)=>{
					children(item, categorySelectorDOM);
					children2(item, tableDom);
				});
				
				 
			})
			}else{
					window.Flex.Component.ProductCategory.Store.Command.getAllChildrenCategories(id).then((r) => {
             
			tableDom.innerHTML = "";		
			let categorySelectorDOM = document.querySelector('#parent_id');
			let categorySelector2DOM = document.querySelector('#parent_id2');
						console.log(r);
			r.data.data.items.forEach((item) => {
				children(item, categorySelectorDOM);
				children2(item, tableDom);
			});  


		}) 
				   
			}
		});
	
        })
    </script>
@endsection
