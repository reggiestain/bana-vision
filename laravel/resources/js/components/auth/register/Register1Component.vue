<template :key="register">
		<!--      ============================= FORM =======================================  -->
<form @submit.prevent="checkForm"  id="register-form" method="POST" :key="regidter_form">
    <!--============================= PARTY =======================================-->
    <div class="form-group col-md-6 col-sm-12 col-xs-12">

      <label for="party" class="control-label">Party:</label>
      

      <select class="form-control form-control-sm col-md-12 control-label" v-model="party" id="party" name="party">
         <option value="Student">Student</option>
         <option value="Company" >Company</option>
         <option value="School" selected="selected">School</option>
         <option value="Organization">Organization</option>
      </select>
    
    </div>
 
  <div class="form-row">
   <!--============================= NAME =======================================-->
   <div class="form-group $errors->has('name') ? ' has-error' : ''  col-md-6" id="name_div">
   	<label for="name" class="col-md-4 control-label">name</label>

   	<input id="name" type="text" class="form-control form-control-sm" v-model="name" name="name" value=" old('name') " autocomplete="new-password" placeholder="enter name" >
   	<!--===========NAME INPUT ERROR MESSAGE=============-->
   	<span v-if="errors.hasOwnProperty('name')" class="help-block" >
   		<strong> {{errors['name']}} </strong>
   	</span>
   </div>
   <!--============================= EMAIL =======================================-->
    <div class="form-group $errors->has('email') ? ' has-error' : ''  col-md-6" id="email_div">
     <label for="email" class="control-label">E-Mail Address</label>
     
       <input id="email" type="email" class="form-control form-control-sm" v-model="email" name="email" value=" old('email') " autocomplete="new-password" placeholder="enter email" >
       <!--===========NAME INPUT ERROR MESSAGE=============-->
       <span v-if="errors.hasOwnProperty('email') || errors.hasOwnProperty('email_validation')" class="help-block">
         <strong> {{errors['email']}}{{errors['email_validation']}} </strong>
       </span>
   </div>
 </div>
 <div class="form-row">
 	<!--============================= PASSWORD =======================================-->
 	<div class="form-group $errors->has('password') ? ' has-error' : ''  col-md-6">
 		<label for="password" class="control-label">Password</label>

 		<input id="password" type="password" v-model="password" class="form-control form-control-sm" name="password" autocomplete="new-password" >
 		<!--===========NAME INPUT ERROR MESSAGE=============-->
 		<span v-if="errors.hasOwnProperty('password')" class="help-block">
 			<strong> {{errors['password']}} </strong>
 		</span>
 	</div>
 	<!--============================= PASSWORD CONFIRM ==================================-->
 	<div class="form-group">
 		<label for="password-confirm" class="control-label">Confirm Password</label>

 		<input id="password-confirm" v-model="password_confirmation" type="password" class="form-control form-control-sm" name="password_confirmation" autocomplete="new-password" >
 		<span v-if="errors.hasOwnProperty('password_confirmation')" class="help-block">
 			<strong> {{errors['password_confirmation']}} </strong>
 		</span>
 	</div> 
 </div>
     
    
<div class="form-group">
       <div class="col-md-6 col-md-offset-4">
         <input type="submit" class="btn btn-orange btn-sm" name="" id="submit-register" formnovalidate>
         <input type="hidden" name="_token" value="Session::token()">
       </div>
     </div>

 </form> 
</template>
<script >
  import {Post} from '../../../Post.ts';
	export default
	{
		props:[],
		data:function() {
			return{
				party:this.$route.params.party?this.$route.params.party:'School',
				name:'',
				email:'',
				password:'',
				password_confirmation:'',
				errors:{},
			}

		},
		methods:
		{
      //check the form for invalid inputs
      //**********************please abstract this method *******************************
			checkForm: function (e) {
				this.errors = {};

				if (!this.name) 
				{
					//this.errors.push("Name required.");
					this.errors['name'] = 'Name required';
				}
				if (!this.password) 
				{
					//this.errors.push("Name required.");
					this.errors['password'] = 'Password required';
				}

				if (!this.email) 
				{
					//this.errors.push('Email required.');
					this.errors['email'] = 'Email required';
				} 
				else if (!this.validEmail(this.email)) 
				{
					//this.errors.push('Valid email required.');
					this.errors['email_validation'] ="not valid email";
				}


				if (this.password !== this.password_confirmation)
				{
					//this.errors.push('password do not match');
					this.errors['password_confirmation'] = 'password do not match';
				}

				if (Object.keys(this.errors).length === 0 && this.errors.constructor === Object) {
					console.log(this.$parent.$options.components);
					this.submit();
					//return true;
				}

	
			},
			submit: function(){
				var keys = [
					'name',
					'email',
					'password',
					'password_confirmation',
					'party'
					];//which values from data are inputs
				var currentObj = this;
      			var formObj = new FormData();
       			keys.forEach(function(key){
       				if(currentObj.$data[key] != '')//ignore empty inputs
       				formObj.append(key,currentObj.$data[key]);
       			});
            	
            	var currentObj = this;
            	//
            	this.$swal({
                	text: "processing step 1",
                	type:currentObj.image_url,
                	buttons: false,
            	});
              //set party in store
              currentObj.$store.commit('set',{property_name:'registerParty',property_values:currentObj.party});
                                 let post_helper = new Post();
              post_helper.update_value(currentObj,currentObj.party,'Party');

            	//validate the email address on the server
            	axios.post('../api/register/step-1',formObj)
            	.then(function (response) {
                  currentObj.$store.commit('set',{property_name:'currentComponent',property_values:'register-2'});
                   const new_data = currentObj.$data;
                  //save the user information in store
                  delete new_data['errors'];
                  delete new_data['party'];
                   post_helper.update_value(currentObj,new_data,'user');
                	//show success alert
                	currentObj.$swal({
                    	text: 'step 1 complete',
                    	type: "success",
                    	showConfirmButton:false,
                    	timer: 3000,
                	});
            	})
            	.catch(function (error) {
            		//show error alert
            		currentObj.$swal({
                    	text: 'An error has occured',
                    	type: "error",
                    	showConfirmButton:false,
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

			validEmail: function (email) 
			{
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(email);
			}
		},
		computed:
		{

		},
		mounted()
		{
			console.log(this.$parent.$options.components);
		}
	}
</script>