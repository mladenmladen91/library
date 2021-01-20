@extends('layout', ["page_title" => 'Stavke menija'])

@section('content')



<div class="row" style="height: 92%;">
    <div class="col-lg-12 p-4" style="height: 100%;">
        <div class="card shadow mb-4" style="height: 100%;">
			<div class="card-header py-2 px-4">
				<div class="row">
					<div class="col-2"><select class="form-control" id="menu_items_select">
						  <option value="">Odaberi stavke</option>
						@foreach($menuItems as $menuItem)
						   <option value="{{$menuItem->id}}">{{$menuItem->name}}</option>
						@endforeach
						</select></div>
					<div class="col-4"><a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPageModal"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj stavku</a>
					</div>
				</div>
			</div>
			<div class="card-body" id="data-holder">



			</div>
		</div>
	</div>

</div>

<div class="modal fade" id="addPageModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Dodaj novu stavku</h5>
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
						<input type="hidden" name="language_id" id="language_id" value="1">
					</div>
					<div class="inputWrapper  m-2 ">
						<label for="discount_id">Izaberi stranicu</label>
						<select class="form-control" id="link">
							<option value="/">Naslovna</option>
							@foreach($pages as $page)
							<option value="{{$page->slug}}">{{$page->title}}</option>
							@endforeach
						</select>
					</div>

					<div class="inputWrapper  m-2 ">
						<label for="category_id">Roditeljska stavka</label>
						<select class="form-control" id="parent_id" data-category-select>
							<option value="0">-----</option>
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

<div class="modal fade" id="updatePageModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Izmeni stavku</h5>
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
						<input type="hidden" name="language_id" id="language_id" value="1">
					</div>
					<div class="inputWrapper  m-2 ">
						<label for="discount_id">Izaberi stranicu</label>
						<select class="form-control" id="link">
							<option value="/">Naslovna</option>
							@foreach($pages as $page)
							<option value="{{$page->slug}}">{{$page->title}}</option>
							@endforeach
						</select>
					</div>

					<div class="inputWrapper  m-2 ">
						<label for="category_id">Roditeljska stavka</label>
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

		// sorting categories			
		function updateToDatabase(idArray) {
			let categories = [];
			for (let i = 0; i < idArray.length; i++) {
				let category = {
					"id": idArray[i]
				};
				categories.push(category);
			}

			window.Flex.Component.MenuItems.Store.Command.sortMenus(categories).then((r) => {
				console.log(r);
			}).catch((r) => {
				alert('error');
			});
		}
		var target = $(".card-body");
		target.sortable({
			items: "div.tester",
			update: function(e, ui) {
				var sortData = target.sortable('toArray', {
					attribute: 'data-id'
				})
				updateToDatabase(sortData)
			}


		});

		// function for listing categories tree 
		function children(item, selectDOM) {
			let optionDOM = document.createElement("option");
			optionDOM.value = item.id;
			let plus = "";

			if (item.children) {
			  if(item.children.length > 0){	
				 plus = " +";
			  }
			}
			if (item.parent_id > 0) {
				optionDOM.appendChild(document.createTextNode("-" + item.name + plus));
			} else {
				optionDOM.appendChild(document.createTextNode(item.name + plus));
			}
			selectDOM.appendChild(optionDOM);

			if (item.children) {
					
				item.children.forEach((item) => {
					children(item, selectDOM);
				});
			}
		}

		// listing elements in the main table			
		function children2(item, tableDOM, parentDOM = null) {


			let divDOM = document.createElement("div");
			divDOM.className += "tester mb-4";
			divDOM.setAttribute("data-id", item.id);

			// creating column name and dropdown
			let aDOM = document.createElement("a");
			aDOM.className += "mr-4";
			aDOM.setAttribute("data-toggle", "collapse");
			aDOM.setAttribute("href", "#multiCollapseExample" + item.id);
			aDOM.setAttribute("role", "button");
			aDOM.setAttribute("aria-expanded", "true");
			aDOM.setAttribute("aria-controls", "#multiCollapseExample" + item.id);
			aDOM.style.color = "#434343";
			aDOM.style.textDecoration = "none";
			aDOM.style.linHeight = "1.7";
			aDOM.style.fontWeight = "400";

			aDOM.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15" class="fill mr-10"><path d="m464.883 64.267h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z"></path><path d="m464.883 208.867h-417.766c-25.98 0-47.117 21.136-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.013-21.137-47.149-47.117-47.149z"></path><path d="m464.883 353.467h-417.766c-25.98 0-47.117 21.137-47.117 47.149 0 25.98 21.137 47.117 47.117 47.117h417.766c25.98 0 47.117-21.137 47.117-47.117 0-26.012-21.137-47.149-47.117-47.149z"></path></svg>' + " " + item.name;

			divDOM.appendChild(aDOM);

			// creating delete button
			let cDOM = document.createElement("button");
			cDOM.className += "btn btn-danger float-right";
			cDOM.setAttribute("data-action", "remove");
			cDOM.setAttribute("data-id", item.id);
			cDOM.appendChild(document.createTextNode("Obriši"));
			cDOM.addEventListener('click', (i, j) => {
				window.Flex.Util.confirmModal({
					title: `Obriši kategoriju ${item.name}?`,
					content: "Da li ste sigurni da zelite da obrišete stavku?",
					data: item,
					success: (data) => {
						window.Flex.Component.MenuItems.Store.Command.remove(item.id, item.menu_id).then(() => {
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
			dDOM.addEventListener('click', (i, j) => {
				let updateModal = document.querySelector('#updatePageModal');
				updateModal.querySelector('[name="id"]').value = item.id;
				updateModal.querySelector('#name2').value = item.name;
				$("#updatePageModal #parent_id2 option").each(function() {
					if ($(this).val() == item.parent_id) {
						$(this).attr("selected", "selected");
					}
				});

				$("#updatePageModal #link option").each(function() {
					if ($(this).val() == item.link) {
						$(this).attr("selected", "selected");
					}
				});

				$('#updatePageModal').modal('show');
			});
			divDOM.appendChild(dDOM);

			/*if (parentDOM != null) {
				parentDOM.appendChild(divDOM);
			} else { */
				tableDOM.appendChild(divDOM);
			//}



			/*if (item.children.length > 0) {
				let collapseDOM = document.createElement("div");
				collapseDOM.className += "multi-collapse";
				collapseDOM.setAttribute("id", "multiCollapseExample" + item.id);
				collapseDOM.style.paddingLeft = '30px';
				collapseDOM.style.marginTop = '20px';
				divDOM.appendChild(collapseDOM);
				item.children.forEach((item) => {
					children2(item, tableDOM, collapseDOM);
				});
			} */
		}

		//adding categories to the field
		window.Flex.Component.MenuItems.Store.Query.list({{$id}}).then((r) => {

			let categorySelectorDOM = document.querySelector('#parent_id');
			let categorySelector2DOM = document.querySelector('#parent_id2');
			let tableDom = document.querySelector('#data-holder');
			r.data.items.forEach((item) => {
				children(item, categorySelectorDOM);
				children(item, categorySelector2DOM);
				children2(item, tableDom);
			});


		})


		document.querySelector('[data-save-category]').addEventListener('click', () => {
			let name = document.querySelector('#addPageModal').querySelector('#name').value;
			let languageId = document.querySelector('#addPageModal').querySelector('#language_id').value;
			let parentId = document.querySelector('#addPageModal').querySelector('#parent_id').value;
			let link = document.querySelector('#addPageModal').querySelector('#link').value;

			window.Flex.Component.MenuItems.Store.Command.add({
				name: name,
				language_id: languageId,
				parent_id: parentId,
				link: link,
				menu_id: {{$id}}
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
			let parentId = document.querySelector('#updatePageModal').querySelector('#parent_id2').value;
			let languageId = document.querySelector('#updatePageModal').querySelector('#language_id').value;
			let link = document.querySelector('#updatePageModal').querySelector('#link').value;
			let pageId = parseInt(document.querySelector('#updatePageModal').querySelector('[name="id"]').value);

			window.Flex.Component.MenuItems.Store.Command.update({
				name: name,
				language_id: languageId,
				parent_id: parentId,
				link: link,
				id: pageId,
				menu_id: {{$id}}
			}).then((r) => {
				location.reload();
			}).catch((r) => {
				let errorDom = document.querySelector('#updatePageModal').querySelector('[data-error-msg]');
				window.Flex.Util.clearElement(errorDom);
				errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom cuvanja kategorije'));
			});
		});
		
		// getting children for menu items
		$("#menu_items_select").change(function(){
			let id = $(this).val();
			let tableDom = document.querySelector('#data-holder');
			if(id == ""){
				window.Flex.Component.MenuItems.Store.Query.list({{$id}}).then((r) => {
             
			tableDom.innerHTML = "";		
			let categorySelectorDOM = document.querySelector('#parent_id');
			let categorySelector2DOM = document.querySelector('#parent_id2');
			r.data.items.forEach((item) => {
				children(item, categorySelectorDOM);
				children2(item, tableDom);
			}); 


		})
			}else{
					window.Flex.Component.MenuItems.Store.Command.getAllChildrenMenus(id).then((r) => {
             
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