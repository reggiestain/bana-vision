@extends('layouts.master')

@section('title')
  
  @if(isset($numberMessages)){{'('.$numberMessages.')'}}help received or given
  @else
  help received or given
  @endif
@endsection

@section('content')
  @include('includes.message-block')
 @foreach($posts as $post)

 @endforeach