<template>
	<!--=======================SETTINGS=======================-->
	<div role="tabcard card" class="tab-pane p-3" id="settings">
		<h4 align="center">
			Settings
		</h4>
		
			<ul class="list-group list-group-flush">
				<!--=================================BASIC DETAILS=======================================-->
				<li class="list-group-item  list-group-item-action">
					<div>
						<a data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1" style="display:block;width:100%">
							<p class="profile-info-list-lable">
								Basic Details
							</p>
							<i class="fas fa-pen float-right"></i>
						</a>
					</div>
					<div class="collapse" id="collapseExample1">
						<form @submit.prevent="editInfo" enctype="multipart/form-data" autocomplete="off">
						<div class="form-row">
							<!--===========================NAME===========================-->
							<div class="form-group col-md-6  $errors->has('name') ? 'has-error':''" id="name_div">
								<label for="name">
									Name:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="name" id="name" :placeholder="user.name" >  
							</div>
							<!--===========================EMAIL===========================-->
							<div class="form-group col-md-6 $errors->has('email') ? 'has-error':''" id="email_div">
								<label for="email">
									E-mail
								</label>
								<input class="form-control form-control-sm" type="text" v-model="email"  id="email" :placeholder="user.email" autocomplete="new-password">  
							</div> 
						</div>
						<div class="form-row">
							<!--===========================INSTITUTION===========================-->
							<div class="form-group col-md-6  $errors->has('institution') ? 'has-error':''" id="institution_div">
								<label for="institution">
									Institution:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="institution" id="institution" placeholder="">  
							</div> 
							<!--===========================PASSWORD===========================-->
							<div class="form-group col-md-6 $errors->has('password') ? 'has-error':''" id="password_div">
								<label for="password">
									Password:
								</label>
								<input class="form-control form-control-sm" type="password" v-model="password" id="password" :placeholder="user.password" autocomplete="new-password"> 
							</div> 


						</div>

						<!--====================================SUBMIT BUTTONS====================================-->
						<div class="col-12 d-flex">
							<div class="btn-group ml-auto mr-auto" role="group" aria-label="Basic example">
								<button type="submit" class="btn btn-light btn btn-outline-dark  btn-sm">
									Submit
								</button> 
								<button class="btn btn-light btn btn-outline-danger  btn-sm" id='delete-user' >
									Delete User 
								</button>
							</div>
						</div>
					</form>
					</div>
				</li>
				<!-- end collpseexmple1 -->
				<!--=================================GENERAL INFORMATION=======================================-->
				<li class="list-group-item  list-group-item-action">
					<div>

						<a  data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2" style="display:block;width:100%">
							<p class="profile-info-list-lable">
								General Information
							</p>
							<i class="fas fa-pen float-right"></i>
						</a>
					</div>
					<div class="collapse" id="collapseExample2">
						<form @submit.prevent="editInfo" enctype="multipart/form-data">
						<div class="form-row"> 
							<!--===========================COUNTRY===========================-->   
							<div class="form-group col-md-6 $errors->has('country') ? 'has-error':''" id="country_div">
								<label for="country">
									country:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="country" id="country" :placeholder="usable.country"> 
							</div>
							<!--===========================K_12===========================-->
							<div class="form-group col-md-6 $errors->has('k_12') ? 'has-error':''" id="k_12_div">
								<label for="k_12">
									k_12:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="k_12" id="k_12" :placeholder="usable.k_12"> 
							</div> 
						</div>
						<div class="form-row"> 
							<!--===========================COEDUCATIONAL===========================-->
							<div class="form-group col-md-6 $errors->has('coeducational') ? 'has-error':''" id="coeducational_div">
								<label for="coeducational">
									coeducational:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="coeducational" id="coeducational" :placeholder="usable.coeducational"> 
							</div>         
							<!--===========================FUNDING===========================-->
							<div class="form-group col-md-6 $errors->has('funding') ? 'has-error':''" id="funding_div">
								<label for="funding">
									Funding:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="funding" id="funding" :placeholder="usable.funding"> 
							</div>
						</div>
						<div class="form-row">
							<!--===========================PASS RATE===========================-->
							<div class="form-group col-md-6 $errors->has('pass_rate') ? 'has-error':''" id="pass_rate_div">
								<label for="pass_rate">
									pass rate:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="pass_rate" id="pass_rate" :placeholder="usable.pass_rate"> 
							</div>
							<!--===========================SPECIAL NEEDS===========================-->
							<div class="form-group col-md-6 $errors->has('special_needs') ? 'has-error':''" id="special_needs_div">
								<label for="special_needs">
									special needs:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="special_needs" id="special_needs" :placeholder="usable.special_needs"> 
							</div> 
						</div>


						<div class="form-row">
							<!--===========================PRINCIPAL===========================-->
							<div class="form-group col-md-6 $errors->has('principal') ? 'has-error':''" id="principal_div">
								<label for="principal" >
									Principal:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="principal" id="principal" :placeholder="usable.principal"> 
							</div> 
							<!--===========================NUMBER STUDENTS===========================-->
							<div class="form-group col-md-6 $errors->has('number_students') ? 'has-error':''" id="number_students_div">
								<label for="number_students">
									Number students:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="number_students" id="number_students" :placeholder="usable.number_students"> 
							</div> 
						</div>
						<!--===========================NUMBER TEACHERS===========================-->
						<div class="form-row">
							<div class="form-group col-md-6 $errors->has('number_teachers') ? 'has-error':''" id="number_teachers_div">
								<label for="number_teachers">
									Number teachers:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="number_teachers" id="number_teachers" :placeholder="usable.number_teachers"> 
							</div> 


						</div>

						<!--====================================SUBMIT BUTTONS====================================-->
						<div class="col-12 d-flex">
							<div class="btn-group ml-auto mr-auto" role="group" aria-label="Basic example">
								<button type="submit" class="btn btn-light btn btn-outline-dark  btn-sm">
									Submit
								</button> 
								<button class="btn btn-light btn btn-outline-danger  btn-sm" id='delete-user' >
									Delete User
								 </button>
							</div>
						</div>
					</form>
					</div>
				</li>
				<!-- end collpseexmple2 -->
				<!--=================================ABOUT=======================================-->
				<li class="list-group-item  list-group-item-action">                         
					<div>

						<a  data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3" style="display:block;width:100%">
							<p class="profile-info-list-lable">
								About
							</p>
							<i class="fas fa-pen float-right"></i>
						</a>
					</div>
					<div class="collapse" id="collapseExample3">
						<form @submit.prevent="editInfo" enctype="multipart/form-data">
						<div class="form-row">
							<!--===========================ABOUT===========================-->
							<div class="form-group col-md-12 $errors->has('about') ? 'has-error':''" id="about_div">
								<label for="password">
									About:
								</label>
								<textarea class="form-control form-control-sm" v-model="about" id="about" :placeholder="usable.about"> </textarea>
							</div> 
							
						</div>
						<div class="form-row">
						<!--===========================HISTORY===========================-->
							<div class="form-group col-md-12 $errors->has('history') ? 'has-error':''" id="history_div">
								<label for="history">
									History:
								</label>
								<textarea class="form-control form-control-sm"  v-model="history" id="history" :placeholder="usable.history"> </textarea>
							</div> 
						</div>

						<!--====================================SUBMIT BUTTONS====================================-->
						<div class="col-12 d-flex">
							<div class="btn-group ml-auto mr-auto" role="group" aria-label="Basic example">
								<button type="submit" class="btn btn-light btn btn-outline-dark  btn-sm">
									Submit
								</button> 
								<button class="btn btn-light btn btn-outline-danger  btn-sm" id='delete-user' >
									Delete User
								 </button>
							</div>
						</div>
					</form>
					</div>
				</li>
				<!-- end collpseexmple3 -->
				<!--=================================CONTACT DETAILS=======================================-->
				<li class="list-group-item  list-group-item-action">
					<div>
						<a data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4" style="display:block;width:100%">
							<p class="profile-info-list-lable">
								Contact Details
							</p>
							<i class="fas fa-pen float-right"></i>
						</a>
					</div>
					<div class="collapse" id="collapseExample4">
						<form @submit.prevent="editInfo" enctype="multipart/form-data">
						<div class="form-row">
							<!--===========================WEBSITE===========================-->
							<div class="form-group col-md-6 $errors->has('web_url') ? 'has-error':''" id="website_div">
								<label for="web_url">
									website
								</label>
								<input class="form-control form-control-sm" type="text" v-model="website" id="website" :placeholder="usable.web_url">  
							</div> 
							<!--===========================TELEPHONE===========================-->
							<div class="form-group col-md-6 $errors->has('telephone') ? 'has-error':''" id="telephone_div">
								<label for="telephone">
									Telephone:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="telephone" id="telephone" :placeholder="usable.telephone">  
							</div> 
						</div>
						<!-- @if($userIdNo->usable_type != "App\Student")-->
						<div class="form-row">
							<!--===========================PROVINCE===========================-->
							<div class="form-group col-md-6" id="province_div">
								<label for="province">
									Province:
								</label>
								<select class="form-control form-control-sm" id="province" v-model="province">
									<option value="eastern-cape">
										Eastern Cape
									</option>
									<option value="free-state" selected="selected">
										Free State
									</option>
									<option value="gauteng">
										Gauteng
									</option>
									<option value="kwazulu-natal">
										KwaZulu Natal
									</option>
									<option value="limpopo">
										Limpopo
									</option>
									<option value="mpumalanga">
										Mpumalanga
									</option>
									<option value="north-west">
										North West
									</option>
									<option value="northern-cape">
										Northern Cape
									</option>
									<option value="western-cape">
										Western Cape
									</option>
								</select>
							</div>
							<!--===========================ADDRESS===========================-->
							<div class="form-group col-md-6 $errors->has('address') ? 'has-error':''" id="address_div">
								<label for="address">
									Address
								</label>
								<input class="form-control form-control-sm" type="text" v-model="address" id="address" :placeholder="usable.address">  
							</div> 
						</div>

						<div class="form-row">
							<!--===========================DISTRICT===========================-->
							<div class="form-group col-md-6 $errors->has('district') ? 'has-error':''" id="district_div">
								<label for="district">
									district:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="district" id="district" :placeholder="usable.district"> 
							</div> 
							<!--===========================SUBURB===========================-->
							<div class="form-group col-md-6 $errors->has('suburb') ? 'has-error':''" id="suburb_div">
								<label for="suburb">
									suburb:
								</label>
								<input class="form-control form-control-sm" type="text" v-model="suburb" id="suburb" :placeholder="usable.suburb"> 
							</div> 
						</div> 

						<!--====================================SUBMIT BUTTONS====================================-->
						<div class="col-12 d-flex">
							<div class="btn-group ml-auto mr-auto" role="group" aria-label="Basic example">
								<button type="submit" class="btn btn-light btn btn-outline-dark  btn-sm">
									Submit
								</button> 
								<button class="btn btn-light btn btn-outline-danger  btn-sm" id='delete-user' >
									Delete User
								 </button>
							</div>
						</div>
					</form>
					</div>
					<!--@endif-->

				</li>
			</ul>
			<br>
	</div> <!--end settings-->
</template>
<script>
	import {Post} from '../../../Post.ts';
	import { mapGetters } from 'vuex';
	export default
	{
		data:function()
		{
			return{

				name:'',
				usable:{},
				email:'',
				institution:'',
				password:'',
				country:'',
				'k_12':'',
				coeducational:'',
				funding:'',
				'pass_rate':'',
				'special_needs':'',
				principal:'',
				'number_students':'',
				'number_teachers':'',
				about:'',
				history:'',
				website:'',
				telephone:'',
				province:'',
				address:'',
				district:'',
				suburb:'',
			}
		},
		methods:
		{
			editInfo(e)
			{
				var keys=[
				'name',
				'email',
				'institution',
				'password',
				'country',
				'k_12',
				'coeducational',
				'funding',
				'pass_rate',
				'special_needs',
				'principal',
				'number_students',
				'number_teachers',
				'about','history',
				'website',
				'telephone',
				'province',
				'address',
				'district',
				'suburb'
				];//which values from data are inputs
				var currentObj = this;
      			var formObj = new FormData();
       			keys.forEach(function(key){
       				if(currentObj.$data[key] != '')
       				formObj.append(key,currentObj.$data[key]);
       			});
            	
            	formObj.append('_token',this.$store.state.token);
            	var currentObj = this;
            	//
            	this.$swal({
                	text: "Updating contact details",
                	icon:currentObj.image_url,
                	buttons: false,
            	});
            	//
            	axios.post('../editInfo',formObj)
            	.then(function (response) {
                	console.error(response.data[1]);
                	//currentObj.$store.commit('setprofilepic',response.data[1]);
                	currentObj.$store.commit('setUserIdNo',response.data['user']);
                	currentObj.$swal({
                    	text: 'Contact details successfully updated',
                    	icon: "success",
                    	buttons:false,
                    	timer: 3000,
                });
            	})
            	.catch(function (error) {
                	currentObj.output = error;
            	})
            	.finally(function(){
               		//reset the forms
               		for (var key in currentObj.$data) 
               		{
               			if (currentObj.$data.hasOwnProperty(key))
               			{
               				currentObj.$data[key] = '';
               			}
               		}
               		
            	});
			}

		},
		computed:
		{
			/*getUser:function()
			{
				return this.$store.state.userIdNo
			}*/
			//get the auth status and user
          ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        }),
		},
		mounted()
		{
			this.post = new Post();
    		this.post.get(this,'/api/'+this.$route.params.slug+'/usable',1,'setUsable');
		}
	}
</script>