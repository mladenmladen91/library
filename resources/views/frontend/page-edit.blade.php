@extends('layout', ["page_title" => 'Stranice-izmjena'])

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Stranice</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Izmijeni stranicu</h6>
                </div>
                <div class="card-body">
                   <form>
                    <div class="logoContainer text-left">
                        
                    </div>
                    <div class="inputWrapper  m-2 text-danger" data-error-msg>
                    </div>
					  <div class="row">
					    <div class="col-4">
						  <div class="m-2">
						<label for="title">Naziv</label>
						<input class="form-control" type="text" id="title" placeholder="Naziv">
						<input type="hidden" id="language_id" value="1" />	
					    <input type="hidden" id="id" name="id" value="1" />	
					     <input type="hidden" id="page_id" name="page_id" value="1" />			  
                           </div>  
						</div>
						<div class="col-4">
						     <div class="m-2">
						       <label for="slug">Slug</label>
						       <input class="form-control" type="text" id="slug" placeholder="Slug">
					         </div>
						 </div>
						  
						
						  
					<div class="col-4">		  
				<div class="inputWrapper  m-2 ">
						<label for="category_id">Kategorija</label>
						<select class="form-control" id="category_id">
						 @foreach($categories as $category)	
						   <option value="{{$category->id}}">{{$category->name}}</option>
						 @endforeach	
						</select>
					</div> 
					  
					   </div>	  
						  
						  
						  
						  
					   </div>
					<div class="inputWrapper  m-2 ">
						 <label for="description">Opis</label>
						<input class="form-control" type="text" id="description" placeholder="opis">
					</div>
					
					<div class="inputWrapper  m-2 ">
						 <label for="content">Tekst</label>
						<div class="editor" style="height:300px"></div>
					</div>
					
					<div class="inputWrapper  m-2 ">   
					  <button class="btn btn-success" type="button" data-update-page>Ažuriraj stranicu</button>
					  <a href="{{route('admin.page')}}" class="btn btn-info" style="color:white">Odustani od izmjena</a>	
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
					<div class="row" id="gallery_holder">
					 
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
						<input id="image-id" type="hidden" name="page_id" value="{{$id}}">
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

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
			
// sorting images		
function updateToDatabase(idArray){
	    let categories = [];
	    for(let i = 0;i < idArray.length; i++){
			let category = {
				"id": idArray[i]
			};
			categories.push(category);
		}
	    
	    window.Flex.Component.Page.Store.Command.sortImages(categories).then((r) => {
					console.log(r);
          }).catch((r) => {
                    alert('error');
           });
    	
    	}
 var target =  $("#gallery_holder");   
target.sortable({
  items: "div.col-3",
  update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData);
            }
        
        
    });			
		
 document.addEventListener('DOMContentLoaded', () => {
            
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

			
			

// slugifying titles		
$('#title').on('input', function() {
	let slug = slugify($(this).val());
	$("#slug").val(slug);
});	 
			
// setting quill editor
var quill = new Quill('.editor', {
    theme: 'snow'
  });			
      			
			// loading data
           window.Flex.Component.Page.Store.Command.getPage({
               language_id : 1,     
			   slug: '{{$slug}}',
			        											
				}).then((r) => {
			   // adding images to container
			   let rowDOM = document.querySelector('#gallery_holder');
			   r.data.data.page.images.forEach((item) => {
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
					    window.Flex.Component.Page.Store.Command.removeImage(item.id, item.image).then(() => {
                                xButtonDOM.closest(".col-3").remove();
                            });
                    });
                });  
				   
				   
                
                    document.querySelector('[name="page_id"]').value = r.data.data.page.page_id;
					document.querySelector('[name="id"]').value = r.data.data.page.id;
                    document.querySelector('#title').value = r.data.data.page.title;
					document.querySelector('#slug').value = r.data.data.page.slug;
					document.querySelector('#description').value = r.data.data.page.description;
					quill.root.innerHTML = r.data.data.page.content; 
					$("#category_id option").each(function(){
						if($(this).val() == r.data.data.page.category_id){
							$(this).attr("selected","selected");
						}
					});
                }).catch((r) => {
					console.log(r);
                    
                });
			
			//updating data
			document.querySelector('[data-update-page]').addEventListener('click', () => {
                let title = document.querySelector('#title').value;
                let slug = document.querySelector('#slug').value;
				let languageId = document.querySelector('#language_id').value;
				let categoryId = document.querySelector('#category_id').value;
				let description = document.querySelector('#description').value;
				let content = quill.root.innerHTML;
                let pageId = document.querySelector('[name="page_id"]').value;
				let id = document.querySelector('[name="id"]').value;
			
                window.Flex.Component.Page.Store.Command.update({
                    title: title,
                    slug: slug,
					language_id: languageId,
					category_id: categoryId,
					content: content,
					description: description,
					page_id: pageId,
					id: id
				}).then((r) => {
                     alert("Stranica sačuvana!");
                 }).catch((r) => {
					console.log(r);
                });
            });
			
			
			//adding image
			document.querySelector('[data-save-image]').addEventListener('click', () => {
                window.Flex.Component.Page.Store.Command.addImage($("#image-form")[0]).then((r) => {
					location.reload();
				}).catch((r) => {
                    let errorDom = document.querySelector('#addImageModal').querySelector('[data-error-msg]');
                    window.Flex.Util.clearElement(errorDom);
                    errorDom.appendChild(document.createTextNode('Doslo je do greske prilikom čuvanja fotografije'));
                });
            });
         
		});
    </script>
@endsection