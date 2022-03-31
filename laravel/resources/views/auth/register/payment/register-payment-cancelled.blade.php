@extends('layouts.masterRegister')

@section('title')
  Welcome
@endsection

@section('content')
  @include('includes.message-block')
<!-- SIGN UP-->
  @if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif
<div>
	<h2>Your Payment has been cancelled!</h2>
</div>

@endsection