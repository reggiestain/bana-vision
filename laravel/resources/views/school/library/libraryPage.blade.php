@extends('layouts.master')

@section('title')
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}featured students page
  @else
  Bursaries Available
  @endif
@endsection

@section('content')
  @include('includes.message-block')
  <div class="card">
  <div class="card-header">
    Library 
  </div>
  <div class="card-body" style="min-height: 25rem;">
  	<form action="{{route('searchLibrary')}}" method="POST" enctype="multipart/form-data">
  		<!--SEARCH QUERY-->
  		<div class="form-group">
  			<input class="form-control form-control-sm ml-auto mr-auto mt-5" type="text" placeholder="search for book" style="width: 75%" name="search_query">
  		</div>

		<!--CATEGORY-->
  		<div class="row">
  			<div class="col">
  				<select id="inputState" class="form-control form-control-sm ml-auto" style="width: 75%" name="category">
  					<option value="default" selected>Category</option>
  					@foreach($books as $book)
  					<option value="{{$book->category}}">{{$book->category}}</option>
  					@endforeach
  				</select>
  			</div>
			
			<!--GRADE-->
  			<div class="col">
  				<select id="inputState" class="form-control form-control-sm" style="width: 75%" name="grade">
  					<option selected value="0">Grade</option>
  					@for ($i = 0; $i <= 12; $i++)
 						
  					<option value="{{ $i }}">grade {{ $i }}</option>
					@endfor
  					
  				</select>
  			</div>
  		</div>
		<div class="mt-2 d-flex">
  			<button type="submit" class="btn btn-primary btn-sm ml-auto mr-auto">Search</button>
  		</div>

  		
  	<input type="hidden"  name="_token" value="{{{csrf_token()}}}"> 
  	<input type="hidden" value="{{$userIdNo->id}}" name="userIdNo">
  	</form>
  	<div class="row">
      <div class="col-12 mt-2">
        <h5 class="  ml-auto mr-auto" style="text-align: center">Featured Books</h5>
      </div>
      <!--featured books carousel-->
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner col-12">

          @foreach($featured_books->chunk(3) as $key => $chunk)
                      <div class="carousel-item row m-0 @if($key == 0)active @endif ">

                        @foreach($chunk as $featured_book)
                        <div class="col-4 float-left p-1" style="padding-left:0;padding-right:0; ">
                         <figure class="figure">
                           <img class="figure-img img-fluid rounded" src="{{route('getPostPic',['filename'=>$featured_book->book->images->first()->name,'folder'=>'books'])}}" alt="Second slide" style="max-width: 100%">
                           <figcaption class="figure-caption">
                            <span style="display: block;">
                              {{$featured_book->book->title}}
                          </figcaption>
                        </figure>
                      </div>
                      @endforeach
                      
                    </div>
                    @endforeach

        </div>
      </div>
  	</div>
  </div>
</div>
@endsection