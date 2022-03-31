<template>
	<div class="modal" tabindex="-1" role="dialog" id="add-student-modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						Add Student
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div><!--end modal header-->
				<div class="modal-body">
					<form  enctype="multipart/form-data">
						<!--========================v-model================================-->
						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">
								Name :
							</label>
							<div class="col-sm-9 ">
								<input  type="text" v-model="name" class="form-control form-control-sm" id="name" placeholder="student's name">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('name')" class="help-block" >
									<strong>
										{{errors['name']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--=========================Surv-model=========================-->
						<div class="form-group row">
							<label for="surname" class="col-sm-3 col-form-label">
								Surname
							</label>
							<div class="col-sm-9 ">
								<input  type="text" v-model="surname" class="form-control form-control-sm" id="surname" placeholder="student's surname">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('surname')" class="help-block" >
									<strong>
										{{errors['surname']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================ID number=======================-->
						<div class="form-group row">
							<label for="id_number" class="col-sm-3 col-form-label">
								Id number
							</label>
							<div class="col-sm-9 ">
								<input  type="text" v-model="id_number" class="form-control form-control-sm" id="id_number" placeholder="student's identity/passport number">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('id_number')" class="help-block" >
									<strong>
										{{errors['id_number']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Disability=======================-->
						<div class="form-group row">
							<label for="disability" class="col-sm-3 col-form-label">
								Disability
							</label>
							<div class="col-sm-9 ">
								<textarea  v-model="disability" class="form-control form-control-sm" id="disability" placeholder="what disability does the student have if any?"></textarea>
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('disability')" class="help-block" >
									<strong>
										{{errors['disability']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Guardian=======================-->
						<div class="form-group row">
							<label for="guardian" class="col-sm-3 col-form-label">
								Guardian
							</label>
							<div class="col-sm-9 ">
								<input  type="text" v-model="guardian"  class="form-control form-control-sm" id="guardian" placeholder="student's legal guardian">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('guardian')" class="help-block" >
									<strong>
										{{errors['guardian']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Grade=======================-->
						<div class="form-group row">
							<label for="grade" class="col-sm-3 col-form-label">
								Grade
							</label>
							<div class="col-sm-9 ">
								<input  v-model="grade" type="number" class="form-control form-control-sm" id="grade" placeholder="student's current grade">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('grade')" class="help-block" >
									<strong>
										{{errors['grade']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Class=======================-->
						<div class="form-group row">
							<label for="class" class="col-sm-3 col-form-label">
								Class
							</label>
							<div class="col-sm-9 ">
								<input  type="text" v-model="class_" class="form-control form-control-sm" id="class" placeholder="student's class suffix i.e C">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('class_')" class="help-block" >
									<strong>
										{{errors['class_']}} 
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
						<!--========================Year=======================-->
						<div class="form-group row">
							<label for="year" class="col-sm-3 col-form-label">
								Year
							</label>
							<div class="col-sm-9 ">
								<input  type="text" v-model="year" class="form-control form-control-sm" id="year">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('year')" class="help-block" >
									<strong>
										{{errors['year']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Special medication=======================-->
						<div class="form-group row">
							<label for="special_medication" class="col-sm-3 col-form-label">
								Special medication :
							</label>
							<div class="col-sm-9 ">
								<input  type="text" v-model="special_medication" class="form-control form-control-sm" id="special_medication" placeholder="any special medication required by student">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('special_medication')" class="help-block" >
									<strong>
										{{errors['special_medication']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Medical condition=======================-->
						<div class="form-group row">
							<label for="medical_condition" class="col-sm-3 col-form-label">
								Medical condition:
							</label>
							<div class="col-sm-9 ">
								<textarea  type="text" class="form-control form-control-sm" id="medical_condition" v-model="medical_condition" placeholder="student's medical condition"></textarea>
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('medical_condition')" class="help-block" >
									<strong>
										{{errors['medical_condition']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Previous school=======================-->
						<div class="form-group row">
							<label for="previous_school" class="col-sm-3 col-form-label">
								Previous school
							</label>
							<div class="col-sm-9 ">
								<input  type="text" class="form-control form-control-sm" id="previous_school" v-model="previous_school" placeholder="student's last attnded school">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('previous_school')" class="help-block" >
									<strong>
										{{errors['previous_school']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Last grade at previous school=======================-->
						<div class="form-group row">
							<label for="previous_school_grade" class="col-sm-3 col-form-label">
								Last grade at previous school :
							</label>
							<div class="col-sm-9">
								<input  type="number" class="form-control form-control-sm" id="previous_school_grade" v-model="previous_school_grade" placeholder="student's grade at last attended school">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('previous_school_grade')" class="help-block" >
									<strong>
										{{errors['previous_school_grade']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================Previous grade=======================-->
						<div class="form-group row">
							<label for="previous_grade" class="col-sm-3 col-form-label">
								Previous grade :
							</label>
							<div class="col-sm-9 ">
								<input  v-model="previous_grade" type="text"  class="form-control form-control-sm" id="previous_grade" placeholder="student's previous grade">
								<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
								<span v-if="errors.hasOwnProperty('previous_grade')" class="help-block" >
									<strong>
										{{errors['previous_grade']}} 
									</strong>
								</span>
							</div>
						</div>
						<!--========================student number=======================-->
						<div class="form-group row">
							<label for="student_number" class="col-sm-3 col-form-label">
								Student number
							</label>
							<div class="col-sm-9 ">
								<input  v-model="student_number" type="text"  class="form-control form-control-sm" id="student_number" placeholder="student's student number">
								
							</div>
						</div>
						<input class="form-control form-control-sm" type="file" v-on:change="imguploaded" placeholder="please upload student's picture">
						<!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
						<span v-if="errors.hasOwnProperty('image')" class="help-block" >
							<strong>
								{{errors['image']}} 
							</strong>
						</span>
					</form>
				</div><!--end modal body-->
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-sm" v-on:click="checkForm">
						Save changes
					</button>

					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
						Close
					</button>
				</div><!--end modal footer-->
			</div><!--end modal content-->
		</div><!--end modal dialog-->
	</div><!--end modal-->
</template>
<script>
	export default
	{
		props:['useridno'],
		data:function(){
			return{
				errors:{},
				'name':'',
				'surname':'',
				'id_number':'',
				'disability':'',
				'guardian':'',
				'grade':'',
				'class_':'',
				'gender':'',
				'year':'',
				'special_medication':'',
				'medical_condition':'',
				'previous_school':'',
				'previous_school_grade':'',
				'previous_grade':'',
				'student_number':'',
				'image':'',
				keys:[
					'name',
					'surname',
					'id_number',
					'disability',
					'guardian',
					'grade',
					'class_',
					'gender',
					'year',
					'special_medication',
					'medical_condition',
					'previous_school',
					'previous_school_grade',
					'previous_grade',
					'image'
					],

			}
		},
		methods:
		{
			checkForm: function (e) {
				var that = this;
				this.errors = {};

				this.keys.forEach(function(key){
					if(!that.$data[key])
					{
						that.errors[key] = key+' required';

					}
				});

				if (Object.keys(this.errors).length === 0 && this.errors.constructor === Object) {
					console.log(this.$parent.$options.components);
					this.submit();
					//return true;
				}

	
			},
			submit: function(){

				var currentObj = this;
      			var formObj = new FormData();
       			currentObj.keys.forEach(function(key){
       				if(currentObj.$data[key] != '')//ignore empty inputs
       				formObj.append(key,currentObj.$data[key]);
       			});
            	
            	formObj.append('_token',this.$store.state.token);//add a token to the form
            	formObj.append('school_id',this.useridno.usable_id); //add school id to the form
            	formObj.append('student_number',this.student_number);//add student number to the form
            	//
            	this.$swal({
                	text: "processing step 1",
                	icon:currentObj.image_url,
                	buttons: false,
            	});

            	axios.post('/createSchoolStudent',formObj)
            	.then(function (response) {
            		currentObj.$store.commit('increment',[response.data['post']]);
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
		}
	}
</script>