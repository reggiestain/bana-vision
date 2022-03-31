<template>
	<div>
		<!--PARTICIPANTS  Modal -->
		<div class="modal fade PostPicCarousel-modal-cl" id="PostPicCarousel-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<!--button to close modal-->
			<button class="d-none d-md-flex" style="float:right;background-color:transparent;border:none" v-on:click="closemodal"><i class="fas fa-2x fa-times-circle"></i></button>
			<div class="col-12 modal-dialog modal-lg" role="document" style="overflow: visible;overflow-y: visible;height:fit-content;top:-2.5rem;">
				<div class="col-12 modal-content" style="border: none;background: transparent;flex-direction: row;">


					<!--MODAL BODY-->
					<div class="col-12 modal-body p-0 d-md-flex">
						<!-- carousel -->
						<div class="col-12 d-sm-none p-3" style="background-color: #ff5500;">
							<h5 class="text-light">
								<a href="#" class="close text-light" data-dismiss="modal" aria-label="Close" style="    float: none;opacity:1">
									<i class="fas fa-arrow-circle-left "></i> Back</a>
								</h5>
							</div>
							<div id="carouselExampleIndicators" class="col-12 col-md-8 carousel slide d-flex align-items-center p-0" data-interval="false" data-ride="carousel" style="background-color: #000000">

								<div  class="carousel-inner"  >	
									<div v-for="(image,index) in curr_props.images" class="carousel-item " v-bind:class="[(index==img_index) ? 'active' : '',]">
										<img 
										class="img-fluid d-block mx-auto" 
										:src="getEventPic(curr_props,index)" 
										id="first-slide-event_.id" 
										alt="First slide"
										>
									</div>

								</div>
								<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div><!-- end carousel -->

							<div class="col-12 col-md-4 p-2" id="post-pic-modal-content" >
								<!-- poster profile -->
								<div class="media col-12 d-flex align-items-center p-0">
									<img 
									class="rounded-circle mr-3 post-avatar" 
									:id="posterpicid"    
									src="route('getProfilePic',['filename'=>$userIdNo->id])" >
									<div class="media-body">
										<a class="mt-0" href="#">
											<strong id="poster-name">My name is earl</strong></a>
									</div>
								</div>
								<!-- end poster profile -->
								<!-- ===================== DYNAMICALLY ADD POST CONTENTS ===================== -->
								<div class="col-12 p-2  mt-3">
									<section>
										<component
										v-bind:is="current_post_component(curr_props)"
										:post="curr_props"
										></component>
									</section>
								</div>
								<!--Like,Comment,Delete,Share buttons plus comments and replies-->


								<comments :post_id="postid" :key_="key_" :post_type="post_type" v-bind:auth_id="auth_id" ></comments>


							</div>

						</div><!--END OF MODAL BODY-->

					</div>
				</div>
			</div>
		</div>
	</template>
<script>
	import OurNeedComponent from "../need/OurNeedComponent";
import EventsComponent from "../event/EventsComponent";
import BursariesComponent from "../bursary/BursariesComponent";
import SchoolComponent from "../school/SchoolComponent";
	export default
	{
		props:['curr_props','img_index'],
		components: {
    events: EventsComponent,
    bursaries: BursariesComponent,
    needs: OurNeedComponent,
    schools : SchoolComponent
  },
		data: function() {
	 		return {
	 			auth_id:'',
	 			post_type:'',
	 			carouselIndicatorsId:'',
	 			carouselIndicatorsRef:'',
	 			key_:0,
	 		}
		},
		methods:
		{
			closemodal:function()
			{
				$('#PostPicCarousel-modal').modal('hide');
			},
			//method directly copied from PostsComponent please abstract it
			//determines which component to load depending on the post clicked
			current_post_component(post) {
      			var current_component;
      			current_component = post.hasOwnProperty("post_type")
        ? post.post_type
        : this.$route.name;
      			return current_component;
    		},
    		//method directly copied from postscomponent please abstract it
    		//gets the image
    		 getEventPic: function(filename, pic_index) {
      var flnm;
      var flpath;
      if (filename.hasOwnProperty("images")) {
        if (filename.images[pic_index]) {
          flnm = filename.images[pic_index].name;
          flpath = filename.images[pic_index].path;
        } else {
          flnm = "random";
          flpath = "";
        }
      }
      return "/api/post-picture/" + flpath + flnm + "/null/null";
    },

		},
		computed:
		{
			
		},
		mounted()
		{

		}
	}
</script>