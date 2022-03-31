@extends('layouts.masterRegister')

@section('title')
  Welcome
@endsection

@section('registrationType')
Basic User Information
@endsection

@section('content')
  @include('includes.message-block')
<!-- SIGN UP-->
  @if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif
  <register></register>

@endsection