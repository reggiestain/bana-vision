<template>
	<div class="modal" tabindex="-1" role="dialog" id="add-staff-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						Add Staff
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form  enctype="multipart/form-data">
						<!--=========================NAME=========================-->
						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">
								Name :
							</label>
							<div class="col-sm-9">
								<input type="text" v-model="name" class="form-control form-control-sm" id="name" placeholder="staff members name">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('name')" class="help-block" >
									<strong>
										{{errors['name']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--=========================SURNAME=========================-->
						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">
								surname :
							</label>
							<div class="col-sm-9">
								<input type="text" v-model="surname" class="form-control form-control-sm" id="name" placeholder="staff members surname">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('surname')" class="help-block" >
									<strong>
										{{errors['surname']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--==========================GENDER==========================-->
						<div class="form-group row" id="gender_div">
							<label for="gender" class="col-sm-3 control-label">
								Gender:
							</label>
							<div class="col-sm-9">
								<select class="form-control form-control-sm" id="gender" v-model="gender">
									<option value="Male">
										Male
									</option>
									<option value="Female" selected="selected">
										Female
									</option>
								</select>
							</div>
						</div>

						<!--=========================ID NUMBER=========================-->
						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">
								Id number :
							</label>
							<div class="col-sm-9">
								<input type="text" v-model="id_number" class="form-control form-control-sm" id="id_number" placeholder="staff members identity/passport number">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('id_number')" class="help-block" >
									<strong>
										{{errors['id_number']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--=========================EMAIL=========================-->
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">
								Email :
							</label>
							<div class="col-sm-9">
								<input type="text" v-model="email" class="form-control form-control-sm" id="email" placeholder="staff members email ">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('email')" class="help-block" >
									<strong>
										{{errors['email']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--=========================IMAGE=========================-->
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">
								Image :
							</label>
							<div class="col-sm-9">
								<input  type="file" v-on:change="imguploaded" class="form-control form-control-sm" id="image" >
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('image')" class="help-block" >
									<strong>
										{{errors['image']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--=========================PASSWORD=========================-->
						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label">
								Password :
							</label>
							<div class="col-sm-9">
								<input type="password" v-model="password" class="form-control form-control-sm" id="password" >
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('password')" class="help-block" >
									<strong>
										{{errors['password']}} 
									</strong>
								</span>
							</div>
						</div>

						<!--=========================PASSWORD CONFIRMATION=========================-->
						<div class="form-group row">
							<label for="password" class="col-sm-3 col-form-label">
								Confirm Password :
							</label>
							<div class="col-sm-9">
								<input type="password" v-model="password_confirmation" class="form-control form-control-sm" id="password_confirmation" placeholder="repeat password">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('password_confirmation')" class="help-block" >
									<strong>
										{{errors['password_confirmation']}} 
									</strong>
								</span>
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('password_confirmation')" class="help-block" >
									<strong>
										{{errors['password_mismatch']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--=========================POSITION=========================-->
						<div class="form-group row">
							<label for="position" class="col-sm-3 col-form-label">
								Position :
							</label>
							<div class="col-sm-9">
								<input type="text" v-model="position" class="form-control form-control-sm" id="position" placeholder="staff members role ">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('position')" class="help-block" >
									<strong>
										{{errors['position']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--=======================================IS TEACHER=======================================-->
						<div class="form-check disabled mr-1">
							<input class="form-check-input" type="checkbox"  id="isteacher" value="true" v-model="is_teacher" @change="getCurriculumn">
							<label class="form-check-label" for="is_teacher">
								Is Teacher?
							</label>
						</div>
						<div class="p-2 border-left" v-if="is_teacher == true">
							<!--=========================AWARDSAWARDS=========================-->
							<div class="form-group row">
								<label for="awards" class="col-sm-3 col-form-label">
									Awards :
								</label>
								<div class="col-sm-9">
									<textarea type="text" v-model="awards" class="form-control form-control-sm" id="awards" placeholder="teachers awards if any"></textarea>
									<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
									<span v-if="errors.hasOwnProperty('awards')" class="help-block" >
										<strong>
											{{errors['awards']}} 
										</strong>
									</span>
								</div>
							</div>
							<!--=========================ABOUT=========================-->
							<div class="form-group row">
								<label for="about" class="col-sm-3 col-form-label">
									About :
								</label>
								<div class="col-sm-9">
									<textarea type="text" v-model="about" class="form-control form-control-sm" id="about" placeholder="teachers description "></textarea>
									<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
									<span v-if="errors.hasOwnProperty('about')" class="help-block" >
										<strong>
											{{errors['about']}} 
										</strong>
									</span>
								</div>
							</div>
							<div class="form-group row p-2" id="experience-div" v-for="(curric,index) in curriculumn_view">
								<div class="badge badge-pill p-2">
									{{curric}}
								</div>
							</div>
							<!--=========================CURRICULUMN_ID=========================-->
							<div class="form-group row">
								<label for="curriculumn_id" class="col-sm-3 col-form-label">
									Subject :
								</label>
								<div class="col-sm-9">
									<select type="text" v-model="curriculumn_in"  class="form-control form-control-sm" id="curriculumn_id" placeholder="Select subject teacher qualified for">
											<option  v-for="curric in curriculumn" :value="curric">{{curric.subject+' grade '+curric.grade}}</option>
										
									</select>
								</div>
							</div>
							<!--=========================EXPERIENCE=========================-->
							<div class="form-group row">
								<label for="experience" class="col-sm-3 col-form-label">
									Experience :
								</label>
								<div class="col-sm-9">
									<input type="number" v-model="experience_in"  class="form-control form-control-sm" id="experience" >
									<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
									<span v-if="errors.hasOwnProperty('experience')" class="help-block" >
										<strong>
											{{errors['experience']}} 
										</strong>
									</span>
								</div>
							</div>
							<div class="col-12">
								<button type="button" class="btn btn-secondary btn-sm" id="add-experience" v-on:click="addExperience">
									<i class="fas fa-plus"></i>
									Add Experience
								</button>
							</div>

						</div><!--end if is teacher-->
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm " v-on:click="checkForm">
						Save changes
					</button>

					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>    
</template>
<script>
	export default
	{
		props:['useridno'],
		data:function()
		{
			return{
				errors:{},
				'name':'',
				id_number:'',
				surname:'',
				gender:'Female',
				email:'',
				password:'',
				password_confirmation:'',
				position:'',
				is_teacher:false,
				awards:'',
				about:'',
				curriculumn:null,
				'curriculumn_id[]':[],
				curriculumn_in:'',
				curriculumn_view:[],
				image:'',
				'experience[]':[],
				experience_in:null,
				keys:[
					'name',
					'id_number',
					'surname',
					'gender',
					'email',
					'password',
					'password_confirmation',
					'position',
					'image',
					
					],

			}
		},
		methods:
		{
			checkForm: function (e) {
				var that = this;
				this.errors = {};

				
				 if (that.is_teacher && (!that.keys['awards'] || !that.keys['about'] || !that.keys['curriculumn_id[]'] || !that.keys['experience[]'])) 
					{

				 	that.keys.push('awards');
				 	that.keys.push('about');
				 	that.keys.push('curriculumn_id[]');
				 	that.keys.push('experience[]'); 
				 	that.keys.push('is_teacher');
			console.log(that.keys['awards']);
				return;
				 	}

				//validate inputs
				this.keys.forEach(function(key){
					if (that.password != that.password_confirmation) 
					{
						that.errors['password_mismatch'] = "password do not match"
					}

					if(!that.$data[key] && key != 'is_teacher')
					{
						that.errors[key] = key+' required';

					}
				});
				console.log(Object.keys(this.errors));
				if (Object.keys(this.errors).length === 0 && this.errors.constructor === Object) {
					this.submit();
					//return true;
				}

	
			},
			submit: function(){
				console.error("im reaching this far");
				var currentObj = this;
      			var formObj = new FormData();
       			currentObj.keys.forEach(function(key){
       				if(currentObj.$data[key] != '')//ignore empty inputs
       				{
       					switch(key)
       					{
       						case 'curriculumn_id[]':
       							for(var i=0;i < currentObj['curriculumn_id[]'].length;i++)
       							{
       								formObj.append('curriculumn_id[]',currentObj['curriculumn_id[]'][i]);
       							}
       						break;	

       						case 'experience[]':
       							for(var i=0;i < currentObj['experience[]'].length;i++)
       							{
       								formObj.append('experience[]',currentObj['experience[]'][i]);
       							}
       						break;

       						default:
       						formObj.append(key,currentObj.$data[key]);
       					}
       					
       				}
       				
       			});
            	
            	formObj.append('_token',this.$store.state.token);//add a token to the form
            	formObj.append('school_id',this.useridno.usable_id); //add school id to the form
    
            	//
            	this.$swal({
                	text: "processing step 1",
                	icon:currentObj.image_url,
                	buttons: false,
            	});

            	axios.post('/createStaff',formObj)
            	.then(function (response) {
            		currentObj.$store.commit('increment1',[response.data['post']]);
                	//show success alert
                	currentObj.$swal({
                    	text: 'step 1 complete',
                    	icon: "success",
                    	buttons:false,
                    	timer: 3000,
                	});
                	$('#add-student-modal').modal('hide');//hide the student modal
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
			imguploaded:function(e)
			{
				this['image'] = event.target.files[0];
			},
			getCurriculumn:function(e)
			{
				var that = this;
				if(this.is_teacher)
				{
					axios.get('../get-curriculumn/'+this.useridno.usable_id)
					 .then(response => {
					 	that.curriculumn = response.data.posts;
				 })
					.catch(error => {
						console.log(error)
						this.errored = true
					});
				}

			},
			addExperience:function(e)
			{
				this['experience[]'].push(this.experience_in);
				this['curriculumn_id[]'].push(this.curriculumn_in.id);
				this.curriculumn_view.push(this.curriculumn_in.subject+' grade '+this.curriculumn_in.grade+' : experience '+this.experience_in+' years');
			}
		}
	}
</script>