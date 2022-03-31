
@extends('layouts.masterProfile')

@section('title')

@if(isset($numberMessages)){{'('.$numberMessages.') '.$userIdNo->name}}
@else
{{$userIdNo->name}}
@endif
@endsection
@section('content')
@include('includes.message-block')
<!--GOOGLE SEARCHABLE KEYBOARDS-->
@section('seoKeywords')
bana , school , {{$userIdNo->name}}
@endsection
@section('seoDescription')
@if($userIdNo->usable_type == 'App\School')
{{$userIdNo->usable->about}}
@endif
@endsection

@section('styles')
<link href="{{URL::asset('/assets/css/placeholder-loading.css')}}" rel='stylesheet' />
<!--<link href="{{URL::asset('/assets/css/adminlte.min.css')}}" rel='stylesheet' /> -->
@endsection


<profile-area useridno="{{$userIdNo->id}}" username="{{$userIdNo->name}}" auth_id="{{Auth::id()}}"></profile-area>
<div v-if="isLoading" class="col-12 ajax-load p-0 mt-2" style="max-height: 400px">
  <div class="ph-item p-0 mb-0">
    <div class="ph-col-12 p-0">
      <div class="ph-picture mb-0" style="height:315px"></div>
      <span id="profilepic">

        <div  class="ph-picture mb-0 bg-white" style="width: 8rem;height: 8rem;position: absolute;bottom: -1rem;left: 2rem;
        padding: 0.35rem;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);z-index:500"></div>
      </span>
      <div class="card col-6 col-md-2 p-0 m-0" id="sponsored-card">
        <div class="ph-item p-0 mb-0">
          <div class="ph-col-12 p-0">
           <div class="ph-picture mb-0" style="height:315px"></div>
         </div>
       </div>
     </div>

   </div>
 </div>
</div>
 <!--  <p><img src="{{URL::asset('/assets/img/loader.gif')}}">Loading More post</p>
 -->


 <div class="container-fluid bg-white" >
  <!-- ==================================== NAVIGATION TABS ==================================== -->
  <ul class="nav nav-tabs  " id="tab-menu" role="tablist" >
    <!--==================OVERVIEW TAB==================-->
    <li role="presentation" class=" nav-item active border-right profile-nav">
      <a class="nav-link active" href="#overview" aria-controls="home" role="tab" data-toggle="tab">
        <i class="fa fa-asterisk fa-nav-tab">
      </i>
       <span class="d-none d-md-flex">Overview</span>
     </a>
   </li>
   
   <!--==================DETAILS TAB==================-->
   <li role="presentation" class="nav-item  border-right" >
    <a class="nav-link" href="#details" aria-controls="details"  role="tab" data-toggle="tab">
      <i class="fa fa-info-circle fa-nav-tab">
      </i>
      <span class="d-none d-md-flex">Details</span>
    </a>
  </li>
  <!--==================GALLERY TAB==================-->
  <li role="presentation" class="nav-item  border-right" >
    <a class="nav-link" href="#gallery" aria-controls="gallery"  role="tab" data-toggle="tab">
      <i class="fa fa-images fa-nav-tab">
      </i>
      <span class="d-none d-md-flex">Gallery</span>
    </a>
  </li>

  @if($userIdNo->usable_type == 'App\School')
  <!--==================ACTIVITIES TAB==================-->
  <li role="presentation" class="nav-item  border-right" >
    <a class="nav-link" href="#activities" aria-controls="activities"  role="tab" data-toggle="tab">
      <i class="fa fa-swimmer fa-nav-tab">
      </i>
      <span class="d-none d-md-flex">Activities</span>
    </a>
  </li>
  <!--==================FACILITITES TAB==================-->
  <li role="presentation" class="nav-item  border-right" >
    <a class="nav-link" href="#facilities" aria-controls="facilities"  role="tab" data-toggle="tab">
      <i class="fa fa-swimming-pool fa-nav-tab">
      </i>
      <span class="d-none d-md-flex">Facilities</span>
    </a>
  </li>

   <!--==================USER SPONSORED TAB==================-->
       <!--  <li role="presentation" class="nav-item" >
          <a class="nav-link" href="#sponsored-users" aria-controls="settings" role="tab" data-toggle="tab">
            <i class="fa fa-cog fa-nav-tab"></i>
            <span class="d-none d-md-flex">Sponsored Users</span>
          </a>
        </li> -->
  @endif
  <!--==================USER SETTINGS TAB==================-->
  @if (Auth::user())
  @if(Auth::user()->name == $userIdNo->name && Auth::user()->id == $userIdNo->id)

  <li role="presentation" class="nav-item" >
    <a class="nav-link" href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
      <i class="fa fa-cog fa-nav-tab"></i>
      <span class="d-none d-md-flex">Settings</span>
    </a>
  </li>

  @endif
  @endif
  <!--==================TEACHERS TABS==================-->
  @if (Auth::user())
  @if(Auth::id() == $userIdNo->id && Auth::user()->usable_type == 'App\Staff' && Auth::user()->usable->teacher->count() )
  
  <li role="presentation" class="nav-item" >
    <a class="nav-link" href="#attendance" aria-controls="attendance" role="tab" data-toggle="tab">
      <i class="fa fa-cog fa-nav-tab"></i>
      <span class="d-none d-md-flex">Attendance</span>
    </a>
  </li>

  @endif
  @endif

  @if (Auth::user())
  @if(Auth::id() == $userIdNo->id && Auth::user()->usable_type == 'App\Student' )
  <li role="presentation" class="nav-item" >
    <a class="nav-link" href="#timetable" aria-controls="attendance" role="tab" data-toggle="tab">
      <i class="fa fa-cog fa-nav-tab"></i>
      <span class="d-none d-md-flex">Timetable</span>
    </a>
  </li>
  @endif
  @endif
</ul>
</div>  <!--END NAVIGATION TABS-->   
<!---->
<!--TABS-->
<div class="container-fluid p-0 m-0 mt-4" style="margin-top: 0.5rem;" >
  <div class="row col-12 m-0 p-0" style="align-items: flex-start;"> 
    <div class="col-12 col-xl-2 col-lg-2 col-md-2  d-none d-md-flex " id="left-sidebar">
      @include('includes.sidebarLeft')
    </div>
    <!-- Tab panes -->



    <div class=" col-12 p-0">
      <div class="card p-0 ml-2 mr-2" style="max-width: 32.25rem;" id="tab-panes" >
        <div class=" tab-content card-body p-0">
          <!--==============================OVERVIEW====================================-->
          <overview :followers="{{$followers}}" :following="{{$followings}}"></overview>
          <!--==============================DETAILS=====================================-->
          <detail :useridno="{{$userIdNo}}" rating="{{$userIdNo->usable_type == 'App\School' ? $rating : ''}}"></detail> <!--****************************fix the rating **********************************-->


          <!--==============================GALLERY=====================================-->
          <div role="tabcard" class="col-12 tab-pane container-fluid p-0" id="gallery" style="background-color: transparent;">
            <!--==============================PHOTOS===================================-->
            <div class="card">
              <nav>

                <div class="card-header nav nav-tabs p-0 border-bottom" id="nav-tab" role="tablist">
                  <div class="pb-0 p-3  col-12">
                    <h4 style="display: inline;">
                      <i class="fas fas1 fa-images"></i>
                      Photos
                    </h4>
                    @auth
                    @if(Auth::id() == $userIdNo->id)
                    <a class=" p-1" href="#" role="button" id="photosMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog fa-card-options"></i>
                    </a>

                    <!--===========================================================================-->
                    <div class="dropdown-menu" aria-labelledby="photosMenuLink">
                      <a class="dropdown-item  OpenimgUpload" href="#">
                        Add image
                      </a>
                    </div>
                    <!--===========================================================================-->
                    @endif
                    @endauth
                    <a class="p-1">
                      <i class="fas fa-wrench fa-card-options">
                      </i>
                    </a>
                    <a class="p-1 ">
                      <i class="fas fa-chevron-up fa-card-options"></i>
                    </a>
                    @auth
                    @if(Auth::id() == $userIdNo->id)

                    <form @submit.prevent="createPost" enctype="multipart/form-data">
                      <input type="file" id="add-picture" @change="addpicture" style="display: none;">
                      <button type="submit" id="submit-photo" class="btn btn-primary btn-xs" style="display:none">
                        Submit
                      </button> 
                    </form>
                    @endif
                    @endauth

                  </div>
                  <a class="nav-item nav-link active gallery-link" id="1" data-toggle="tab" href="#cover-photos" role="tab" aria-controls="cover-photos" aria-selected="true">
                    <i class="fas fas1 fa-images">
                    </i>
                    Cover
                  </a>


                  <a class="nav-item nav-link p-2 gallery-link" id="2"  data-toggle="tab" href="#profile-photos" role="tab" aria-controls="profile-photos" aria-selected="false">
                    <i class="fas fas1 fa-images "></i>
                    Profile
                  </a>

                  <a class="nav-item nav-link p-2 gallery-link" id="3" href="#other-photos" data-toggle="tab" ria-controls="other-photos" aria-selected="false">
                    <i class="fas fas1 fa-images"></i>
                    Other
                  </a>

                </div>
              </nav>
              <!-- wrapper -->
              <!-- <div class="card-body p-0"> -->
                <div class="tab-content card-body p-0" id="nav-tabContent">
                  <div class="tab-pane fade show active col-12 p-2 container" id="cover-photos" role="tabpanel" aria-labelledby="cover-photos-tab" >
                    <div id="cover-photo-data">
                      <!--include('coverPhotoData')-->
                      <image-post v-bind:posts="{{$cover_photos}}"   page="page1" user_name_slug="{{str_slug($userIdNo->name, '.')}}" post_type="cover" :useridno="{{$userIdNo}}" auth_id="{{Auth::id()}}"></image-post>
                    </div>
                  </div><!-- end tab pane -->

                  <!-- ===================================PROFILE PANE============================================= -->
                  <div class="tab-pane fade col-12 p-2 container" id="profile-photos" role="tabpanel" aria-labelledby="profile-photos-tab">
                    <div id="profile-photo-data">
                      <!--include('profilePhotoData')-->
                      <image-post v-bind:posts="{{$profile_photos}}"   page="page2" user_name_slug="{{str_slug($userIdNo->name, '.')}}" post_type="profile" :useridno="{{$userIdNo}}" auth_id="{{Auth::id()}}"></image-post>
                    </div>
                  </div><!-- END PROFILE PANE -->
                  <!-- ==================================OTHER PANE============================================= -->
                  <div class="tab-pane fade col-12 p-2 container" id="other-photos" role="tabpanel" aria-labelledby="other-photos-tab">
                    <div id="other-photo-data">
                      <image-post v-bind:posts="{{$post_photos}}"   page="page3" user_name_slug="{{str_slug($userIdNo->name, '.')}}" post_type="post" :useridno="{{$userIdNo}}" auth_id="{{Auth::id()}}"></image-post>
                      <!--include('otherPhotoData')-->
                    </div>
                  </div><!-- END OTHER PANE -->
                </div><!-- end tab-content -->
                <!-- </div> --><!-- end wrapper -->
              </div><!-- end content -->
              <hr>
              <!--============================================VIDEOS=============================================-->
              <div class="card mt-3">
                <nav>

                  <div class="card-header nav nav-tabs p-0 border-bottom" id="nav-tab" role="tablist">
                    <div class="pb-0 p-3  col-12" >
                      <h4  style="display: inline;">
                        <i class="fas fas1 fa-video"></i>
                        Videos
                      </h4>
                      <!--Add videos-->
                      <a class="p-1"  role="button" id="videos-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-plus fa-card-options"></i>
                      </a>
                      <!--Add videos dropdown-->
                      <div class="dropdown-menu" aria-labelledby="videos-dropdown">
                        <a class="dropdown-item" href="#" id="add-video-option"><i class="fas fa-plus"> Add video</i></a>
                      </div>
                      <!---->
                      <a class="p-1">
                        <i class="fas fa-wrench fa-card-options"></i>
                      </a>
                      <a class="p-1">
                        <i class="fas fa-cog fa-card-options"></i>
                      </a>
                    </div>
                    <a class="nav-item nav-link active gallery-link " id="4" data-toggle="tab" href="#cover-photos" role="tab" aria-controls="cover-photos" aria-selected="true">
                      <i class="fas fas1 fa-images">
                      </i>
                      Cover
                    </a>


                    <a class="nav-item nav-link gallery-link p-2" id="5"  data-toggle="tab" href="#profile-photos" role="tab" aria-controls="profile-photos" aria-selected="false">
                      <i class="fas fas1 fa-images "></i>
                      Profile
                    </a>

                    <a class="nav-item nav-link gallery-link p-2" id="6" href="#other-photos" data-toggle="tab" ria-controls="other-photos" aria-selected="false">
                      <i class="fas fas1 fa-images"></i>
                      Other
                    </a>

                  </div>
                </nav>
                <!-- wrapper -->
                <!-- <div class="card-body p-0"> -->
                  <div class="tab-content card-body p-0" id="nav-tabContent">
                    <div class="tab-pane fade show active col-12 p-0"  role="tabpanel" aria-labelledby="cover-photos-tab" >

                      <form action="{{route('saveVideo')}}" method="POST" enctype="multipart/form-data">
                        <input type="file" name="video" id="video-input" style="display: none" >
                        <input type="hidden" name="video_type" value="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" style="display: none">submit</button>
                      </form>
                      @foreach($post_videos->chunk(3) as $chunk)
                      <div class="row m-0">
                        @foreach($chunk as $post_)
                        <div class="col-4 d-flex align-items-center justify-content-center ">

                          @if($post_->videos->first()->thumbnail_name)
                          <i class="far fa-play-circle fa-4x  mx-auto" style="z-index: 200;position: absolute;color: #f7f7f7"></i>
                          <img class="video-image " data-body="{{$post_->body}}" src="{{route('getPostPic',['filename'=>$post_->videos->first()->thumbnail_name,'folder'=>'post'])}}" style="max-width:100%;height: 100%;width:100%" data-video="{{route('getVideo',['video_id'=>$post_->videos->first()->id])}}">
                          @endif
                        </div>
                        @endforeach
                      </div>
                      @endforeach
                      @include('includes.addVideoModal')

                    </div><!-- end tab pane -->

                    <!-- ===================================PROFILE PANE============================================= -->
                    <div class="tab-pane fade"  role="tabpanel" aria-labelledby="profile-photos-tab">
                      <h1>profile photos</h1>
                    </div><!-- END PROFILE PANE -->
                    <!-- ==================================OTHER PANE============================================= -->
                    <div class="tab-pane fade"  role="tabpanel" aria-labelledby="other-photos-tab">
                      <h1>other photos</h1>
                    </div><!-- END OTHER PANE -->
                  </div><!-- end tab-content -->
                  <!-- </div> --><!-- end wrapper -->
                </div><!-- end content -->
              </div>               

              <!-- ===================================SETTINGS============================================= -->
              <settings :useridno="{{$userIdNo}}"></settings>


              <!--==============================ATTENDANCE=====================================-->
              @auth
              @if(Auth::id() == $userIdNo->id && Auth::user()->usable_type == 'App\Staff' && Auth::user()->usable->teacher->count() )
              <div role="tabcard" class="col-12 p-2 tab-pane container-fluid " id="attendance" style="background-color: transparent;">
                <h5>This is the attendance tab</h5>

                <form>
                  <div class="form-row m-0">
                    <div class="col">
                      <select class="form-control form-control-sm" id="exampleFormControlSelect1" placeholder="week">
                        @for($i=1;$i<=52;$i++)
                        <option value="{{$i}}">week {{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    @if(isset($teachers_students))
                    <div class="col">
                      <select type="text" list="teachers_students" class="form-control form-control-sm" placeholder="school_student" name=>
                        @foreach($teachers_students->unique() as $student)
                        <option value="{{$student->id}}">{{$student->surname.' '.$student->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col">
                      <select type="text" list="teachers_students" class="form-control form-control-sm" placeholder="school_student">
                        @foreach($teachers_students->unique() as $student)
                        <option value="{{$student->grade.'-'.$student->class}}">{{$student->grade.' '.$student->class}}</option>
                        @endforeach
                      </select>
                    </div>
                    @endif
                  </div>
                  <div class="text-center">
                    <div class="btn-group mt-2 d-flex ml-auto mr-auto" style="text-align: center;" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-secondary btn-sm mr-2">get attendance</button>
                      <button type="button" class="btn btn-secondary btn-sm mr-2" id="create-school-student-attendance">create attendance</button>
                      <button type="button" class="btn btn-secondary btn-sm">Right</button>
                    </div>
                  </div>
                </form>
                @include('includes.addSchoolStudentAttendanceModal')
              </div>
              @endif
              @endauth

              <!--=======================TIMETABLE=======================-->
              <div role="tabcard card" class="tab-pane p-3" id="timetable">
                <table class="table table-bordered  table-hover table-responsive ">
                  <thead>
                    <tr  class="table-dark">
                      <th scope="col">Time</th>
                      <th scope="col">Monday</th>
                      <th scope="col">Tuesday</th>
                      <th scope="col">Wednesday</th>
                      <th scope="col">Thursday</th>
                      <th scope="col">Friday</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row" style="background-color:#f5f8fa">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row" style="background-color:#f5f8fa">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row" style="background-color:#f5f8fa">3</th>
                      <td colspan="2">Larry the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
              </div><!--end timetable-->

              @if($userIdNo->usable_type == 'App\School')
              <!--=========================================FACILITIES=========================================-->
              <facilities auth_id="{{Auth::id()}}" :facilities="{{$userIdNo->usable->facilities}}" :useridno="{{$userIdNo}}"></facilities>

              <!--=========================================ACTIVITIES=========================================-->
              <activities auth_id="{{Auth::id()}}" :activities="{{$userIdNo->usable->activities}}" :useridno="{{$userIdNo}}"></activities>

              
              @endif
            </div>

          </div> <!--end tabs-->

        </div>
        <div class="col-12 col-xl-2 col-lg-2 col-md-2  p-0 ">
          @include('includes.sidebarRight') 
        </div>
      </div>
    </div>







  </div>
  <!---->



  <!--PERSONAL INFORMATION-->


  <div type="hidden" id="page_username" data-username="{{$userIdNo->name}}"></div>
  <div type="hidden" id="user_id" data-userId="{{$userIdNo->id}}"></div>
  <div type="hidden" data-about="about"></div>
  <div type="hidden" data-imageUrl="imageurl"></div>




  <!-- show fullscreen Modal -->
  <div class="modal fade" id="show-fullscreen-modal" tabindex="-1" role="dialog" aria-labelledby="show-fullscreen" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="margin-left: auto !important;margin-right: auto !important">
      <div class="modal-content" style="min-height: 85vh">

        <div class="modal-body p-0 bg-dark">
          <img id="fullscreen-image" class="figure-img img-fluid d-block mx-auto" alt="" style=" ">
        </div>

      </div>
    </div>
  </div>
  @section('scripts')
   <script type="text/javascript"  src=" {{URL::asset('/assets/js/jquery.min.js')}}"></script>
   <script type="text/javascript"  src=" {{URL::asset('/assets/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript"  src=" {{URL::asset('/assets/js/flot/jquery.flot.js')}}"></script>
  <script type="text/javascript" src=" {{URL::asset('/assets/js/flot/plugins/jquery.flot.resize.js')}}"></script>
  @if(isset($userIdNo))
  <script>

    var urlDeleteUser = "{{route('deleteUser',['userIdNo'=>$userIdNo])}}";
  </script>
  @endif
  <!--Basic Scripts-->
  <script type='text/javascript'>
    var token = '{{Session::token()}}';
    var urlEdit= '{{route('edit')}}';
    var urlLike= '{{route('like')}}';
  </script>
  <script>
 //redirect to specific tab
 $(document).ready(function () {
   $('#tab-menu a[href="#{{ old('tab') }}"]').tab('show');
   $('#tab-menu a[href="#{{ session('tab') }}"]').tab('show');
 });

/**********************************************************************************************
* Lazily load the pages on a tab
***********************************************************************************************
*
*
*/
  /*var cover =1;
  var profile=1;
  var other=1;
  $(document).ready(function(){

  $(window).scroll(function() {

      if($(window).scrollTop() + $(window).height() >= $(document).height()) {

          if($(".nav-item.active.show").attr('id') == 'cover-photos-tab')
          {
            alert("scrolling");
            cover++;
            loadMoreData(cover,'cover','#cover-photo-data');
          }
          else if ($(".nav-item.active.show").attr('id') == 'profile-photos-tab')
          {
            profile++;
            loadMoreData(profile,'profile','#profile-photo-data');
          }
          else  if ($(".nav-item.active.show").attr('id') == 'other-photos-tab')
          {
            other++;
            loadMoreData(other,'other','#other-photo-data');
          }

      }

  });

});

  function loadMoreData(page,page_name,place_id){

    $.ajax(

          {

              url: '?'+page_name+'=' + page,

              type: "get",

              beforeSend: function()

              {
                  /*setTimeout(function(){ 
                    console.log("setting timeout"+page);
                    $('.ajax-load').show(); }, 30000);
                    */
              //}

          //})

         /* .done(function(data)

          {

              if(data.html == " "){

                  $('.ajax-load').html("No more records found");

                  return;

              }

            // $('.ajax-load').hide();
              $('.ajax-load').fadeIn();
              $(place_id).append($('ajax.load'));
              $(place_id).append(data.html);

          })

          .fail(function(jqXHR, ajaxOptions, thrownError)

          {

                alert('server not responding...');

          });

        }*/

      </script>
      @endsection

      @endsection
