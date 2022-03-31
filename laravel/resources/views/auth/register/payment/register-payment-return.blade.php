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
	<h2>Your order has been succesfully placed!</h2>

	<p>Your subscription has been succesfully processed, thank you for choosing Bana. </p>
</div>

@endsection