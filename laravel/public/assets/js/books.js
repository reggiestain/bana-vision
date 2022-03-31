$(document).on('click','.show-photo',function(event){
  var book = JSON.parse($(event.target).attr('data-book'));
	var studentsImages = document.getElementById("student-pictures-"+book.id);

	studentsImages.innerHTML = '';

	studentsImages.innerHTML += '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" id="first-slide" alt="First slide" ></div>';

	console.log("here");
	$('#first-slide').prop('src',(value=$(event.target).attr('src')));
	document.getElementById("post-text-"+book.id).innerHTML='<h6><strong>'+book.title+'</strong></h6>'+
	'<dl class="row m-0">'+
	'<dt class="col-sm-4">Description :</dt>'+
	'<dd class="col-sm-8">'+book.description+'</dd>'+
	'<dt class="col-sm-4">Quantity :</dt><dd class="col-sm-8">'+book.quantity+'</dd>'+
	'<dt class="col-sm-4">Author :</dt><dd class="col-sm-8">'+book.author+'</dd>'+
	'<dt class="col-sm-4">Year :</dt><dd class="col-sm-8">'+book.year+'</dd>'+
	'<dt class="col-sm-4">Grade :</dt><dd class="col-sm-8">'+book.grade+'</dd>'+
	'<dt class="col-sm-4">Category :</dt><dd class="col-sm-8">'+book.category+'</dd></dl><hr>'+
	'<div class="col-12 p-1">'+
	'<nav>'+
  	'<div class="nav nav-tabs" id="nav-tab" role="tablist">'+
      '<a class="nav-item nav-link active" id="nav-library-tab" data-toggle="tab" href="#nav-library" role="tab" aria-controls="nav-library" aria-selected="true">Make library book</a>'+
    '<a class="nav-item nav-link" id="nav-student-tab" data-toggle="tab" href="#nav-student" role="tab" aria-controls="nav-student" aria-selected="false">Loan to student</a>'+
    '<a class="nav-item nav-link" id="nav-storage-tab" data-toggle="tab" href="#nav-storage" role="tab" aria-controls="nav-storage" aria-selected="false">Save in storage</a>'+
  '</div>'+
'</nav>'+
//******************************library book *********************************************
'<div class="tab-content" id="nav-tabContent">'+
  '<div class="tab-pane fade show active" id="nav-library" role="tabpanel" aria-labelledby="nav-library-tab">'+
  '<form method="post" action="'+libraryRoute+'"><input type="hidden" name="school_id" value="'+schoolId+'">'+
  		'<input type="hidden" name="book_id" value="'+book.id+'">'+
  		'<div class="form-group row m-0 mt-2">'+
    		'<label for="library_quantity" class="col-sm-4 p-0 col-form-label">Quantity</label>'+
    		'<div class="col-sm-8">'+
      			'<input type="number" name="library_quantity" min="0" class="form-control form-control-sm" id="library_quantiy" placeholder="number of books to be placed in the library">'+
    		'</div>'+
    	//number of books available
    	'<div class="form-group row m-0 mt-2 w-100">'+
    		'<label for="num_available" class="col-sm-4 p-0 col-form-label">N0 available:</label>'+
    		'<div class="col-sm-8">'+
      			'<input type="number" name="num_available" min="0" class="form-control form-control-sm" id="num_available" placeholder="number of books available">'+
    		'</div>'+
  		'</div>'+

  		'<div class="form-group row m-0 mt-2 w-100">'+
    		'<label for="num_total" class="col-sm-4 p-0 col-form-label">Total n0 books:</label>'+
    		'<div class="col-sm-8">'+
      			'<input type="number" name="num_total" min="0" class="form-control form-control-sm" id="num_total" placeholder="total number of library books">'+
    		'</div>'+
  		'</div>'+
  		//location of the book
  		'<div class="form-group row m-0 mt-2 w-100">'+
    		'<label for="location" class="col-sm-4 p-0 col-form-label">Location:</label>'+
    		'<div class="col-sm-8">'+
      			'<input type="text" name="location" min="0" class="form-control form-control-sm" id="location" placeholder="location where the book is kept">'+
    		'</div>'+
  		'</div>'+
  		//book identification
  		'<div class="form-group row m-0 mt-2 w-100">'+
    		'<label for="book_identification" class="col-sm-4 p-0 col-form-label">Book identificaton</label>'+
    		'<div class="col-sm-8">'+
      			'<input type="number" name="book_identification" min="0" class="form-control form-control-sm" id="book_identification" placeholder="number that identifies the book">'+
    		'</div>'+
  		'</div>'+
  		//the format of the book
  		'<div class="form-group row m-0 mt-2 w-100">'+
    		'<label for="format" class="col-sm-4 p-0 col-form-label">Book format</label>'+
    		'<div class="col-sm-8">'+
      			'<input type="format" name="format" min="0" class="form-control form-control-sm" id="book_identification" placeholder="the book format">'+
    		'</div>'+
  		'</div>'+
  		//book reservation
  		'<div class="form-group row m-0 mt-2 w-100">'+
    		'<label for="library_quantity" class="col-sm-4 p-0 col-form-label">Reservation</label>'+
    		'<div class="col-sm-8">'+
      			'<select class="custom-select mr-sm-2 form-control form-control-sm" id="reserved" name="reserved">'+
        			'<option selected>Choose...</option>'+
        			'<option value="0">reserved</option>'+
        			'<option value="1">not reserved</option>'+
      			'</select>'+
    		'</div>'+
  		'</div>'+
  		'</div>'+
  		'<input type="hidden"  name="_token" value="'+token+'"> '+
  		'<button type="submit" class="btn btn-sm">Save</button>'+
  '</form>'+
  '</div>'+
  //******************************loan to student tab *********************************************
  '<div class="tab-pane fade" id="nav-student" role="tabpanel" aria-labelledby="nav-student-tab">'+
    '<form method="post" action="'+studentRoute+'">'+
  	'<input type="hidden" name="school_id" value="'+schoolId+'">'+
  		'<input type="hidden" name="book_id" value="'+book.id+'">'+
  		'<input type="hidden"  name="_token" value="'+token+'"> '+
  		student+
  		'</form>'+
  '</div>'+
  //************************************storage tab *********************************************
  '<div class="tab-pane fade" id="nav-storage" role="tabpanel" aria-labelledby="nav-storage-tab">'+
  		'<form method="post" action="'+storageRoute+'"><input type="hidden" name="school_id" value="'+schoolId+'">'+
  		'<input type="hidden" name="book_id" value="'+book.id+'">'+
  		'<div class="form-group row m-0 mt-2 w-100">'+
    		'<label for="storage_quantity" class="col-sm-4 p-0 col-form-label">Quantity :</label>'+
    		'<div class="col-sm-8">'+
      			'<input type="number" name="storage_quantity" min="0" class="form-control form-control-sm" id="storage_quantity" placeholder="number of spare books">'+
    		'</div>'+
    	'</div>'+
    	'<input type="hidden"  name="_token" value="'+token+'"> '+
  		'<button type="submit" class="btn btn-sm">Save</button>'+
    	'</form>'+
  '</div>'+
'</div>';

	$('#PostPicCarousel-modal-'+book.id).modal();

});


$(document).on('click','#add-book-link',function(event){
	console.log('book page');
	$('#add-book-modal').modal();
});
