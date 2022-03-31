<template>
	<div>
    <!--===========================LOADING SPINNER===========================-->
    <div class="d-flex col-12 loader-wrap" v-if="searchloading" style="min-height: 6rem;margin-top: 10rem">
        <div class="loader">
          <span class="loader-item"></span>
          <span class="loader-item"></span>
          <span class="loader-item"></span>
          <span class="loader-item"></span>
          <span class="loader-item"></span>
          <span class="loader-item"></span>
          <span class="loader-item"></span>
          <span class="loader-item"></span>
          <span class="loader-item"></span>
          <span class="loader-item"></span>
        </div>
    </div>

    <!--==========================================no results message==========================================-->
    <div class="card card-custom col-12 mt-2  border border-warning" v-if="searchResults">
      <div class="card-body">
      <h2>
        <i class="fas fa-search"></i>
        <span class="ml-2">
        No results to display at the moment!
      </span>
      </h2>
    </div>
    </div><!--end no results message-->

		<div v-if="!searchloading" v-for="(chunk,chunkIndex) in chunkedPosts">
	<div class="card card-custom d-flex mt-2 ">
  <div class="card-header">
    <div v-if="chunk.shared"> <!--this event is shared on a timeline-->
    <div class="media d-flex align-items-center p-0 pb-2">
      <img class="rounded-circle mr-3 img-circle bg-white post-avatar" :src="profile_pic(chunk.shared_user_id)" id="jumbotron-image"  >
      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
          <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->shared_user_slug])" style="padding-right:6px">
            {{chunk.shared_user_name}} <span style="color:#000000">shared a student project</span>
          </a>
        </h5>
        <a style="color: black" >
         $post->created_at->format('j F g:i A')
       </a>
     </div>
     <!--===========================SHARED POST MORE OPTIONS BUTTON==============================-->
     <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v "></i>
    </a>
    <!--============================SHARED POST OPTIONS DROPDOWN========================================-->
     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <div v-if="!isRouteStudentAwardsPage"><!--is route bursary-->
        <a class="dropdown-item" href="route('ourNeeds',['user'=>$post->user])">more needs from </a>
        </div><!--end is route-->
      
    </div>
   </div>
</div><!--end is shared-->

   <div class="media d-flex align-items-center p-0 pb-2">
   	<div v-if="!chunk.shared"><!--is shared-->
      <img class="rounded-circle mr-3 img-circle bg-white post-avatar" :src="profile_pic(chunk.school.user[0].id)" id="jumbotron-image" >
      </div><!--end is shared-->
      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
          <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->shared_user_slug])" style="padding-right:6px">
            {{chunk.school.user[0].name}} 
          </a>
        </h5>
        <a style="color: black" >
         {{chunk.created_at}}
       </a>
     </div>
     <!--===========================SHARED POST MORE OPTIONS BUTTON==============================-->
     <div v-if="!chunk.shared"><!--is shared-->
     <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v "></i>
    </a>
    </div><!--end if-->
    <!--============================SHARED POST OPTIONS DROPDOWN========================================-->
     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <div v-if="!chunk.isRouteStudentAwardsPage">
        <a class="dropdown-item" href="route('ourNeeds',['user'=>$post->user])">more needs from </a>
        </div><!--end is project-->
      
    </div>
   </div>
  
  </div>
  <img class="card-img-top show-photo"  :src="getProjectPic(chunk)" alt="Schools brand picture" style="background-color:beige;max-height: 30rem; "  v-on:click="showphoto(chunk,0)">
    <!--============================CARD BODY===============================-->
  <div class="card-body" style="padding: 0"> 
      <div class="col-12 row" style="background-color: #eff1f3;padding: 0;margin: 0">
      <!--==============================EVENT CALENDAR==============================-->
      <div class="col-3 p-3" style="    text-align: center;">
        <span class="fa-stack fa-2x">
          <i class="fas fa-chalkboard-teacher fa-stack-2x" style="color:#4169e1"></i>
        </span>
      </div>
      <!--==============================EVENT DETAILS==============================-->
      <div class="col-9 p-3" >
        <h5>
          <strong class="text-dark">
            {{chunk.name}} , ({{chunk.date}})
          </strong>
        </h5>
        category : {{chunk.category}}
            <p class="text-muted">
              {{chunk.description}}
            </p>

      </div>
   </div>

   <div class="col-12 p-4 m-0" style="background-color: #eff1f3">
     <h1>Participants:</h1>
     <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <!--===========================================================-->
          <div class="carousel-inner">
            <!--foreach($userIdNo->usable->staff->chunk(3) as $key => $chunk)-->
        
              <!--===========================================================-->
              <div v-for="(chnk,indx) in chunkedStudents(chunk.school_students)" :class="isActive(indx)">

                <!--foreach($chunk as $member)-->
              
                  <!--===========================================================-->
                  <div v-for="member in chnk" class="col-4 float-left" style="padding-left:0;padding-right:0; ">
                    <figure class="figure">
                      <img class="rounded-circle figure-img img-fluid" :src="'/profile-picture/'+ member.id" alt="Second slide" style="height: 3rem;width: 3rem">
                      <figcaption class="figure-caption">
                        <span style="display: block;">
                          <a href="route('SchoolProfilePage',['user'=>$member->user->first()->slug])">
                            {{member.name}}
                          </a>
                        </span>
                        Grade : {{member.grade}}
                      </figcaption>
                    </figure>
                  </div>
              
                <!--===========================================================-->
                <!--endforeach-->

              </div>
            
            <!--===========================================================-->
            <!--endforeach-->
          </div>
          <!--===========================================================-->
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" dataslide="prev" >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" dataslide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
   </div>

<span class="p-2 pb-0">
  <comments :post_id="chunk.id" :key_="chunkIndex" post_type="OurEvent" v-bind:auth_id="auth_id" ></comments>
  <!--@include('includes.postInteractions')--></span>
    </div> 
</div>
</div>
</div>
</template>
<script>
	export default {
		props:['post','isRouteStudentAwardsPage','auth_id'],
		data: function() {
	 		return {
	 			groupPosts:this.post,
	 		}
		},
		methods:
		{

      chunkedStudents(students)
      {
        return _.chunk(students,3);
      },
			getProjectPic:function(filename)
			{
				var flnm;
				var path;
      			//console.log(filename);
      			if(filename.images.length > 0)
      			{
      				flnm = filename.images[0].name;
      			}
      			else
      			{
      				flnm = 'random';
      			}
      			
      			return '/post-picture/'+flnm+'/students_projects';
  			},
          isActive(index)
    {
      console.error(index);
      if(index === 0)
      {
        return 'carousel-item active';
      }
      else
      {
        return 'carousel-item';
      }
    },
  			profile_pic:function(user_id)
			{
				return '/profile-picture/'+user_id
			},
      showphoto:function(student_project,active)
    {
      console.log('%c'+'im clicked','font-size:140px');
      console.log(student_project);
      //console.log($(event.target).attr('data-event'));
      //var student_project = $(event.target).attr('data-event');
      //student_project.images
      var imgsrc = $(event.target).attr('src');
      //var studentsImages = document.getElementById("student-pictures");
      var mrkup='';
      for (var i = 1; i < student_project.images.length; i++) 
      {
        mrkup += '<div class="carousel-item">'+
      '<img class="img-fluid d-block mx-auto modal-img"  src="/post-picture/'+student_project.images[i].name+'/events" alt="Third slide">'+
    '</div>';
      }
      //studentsImages.innerHTML = '';

     var innerHTML = '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" src="/post-picture/'+student_project.images[active].name+'/students_projects" id="first-slide-'+student_project.id+'" alt="First slide" ></div>'+mrkup;
      //$('#first-slide').prop('src',$(event.target).attr('src'));
      var posttext='<h4>'+student_project.name+'</h4><p>'+
      student_project.description+'</p><ul>'+
      '<li ><strong>Category:</strong> '+student_project.category+'</li>'+
      '<li><strong>Date:</strong> ' +student_project.date+'</li>'+
      '</ul>';
      var modal_object = 
      {
        'id':student_project.id,
        'auth_id':this.auth_id,
        'post_type':"OurEvent",
        'innerhtml':innerHTML,
        'posttext':posttext,
        'posterimg':this.profile_pic(student_project.school.user[0].id),
        'postername':student_project.school.user[0].name
      };
      var reff = 'postpic'+student_project.id;
      this.ref_=reff;
      console.log(reff);
      console.log(this.$root.$refs);
      console.log(this.$refs);
      console.log(this.$store.state.pic_post_id);
      this.$store.commit('setpicid',student_project.id);
      console.log(this.$store.state.pic_post_id);
      //$('#PostPicCarousel-modal-'+student_project.id).modal();
      this.$root.$refs['getpostpic'].launchModal(modal_object); //calls launchmodal method from postpic component
    }
		},
		computed:
		{
		
    	chunkedPosts () 
        {
            var that = this;
              this.$store.state.posts.forEach(function(post){
                          console.log(that.groupPosts);
                          that.groupPosts = that.groupPosts.concat(post);
                          console.log(that.groupPosts);
                        });
                        console.log(this.$store.state.posts);
         
                        return this.groupPosts;
            

        },

        searchloading()//sets loading state of the filtered results
        {
          return this.$store.state.searchLoading;
        },
        searchResults()
      {
        return this.$store.state.resultsEmpty;
      }
	},
  mounted()
    {
      //the page loaded with some posts
      if (Array.isArray(this.post) && this.post.length) {
        //remove empty results message
        this.$store.commit('setResultsEmpty',false);
      }
    }
}
</script>