@extends('layouts.master')

@section('title')
 
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}Books
  @else
    Books
  @endif
@endsection
@inject('students', 'App\SchoolStudent')
@section('content')
  @include('includes.message-block')
 
  <div class="card">
  	<div class="card-header">
  		Books
  		<a class="p-1"  style="float: right !important">
  			<i class="fas fa-wrench" style="color:#c5c7cb">
  			</i>
  		</a>
  		<a class="p-1 " style="float: right !important">
  			<i class="fas fa-chevron-up " style="color:#c5c7cb"></i>
  		</a>
  		<a class="p-1 " style="float: right !important" href="#" role="button" id="add-book" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  			<i class="fas fa-cog " style="color:#c5c7cb"></i>
  		</a>
		<!--Cog dropdown-->
		<div class="dropdown-menu" aria-labelledby="add-book">
			<a class="dropdown-item" href="#" id="add-book-link">Add a book</a>
			<a class="dropdown-item" href="#">Another action</a>
			<a class="dropdown-item" href="#">Something else here</a>
		</div>
  	</div>
  	<div class="card-body">
  		<div id="books-data">
  		@include('booksData')
  	</div>
  	</div>
  </div>

  <hr>

  <script type="text/javascript">
  	var token = '{{csrf_token()}}';
  	var libraryRoute = '{{route('createLibraryBook')}}';
  	var studentRoute = '{{route('createLoanedBook')}}';
  	var storageRoute = '{{route('createStorageBook')}}';
  	var schoolId = "{{$userIdNo->usable_id}}"

  	var page =1;
  $(document).ready(function(){

  $(window).scroll(function() {

      if($(window).scrollTop() + $(window).height() >= $(document).height()) {

          page++;

          loadMoreData(page);

      }

  });

});

  function loadMoreData(page){

    $.ajax(

          {

              url: '?page=' + page,

              type: "get",

              beforeSend: function()

              {
                  /*setTimeout(function(){ 
                    console.log("setting timeout"+page);
                    $('.ajax-load').show(); }, 30000);
                  */
              }

          })

          .done(function(data)

          {

              if(data.html == " "){

                  $('.ajax-load').html("No more records found");

                  return;

              }

            // $('.ajax-load').hide();
              $('.ajax-load').fadeIn();
              $("#books-data").append($('ajax.load'));
              $("#books-data").append(data.html);

          })

          .fail(function(jqXHR, ajaxOptions, thrownError)

          {

                alert('server not responding...');

          });

  }

  var student;
  var results = '';
  $(document).on('change','#select-class',function(event){
  	var str = $(event.target).val();
  	str = str.split(" ");
  	results = '';
  	$('#results').html('');
  	var url = '/'+'<?php echo($userIdNo->slug)?>'+'/admin/students/'+str[0]+'/'+str[1];
	$.ajax({
		method: 'GET',
		url: url ,
	})
     .done(function (msg){
     	var stdnt;
     	for(stdnt in msg.students)
     	{
     		console.log(msg.students[stdnt]);
     		results += '<div class="col-6 form-group">'+
    		'<label for="exampleInputEmail1">'+msg.students[stdnt].name+' '+msg.students[stdnt].surname+'</label>'+
    		'<input type="text" name="book_number[]" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Book number">'+
    		'<input type="hidden" name="school_student_id[]" value="'+msg.students[stdnt].id+'">'+
  			'</div>';
     	}
     	$('#results').append(results);
     	$(postBodyElement).text(msg['new_body']);
     	$('#edit-modal').modal('hide');
     });
});
  student = '<div class="form-group row m-0 mt-2">'+ //this is used in book.js as student to add to student nav
    		'<label for="exampleInputEmail1" class="col-4">Class</label>'+
    		'<select class="col-8 form-control form-control-sm" id="select-class">'+
      			'<option selected>Class </option>'+
      			@foreach($userIdNo->usable->first()->schoolclass as $class)
      			'<option value="{{$class->grade.' '.$class->class_name}}">Grade {{$class->grade.' '.$class->class_name}}</option>'+
      			@endforeach
    		'</select>'+
  		'</div>'+
  		 '<div id="results"></div>'+
  		 '<button type="submit" class="btn btn-sm">Save</button>';
  </script>

@include('includes.addBookModal')
 @endsection