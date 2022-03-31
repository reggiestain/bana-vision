<template>
	<div>
		<div v-if="rating > 0">
		<span style="display: inline;" v-for="i in 5">
			<i v-bind:class="'fas fa-star'+showRating(i)" style="color: #DAA520;" aria-hidden="true"></i>

		</span>
	</div>
	<div v-else>
	 	No Rating
	</div>
		getRatingsCount total reviews
		<div v-for="review in ratings">
			<!--===========================================================-->
			<div class="media" style="text-align: left;">
				<img class="mr-3 rounded-circle" :src="profile_pic(review.user.id)" alt="" style="max-width: 2.35rem;max-height: 2.35rem">
				<div class="media-body">
					<a :href="'/'+review.user.slug">
						<span >
							<h6 class="mt-0">
								{{review.user.name}}
							</h6>
						</span>
					</a>
					<div class="badge badge-pill p-2" id="pill-review" :data-rating="review.rating" style="white-space: normal;background-color: #f0f0f0;">
						{{review.review}}
					</div>
				</div>
			</div>

			<!--===========================================================-->
		</div>
		<div class="col-12">
			<button class="btn btn-light btn-sm mt-2" @click="getRatings">
				<div  class="d-flex col-12" v-if="loadingRating">
					<img class="ml-auto mr-auto" src="/assets/img/loader.gif">
				</div>
				<div v-else>
					See more
				</div>
			</button>
		</div>
	</div>
</template>
<script>
	export default
	{
		props:['useridno','rating'],
		data:function()
		{
			return{
				ratings : [],
				errors_array:[],
				page:1,
				loadingRating:false,

			}
		},
		methods:
		{
			showRating(index)
			{
				var index_ = index -1;
				var half = (this.rating==index_+0.5)?'-half':'';
				var full = (this.rating<=index_)?'-o':'';
				console.log('%c'+half+full,'color:purple;font-size:32rem');
				return half+full;
			},
			getRatings()
			{
				var currentObj = this;
				this.loadingRating = true;
				axios.get(this.useridno.slug+'/getRating/?page='+this.page)
            	.then(function (response) {
                	currentObj.ratings = currentObj.ratings.concat(response.data['ratings']);
                	currentObj.page++;
            	})
            	.catch(function (error) {
                if( error.response )
                {
                  var errors = error.response.data.errors; // => the response payload 
                  var error_string = '';
                    Object.entries(errors).forEach(([key, value]) => {
                        value.forEach(function(errormsg){
                            currentObj.errors_array.push(errormsg);
                            error_string = error_string + '\n ' + errormsg;
                        });
                    });

                    currentObj.$swal({
                        text: error_string,
                        icon:that.image_url,
                 
                   
                    });

                }
            })
            	.finally(function(){
            		setTimeout(function(){ currentObj.loadingRating = false; }, 1500);
            	})
               		//reset th
			},
			profile_pic:function(user_id)
			{
				return '/profile-picture/'+user_id
			},

		},
		computed:
		{
		/*
			getRatingsCount:function()
			{
				return this.useridno.usable.ratings.length;
			}*/


			displayRating()
			{
				var rating = this.rating

				if(rating > 0)
				{
					for (var i=0;i<5;i++)
					{
						return '<i class="fas fa-star'+rating==i+.5?'-half':''+rating<=i?'-o':''+'" style="color: #DAA520;" aria-hidden="true"></i>';
					}
				}
				else 
				{
					return 'no rating'
				}
			}

		},
		mounted()
		{
			this.getRatings();
		}
	}
</script>