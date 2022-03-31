<template>
	<!--==============================STUDENTS CENTER=====================================-->
	<div role="tabcard" class="col-12 tab-pane container-fluid p-0" id="gallery" style="background-color: transparent;">
		<!--==============================FEATURED===================================-->
		<div class="card">
			<nav>

				<div class="card-header nav nav-tabs p-0 border-bottom" id="nav-tab" role="tablist">
					<div class="pb-0 p-3  col-12" style="padding-bottom: 0 !important">
						<h4 style="display: inline;">
							<i class="fas fas1 fa-users">
							</i>
							   Users
						</h4>
						<div v-if="auth_id == useridno._id">

							<!--Add student dropdown button-->
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
								<a class="dropdown-item"  href="#" data-toggle="modal" data-target="#addStudentModal" v-on:click="addStudent">
									<i class="fas fa-plus">
									</i>
									add student
								</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#addStaffModal" v-on:click="addStaff">
									<i class="fas fa-plus">
									</i>
									add staff
								</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#addClassModal" v-on:click="addClass">
									<i class="fas fa-plus">
									</i>
									add class
								</a>
							</div>


							<form action="route('createPost')" method="POST" enctype="multipart/form-data">
								<input type="file" id="add-picture" name="addPicture" style="display: none;">
								<button type="submit" id="submit-photo" class="btn btn-primary btn-xs" style="display:none">
									Submit
								</button> 
								<input type="hidden"  name="_token" value="csrf_token()">
							</form>

						</div>
					</div>
					<a class="nav-item nav-link active gallery-link" id="1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="student-photos" aria-selected="true" style="padding: 0.5rem 1.25rem !important">
						<i class="fas fas1 fa-user-graduate">
						</i>
						Students
					</a>


					<a class="nav-item nav-link p-2 gallery-link" id="2"  data-toggle="tab" href="#tab-2" role="tab" aria-controls="staff-photos" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
						<i class="fas fas1 fa-user-tie "></i>
						Staff
					</a>

					<a class="nav-item nav-link p-2 gallery-link" id="3" href="#other-photos" data-toggle="tab" ria-controls="other-photos" aria-selected="false" style="padding: 0.5rem 1.25rem !important">
						<i class="fas fas1 fa-images"></i>
						Projects
					</a>

				</div>
			</nav><!--end nav-->
			
				<!--====================================SCHOOL STUDENTS===================================-->
				<div class="tab-content card-body p-0" id="nav-tabContent">
					<div class="tab-pane fade show active col-12 p-2 container" id="tab-1" role="tabpanel" aria-labelledby="student-photos-tab" >

						<!--Featured students get added here-->
						<div id="tab-1-data">
							<div class="row m-0" v-for="chunk in chunkedPosts">
								<div class="col-4" v-for="student in chunk">
									<figure class="figure">
										<img :src="getPostImg(student,'school_student')" class="figure-img img-fluid rounded-circle" alt="A generic square placeholder image with rounded corners in a figure." style="max-width: 100%;width:7rem;object-fit: cover;border-radius:50%;width: 50px;height: 50px;" v-on:click="admininfo(student)" >

										<figcaption class="figure-caption" style="    text-align: center;" >
											{{student.name+' '+student.surname}}
										</figcaption>
									</figure>
								</div><!--end innerloop-->
							</div><!--end outerloop-->
						</div>

					</div><!-- end tab pane -->

					<!-- ===================================staffS=================================== -->
					<div class="tab-pane fade col-12 p-2 container" id="tab-2" role="tabpanel" aria-labelledby="staff-photos-tab">

						<div id="tab-2-data" >
							<!--include('studentAwardData')-->
							<div class="row m-0" v-for="chunk1 in chunkedPosts1">
								<div class="col-4" v-for="staff in chunk1">
									<figure class="figure">
										<img :src="getPostImg(staff,'staff')"    class="figure-img img-fluid rounded-circle" alt="A generic square placeholder image with rounded corners in a figure." style="max-width: 100%;width: 6rem;object-fit: cover;border-radius:50%;width: 50px;height: 50px;">

										<figcaption class="figure-caption">
											{{staff.name+' '+staff.surname}}
										</figcaption>
									</figure>
								</div>
							</div>
						</div>
					</div><!-- END PROFILE PANE -->
					<!-- ==================================PROJECTS PANE============================================= -->
					<div class="tab-pane fade col-12 p-2 container" id="tab-3" role="tabpanel" aria-labelledby="other-photos-tab">

					</div><!-- END OTHER PANE -->
				</div><!-- end tab-content -->
				<!-- </div> --><!-- end wrapper -->
			</div><!-- end content -->
			<hr>
			<add-student :useridno="useridno"></add-student>
			<admin-info :student="student"></admin-info>
			<add-staff :useridno="useridno"></add-staff>
			<add-class></add-class>
			
	</div> 
</template>
<script>
	export default
	{
		props:['auth_id','useridno','students','staff'],
		data:function()
		{
			return {
				groupPosts:this.students,
				groupPosts1:this.staff,
				student:null,
			}
		},
		methods:
		{
			getPostImg: function(name,xtra_info = null) 
			{
				var pth;
				console.log(name);
				if(name.images)
				{


					pth = name.images[0].path;
					name = name.images[0].name;

            		//return '/sub-picture/'+name+'/'+name.substring(0, name.lastIndexOf('-'))+'-';
        		}
        		else if(name.imageable)
        		{
        			pth = name.imageable[0].path;
					name = name.imageable[0].name;
        		}
        		else
        		{
        			var img;
        			img = name[xtra_info].images[0];
        			pth = img.path;
        			name = img.name;
        		}
        		return '/sub-picture/'+name+'/'+pth.replace(/\//g,"-");

    		},
    		admininfo:function(student)
    		{
    			this.student = student; //set the current student
    			$('#admin-info-modal').modal();
    		},
    		addStudent:function()
    		{
    			$('#add-student-modal').modal(); //launch the add student modal
    		},
    		addStaff:function()
    		{
    			$('#add-staff-modal').modal(); //launch the add staff modal
    		},
    		addClass:function()
    		{
    			$('#add-class-modal').modal(); // launch the add class modal 
    		}
		},
		computed:
		{
			chunkedPosts () 
        	{
        		var that = this;
        		this.$store.state.posts.forEach(function(post){
                   post.forEach(function(pst){
                    if(!that.groupPosts.includes(pst)) //doesn't include this post already
                    {
                      that.groupPosts.push(pst);
                    }
                       });
            });
        		console.log(_.chunk(this.groupPosts,3));

        		return _.chunk(this.groupPosts,3);
        	},
        	chunkedPosts1 () 
        	{
        		var that = this;
        		this.$store.state.posts1.forEach(function(post){
                   post.forEach(function(pst){
                    if(!that.groupPosts1.includes(pst)) //doesn't include this post already
                    {
                      that.groupPosts1.push(pst);
                    }
                       });
            });
        		console.log(_.chunk(this.groupPosts1,3));

        		return _.chunk(this.groupPosts1,3);
        	},
		}
	}
</script>