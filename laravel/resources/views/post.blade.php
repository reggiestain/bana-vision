@extends('layouts.master')

@section('title')
 
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}our excess
  @else
    our excess
  @endif
@endsection

@section('content')
  @include('includes.message-block')
       
    <div class="card card-custom d-flex mt-2"> 
    <img class="card-img-top"  src="" alt="Schools brand picture" style="background-color:beige;height: 14.25rem; ">
    <div class="card-body" style="padding: 0"> 
      <div class="col-12 row" style="background-color: #eff1f3;padding: 0;margin: 0">
      <div class="col-3 p-3" style="    text-align: center;">
        <span class="fa-stack fa-3x">
          <i class="far fa-calendar fa-stack-2x"></i>
          <span class="fa-stack-1x " style="margin-top: 0"><strong style="display: block;font-size: 1rem">mnt</strong></span>
          <span class="fa-stack-1x" style="margin-top: 0.85rem;"><strong  style="font-size:1.5rem">27</strong></span>
        </span>
      </div>

      <div class="col-9 p-3" id="container-{{$post->id}}">
        <h6><strong>{{$post->name}}</strong></h6>
        
         
            {{{$post->description}}}
         
            <span class="text-muted">{{$post->venue}}</span>
 
          
            {{$post->timeslot}}
         
      </div>
   </div>
       
<span class="p-2 border-left">@include('includes.postInteractions')</span>
    </div> 

  </div>
@if($post instanceof App\OurEvent)

yesssss
@else
noooo
@endif
 @endsection