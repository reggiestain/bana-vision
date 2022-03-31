@extends('layouts.master')

@section('title')
  
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}outreach page
  @else
  outreach page
  @endif
@endsection

@section('content')
  @include('includes.message-block')