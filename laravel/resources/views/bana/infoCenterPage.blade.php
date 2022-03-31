@extends('layouts.master')

@section('title')
 
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}Announcements
  @else
    Announcements
  @endif
@endsection
 @section('styles')
 <!--FROM NEWSFEED PAGE-->
  <style type="text/css">
    #feed-textarea
    {
       border:none;
        background-color:transparent;
        padding:0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        resize: none;
    }

    .feeds-inputs
    {
       border:none;
        background-color:transparent;
        padding:0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        resize: none;
    }
    .feeds-inputs.form-control:focus 
    {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0);
       
    }
    .inputs.form-control:focus 
    {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0);
       
    }

    ::-webkit-input-placeholder {
  color: peachpuff;
  font-size: 13px;
}
::-moz-placeholder {
  color: peachpuff;
  font-size: 13px;
}
:-ms-input-placeholder {
  color: peachpuff;
  font-size: 13px;
}
::placeholder {
  color: peachpuff;
  font-size: 13px;
}
  </style>
 @endsection
@section('content')
  @include('includes.message-block')


		<!--=======================LOADER PLACE HOLDER=======================-->
		<div class="card col-12  ajax-load text-center mt-2 p-0 post-card" style="display:none;">
       
          <div class="ph-item">
            <div class="ph-col-12">
              <div class="ph-picture"></div>
              <div class="ph-row">
                <div class="ph-col-4"></div>
                <div class="ph-col-8 empty"></div>
                <div class="ph-col-12"></div>
              </div>
            </div>
            <div class="ph-col-2">
              <div class="ph-avatar"></div>
            </div>
            <div>
              <div class="ph-row">
                <div class="ph-col-12"></div>
                <div class="ph-col-2"></div>
                <div class="ph-col-10 empty"></div>
                <div class="ph-col-8 big"></div>
                <div class="ph-col-4 big empty"></div>
              </div>
            </div>
          </div>
   
 <!--  <p><img src="{{URL::asset('/assets/img/loader.gif')}}">Loading More post</p>
 -->
</div>

<!-- <announcements :post="{{$posts}}"></announcements> -->
<info-center :posts="{{$posts}}" type="{{$type}}"></info-center>


 @endsection
 