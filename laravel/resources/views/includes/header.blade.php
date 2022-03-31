
  <nav class="navbar navbar-default fixed-top bg-white d-flex flex-row justify-content-between p-0" >
    <div class="navbar-header col-xl-4 col-lg-4 col-md-4  col-sm-4 col-12 d-flex">
      <!--==================SIDEBAR LEFT=========================-->
      <div class="d-md-none align-self-center"  style="z-index:10400 !important;">
            <button class="navbar-toggler" data-target="#left-sidebar"  data-toggle="collapse" type="button" aria-controls="left-sidebar" aria-expanded="false"   >
              <i class="fa fa-ellipsis-v fa-1x" style="color:#ff5500"></i>
            </button>
        </div> 

      <a  class="align-self-center navbar-brand" href="route('home')">
        <img class="wrap" id="banner"  src="{{URL::asset('/assets/img/bana.png')}}" style="height:2.4rem">
      </a>

      <!--===================Mobile Device========================================================-->
      <div class="dropdown dropleft show align-self-center ml-auto">

        @if(Auth::check())
        <a class="align-self-center ml-auto d-xl-none d-lg-none d-md-none d-sm-none feature-unavailable" hef-del="route('messages',['user'=>Auth::user()->slug])">
          <span>
            {{$numberMessages}}
            <i class="fa fa-envelope" style="padding-right:3px"></i>
          </span>
        </a>
        <a class="align-self-center ml-auto d-xl-none d-lg-none d-md-none d-sm-none" href="route('notifications',['user'=>Auth::user()->slug])">
          <span>
            {{$numberNotifications}}
            <i class="fa fa-bell" style="padding-right:3px"></i>
          </span>
        </a>

        @endif
        <a href="#" role="button" id="dropdown-content" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false" class=" dropdown-toggle align-self-center ml-auto d-xl-none d-lg-none d-md-none d-sm-none mr-1" title="" role="button" >
          <span class="mr-1">
            @if(Auth::check())
            <strong>{{Auth::user()->name}}</strong>
            @else 
            <i class="fa fa-lock" style="color:#ffd700;padding-right:2px"></i>
            login @endif
          </span>
        </a>


        @include('includes.dropdownMenu')
      </div>
      <a href="{{url('/register')}}" class="align-self-center d-xl-none d-lg-none d-md-none d-sm-none"  role="button" >
        <span>
          @if(Auth::check())  
          @else 
          <i class="fas fa-pen" style="color:orange"></i>
          register @endif
        </span>
      </a>

      <!--====================== MENU TOGGLE BUTTON ======================-->

        <div class="d-md-none align-self-center"  style="z-index:10400 !important;">
            <button class="navbar-toggler" data-target="#navigation-sidebar"  data-toggle="collapse" type="button" aria-controls="navigation-sidebar" aria-expanded="false"   ><i class="fa fa-bars fa-1x" style="color:#ff5500"></i></button>
        </div>

      <!--=================== END Mobile Device========================================================-->

    </div>
    <!--=================== SEARCH ========================================================-->
    <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4 col-xs-12" id="top-navbar" >
      @if((Route::currentRouteName() != "register"))
      <form  action="route('searchResults')"  role="search" method="POST"><!--make proper route-->

        <div class="input-group input-group-sm" style="padding-bottom: 10px;">
          <input type="text" class="form-control search-form form-control-sm" autocomplete="off" placeholder="Search" id="search" name="search" style="border-radius: 5rem;">
          <button class="btn btn-default search-btn btn-sm" type="submit" style="position: absolute;right: 0.28rem;border-radius: 7rem;height: 1.25rem; width: 1.25rem; /= Safari 3-4, iOS 1-3.2, Android 1.6- =/
          -webkit-border-radius: 7rem; 
          /= Firefox 1-3.6 =/
          -moz-border-radius: 7rem; padding: 0;bottom: 0.87rem;">
          <i class="fa fa-search" style="color:white;line-height: 1.25rem;font-size: 0.7rem;text-align: center;"></i>
        </button>
        </div>
        <input type="hidden" name="_token" value="{{Session::token()}}">
        <input type="hidden" name="userIdNo" value="@if(isset($userIdNo)){{$userIdNo}}@endif">
        <!-- SEARCH DROPDOWN -->
        <div class="content-list dont-close" id="list">
          <div>
          <ul class="drop-list dont-close">
            <li>
              <div class="form-check d-flex align-items-center  dont-close">
                <input type="hidden" name="search_institutions" value="0">
                <input type="checkbox" class="form-check-input mt-0  ml-0 dont-close " style="position: relative;" name="search_institutions" id="search-institutions">
                <label class="form-check-label dont-close" for="search-institutions">
                <span class="item dont-close">
                  <span class="icon people dont-close">
                    <i class="fas fa-university dont-close"></i>
                  </span>
                  <span class="text dont-close">
                  Institutions
                </span>
                </span>
              </label>
              </div>
              
            </li>
            <li>
              <div class="form-check d-flex align-items-center  dont-close">
                <input type="hidden" name="search_events" value="0">
                <input type="checkbox" class="form-check-input mt-0  ml-0 dont-close " name="search_events" style="position: relative;" id="search-events">
                <label class="form-check-label dont-close" for="search-events">
                <span class="item dont-close">
                  <span class="icon image dont-close">
                    <i class="fas fa-calendar-alt dont-close"></i>
                  </span>
                  <span class="text dont-close">
                  Events
                </span>
                </span>
              </label>
              </div>
              
            </li>
            <li>
              <div class="form-check d-flex align-items-center  dont-close">
                <input type="hidden" name="search_bursaries" value="0">
                <input type="checkbox" class="form-check-input mt-0  ml-0 dont-close " style="position: relative;" name="search_bursaries" id="search-bursaries">
                <label class="form-check-label dont-close" for="search-bursaries">
                <span class="item dont-close">
                  <span class="icon video dont-close">
                    <i class="fas fa-piggy-bank dont-close"></i>
                  </span>
                  <span class="text dont-close">
                  Bursaries
                </span>
                </span>
              </label>
              </div>
              
            </li>
            <li>
              <div class="form-check d-flex align-items-center  dont-close">
                <input type="hidden" name="search_needs" value="0">
                <input type="checkbox" class="form-check-input mt-0  ml-0 dont-close " style="position: relative;" name="search_needs" id="search-needs">
                <label class="form-check-label dont-close" for="search-needs">
                <span class="item dont-close">
                  <span class="icon place dont-close">
                    <i class="fas fa-hand-holding-heart dont-close"></i>
                  </span>
                  <span class="text dont-close">
                  Needs
                </span>
                </span>
              </label>
              </div>
              
            </li>
      
          </ul>
        </div>
          <div class="p-2 border-top">
            <button type="submit" name="" style="color: blue;border: none;background: transparent;">
              <h6>
                See all results for 
                <span id="search-for"></span>
              </h6>
            </button>
          </div>
        </div>
      </form>
      @endif
    </div>

        

          <!--===================Desktops Device========================================================-->

          <!--<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12 collapse navbar-collapse navbar-ex1-collapse d-sm-none d-xs-none" id="navbar"  >-->
            <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4 col-xs-12 d-flex align-items-center ">
             @if(Auth::check())
             <a class="d-none d-sm-none d-md-block ml-auto feature-unavailable" href-del="route('messages',['user'=>Auth::user()->slug]">
              <span>
                {{$numberMessages}}
                <i class="fa fa-envelope" style="padding-right:3px"></i>
              </span>
            </a>
           
           
            <div class="dropdown show" >
              <!--****************************************uncomment please**********************************************-->
              <notifications></notifications>

            </div>
          
            <!-- <notifications-dropdown></notifications-dropdown> -->
            @endif
            <div class="dropdown dropleft show align-self-center @if(!Auth::user()) ml-auto @endif">
              <a class="dropdown-toggle d-none d-sm-none d-md-block ml-auto" href="#" role="button" id="dropdown-content" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false"  title="" role="button" >
                <span>
                  @if(Auth::check())
                  {{Auth::user()->name}} 
                  @else 
                  <i class="fa fa-lock" style="color: #ffd700"></i>
                  login 
                  @endif
                </span>
              </a>
              @include('includes.dropdownMenu')
            </div>
            <a class="d-none d-sm-none d-md-block  ml-1" href="{{ url('/register/step-1')}}" class=" hidden-sm hidden-xs" role="button" >
              <span>
                @if(Auth::check())  
                @else 
                <i class="fas fa-pen"></i>
                register @endif
              </span>
            </a> 

            <!--===================END DESKop Device========================================================-->


          </div>
          <!--JUMBOTRON-->

          @if(!isset($userIdNo->name) || Route::currentRouteName() == "messages")

          @else
          <div class="jumbotron col-lg-12 col-sm-12 col-12 d-flex align-items-center" >
            <div class="media d-flex align-items-center p-2">
              <img class="rounded-circle mr-3 bg-white post-avatar" src="route('getProfilePic',['filename'=>$userIdNo->id])" id="jumbotron-image"  class="img-circle">
              <div class="media-body" >
                <h5 class="text-light mb-1" style="font-size: 0.755rem">
                  <a class="navbar-logo  ml-auto text-light" href="route('SchoolProfilePage',['userIdNo'=>$userPassedId->slug])" style="padding-right:6px">
                    @if(isset($userIdNo->name))
                    {{$userPassedId->name}}
                    @endif<!--{{$userPassedId}}-->

                  </a>
                </h5>
                @auth
                  @if($userIdNo->id != Auth::id())
                <a class="badge badge-pill badge-success " href="route('followUser',['likeableId'=>$userPassedId->slug])" >
                  <i class="fa fa-heart"> 
                    Follow us
                  </i>
                </a>
                
              </form>
                @endif
                @endauth
              </div>
            </div>

            @if(isset($userIdNo->name))
            <!--SEND MESSAGE-->
            <span class="ml-auto">
             @if(Auth::check() && Auth::id() != $userIdNo->id)
             <a class="ml-auto text-light"  href="#" data-recipient="{{$userIdNo->slug}}">
              <i class="fas fa-splotch fa-1x rate-us"></i>
            </a> 
            <a class="ml-auto text-light" href="#" data-recipient="{{$userIdNo->slug}}">
              <i class="fa fa-envelope fa-1x send-message"></i>
            </a> 
            @endif

            @if(Auth::check() && Auth::id()==$userIdNo->id && Route::currentRouteName() != 'getFeed') 
                <a class="ml-auto text-light" href="Route('getFeed',['user'=>$userIdNo])" data-recipient="{{$userIdNo->slug}}">
              <i class="fas fa-rss-square fa-1x"></i>
              <span class="ml-1">
                feed
              </span>
            </a> 
            @endif
            <!--HELP-->
            <a class="align-items-center ml-auto border-right text-light"  href="route('getHelpPage')">
              <i class="fa fa-question-circle fa-1x"></i>
              Help
            </a>
            <!--ABOUT US-->
            <a class="align-items-center ml-auto text-light" href="route('userDetails',['user'=>$userPassedId->slug])">
              <i class="fa fa-info-circle fa-1x"></i>
              About us
            </a>
          </span>
          @endif  
        </div>

        @endif
        <!--END JUMBOTRON-->

      </nav>






<!--include('includes.messagesModal')
include('includes.ratingModal')
include('includes.deleteConfirmationModal')-->

