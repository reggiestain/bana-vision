<template>
		<div role="tabcard" class="tab-pane active" id="overview">
			<div class="card">
            <nav>
            	<div class="card-header nav nav-tabs p-0 border-bottom" id="nav-tab" role="tablist">
            		<div class="pb-0 p-3  col-12" style="padding-bottom: 0 !important">
            			<h4  style="display: inline;">
            				<i class="fas fas1 fa-hourglass-half"></i>
            				  Overview
            			</h4>
            			<!--Add videos-->
            			<a class="p-1 tab-icon-p "  style="float: right !important"  role="button" id="videos-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            				<i class="fas fa-plus" style="color: #c5c7cb"></i>
            			</a>
            			<!--Add videos dropdown-->
            			<div class="dropdown-menu" aria-labelledby="videos-dropdown">
            				<a class="dropdown-item" href="#" id="add-video-option">
            					<i class="fas fa-plus"> Add video</i>
            				</a>
            			</div>
            			<!---->
            			<a class="p-1 tab-icon-p "  style="float: right !important">
            				<i class="fas fa-wrench" style="color: #c5c7cb"></i>
            			</a>
            			<a class="p-1 tab-icon-p "  style="float: right !important">
            				<i class="fas fa-cog" style="color: #c5c7cb"></i>
            			</a>
            		</div>
            		<a class="nav-item nav-link active gallery-link " id="4" data-toggle="tab" href="#user-activities" role="tab" aria-controls="user-activities" aria-selected="true" style="padding: 0.5rem 1.25rem !important">
            			<i class="fas fas1 fa-user-clock">
            			</i>
            			<span class="d-none d-md-flex">Activities</span>
            		</a>


            		<a class="nav-item nav-link gallery-link p-2" id="5"  data-toggle="tab" href="#followers" role="tab" aria-controls="followers" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
            			<i class="fas fas1 fa-user-friends "></i>
            			<span class="d-none d-md-flex">Followed By</span>
            		</a>

            		<a class="nav-item nav-link gallery-link p-2" id="6" href="#following" data-toggle="tab" ria-controls="following" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
            			<i class="fas fas1 fa-user-check"></i>
            			<span class="d-none d-md-flex">Following</span>
            		</a>
			<a class="nav-item nav-link gallery-link p-2" id="7" href="#dashboard" data-toggle="tab" ria-controls="dashboard" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
            			<i class="fas fas1 fa-qrcode"></i>
            			<span class="d-none d-md-flex">Dashboard</span>
            		</a>

            	</div>
        	</nav>


        	<div class="tab-content card-body p-0" id="nav-tabContent">
        		<div class="tab-content card-body p-0" id="nav">
        	            	<div class="tab-pane fade show active col-12 p-2 container" id="user-activities" role="tabpanel" aria-labelledby="cover-photos-tab" >
        	              		<div id="cover-photo-data">
        	                 	</div>
        	                </div>

         		<!--================================================FOLLOWERS================================================-->
         		<div class="tab-pane fade  col-12 p-2 container" id="followers" role="tabpanel" aria-labelledby="cover-photos-tab" >
         			<div id="cover-photo-data">
                <!--uses this to load post and their images 3 at a time-->
                <image-post   :key="1" :key_="1" tab_number="1" url="followers" returnVal="followers" options="followers_options"></image-post>
         			</div>
         		</div>
           

          		<!--================================================FOLLOWING================================================-->
          		<div class="tab-pane fade col-12 p-2 container" id="following" role="tabpanel" aria-labelledby="cover-photos-tab" >
          			<div id="cover-photo-data">
          				<!--uses this to load post and their images 3 at a time-->
                  <image-post   :key="1" :key_="1" tab_number="1" url="followings" returnVal="followings" options="followings_options"></image-post>
          			</div>
          		</div>

            <div class="tab-pane fade col-12 p-2 container" id="dashboard" role="tabpanel" aria-labelledby="cover-photos-tab" >
              <!-- <sponsored-users></sponsored-users> -->
            </div>
        
			</div>
        </div>
    </div>
    </div>
</template>
<script>
  import ImagePostComponent from '../../../components/post/ImagePostComponent';
	export default
	{
		props:['followers','following'],
    components:{
      'image-post':ImagePostComponent,
    },
		data:function()
		{
			return{
        facilities_options:{
          show_carousel:true,
          show_carousel_on:'participants',
          caption:'name'
        },
			}
		},
		computed:
		{

		},
		methods:
		{
			profile_pic:function(user_id)
      		{
        		return '/profile-picture/'+user_id
      		},
		}
	}
</script>
