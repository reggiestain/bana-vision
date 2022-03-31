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
           {{chunk.shared_user_name}} <span style="color:#000000">shared a student award</span>
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
        <div v-if="isRouteStudentAwardsPage">
        <a class="dropdown-item" href="route('ourNeeds',['user'=>$post->user])">more needs from </a>
        </div>
      
    </div>
   </div>
</div>

   <div class="media d-flex align-items-center p-0 pb-2">
   	  <div v-if="!chunk.shared">
      <img class="rounded-circle mr-3 img-circle bg-white post-avatar" :src="profile_pic(chunk.school_student.school.user[0].id)" id="jumbotron-image" >
      </div>

      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
          <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->shared_user_slug])" style="padding-right:6px">
            {{chunk.school_student.school.user[0].name}}
          </a>
        </h5>
        <a style="color: black" >
         {{chunk.created_at}}
       </a>
     </div>
     <!--===========================SHARED POST MORE OPTIONS BUTTON==============================-->
     <div v-if="chunk.shared">
     <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v "></i>
    </a>
    </div>
    <!--============================SHARED POST OPTIONS DROPDOWN========================================-->
     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <div v-if="isRouteStudentAwardsPage">
        <a class="dropdown-item" href="route('ourNeeds',['user'=>$post->user])">more needs from </a>
        </div>
      
    </div>
   </div>
   
  </div>
  <img class="card-img-top show-photo"  :src="getAwardPic(chunk)" alt="Schools brand picture" style="background-color:beige;max-height: 30rem; "  v-on:click="showphoto(chunk,0)">
  <!--============================CARD BODY===============================-->
  <div class="card-body" style="padding: 0"> 
      <div class="col-12 row" style="background-color: #eff1f3;padding: 0;margin: 0">
      <!--==============================EVENT CALENDAR==============================-->
      <div class="col-3 p-3" style="    text-align: center;">
        <span class="fa-stack fa-2x">
          <i class="fas fa-certificate fa-stack-2x" style="color:#4169e1"></i>
        </span>
      </div>
      <!--==============================EVENT DETAILS==============================-->
      <div class="col-9 p-3" >
        <h5>
          <strong class="text-dark">
            Our Awardee : {{chunk.school_student.name}} {{chunk.school_student.surname}}
          </strong>
        </h5>
        field : {{chunk.field}}
            <p class="text-muted">
              {{chunk.description}}
            </p>

      </div>
   </div>
       
<span class="p-2 pb-0"><comments :post_id="chunk.id" :key_="chunkIndex" :likes-count="chunk.likes_count" :comments-count="chunk.comments_count" :shares-count="chunk.shares_count" post_type="StudentAward"></comments><!--@include('includes.postInteractions')--></span>
    </div> 
</div>
	</div>
</div>
</template>
<script>
	export default {
		props:['post','is_route_student_awards_page'],
		data: function() {
	 		return {
	 			groupPosts:this.post
	 		}
		},
		methods:
		{
			getAwardPic:function(filename)
			{
				var flnm;
				var path;
      			//console.log(filename);
      			if(filename.images.length > 0)
      			{
      				flnm = filename.images[0].name;
      				path= filename.images[0].path.replace(/\//g, "-");

      			}
      			else
      			{
      				flnm = 'random';
      			}
      			//http://test2.bana.vision/sub-picture/nick.khumalo2-student_awards-1.jpg/marc.thomas1-students-nick.khumalo2-student_awards-
      			return '/sub-picture/'+flnm+'/'+path;
  			},
  			profile_pic:function(user_id)
			{
				return '/profile-picture/'+user_id
			},
        showphoto:function(student_award,active)
    {
      console.log('%c'+'im clicked','font-size:140px');
      console.log(student_award);
      //console.log($(event.target).attr('data-event'));
      //var student_award = $(event.target).attr('data-event');
      //student_award.images
      var imgsrc = $(event.target).attr('src');
      //var studentsImages = document.getElementById("student-pictures");
      var mrkup='';
      for (var i = 1; i < student_award.images.length; i++) 
      {
        mrkup += '<div class="carousel-item">'+
      '<img class="img-fluid d-block mx-auto modal-img"  src="/post-picture/'+student_award.images[i].name+'/events" alt="Third slide">'+
    '</div>';
      }
      //studentsImages.innerHTML = '';

     var innerHTML = '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" src="'+this.getAwardPic(student_award)+'" id="first-slide-'+student_award.id+'" alt="First slide" ></div>'+mrkup;
      //$('#first-slide').prop('src',$(event.target).attr('src'));
      var posttext='<h4>Our awardee : '+student_award.school_student.name+' '+student_award.school_student.surname+'</h4><p>'+
      student_award.description+'</p><ul>'+
      '<li ><strong>Awarded by:</strong> '+student_award.awarded_by+'</li>'+
      '<li ><strong>Field:</strong> '+student_award.field+'</li>'+
      '<li><strong>Year:</strong> ' +student_award.year+'</li>'+
      '</ul>';
      var modal_object = 
      {
        'id':student_award.id,
        'auth_id':this.auth_id,
        'post_type':"OurEvent",
        'innerhtml':innerHTML,
        'posttext':posttext,
        'posterimg':this.profile_pic(student_award.school_student.school.user[0].id),
        'postername':student_award.school_student.school.user[0].name
      };
      var reff = 'postpic'+student_award.id;
      this.ref_=reff;
      this.$store.commit('setpicid',student_award.id);
      console.log(this.$store.state.pic_post_id);
      //$('#PostPicCarousel-modal-'+student_award.id).modal();
      this.$root.$refs['getpostpic'].launchModal(modal_object); //calls launchmodal method from postpic component
    }
		},
		computed:
		{
		
    	chunkedPosts () 
        {
            var that = this;
            if(this.is_route_student_awards_page)
            {
              this.$store.state.posts.forEach(function(post){
                          console.log(that.groupPosts);
                          that.groupPosts = that.groupPosts.concat(post);
                          console.log(that.groupPosts);
                        });
                        console.log(this.$store.state.posts);
          }           
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