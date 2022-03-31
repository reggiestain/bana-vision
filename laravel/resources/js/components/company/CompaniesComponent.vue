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

		<div v-if="!searchloading" class="card card-custom d-flex mt-2 institution" v-for="(chunk,chunkIndex) in chunkedPosts"> 
          <!--=========================INSTITUTION HEADER=============================-->
          <div class="card-header">
     <!--IF POST IS SHARED-->
            <div v-if="shared" class="media d-flex align-items-center p-0 pb-3">
              <img class="rounded-circle mr-3 img-circle bg-white post-avatar" src="route('getProfilePic',['filename'=>$post->shared_user_id])" id="jumbotron-image">
              <div class="media-body" >
                <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
                  <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->slug])" style="padding-right:6px">
                    $post->shared_user_name 
                    <span style="color:#000000">
                      shared a school
                    </span>
                  </a>
                </h5>
                <a style="color: black" >
                 $post->created_at->format('j F g:i A')
               </a>
             </div>
             <!--===========================BURSARY MORE OPTIONS BUTTON==============================-->
             <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v "></i>
             </a>
             <!--============================BURSARY MORE OPTIONS DROPDOWN========================================-->
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">
                Action
              </a>
              <a class="dropdown-item" href="#">
                Another action
              </a>
              <a class="dropdown-item" href="#">
                Something else here
              </a>
            </div>
          </div><!--end shared-->
      
            <div class="media d-flex align-items-center p-0">
              
              <img v-if="!shared" class="rounded-circle mr-3 img-circle bg-white post-avatar" :src="profile_pic(chunk.user[0].id)" id="jumbotron-image"  >
          
              <div class="media-body" >
                <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
                  <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->slug])" style="padding-right:6px">
                    {{chunk.user[0].name}}
                  </a>
                </h5>
                <a style="color: black" >
                 {{chunk.business_entity}} Company
               </a>
             </div>
             <!--===========================BURSARY MORE OPTIONS BUTTON==============================-->
            
             <a v-if="!shared" class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v "></i>
             </a>
        
             <!--============================BURSARY MORE OPTIONS DROPDOWN========================================-->
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">
                Action
              </a>
              <a class="dropdown-item" href="#">
                Another action
              </a>
              <a class="dropdown-item" href="#">
                Something else here
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
           <div class="col-12 row" style="padding: 0;margin: 0">
          <!--==============================EVENT CALENDAR==============================-->
      <div class="col-3 p-3 pb-0" style="    text-align: center;">
        <span class="fa-stack fa-3x">
          <i class="fas fa-store fa-stack-2x" style="color:#4169e1"></i>
        </span>
      </div>
          <!--==============================ORGANIZATION DETAILS==============================-->
      <div class="col-9 p-3 pb-0" id="container-$post->id">
          <ul class="list-group ">
            <li class="list-group-item" style="border: none;padding:0.25rem">
              <strong>
                <i class="fas fa-registered" ></i>
                <span class="ml-2  badge badge-pill badge-light" style="font-size:100% !important">
                  Registration number : {{chunk.registration_number}}
              </span>
            </strong>
            </li>
             <li class="list-group-item" style="border: none;padding:0.25rem">
              <strong>
                <i class="fas fa-industry" ></i>
                <span class="ml-2">
                  Industry : {{chunk.sector}}
              </span>
             </strong>
             </li>
             <li class="list-group-item" style="border: none;padding:0.25rem">
              <strong>
                <i class="fas fa-globe" ></i>
                <span class="ml-2">
                  
                  Website : 
                  <a :href="chunk.web_url" target="_blank">
                    {{chunk.web_url}}
                </a>
              </span>
             </strong>
             </li>
             <li class="list-group-item" style="border: none;padding:0.25rem">
              <strong>
                <i class="fas fa-phone" style="color:rebeccapurple"></i>
                <span class="ml-2">
                  <a>Telephone : {{ chunk.telephone}}</a>
              </span>
             </strong>
             </li>
             <li class="list-group-item" style="border: none;padding:0.25rem">
              <strong>
                <i class="fas fa-building" style="color: lightsteelblue"></i>
                <span class="ml-2">
                  Address : <address>
                    {{chunk.business_place_address}} {{chunk.business_place_town}}<br> {{chunk.business_place_area_code}}
                  </address>
              </span>
             </strong>
           </li>
          </ul>
        </div><!--end companies details-->
      </div>
        </div>
      </div>
	</div>
</template>
<script>
export default
{
	props:['post','is_route_featured_page','shared'],
		data: function() {
	 		return {
	 			groupPosts:this.post
	 		}
		},
		methods:
		{
			getFeaturedPic:function(filename)
			{
				var flnm;
				var path;
      			//console.log(filename);
      			if(filename.school_student.images.length > 0)
      			{
      				flnm = filename.school_student.images[0].name;
      				path= filename.school_student.images[0].path.replace(/\//g, "-");
      			}
      			else
      			{
      				flnm = 'random';
      			}
      			
      			return '/sub-picture/'+flnm+'/'+path;
  			},
        /**
         * [profile_pic description]
         * @param  {[type]} user_id [description]
         * @return {[type]}         [description]
         */
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