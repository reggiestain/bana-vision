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
	<div v-if="!searchloading" v-for="(chunk,chunkIndex) in chunkedPosts" :id="announcement_id(chunk.id)">
 <div class="card card-custom d-flex mt-2 event" > <!-- @if((Route::currentRouteName() != "searchResults"))@endif--> 
  <!--=========================EVENT HEADER=============================-->
  <div class="card-header">
  	<div v-if="shared">
    <!--this event is shared on a timeline-->
    <div class="media d-flex align-items-center p-0 pb-3">
      <!--===============================SHARER PROFILE IMAGE===============================-->
      <img class="rounded-circle mr-3 img-circle bg-white post-avatar"  src="route('getProfilePic',['filename'=>$post->shared_user_id])" id="jumbotron-image" >
      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
          <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->share_user_slug])" style="padding-right:6px">
            $post->shared_user_name 
            <span style="color:black">
              shared an event
            </span>
          </a>
        </h5>
        <a style="color: black" >
         post->created_at->format('j F g:i A')
       </a>
     </div>
     <!--===========================EVENT MORE OPTIONS BUTTON==============================-->
     <a class="ml-auto" href="#" role="button" id="userMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v "></i>
    </a>
    <!--============================EVENT MORE OPTIONS DROPDOWN========================================-->
     <div class="dropdown-menu" aria-labelledby="userMenuLink">
     
       <div v-if="!isRouteOurEventsPage"> <!--if is not in events page-->
        <a class="dropdown-item" href="route('ourEventsPage',['user'=>$post->user])">
          more events from $post->user->name
        </a>
       </div><!--end if current route is ourEventsPage-->
    </div>
   </div>
</div><!--end of shared header-->
    <div class="media d-flex align-items-center p-0">
      <!--if this is shared-->
      <!--==============================USER IMAGE==============================-->
      <img class="rounded-circle mr-3 img-circle bg-white post-avatar"  src="/assets/img/bana1.png" id="jumbotron-image"  >
     
      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;color:black">
        
           Bana Announcements
      
        </h5>
        <a style="color: black" >
        {{chunk.created_at|removeTime}}
       </a>
     </div>
     <div ><!-- if is not shared-->
     <!--===========================EVENT MORE OPTIONS BUTTON==============================-->
     <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v "></i>
    </a>
     </div>
    <!--============================EVENT MORE OPTIONS DROPDOWN========================================-->
     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @auth
        @if(Auth::id() == $post->user->id)
        <a class="dropdown-item" href="route('deleteEvent',['eventIdNo'=>$post->id])" style="color:red"><i class="fas fa-trash"></i><span class="ml-1">
          delete event
        </span>
        </a>
        @endif
        @endauth
        @if (Route::currentRouteName() != 'ourEventsPage')
        <a class="dropdown-item" href="route('ourEventsPage',['user'=>$post->user])">
          more events from $post->user->name
        </a>
        @endif
      <a class="dropdown-item" href="#">
        <i class="fas fa-ban"></i>
        <span class="ml-1">
          Report
        </span>
      </a>
    </div>
   </div>
 </div>
    <!-- ==============================EVENT IMAGE============================== -->
     <div >
    <!--================first image row================-->
    <div class="row m-0 p-0 d-flex" >
      <div class="col " style="padding-left:0rem;padding-right:0.1rem;max-height:19rem;overflow:hidden">
        <img class="card-img-top show-photo d-block mx-auto w-100"  :src="getEventPic(chunk,0)" alt="Schools brand picture" style="background-color:beige;max-height: 30rem;text-align:center ;height:100%" data-bursary="$post" data-requirements="$post->requirements" v-on:click="showphoto(chunk,0)" :data-event="chunk">
      </div>
      <!--================second column================-->
      <div class="col" style="padding-left:0.1rem;padding-right:0rem;max-height:19rem;overflow:hidden" v-if="showpic(chunk,1)">
          <img class="card-img-top show-photo d-block mx-auto w-100 "  :src="getEventPic(chunk,1)" alt="Schools brand picture" style="background-color:beige;max-height: 30rem;text-align:center;height:100% " data-bursary="$post" data-requirements="$post->requirements" v-on:click="showphoto(chunk,1)" :data-event="chunk">
      </div>
    </div><!--end first div row-->


    <!--================second div row================-->
    <div class="row m-0 p-0 d-flex" style="padding-top:0.2rem">
      <div class="col " style="padding-right:0.1rem;padding-top:0.2rem;padding-left:0rem;max-height:15rem;overflow:hidden" v-if="showpic(chunk,2)">
        <img class="card-img-top show-photo mx-auto d-block w-100"  :src="getEventPic(chunk,2)" alt="Schools brand picture" style="background-color:beige;max-height:20rem;height: 100%; text-align:center" v-on:click="showphoto(chunk,2)" :data-event="chunk">
      </div>

      <div class="col " style="padding-left:0.1rem;padding-right:0.1rem;padding-top:0.2rem;max-height:15rem;overflow:hidden" v-if="showpic(chunk,3)">
        <img class="card-img-top show-photo mx-auto d-block w-100"  :src="getEventPic(chunk,3)" alt="Schools brand picture" style="background-color:beige;max-height:20rem;height: 100%;text-align:center " v-on:click="showphoto(chunk,3)" :data-event="chunk">
      </div>

      <div class="col " style="padding-right:0rem;padding-left:0.1rem;padding-top:0.2rem;max-height:15rem;overflow:hidden" v-if="showpic(chunk,4)">
        <img class="card-img-top show-photo mx-auto d-block w-100"  :src="getEventPic(chunk,4)" alt="Schools brand picture" style="background-color:beige;height: 100%;max-height:20rem; text-align:center" v-on:click="showphoto(chunk,4)" :data-event="chunk">
      </div>
    </div>
  </div><!--end event image -->

    <div class="card-body" style="padding: 0"> 
      <div class="col-12 row" style="background-color: #eff1f3;padding: 0;margin: 0">
      <!--==============================EVENT CALENDAR==============================-->
      <div class="col-3 p-3" style="    text-align: center;">
        <span class="fa-stack fa-3x">
          <i class="fas fa-bullhorn fa-stack-2x" style="color:#4169e1"></i>
        </span>
      </div>
      <!--==============================EVENT DETAILS==============================-->
      <div class="col-9 p-3" id="container-$post->id">
           {{chunk.announcement}}
      </div>
   </div>
       
    </div> 
    <!--php 
    $userIdNo = $post->user;
     -->
<!--@include('includes.viewPostPicModal')-->
  </div>

	</div>
 

</div>
</template>
<script>
	import  '../post/CommentsComponent.vue';
	export default 
	{
		props:['post','shared','isRouteOurEventsPage','isEvent','auth_id'],
		data: function() {
	 		return {
	 			groupEvents:this.post,
        ref_:''
	 		}
		},
	
	methods:
	{
		getEventPic:function(filename,pic_index)
		{
      var flnm;
      //console.log(filename);
      if(filename.images[pic_index])
      {
        flnm = filename.images[pic_index].name;
       
      }
      else
      {
        flnm = 'random';
      }
       return '/post-picture/'+flnm+'/events/null/null';
		},
    showpic:function(image,img_index)
      {
        console.log()
        if(this.getEventPic(image,img_index) == '/post-picture/random/events')
        {
          return false;
        }
        else
        {
          return true;
        }
      },
		profile_pic:function(user_id)
		{
			return '/profile-picture/'+user_id
		},
    /***************************************************************
    *
    ***************************************************************
    */
    showphoto:function(event_,active)
    {
      console.log(event_);
      //console.log($(event.target).attr('data-event'));
      //var event_ = $(event.target).attr('data-event');
      //event_.images
      var imgsrc = $(event.target).attr('src');
      //var studentsImages = document.getElementById("student-pictures");
      var mrkup='';
      for (var i = 1; i < event_.images.length; i++) 
      {
        mrkup += '<div class="carousel-item">'+
      '<img class="img-fluid d-block mx-auto modal-img"  src="/post-picture/'+event_.images[i].name+'/events" alt="Third slide">'+
    '</div>';
      }
      //studentsImages.innerHTML = '';

     var innerHTML = '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" src="/post-picture/'+event_.images[active].name+'/events" id="first-slide-'+event_.id+'" alt="First slide" ></div>'+mrkup;
      //$('#first-slide').prop('src',$(event.target).attr('src'));
      var posttext='<h4>'+event_.name+'</h4><p>'+
      event_.description+'</p><ul>'+
      '<li ><strong>Venue:</strong> '+event_.venue+'</li>'+
      '<li><strong>Date:</strong> ' +event_.date+'</li>'+
      '<li><strong>Timeslot:</strong> ' +event_.timeslot+
      '</ul>';
      var modal_object = 
      {
        'id':event_.id,
        'auth_id':this.auth_id,
        'post_type':"OurEvent",
        'innerhtml':innerHTML,
        'posttext':posttext,
        'posterimg':this.profile_pic(event_.user.id),
        'postername':event_.user.name
      };
      var reff = 'postpic'+event_.id;
      this.ref_=reff;
      console.log(reff);
      console.log(this.$root.$refs);
      console.log(this.$refs);
      console.log(this.$store.state.pic_post_id);
      this.$store.commit('setpicid',event_.id);
      console.log(this.$store.state.pic_post_id);
      //$('#PostPicCarousel-modal-'+event_.id).modal();
      this.$root.$refs['getpostpic'].launchModal(modal_object); //calls launchmodal method from postpic component
    },
    announcement_id:function(id)
    {
      return 'announcement'+id;
    },
    scrollFix: function(hashbang)
    {
      location.href = hashbang;
    }
	},
	filters:
	{
		getYMonth:function(date)
		{
			var res;
			res = date.slice(4,6);
			return res;
		},
		getDay:function(date)
		{
			var res;
			//res = date.slice(6,9);
			return res;
		},
		removeTime:function(date)
		{
			var res;
			res = date.split(" ");
			return res[0];
		}

	},
	computed:
	{
		
    chunkedPosts () 
        {
            var that = this;
           // if(this.isRouteOurEventsPage)
            //{
              /*this.$store.state.posts.forEach(function(post_){
                          console.log(that.groupEvents);
                          post_.forEach(function(pst){
                            that.groupEvents.push(pst);
                            console.log(pst);
                          });
                          
                        });*/


              this.$store.state.posts.forEach(function(post){
              //console.log(that.groupBursaries.includes(post));
              if(!that.groupEvents.includes(post))
              {
                that.groupEvents = that.groupEvents.concat(post);
              }
              //console.log(that.groupBursaries);
            });
            //console.log(this.$store.state.posts);  
                        console.log(this.$store.state.posts);
          //}           
                        return this.groupEvents;
            

        },
        getpostpic()
        {
          return this.ref_;
        },
        searchloading()//sets loading state of the filtered results
        {
          return this.$store.state.searchLoading;
        }
	},
	mounted: function()
  {
    // From testing, without a brief timeout, it won't work.
    setTimeout(() => this.scrollFix(location.hash), 1)
  },
}
</script>