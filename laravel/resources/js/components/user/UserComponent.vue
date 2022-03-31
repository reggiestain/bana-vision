<template>
	<div>
		<div v-for="(chunk,chunkIndex) in chunkedPosts">
<div class="card card-custom d-flex mt-2 institution" > 
          <!--*************************INSTITUTION HEADER*****************************-->
          <div class="card-header">
            @if(isset($post->shared))
            <div class="media d-flex align-items-center p-0 pb-3">
              <img class="rounded-circle mr-3 img-circle bg-white post-avatar" src="route('getProfilePic',['filename'=>$post->shared_user_id])" id="jumbotron-image" >
              <div class="media-body" >
                <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
                  <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->slug])" style="padding-right:6px">
                    $post->shared_user_name <span style="color:#000000">shared a school</span>
                  </a>
                </h5>
                <a style="color: black" >
                 $post->created_at->format('j F g:i A')
               </a>
             </div>
             <!--***************************BURSARY MORE OPTIONS BUTTON******************************-->
             <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v "></i></a>
             <!--****************************BURSARY MORE OPTIONS DROPDOWN****************************************-->
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
          @endif
            <div class="media d-flex align-items-center p-0">
              @if (!(isset($post->shared)))
              <img class="rounded-circle mr-3 img-circle bg-white post-avatar" src="route('getProfilePic',['filename'=>$post->id])" id="jumbotron-image" >
              @endif
              <div class="media-body" >
                <h5 style="font-size: 0.755rem;margin-bottom: 0.15rem;">
                  <a class="navbar-logo  ml-auto" href="route('SchoolProfilePage',['userIdNo'=>$post->slug])" style="padding-right:6px">
                    {{chunk.name}}
                  </a>
                </h5>
                <a style="color: black" >
                 $post->usable->k_12 School
               </a>
             </div>
             <!--***************************BURSARY MORE OPTIONS BUTTON******************************-->
             @if (!(isset($post->shared)))
             <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v "></i></a>
             @endif
             <!--****************************BURSARY MORE OPTIONS DROPDOWN****************************************-->
             <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item" style="border: none;padding:0.25rem">
              <span class="ml-2">
                <strong>
                  <i class="fas fa-check-double" style="color:#adff2f"></i>Province :
                </strong> $post-usable-province
              </span>
            </li>
             <li class="list-group-item" style="border: none;padding:0.25rem"><span class="ml-2"><strong><i class="fas fa-check-double" style="color:#adff2f"></i>District :</strong> $post-usable-district</span></li>
             <li class="list-group-item" style="border: none;padding:0.25rem"><span class="ml-2"><strong><i class="fas fa-check-double" style="color:#adff2f"></i>Coeducational :</strong> $post-usable-coeducational</span></li>
             <li class="list-group-item" style="border: none;padding:0.25rem"><span class="ml-2"><strong><i class="fas fa-check-double" style="color:#adff2f"></i>Special Needs :</strong> @if($post-usable-special_needs  0)Yes @else No @endif</span></li>
             <li class="list-group-item" style="border: none;padding:0.25rem"><span class="ml-2"><strong><i class="fas fa-check-double" style="color:#adff2f"></i>Funding :</strong> @if($post-usable-funding  0)Public school @else Private school @endif</span></li>
          </ul>
        </div>
      </div>
  </div>
</div>
</template>
<script>
export default {
	props:['post',],
		data: function() {
	 		return {
	 			groupUsers:this.post
	 		}
		},
		computed:
	{
		
    chunkedPosts () 
        {
            var that = this;
            if(this.isRouteOurEventsPage)
            {
              this.$store.state.posts.forEach(function(post){
                          console.log(that.groupUsers);
                          that.groupUsers = that.groupUsers.concat(post);
                          console.log(that.groupUsers);
                        });
                        console.log(this.$store.state.posts);
          }           
                        return this.groupUsers;
            

        }
	},
}
</script>