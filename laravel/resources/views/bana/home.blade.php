@extends('layouts.masterProfile')
@section('styles')

    <link rel="stylesheet" href="{{URL::asset('/assets/css/styling.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/responsive.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/fontawesome.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/dropzone.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/jquery.jgrowl.css')}}"/>

    <style>
        .jumbotron {
            background-color:#ff5500;position:fixed;z-index:50;width:100%
        }

        #navbar
        {
            margin-top:15px;
        }

        a:hover,a:focus{
            text-decoration: none;
            outline: none;
        }
        .nav-tabs {
            border-bottom: 1px solid #e4e4e4;
        }
        .nav-tabs > li{
            margin-right: 1px;
        }
        .nav-tabs > li > a{
            border-radius: 0px;
            border: 1px solid #e4e4e4;
            border-right: 0px none;
            margin-right: 0px;
            padding: 8px 17px;
            color:#222222;
            transition: all 0.3s ease-in 0s;
        }
        .nav-tabs > li:last-child{
            border-right:1px solid #ededed;
        }
        .nav-tabs > li > a{
            padding: 15px 30px;
            border:1px solid #ededed;
            border-right: 0px none;
            border-top: 2px solid #ededed;
            background: #ededed;
            color: #8f8f8f;
            font-weight: bold;
        }
        .nav-tabs > li > a:hover{
            border-bottom-color: #ededed;
            border-right: 0px none;
            background: #3498db;
            color: #444;
        }
        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:focus,
        .nav-tabs > li.active > a:hover{
            border-top: 2px solid #ff5500 ;
            border-right: 0px none;
            color: #444;
        }
        .tab-content > .tab-pane{
            border: 1px solid #e4e4e4;
            border-top: 0px none;
            padding: 20px;
            line-height: 22px;
        }
        .tab-content > .tab-pane > h3{
            margin-top: 0;
        }

        body{
            margin :0 !important;
        }

        #container-div
        {
            padding: 0 !important;
        }

       

    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{URL::to('/assets/js/modal.js'

    )}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({ headers:
          {
            'X-CSRF-TOKEN':$(
                'meta[name="csrf_token"]'
                ).attr('content')
        }
    });
</script>
  
  <script>
  var token = '{{Session::token()}}';
  var province = '';
 var schoolsUrl = "route('schoolsPage',['province'=>''])";
  
</script>


@endsection

@section('content')

<div>
   <app-component></app-component>
</div>
     
 <!--<home :announcements="{{$announcements}}" :news="{{$news}}"></home>-->
        
@endsection
@include('includes.unavailableModal')

