@extends('layouts.master')

@section('title')

@if(isset($numberMessages)){{'('.$numberMessages.')'}}Schools
  @else
  notifications
  @endif
@endsection

@section('content')
@include('includes.message-block')

<div class="card card-custom" style="margin-top:-44px;margin-left:5px;margin-bottom:0"> 
  <div class="card-body">
   
    <ul class="list-group list-group-flush">
         
      
      @if($notifications !="[]")
      @foreach($notifications as $notification )
      <li class="list-group-item">
        {{{$notification->data['tips']}}}
      </li>
        @endforeach
      @else
        <h4>No entries match your request</h4>
      @endif 
     </ul>
   

    

  </div>
</div>



@endsection
