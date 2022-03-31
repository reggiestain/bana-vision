<template>
   <div>
    <!--<profile-area user="{{$user->id}}" username="{{$user->name}}" auth_id="{{Auth::id()}}"></profile-area>-->
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



 <!---->
 <!--TABS-->
 <div class="container-fluid p-0 m-0"  >

   <!-- ==========================MAK POSTS  ==========================-->
    <div v-if="auth.auth_owner_of_post(auth_user, user) && authenticated">
      <make-post
        :user="auth_user"
        :usable_type="auth_user.usable_type"
        :included_posts="included_posts"
      ></make-post>
    </div>

  <!-- Tab panes -->

  <div class=" col-xl-12 col-lg-12 col-md-12 col-12 p-0 ">
    <div class="card p-0 ml-2 mr-2" style="max-width: 32.25rem;" id="tab-panes" >
      <div class=" tab-content card-body p-0">
        <!--==============================OVERVIEW====================================-->
        <overview></overview>
        <!--==============================DETAILS=====================================-->
        <detail :user_="user"></detail> <!--****************************fix the rating **********************************-->


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

                  <div v-if="auth.auth_owner_of_post(auth_user, user)">
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
                  </div><!--end if auth-->

                  <a class="p-1">
                    <i class="fas fa-wrench fa-card-options">
                    </i>
                  </a>
                  <a class="p-1 ">
                    <i class="fas fa-chevron-up fa-card-options"></i>
                  </a>
                  <div v-if="auth.auth_owner_of_post(auth_user, user)">

                    <form @submit.prevent="createPost" enctype="multipart/form-data">
                      <input type="file" id="add-picture" @change="addpicture" style="display: none;">
                      <button type="submit" id="submit-photo" class="btn btn-primary btn-xs" style="display:none">
                        Submit
                      </button> 
                    </form>
                  </div><!--end if auth-->

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
                    <!-- <image-post posts="cover_photos"   page="page1" user_name_slug="user" post_type="cover" :user="user" auth_id="Authid"></image-post> -->
                  </div>
                </div><!-- end tab pane -->

                <!-- ===================================PROFILE PANE============================================= -->
                <div class="tab-pane fade col-12 p-2 container" id="profile-photos" role="tabpanel" aria-labelledby="profile-photos-tab">
                  <div id="profile-photo-data">
                    <!--include('profilePhotoData')-->
                    <!-- <image-post posts="profile_photos"   page="page2" user_name_slug="user" post_type="profile" :user="user" auth_id="Authid"></image-post> -->
                  </div>
                </div><!-- END PROFILE PANE -->
                <!-- ==================================OTHER PANE============================================= -->
                <div class="tab-pane fade col-12 p-2 container" id="other-photos" role="tabpanel" aria-labelledby="other-photos-tab">
                  <div id="other-photo-data">
                    <!-- <image-post posts="post_photos"   page="page3" user_name_slug="user" post_type="post" :user="user" auth_id="Authd"></image-post> -->
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

                    <form action="route('saveVideo')" method="POST" enctype="multipart/form-data">
                      <input type="file" name="video" id="video-input" style="display: none" >
                      <input type="hidden" name="video_type" value="post">
                      <input type="hidden" name="_token" value="csrf_token()">
                      <button type="submit" style="display: none">submit</button>
                    </form>
                    <!-- <div v-for="chunk in post_videos">
                      <div class="row m-0" v-for="post_ in chunk">
                        <div class="col-4 d-flex align-items-center justify-content-center ">
                          <div v-if="post.thumbnail_name">
                            <i class="far fa-play-circle fa-4x  mx-auto" style="z-index: 200;position: absolute;color: #f7f7f7"></i>
                            <img class="video-image " data-body="post.body" src="route('getPostPic',['filename'=>$post_->videos->first()->thumbnail_name,'folder'=>'post'])" style="max-width:100%;height: 100%;width:100%" data-video="route('getVideo',['video_id'=>$post_->videos->first()->id])">
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <!--@include('includes.addVideoModal')-->

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
            </div> <!-- end gallery -->              

            <!-- ===================================SETTINGS============================================= -->



            <div v-if="auth.auth_owner_of_post(auth_user, user) && authenticated">
            <settings></settings>
          </div>


            <!--==============================ATTENDANCE=====================================-->
            <div v-if="auth.auth_owner_of_post(auth_user, user) && auth.user_is_of_type(auth_user.usable_type,['staff_member','teacher'])"><!--auth_s-->
              <div role="tabcard" class="col-12 p-2 tab-pane container-fluid " id="attendance" style="background-color: transparent;">
                <h5>This is the attendance tab</h5>

                <form>
                  <div class="form-row m-0">
                    <div class="col">
                      <select v-for="i in 52" class="form-control form-control-sm" id="exampleFormControlSelect1" placeholder="week">
                        <option value="$i">week {{i}}</option>
                      </select>
                    </div>
                    <div v-if="teachers_students"><!--teachers_student-->
                      <div class="col">
                        <select v-for="student in teachers_students" type="text" list="teachers_students" class="form-control form-control-sm" placeholder="school_student" name=>
                          <option value="student.id">{{student.surname+' '+student.name}}</option><!--change value-->
                        </select><!--end students loop-->
                      </div>

                      <div class="col">
                        <select v-for=" student in teachers_students" type="text" list="teachers_students" class="form-control form-control-sm" placeholder="school_student">
                          <option value="student->grade.'-'.$student->class">{{student.grade+' '+student.class}}</option> <!--change value-->
                        </select>
                      </div>
                    </div><!--end if teacher student-->
                  </div>
                  <div class="text-center">
                    <div class="btn-group mt-2 d-flex ml-auto mr-auto" style="text-align: center;" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-secondary btn-sm mr-2">get attendance</button>
                      <button type="button" class="btn btn-secondary btn-sm mr-2" id="create-school-student-attendance">create attendance</button>
                      <button type="button" class="btn btn-secondary btn-sm">Right</button>
                    </div>
                  </div>
                </form>
                <!--@include('includes.addSchoolStudentAttendanceModal')-->
              </div>
            </div><!--end auth-->

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

              <!--=========================================FACILITIES=========================================-->
              <facilities></facilities>

              <!--=========================================ACTIVITIES=========================================-->
              <activities></activities>

              <!-- <school-filter></school-filter> -->
          </div><!-- end tab content -->

        </div> <!--end tabs panes-->

      </div><!-- end tab panes parent -->
    </div> <!-- end container fluid -->

      <!---->
      <!--PERSONAL INFORMATION-->

<!-- 
  <div type="hidden" id="page_username" data-username="user->name"></div>
  <div type="hidden" id="user_id" data-userId="user->id"></div>
  <div type="hidden" data-about="about"></div>
  <div type="hidden" data-imageUrl="imageurl"></div> -->

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
</div>
</div>
</template>

<script>
import DetailsComponent from '../../../components/user/profile/DetailsComponent';
import OverviewComponent from '../../../components/user/profile/OverviewComponent';
import SettingsComponent from '../../../components/user/profile/SettingsComponent';
import FacilitiesComponent from '../../../components/school/FacilitiesComponent';
import ActivitiesComponent from '../../../components/school/ActivitiesComponent';
import ImagePostComponent from '../../../components/post/ImagePostComponent';
import SearchSchoolComponent from '../../../components/bana/SearchSchoolComponent';
import {Post} from '../../../Post.ts';
import { Auth } from '../../../Auth.ts';
import { mapGetters } from 'vuex';
export default {
  data: function() {
          return {
            auth: new Auth(),
             included_posts: ["needs", "bursaries", "events"],
          }
      },
      components:{
      'detail':DetailsComponent,
      'overview':OverviewComponent,
      'settings':SettingsComponent,
      'image-post':ImagePostComponent,
      'facilities':FacilitiesComponent,
      'activities':ActivitiesComponent,
      'school-filter':SearchSchoolComponent,
    },
      methods:
      {
        //====================================abstract this method
        
      },
      computed:
      {
        //get the auth status and user
          ...mapGetters({
            authenticated: 'auth/authenticated',
            auth_user: 'auth/user',
            user:'user'
        })
      },
      mounted()
      {
        this.post.get(this,'/api/'+this.$route.params.slug+'/',1,'user_id','user');
      }
}
  //redirect to specific tab
/*  $(document).ready(function () {
    $('#tab-menu a[href="#{{ old('tab') }}"]').tab('show');
    $('#tab-menu a[href="#{{ session('tab') }}"]').tab('show');
  });*/
</script>