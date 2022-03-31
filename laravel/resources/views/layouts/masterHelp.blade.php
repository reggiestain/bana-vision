<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset ="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
   <!--<link rel="stylesheet" href="{{URL::asset('/assets/css/bootstrap.min.css')}}"/>-->

    <!-- <link rel="stylesheet" href="{{URL::asset('assets/css/beyond.min.css')}}"/>-->
    <!-- <script src="{{ asset('assets/js/app.js') }}" ></script> -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('/assets/css/styling.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/responsive.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/fonts/fontawesome/css/all.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/dropzone.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/jquery.jgrowl.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('/assets/css/jquery.flexdatalist.min.css')}}"/>
    <link href="{{URL::asset('/assets/css/fullcalendar.min.css')}}" rel='stylesheet' />
    <link href="{{URL::asset('/assets/css/registration.css')}}" rel='stylesheet' />
    <link href="{{URL::asset('/assets/css/fullcalendar.print.min.css')}}" rel='stylesheet' media='print' />


    <!--<script type="text/javascript" src="{{URL::asset('/assets/js/jquery-3.1.1.min.js')}}"></script>-->
    <script type="text/javascript" src="{{URL::asset('/assets/js/modernizr.custom.js')}}"></script>
   <!--  <script type="text/javascript" src="{{URL::asset('/assets/js/bootstrap.min.js')}}"></script> -->
    <script type="text/javascript" src="{{URL::asset('/assets/js/dropzone.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/assets/js/jquery.jgrowl.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/assets/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/assets/js/jquery.flexdatalist.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/assets/js/fullcalendar.min.js')}}"></script>
   
    <script>

        /*Menu-toggle*/
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
            alert("im clicked");
        });
    </script>


    <script type="text/javascript" src="{{URL::to('/assets/js/modal.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('/assets/js/registration.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('/assets/js/ui.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({ headers:
          {
            'X-CSRF-TOKEN':$(
                'meta[name="csrf_token"]'
                ).attr('content')
        }
    });
</script>

    <!--<script type="text/javascript" src="{{URL::asset('assets/js/beyond.min.js'

    )}}"></script>-->

</head>
<body>
    @include('includes.helpHeader')


    @yield('content')
    

        <div class="row m-0" style="padding: 0">

            <!-- PUT STUDENT SUPPORT MODL HERE -->
            @include('includes.studentSupportModal')
        </div>
    </div>
    <!--END PAGE CONTENT-->

    @include('includes.agreement')
     <!--END PAGE CONTENT-->
    @include('includes.footer')
     <!--search script-->
    <script>
  var token = '{{Session::token()}}';
  var token1 = '{{csrf_token()}}';
  var urlEditEvent = '{{route('editEvent')}}';
  var urlAddMessage = '{{route('sendMessage')}}';
  $(document).on('click','#search' ,function(event){
        
        event.stopPropagation();
        

        $("#list").fadeIn("fast");
        
      });
      
      $(document).click( function(event){
        if(!($(event.target).hasClass("dont-close"))) 
       {
          $('#list').hide();
        }
        

      });
      $(document).on('input','#search',function(event){
          console.log(this.value);
          document.getElementById('search-for').innerText = '"' +this.value+'"';
      });
     
</script>
<!--Feature unavailable-->
<script type="text/javascript">
  //unavailable-modal
  $(document).on('click','.feature-unavailable',function(event){
      $('#unavailable-modal').modal();
  });
</script>
    
</body>
</html>
