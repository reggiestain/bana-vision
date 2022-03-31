<template>
	<!-- this component loads other components to display different form data the child component data is stored as 
	vuex form_data  -->
	<!-- =======================CREATE POST======================= -->
	<div class="card" >
		<div class="card-header">
			<span>
				<i class="fas fa-edit"></i>
			</span>
			<span class="ml-2">
				Create update
			</span>
		</div>
		<!--=============================CARD BODY=============================-->
		<div class="card-body p-0">
			<form @submit.prevent="create_post" enctype="multipart/form-data">
				<div class="form-group row m-0">
					<div class="col-8  m-0 p-0 pl-3 pt-2 pb-2 d-flex">
						<div class="row m-0 p-0 other-fields">
							<div class="col-12 p-0 $errors->has('post') ? 'has-error':''">
								<textarea class="form-control inputs" id="feed-textarea" cols="30" rows="3" :placeholder="edit_post.description" v-on:change="post_helper.update_value($root,$event.target.value,'post')"  value="post" required v-on:click="showmore"></textarea>
							</div>
							<component v-bind:is="(edit_post.post_type !==undefined)?edit_post.post_type:postType" :edit_post="edit_post"></component>

						</div>
					</div>

					<div class="col-4 row m-0 p-0 d-flex"  v-if="imagePreview == false">
						<!--=====================IMAGE==========================-->
						<div class="col p-0 d-flex border-left border-right align-items-center">
							<span  class="ml-auto mr-auto" id="image-section">
								<i class="fas fa-image fa-3x add-image" style="color:#ff7f50"></i>
							</span>
							<div class="$errors->has('image') ? 'has-error':''"> 
								<input type="file" @change="imageChanged" id="add-image" style="display: none;" multiple>
							</div>
						</div>
						<!--=====================VIDEO==========================-->
						<div class="col p-0 d-flex  align-items-center " id="video-div" >
							<span class="ml-auto mr-auto">
								<i class="fas fa-video fa-3x add-video" style="color:#ff7f50">
								</i>
							</span>
							<div class="$errors->has('video') ? 'has-error':''">
								<input type="file" v-on:change="video" id="add-video" style="display: none;" value="Request::old('video')">
							</div>
						</div>
					</div>

					<div class="col-4 row m-0 p-1 d-flex d-flex border-left border-right align-items-center" style="max-height:20rem;overflow-y:scroll" v-else>
						<div class="col-12 m-0 p-0" v-for="image in imageData" >
							<div class="col-12">
								<img class="mr-3 image-fluid d-block rounded mt-1" :src="image"   style="width:6.35rem;height:6.35rem">
							</div>
						</div>
					</div>

				</div>

				<!--END CARD BODY-->
				<div class="card-footer row m-0 " >
					<div v-for="included_post in included_posts">
					<!--=======================INCLUDED POST=======================-->
					<div class="col form-check form-check-inline radios" v-if="usable_type == 'App\\School'">
						<input class="form-check-input radio-inline  align-self-center" type="radio" v-model="postType" :id="included_post+'-radio'" :value="included_post" style="display:none" v-on:change="showmore">
						<label class="form-check-label" :for="included_post+'-radio'">
							<span class="d-none d-md-inline bg-white" style="border: solid grey 1px;border-radius: 7rem;padding: 0.5rem 0.75rem;">
								<i class="fas fa-calendar-alt fa-1x" style="display:inline;color:#00016C"></i>
							</span>
							<strong class="ml-2">
								{{included_post}}
							</strong>
						</label>
					</div><!--END EVENT  -->
					</div>
                <!--=======================COLLAPSE SECTION=======================-->
                <div class="col-12 collapse " id="more">
                	<button type="submit"  class="btn btn-primary btn-sm d-flex mt-2  ml-auto">Post</button>
                </div>
            </div>
        </form>
    </div>
</div>
</template>
<script>
	import CreateEventComponent from './create/CreateEventComponent' ;
	import CreateBursaryComponent from './create/CreateBursaryComponent' ;
	import CreateNeedComponent from './create/CreateNeedComponent' ;
	import {Post} from '../../Post.ts';
	export default{
		components:{
			'events':CreateEventComponent,
			'bursaries':CreateBursaryComponent,
			'needs':CreateNeedComponent,
		},
	props:{
		'usable_type':{
		},
		'user':{
		},
		'included_posts':{
		},
		'edit_post':{
        default() {
            return {description:'Say something, '/*+$root.user.name*/}
        }
				
			
			/*default () { 
    			return () => this.innerMethod();
  			},*/
		}
	},
	data:function() {
        return {
        	post_helper:new Post(),
            errors_array:[],
            postType:'',
            video:'',
            image:null,
            post:'',
            needDueDate:'',
            needUrgency:'',
            needCategory:'',
            needQuantity:'',
            needTitle:'',
            bursaryRequirement:'',
            bursaryRequirements:[],
            bursaryPositionsAvailable:0,
            bursarySector:'',
            bursaryApplicationLink:'',
            bursaryClosingDate:'',
            bursaryTitle:'',
            eventTimeslotFrom:'',
            eventTimeslotTo:'',
            eventVenue:'',
            eventDate:'',
            eventName:'',
            imagePreview:false,
            imageData: [],
          }
        },
    methods:
    {
        async imageChanged(event)
        {
            //console.log(event);
            $('#more').collapse('show');
            this.imagePreview = true;
            this.image = event.target.files;

            let    that=this;
            let img_arr = [];
           for (let i=0; i<this.image.length; i++){
            	var reader = new FileReader();

     		 reader.readAsDataURL(this.image[i]);
     			const result = await new Promise((resolve,reject)=> {	reader.onload =  function (e) {
     				resolve(reader.result);
     			        			var img = new Image();
     			        			img.className = "mr-3 image-fluid d-block rounded mt-1";
     			        			img.style.width = "12.35rem";
     			        			img.style.height = "12.35rem";
     			     			}
     			     		});
     			 this.imageData.push(result);
     			 img_arr[i] = that.image[i];
 			}

 			//update the form_data images array on the store 
 			//include image if input is not empty
            if(this.image != null)
            {
                this.post_helper.update_value(that,img_arr,'images[]');
            }
 			
    	},
    	//updates binded value on the component and store
    	//****************************************ABSTRACT THIS METHOD PLEASE PLEASE PLEASE*************************************

        create_post(e) 
        {
            var that=this;
            var post_uri;
            //check if the post is from the feed or events/bursaries/needs ...etc
            post_uri = (this.postType!=='')?this.postType:this.$route.name;
            //check if updating if included_posts (buttons to select needs or events) is undefined thenis from update modal
            if(this.edit_post.hasOwnProperty('post_type'))
            	post_uri = post_uri + this.edit_post._id;
            //submit posts using axios
          	that.post_helper.post(that,`/api/${this.$route.params.slug}/${post_uri}`);
        },
        //show the post submit button 
        showmore()
        {
            $('#more').collapse('show');
        },

    },
    computed:
    {

    },
    mounted()
    {
    }

}
 $(document).on('click','.add-image',function(){
    $('#add-image').trigger('click');
  });

  $(document).on('click','.add-video',function(){
    $('#add-video').trigger('click');
  });
</script>