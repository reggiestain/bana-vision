
  <nav class="navbar  navbar-expand-lg fixed-top bg-white d-flex flex-row justify-content-between text-light" style="background-color: #ff5500 !important" role="navigation">
    <div class="container-fluid">

    <!--====================================NAVBAR HEADER====================================-->
    <div class="navbar-header col-12 d-flex row m-0 p-0 align-items-center">
      <div class="col-12 row m-0">
        <div class="col-3 p-0">
          <a  class=" navbar-brand m-0" href='{{route('home')}}'>
            <img class="wrap" id="banner"  src="{{URL::asset('/assets/img/bana1.png')}}" style="height:2.4rem">
          </a>

          <h6 class="d-inline text-light">Help</h6>
        </div>

        <!--====================================TOGGLE BUTTON====================================-->
        <button class="navbar-toggler btn ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <i class="fas fa-bars text-light"></i>
      </button><!--end toggle button-->

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!--====================================HELP OPTIONS====================================-->
        <ul class=" nav navbar-nav nav-tabs col-9 text-light" style="margin-top: 0.45rem;border:none; !important">
          <li class="nav-item dropdown">
            <a class="nav-link text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><h6>Using Bana</h6></a>
            <div class="dropdown-menu ">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><h6>Managing account</h6></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
              <h6>
              Privacy
            </h6>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">
              <h6>
              Contact us
            </h6>
            </a>
          </li>
        </ul>

        <!--====================================REGISTER LINK====================================-->
        <div class="col-3 row m-0">
          <a class="ml-auto text-light" href="{{ url('/register/step-1')}}" class=" hidden-sm hidden-xs" role="button">
            <h6>register</h6>   
          </a> 
        </div><!--end register-->
      </div>

    </div>
    
    
 
</div><!--end navbar header-->

    <!-- ================================================-SEARCH ================================================-->
    <div class="d-none d-md-flex col-md-3"></div>
    <div class="col-md-6 col-12" id="top-navbar" style="padding:0 2rem">
      
      <form  action="{{route('searchResults')}}"  role="search" method="POST">
        <label for="search"><h3>How can we help you?</h3></label>
        <div class="input-group input-group-sm" style="padding-bottom: 10px;">

          <input type="text" class="form-control search-form form-control-sm" autocomplete="off" placeholder="Search" id="search" name="search" style="border-radius: 5rem;">
          <button class="btn btn-default search-btn btn-sm" type="submit" style="position: absolute;right: 0.28rem;border-radius: 7rem;height: 1.25rem; width: 1.25rem; /= Safari 3-4, iOS 1-3.2, Android 1.6- =/
          -webkit-border-radius: 7rem; 
          /= Firefox 1-3.6 =/
          -moz-border-radius: 7rem; padding: 0;bottom: 0.87rem;"><i class="fa fa-search text-light" style="line-height: 1.25rem;font-size: 0.7rem;text-align: center;"></i></button>
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
                  <span class="text dont-close">Institutions</span>
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
                  <span class="text dont-close">Events</span>
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
                  <span class="text dont-close">Bursaries</span>
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
                  <span class="text dont-close">Needs</span>
                </span>
              </label>
              </div>
              
            </li>
      
          </ul>
        </div>
          <div class="p-2 border-top">
            <button type="submit" class="text-primary" name="" style="border: none;background: transparent;"><h6>See all results for <span id="search-for"></span></h6></button>
          </div>
        </div>
      </form>
    </div>
      <div class="d-none d-md-flex col-md-3"></div>
        <!--END JUMBOTRON-->
        </div>
      </nav>






@include('includes.messagesModal')
@include('includes.ratingModal')
@include('includes.deleteConfirmationModal')

