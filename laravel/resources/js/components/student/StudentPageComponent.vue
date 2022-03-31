<template>
    <div>
    	<!--==============================STUDENTS CENTER=====================================-->
     <div role="tabcard" class="col-12 tab-pane container-fluid p-0" id="gallery" style="background-color: transparent;">
      <!--==============================FEATURED===================================-->
      <div class="card">
        <nav>
          
          <div class="card-header nav nav-tabs p-0 border-bottom" id="nav-tab" role="tablist">
            <div class="pb-0 p-3  col-12" style="padding-bottom: 0 !important">
            <h4 style="display: inline;">
              <i class="fas fas1 fa-images"></i>
               Students
            </h4>

            <!--Add student dropdown button-->
            <div v-if="auth.auth_owner_of_post(auth_user,user) && authenticated">
            <a class="p-1 studentdropdown"  style="float: right !important" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-cog" style="color:#c5c7cb"></i>
            </a>
            <a class="p-1"  style="float: right !important">
              <i class="fas fa-wrench" style="color:#c5c7cb">
              </i>
            </a>
            <a class="p-1 " style="float: right !important">
              <i class="fas fa-chevron-up " style="color:#c5c7cb"></i>
            </a>
			       <!--Add student dropdown menu-->
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            	<a class="dropdown-item"  href="#" data-toggle="modal" data-target="#featuredStudentModal">
                Featured Student
              </a>
            	<a class="dropdown-item" href="#" data-toggle="modal" data-target="#studentAwardModal">
                Student Award
              </a>
            	<a class="dropdown-item" href="#" data-toggle="modal" data-target="#studentProjectModal">
                Student Project
              </a>
            </div>

            <form action="route('createPost')" method="POST" enctype="multipart/form-data">
              <input type="file" id="add-picture" name="addPicture" style="display: none;">
              <button type="submit" id="submit-photo" class="btn btn-primary btn-xs" style="display:none">
                Submit
              </button> 
              <input type="hidden"  name="_token" value="{csrf_token()}">
            </form>
        </div>

          </div>
            <a class="nav-item nav-link active gallery-link" id="1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="cover-photos" aria-selected="true" style="padding: 0.5rem 1.25rem !important">
              <i class="fas fas1 fa-images">
              </i>
              Featured
            </a>


            <a class="nav-item nav-link p-2 gallery-link" id="2"  data-toggle="tab" href="#tab-2" role="tab" aria-controls="profile-photos" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
              <i class="fas fas1 fa-award "></i>
              Awards
            </a>

            <a class="nav-item nav-link p-2 gallery-link" id="3" href="#tab-3" data-toggle="tab" ria-controls="other-photos" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
              <i class="fas fas1 fa-chalkboard-teacher"></i>
              Projects
            </a>

          </div>
        </nav>
        <!-- wrapper -->
        <!-- <div class="card-body p-0"> -->
          <!--====================================FEATURED STUDENTS=============================================-->
          <div class="tab-content card-body p-0" id="nav-tabContent">
            <div class="tab-pane fade show active col-12 p-2 container" style="margin-bottom: 5rem" id="tab-1" role="tabpanel" aria-labelledby="cover-photos-tab" >
              <!--Featured students get added here-->
              <div id="tab-1-data">
               <image-post   :key="1" :key_="1" tab_number="1" url="featured-students" returnVal="featured_student" :options="featured_student_options"></image-post>
              </div>

            </div><!-- end tab pane -->

            <!-- ===================================AWARDS PANE============================================= -->
            <div class="tab-pane fade col-12 p-2 container" style="margin-bottom: 5rem" id="tab-2" role="tabpanel" aria-labelledby="profile-photos-tab">
             
             <div id="tab-2-data" > 



 <image-post   :key="2" :key_="2" tab_number="2" url="student-awards" returnVal="student_award" :options="student_award_options"></image-post>




            </div>
            </div><!-- END PROFILE PANE -->
            <!-- ==================================PROJECTS PANE============================================= -->
            <div class="tab-pane fade col-12 p-2 container" id="tab-3" role="tabpanel" aria-labelledby="other-photos-tab">
              <div id="tab-3-data" > 
               
<image-post   :key="3" :key_="3" tab_number="3" url="student-projects" returnVal="student_project" :options="student_project_options"></image-post>








              </div>
            </div><!-- END OTHER PANE -->
          </div><!-- end tab-content -->
          <!-- </div> --><!-- end wrapper -->
        </div><!-- end content -->
         <hr>
      </div> 

      <!-- <add-student-award :students="$students"></add-student-award>
      <add-featured-student :students="$students"></add-featured-student>
      <add-student-project :students="$students" :user="$userIdNo"></add-student-project> -->

    </div>
</template>

<script>
	import {Auth} from '../../Auth.ts';
	import {Post} from '../../Post.ts';
	import ImagePostComponent from '../post/ImagePostComponent';
	import { mapGetters } from 'vuex';
    export default {
        /*props: ['name', 'description','date','category','colid','colbid'],*/
         components:{
      'image-post':ImagePostComponent,
    },
        data:function()
		{
			return {
				post:null,
				auth: new Auth(),
				student_project_options:{show_carousel:true,show_carousel_on:'participants',caption:'name'},
				student_award_options:{show_carousel:false},
				featured_student_options:{show_carousel:false},
			}
		},
        mounted() {
            console.log(this.$refs)
        },
        computed:
        {
        	//get the auth status and user
          	...mapGetters({
            	authenticated: 'auth/authenticated',
            	auth_user: 'auth/user',
            	user:'user',
        	}),
        }
    }
</script>
