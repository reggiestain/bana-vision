<template v-if="user.usable == 'App/School'">
	<div role="tabcard" class="tab-pane" id="activities">
		<nav>
			<div class="card-header nav nav-tabs p-0 border-bottom" id="nav-tab" role="tablist">
				<div class="pb-0 p-3  col-12" >
					<h4  style="display: inline;">
						<i class="fas fas1 fa-swimmer"></i>
						Activities 
					</h4>
					<!--Add activities-->
					<a class="p-1"  style="float: right !important"  role="button" id="activities-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-plus" style="color: #c5c7cb"></i>
					</a>
					<!--Add activities dropdown-->
					<div class="dropdown-menu" aria-labelledby="activities-dropdown" v-if="auth.auth_owner_of_post(auth_user, user) && authenticated">
						<a class="dropdown-item" href="#" id="add-activity-option" @click="addActivityClicked">
							<i class="fas fa-plus"> Add Activity</i>
						</a>
					</div>
					<!---->
					<a class="p-1"  style="float: right !important">
						<i class="fas fa-wrench" style="color: #c5c7cb"></i>
					</a>
					<a class="p-1"  style="float: right !important">
						<i class="fas fa-cog" style="color: #c5c7cb"></i>
					</a>
				</div>


			</div>
		</nav>


		<div class="tab-content card-body p-0" id="nav-tabContent">
			<div class="tab-content card-body p-0" id="nav">
				<div class="tab-pane fade show active col-12 p-2 container" id="school-activities" role="tabpanel" aria-labelledby="cover-photos-tab" >
					<!--there are no activities uploaded-->
					<!-- <div v-if="!activities.length">
						<h1>Nothing to display at the moment</h1>
					</div>

					<div v-if="!activities.length && auth_id == user.id">
						<h1>Show people your activities</h1>
					</div> -->
					 <image-post   :key="0" :key_="1" tab_number="1" url="activities" returnVal="school_activities" :options="activities_options"></image-post>

				</div>
			</div>
		</div>

				<!-- Modal -->
		<div class="modal fade" id="add-activity-modal" tabindex="-1" role="dialog" aria-labelledby="add-activity-ModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-white text-dark">
						<h6 class="modal-title text-dark" id="exampleModalLabel" >Add Activity</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body " >
					<form  @submit.prevent="checkForm" enctype="multipart/form-data">

						<div class="form-group row  ">
							<label for="inputEmail3" class="col-sm-3 col-form-label">
								<strong>
									Name
								</strong>
							</label>
							<div class="col-md-9 " id="name_div">

								<input class="form-control form-control-sm" type="text" v-model="name" id="activity-name" placeholder="provide short descriptive name"> 
								<!--===========NAME INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('name')" class="help-block">
									<strong> {{errors['name']}} </strong>
								</span> 
							</div>
						</div>

						<div class="form-check p-0">
							<select class="form-control form-control-sm" id="urgency" v-model="type">
								<option value="" selected disabled hidden>Select type</option>
								<option value="sports">sports</option>
								<option value="academic">academic</option>
								<option value="recreation">recreation</option>
							</select>
						</div>

						<div class="form-group row  ">
							<label for="inputEmail3" class="col-sm-3 col-form-label">
								<strong>
									Description
								</strong>
							</label>

							<div class="col-md-9" id="description_div">
								<textarea class="form-control form-control-sm" rows="5" placeholder="describe the activity to the audience" v-model="description" id="activity-description">
								</textarea>
								<!--===========NAME INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('description')" class="help-block">
									<strong> {{errors['description']}} </strong>
								</span>
							</div>
						</div>

						<div class="form-group row m-0"> 
							<input type="file"  name="activity-imagea" class="form-control form-control-sm" id="activity-image" v-on:change="imguploaded" multiple>
						</div>
						
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
					<button  class="btn btn-primary btn-sm" @click="checkForm">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	</div><!--end activities-->
</template>
<script>
	import {Post} from '../../Post.ts';
	import {Auth} from '../../Auth.ts';
	import ImagePostComponent from '../post/ImagePostComponent';
	import { mapGetters } from 'vuex';
	export default
	{
		props:[],
		data:function ()
		{
			return {
				groupPosts:this.$store.state.school_activities,
				name:'',
				posts:{posts2:this.$store.state.school_activities},
				description:'',
				type :'',
				errors:{},
				activities_options:{show_carousel:true,show_carousel_on:'participants',caption:'name'},
				'activities-image':null,
				auth : new Auth()
			}
		},
		components:{
			'image-post':ImagePostComponent
		},
		computed:
      {
        //get the auth status and user
          ...mapGetters({
            authenticated: 'auth/authenticated',
            auth_user: 'auth/user',
            user:'user'
        })
      },
		methods:
		{
			addActivityClicked:function()
			{
				$('#add-activity-modal').modal();
			},
			imguploaded:function(e)
			{
				this['activities-image'] = event.target.files;
			},
			checkForm: function (e) {
				this.errors = {};

				if (!this.name) 
				{
					//this.errors.push("Name required.");
					this.errors['name'] = 'Name required';
				}

				if (!this.description) 
				{
					//this.errors.push("Name required.");
					this.errors['description'] = 'Description required';
				} 

				if (!this.type) 
				{
					//this.errors.push("Name required.");
					this.errors['type'] = 'Type required';
				}
				
				if (Object.keys(this.errors).length === 0 && this.errors.constructor === Object) {
					this.submit();
					//return true;
				}

	
			},
			submit: function(){
				var keys = [
					'name',
					'description',
					'type',
					];//which values from data are inputs

				var currentObj = this;
      			var formObj = new FormData();
       			keys.forEach(function(key){
       				if(currentObj.$data[key] != '')//ignore empty inputs
       				formObj.append(key,currentObj.$data[key]);
       			});

       			if(this['activities-image'] != null)
            	{
                	//formObj.image = this.image;
                	for(var i = 0; i<this['activities-image'].length;i++)
                	{
                    	formObj.append('activities-image[]',this['activities-image'][i]);
                	}
            	}
            	
            	formObj.append('_token',this.$store.state.token);//add a token to the form
            	$('#add-activity-modal').modal('hide');
            	var currentObj = this;
            	//
            	this.$swal({
                	text: "adding activity",
                	icon:currentObj.image_url,
                	buttons: false,
            	});

            	axios.post('/add-activity',formObj)
            	.then(function (response) {
            		currentObj.$store.commit('increment1',[response.data['post']]);
                	//show success alert
                	currentObj.$swal({
                    	text: 'Successfully added activity',
                    	icon: "success",
                    	buttons:false,
                    	timer: 3000,
                	});
            	})
            	.catch(function (error) {
            		//show error alert
            		currentObj.$swal({
                    	text: 'An error has occured',
                    	icon: "error",
                    	buttons:false,
                    	timer: 3000,
                	});

                	var errors_ = error.response.data.errors;
                	//iterate errors and display on appropriate input field
            		Object.keys(errors_).forEach(function(err){
            			errors_[err].forEach(function(msg){
            			currentObj[err]= null;
            				currentObj.errors[err] = msg;
            			});
            		});
                	currentObj.output = error;
            	});
            	
			},

		},
		mounted()
		{
			//this.post = new Post();
    		//this.post.get(this,'/api/'+this.$route.params.slug+'/activities',1,'user_id','school_activities');
		}
	}
</script>