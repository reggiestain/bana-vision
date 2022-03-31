<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset ="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="{{ asset('js/app.js') }}" ></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('/assets/css/styling.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/responsive.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/fonts/fontawesome/css/all.min.css')}}"/>

    <!-- styles from ntsiki -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>-->
 <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="{{URL::asset('/assets/css/aside.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/assets/css/main.css')}}"> -->

    
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href="{{URL::asset('/assets/img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('/assets/img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('/assets/images/favicon-16x16.png')}}">
    <!--end styles from ntsiki-->


    <script type="text/javascript" src="{{URL::asset('/assets/js/profile_page.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('/assets/js/ui.js')}}"></script>

</head>
<body> 
<!-- style="background-color:#f0f0f0 "> -->
    <div id="app">
        <!-- ========================= Header ========================= -->
       <site-header></site-header>
       <div class="container-fluid p-0 " id="container-div" >

        <component v-bind:is="this.$store.state.current_component"></component>

        <page-content>
            <!-- component found at  resources/components/bana/PageContentComponent -->
        </page-content>
    </div>
    <!--<postpic-modal ref="getpostpic"></postpic-modal>-->
</div>
@yield('scripts')
<script>
  var token = '{{Session::token()}}';
  var token1 = '{{csrf_token()}}';
</script>
<script type="text/javascript">
  //unavailable-modal
  $(document).on('click','.feature-unavailable',function(event){
      $('#unavailable-modal').modal();
  });
</script>
</body>
</html>
