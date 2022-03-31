<!--
=
=
=  LEFT SIDEBAR
=
=
=
=
-->
<div class="col-12 row m-0 pl-0 pr-0">
 <div class="card col p-1 d-none" style="max-height: 21rem" >
    <div class="card-body p-1" style="text-align: center;">    
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <span class="text-muted d-flex mr-auto">
            Sponsored
          </span>
          <div class="carousel-item active">
            <img class="d-block w-100 figure-img" src="{{URL::asset('/assets/img/add_1.jpg')}}" alt="First slide" style="width:12rem;height:12rem">
            <div class="btn-group mt-1" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Left
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Middle
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem" >
                Right
              </button>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 figure-img" src="{{URL::asset('/assets/img/add_2.jpg')}}" alt="Second slide" style="width:12rem;height:12rem">
            <div class="btn-group mt-1" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Left
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Middle
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem" >
                Right
              </button>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 figure-img" src="{{URL::asset('/assets/img/add_3.jpg')}}" alt="Third slide" style="width:12rem;height:12rem">
            <div class="btn-group mt-1" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Left
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Middle
              </button>
              <button type="button" class="btn btn-secondary btn-sm"  style="font-size:0.6rem">
                Right
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>

    </div> 
    <div class="col-6" style="position: absolute;bottom: -5rem;">
      <a href="{{route('getAboutUsPage')}}">
        <small class="text-muted feature-unavailable" style="font-size: 86% ">
          About us -
      </small>
    </a>
      <a href="#">
        <small class="text-muted feature-unavailable" style="font-size: 86% ">
         Get involved -
      </small>
      </a>
      <br>
      <a href="#">
        <small class="text-muted feature-unavailable" style="font-size: 86% ">
         Things to know - 
      </small>
      </a>
      <a href="#"  data-toggle="modal" data-target="#student-support">
        <small class="text-muted" style="font-size: 86%">
       Student support
      </small>
      </a>
      <br>
      <img class="wrap" src="{{URL::asset('/assets/img/bana.png')}}" style="height:1.8rem">
      <small class="text-muted feature-unavailable" style="font-size: 86% ">
        Bana &#169; {{now()->year}}
      </small>
    </div> 

    @switch(Route::currentRouteName())
      @case("searchResults")

      <div class="row  col-12" style="margin-left: 0.5rem;padding: 0">
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <h6 class="text-muted mr-auto ml-auto">
              Edit Search
            </h6>
            <div class="form-check mr-1">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
              <label class="form-check-label" for="exampleRadios1">
                Default radio
              </label>
            </div>
            <div class="form-check mr-1">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
              <label class="form-check-label" for="exampleRadios2">
                Second default radio
              </label>
            </div>
            <div class="form-check disabled mr-1">
              <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
              <label class="form-check-label" for="exampleRadios3">
                Disabled radio
              </label>
            </div>
          </div>
        </div>
      </div>
          @break

      @case("generalStudentAwards")

        <student-award-filter></student-award-filter>
          @break

          @case("schoolsPage")
            <schools-search-filter></schools-search-filter>
          @break

      @case("generalFeaturedStudents")
          <featured-student-filter></featured-student-filter>
          @break

      @case("generalStudentProjects")

      <student-search-filter></student-search-filter>
          @break

      @case("generalBursaries")
          <bursaries-search-filter></bursaries-search-filter>
          @break

      @case("generalNeeds")
          <needs-search-filter></needs-search-filter> 
      @break

      @case("generalEvents")
          <events-search-filter></events-search-filter> 
      @break

      @case("messages")

      @break
       @case("getAnnouncements")
        <announcements-sidebar-left></announcements-sidebar-left>
      @break
      <!--============================LIBRARY============================-->
      @case("library")
      <div class="row  col-12" style="margin-left: 0.5rem;padding: 0">
        <div class="card col-12" style="padding:0.5rem" >
          
          <div class="card-body" style="padding: 0 0.25rem">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action">
                Cras justo odio
              </a>
              <a href="#" class="list-group-item list-group-item-action">
                Dapibus ac facilisis in
              </a>
              <a href="#" class="list-group-item list-group-item-action">
                Morbi leo risus
              </a>
              <a href="#" class="list-group-item list-group-item-action">
                Porta ac consectetur ac
              </a>
              <a href="#" class="list-group-item list-group-item-action disabled">
                Vestibulum at eros
              </a>
            </div>
          </div>
        </div>
      </div>
          @break
      <!--============================ADMIN============================-->
      @case('getAdminPage')
      <div class="row  col-12" style="margin-left: 0.5rem;padding: 0">
        <div class="card col-12" style="padding:0.5rem" >
          <div class="card-body" style="padding: 0 0.25rem">
            <h5 class="card-title text-muted" style="text-align: center;">
              <i class="fas fa-briefcase" style="color: brown"></i>
               Tools
            </h5>
            <div class="list-group">
              <a href="{{route('getMakeTimetablePage',['user'=>$userIdNo])}}" class="list-group-item list-group-item-action">
               <i class="fas fa-table" style="color: #6b8e23"></i>
                Timetable
              </a>
              <a href="{{route('getCurriculumn',['user'=>$userIdNo])}}" class="list-group-item list-group-item-action">
                <i class="fas fa-chalkboard-teacher" style="color: #cbbf6d"></i>
               Curriculumn
              </a>
              <a href="{{route('getBooks',['user'=>$userIdNo])}}" class="list-group-item list-group-item-action">
                <i class="fas fa-book" style="color:#a52a2a"></i>
                 Books
              </a>
            </div>
          </div>
        </div>
      </div>
      @break

      <!--============================BOOKS============================-->
      @case('getBooks')
        <div class="row  col-12" style="margin-left: 0.5rem;padding: 0">
        <div class="card col-12" style="padding:0 !important" >
          
          <div class="card-body" style="padding: 0 !important">
            <div id="books-div" style="padding:0 !important">
              @piechart('books', 'books-div')
            </div>
            <hr>
            <div id="loan-div" style="padding-left: 0.14rem;">
              
            </div>
            @areachart('loan','loan-div')
          </div>
        </div>
      </div>
      @break

      @case("companiesPage")

        <companies-search-filter></companies-search-filter>
      @break

      @case("organizationsPage")

        <organizations-search-filter></organizations-search-filter>
      @break

      <!--============================DEFAULT============================-->
      @default
      @if (isset($userIdNo))
      @switch($userIdNo->usable_type)
      @case('App\School')
      <div class="row  col-12" style="margin-left: 0.5rem;padding: 0">
        <!-- =======================================FEATURED STUDENTS=============================================== -->
        <div class="card col-12" style="padding:0.5rem;min-height:3rem">
            @if($userIdNo->usable->featuredStudents()->count() > 0)
          <div class="card-body" style="padding: 0 0.25rem">
           <div >
            <p  style="float:left;">
              <strong>
                @yield('header-title-1')
              </strong>
            </p >
            <p style="float: right;">
              <a href="{{route('studentAwards',['user'=>$userIdNo->slug])}}">
               more 
             </a>
           </p>
         </div>
         <!-- FEATURED STUDENTS CAROUSEL -->
         <div id="carouselFeaturedControls" class="carousel slide " data-ride="carousel">
          
          <div class="carousel-inner">
          
           @foreach($userIdNo->usable->featuredStudents()->get() as $key=>$featured_student )
           <div class="carousel-item @if($key == 0)active @endif ">
            <figure class="figure" style="padding-left: 0rem;padding-right: 0.1rem;max-height: 6rem;overflow: hidden;">
              <img class="d-block w-100 figure-img  " src="{{'/post-picture/'.$userIdNo->slug.'/students/'.$featured_student->images->first()->name.'/'.$featured_student->school_student_id.'/profile'}}" alt="First slide" style="height: 100%">
            </figure>
            <figcaption class="figure-caption">
                {{$featured_student->achievements}}
              </figcaption>
          </div>
          @endforeach
          

        </div>
        <a class="carousel-control-prev" href="#carouselFeaturedControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">
            Previous
          </span>
        </a>
        <a class="carousel-control-next" href="#carouselFeaturedControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">
            Next
          </span>
        </a>
      </div>
      <!-- END FEATURED STUDENTS CAROUSEL -->
      <!-- INTERACTIONS -->
      <div class="row m-0 border-top " >
        <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
          <a href="#">
            <span style="display: block;">
              <i class="fas fa-share-alt"></i>
            </span>
          </a>
          <small>share</small>

        </div>
        <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
          <a href="#">
            <span style="display: block;">
              <i class="fas fa-eye"></i>
            </span>
          </a>
          <small>view</small>

        </div>
        <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
          <a href="#">
            <span style="display: block;">
              <i class="fas fa-rss"></i>
            </span>
          </a>
          <small>subscribe</small>

        </div>
      </div>
      <!-- END INTERACTIONS -->
    </div>

    @else
            <h1 class="lead">Nothing to display at the moment</h1>
          @endif
  </div>

  <!-- =======================================STUDENT PROJECTS=============================================== -->
  <div class="card col-12" style="padding:0.5rem" >
@if($userIdNo->usable->featuredStudents()->count() > 0)
    <div class="card-body" style="padding: 0 0.25rem">
     <div >
      <p  style="float:left;" class="muted-text">
        <strong>
          Student Projects
        </strong>
      </p >
      <p style="float: right;">
        
       <a class="p-1" >
        <i class="fas fa-chevron-up " style="color:#c5c7cb"></i>
      </a>
      <a class="p-1"  >
        <i class="fas fa-wrench" style="color:#c5c7cb">
        </i>
      </a>
      <a class="p-1 ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="z-index: 6000" >
        <i class="fas fa-cog" style="color:#c5c7cb">
        </i>
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="{{route('studentAwards',['user'=>$userIdNo->slug])}}">
         more 
       </a>
      </div>
     </p>
   </div>

   <!-- STUDENT PROJECTS CAROUSEL -->
   <div id="carouselProjectControls" class="carousel slide " data-ride="carousel">
    <div class="carousel-inner">
    @foreach($userIdNo->usable->studentProjects()->get() as $key=>$project )
           <div class="carousel-item @if($key == 0)active @endif " >
            <figure class="figure" style="padding-left: 0rem;padding-right: 0.1rem;max-height: 6rem;overflow: hidden;">
              <img class="d-block w-100 figure-img  " src="{{route('getSubfolderPic',['filename'=>$project->images->first()->name,'folder'=>str_replace('/','-',$project->images->first()->path)])}}" alt="First slide" style="height: 100%">
              
            </figure>
            <figcaption class="figure-caption">
               {{$project->name}}
              </figcaption>
          </div>
          @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselProjectControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true">
        
      </span>
      <span class="sr-only">
        Previous
      </span>
    </a>
    <a class="carousel-control-next" href="#carouselProjectControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">
        Next
      </span>
    </a>
  </div>
  <!-- END STUDENT PROJECTS CAROUSEL -->
  <!-- INTERACTIONS -->
  <div class="row border-top " style="margin: 0;">
    <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
      <a href="#">
        <span style="display: block;">
          <i class="fas fa-share-alt"></i>
        </span>
      </a>
      <small>share</small>

    </div>
    <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
      <a href="#">
        <span style="display: block;">
          <i class="fas fa-eye"></i>
        </span>
      </a>
      <small>view</small>

    </div>
    <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
      <a href="#">
        <span style="display: block;">
          <i class="fas fa-rss"></i>
        </span>
      </a>
      <small>subscribe</small>

    </div>
  </div>
  <!-- END INTERACTIONS -->
</div>
@else
            <h1 class="lead">Nothing to display at the moment</h1>
          @endif
</div>
</div>
@break
@default
@endswitch
@endif <!--end of if on generic picture-->
    @endswitch

    @if(Route::currentRouteName() != "searchResults" && Route::currentRouteName() != "library")

@else
  
@endif
</div>

@include('includes.unavailableModal')




