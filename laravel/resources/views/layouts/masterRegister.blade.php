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
    <link href="{{URL::asset('/assets/css/registration.css')}}" rel='stylesheet' />
    
    <script type="text/javascript" src="{{URL::to('/assets/js/modal.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({ headers:
          {
            'X-CSRF-TOKEN':$(
                'meta[name="csrf_token"]'
                ).attr('content')
        }
    });
</script>

</head>
<body>
    <div id="app">
    @if(Route::currentRouteName() == 'login')
        @include('includes.header')
    @endif
    <div class="fadeMe"></div>
    <div class="d-flex row m-auto  col-12 align-items-center" style="padding: 1.25rem;z-index: 12;position: absolute" id="container-div">
        
        <!--Buttons-->


        <div class="card mx-auto my-auto register rounded col-12 col-md-9 align-self-center" style="vertical-align: middle">
            <div class="card-body row m-0 p-0">
                <div class="col-md-3 d-none d-md-block register-left p-1">
                    <a href="{{Route('home')}}">
                    <img class="wrap" id="banner"  src="{{URL::asset('/assets/img/bana1.png')}}" style="height:4.4rem">
                    <h5>
                        Bana
                    </h5>
                    </a>

                    <p>
                        You are a few steps away from connecting with other academics!
                    </p>
                    @if(Route::currentRouteName() == 'register')
                    <div class="progress">
                        <div class="progress-bar" id="register-progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    @endif
                    <br/>
                </div>
                <div class="col-12 col-md-9 register-right">  
                    <h4 class="register-heading mt-2">
                        @yield('registrationType')
                    </h4>
                    <div class="col-12 register-form ">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-0" style="padding: 0">

            <!-- PUT STUDENT SUPPORT MODL HERE -->
            @include('includes.studentSupportModal')
                <!--content from different pages gets added here by laravel-->  
        </div>
    </div>
    <!--END PAGE CONTENT-->

    @include('includes.agreement')
     <!--END PAGE CONTENT-->
    
    @if(Route::currentRouteName() == 'login')
        @include('includes.footer')
    @endif

    </div>
</body>
</html>
