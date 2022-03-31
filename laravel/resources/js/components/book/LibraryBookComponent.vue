<template>
	<div>
		<div v-for="chunk in chunkedPosts">
	<div class="card card-custom d-flex mt-2 ">
  <div class="card-header">
    <div v-if="chunk.shared"><!--this event is shared on a timeline-->
    <div class="media d-flex align-items-center p-0 pb-2">
      <img class="rounded-circle mr-3 img-circle bg-white post-avatar" :src="profile_pic(chunk.shared_user_id)" id="jumbotron-image">
      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
          <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->shared_user_slug])" style="padding-right:6px">
            {{chunk.shared_user_name}} <span style="color:#000000">shared a book</span>
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
        <div v-if="!isRouteBooksPage"><!--is route-->
        <a class="dropdown-item" href="route('ourNeeds',['user'=>$post->user])">more needs from </a>
        </div><!--end is not route-->
      
    </div>
   </div>
</div><!--end is shared-->
   <div class="media d-flex align-items-center p-0 pb-2">
   	<div v-if="!chunk.shared"><!--is not shared-->
      <img class="rounded-circle mr-3 img-circle bg-white post-avatar" src="route('getProfilePic',['filename'=>$post->shared_user_id])" id="jumbotron-image" >
     </div><!--end is not shared-->
      <div class="media-body" >
        <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
          <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->shared_user_slug])" style="padding-right:6px">
           {{chunk.user[0].name}}
          </a>
        </h5>
        <a style="color: black" >
         $post->created_at->format('j F g:i A')
       </a>
     </div>
     <!--===========================SHARED POST MORE OPTIONS BUTTON==============================-->
     <div v-if="!chunk.shared">
     <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v "></i>
    </a>
    </div>
    <!--============================SHARED POST OPTIONS DROPDOWN========================================-->
     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <div v-if="!isRouteBooksPage"> 
        <a class="dropdown-item" href="route('ourNeeds',['user'=>$post->user])">more needs from </a>
        </div>
      
    </div>
   </div>
  </div>
  <img class="card-img-top show-photo" :src="getBookPic(chunk)"    alt="Schools brand picture" style="background-color:beige;max-height: 30rem; ">
  <!--============================CARD BODY===============================-->
  <div class="card-body" style="padding: 0"> 
      <div class="col-12 row" style="background-color: #eff1f3;padding: 0;margin: 0">
      <!--==============================EVENT CALENDAR==============================-->
      <div class="col-3 p-3" style="    text-align: center;">
        <span class="fa-stack fa-2x">
          <i class="fas fa-book fa-stack-2x" style="color:#4169e1"></i>
        </span>
      </div>
      <!--==============================EVENT DETAILS==============================-->
      <div class="col-9 p-3" >
        <h5>
          <strong>
            {{chunk.book.title}}
          </strong>
        </h5>
        <h6>By {{chunk.book.author}}</h6>
           Isbn :  {{chunk.book.isbn_number}}
            <p class="text-muted">
              {{chunk.book.description}}
            </p>

      </div>
   </div>
       
<span class="p-2 pb-0"></span>
    </div> 
</div>
</div>
</div>
</template>
<script>
	export default {
		props:['post','isRouteBooksPage'],
		data: function() {
	 		return {
	 			groupPosts:this.post
	 		}
		},
		methods:
		{
			getBookPic:function(filename)
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
      			
      			return '/post-picture/'+flnm+'/books';
  			},
  			profile_pic:function(user_id)
			{
				return '/profile-picture/'+user_id
			},
		},
		computed:
		{
		
    	chunkedPosts () 
        {
            var that = this;
            if(this.isRouteBooksPage)
            {
              this.$store.state.posts.forEach(function(post){
                          console.log(that.groupPosts);
                          that.groupPosts = that.groupPosts.concat(post);
                          console.log(that.groupPosts);
                        });
                        console.log(this.$store.state.posts);
          }           
                        return this.groupPosts;
            

        }
	},
}
</script>