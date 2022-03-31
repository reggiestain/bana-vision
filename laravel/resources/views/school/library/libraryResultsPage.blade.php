@extends('layouts.master')

@section('title')
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}Library search results
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
     <h4 class=" d-flex ml-auto mr-auto" style="text-align: center">Displaying results for "{{$query_result}}"</h4>
  	<div class="col-12 p-2">
  			@foreach($books->chunk(3) as $chunk)
             <div class="row m-0 " style="height:10rem;">
              @foreach($chunk as $key=>$book)
                <div class="col-4 pl-1 pr-1">
                	<figure class="figure">
  						<img src="{{route('getPostPic',['filename'=>$book->images->first()->name,'folder'=>'books'])}}" class="figure-img img-fluid library-book" alt="A generic square placeholder image with rounded corners in a figure." data-id="{{$book->id}}" data-title="{{$book->title}}" data-description="{{$book->description}}" data-isbn="{{$book->isbn_number}}" data-author="{{$book->author}}" data-year="{{$book->year}}" data-location="{{$book->location}}" data-src="{{route('getPostPic',['filename'=>$book->images->first()->name,'folder'=>'books'])}}" style="max-width: 100%">
  						<figcaption class="figure-caption">{{$book->title}}</figcaption>
  					</figure>
                </div>
              @endforeach
  		</div>
  		@endforeach
  	</div>
  </div>
</div>

@include('includes.libraryBookModal')
@endsection