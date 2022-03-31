<template>
	<!--============================= FORM ======================================= -->   
     <form @submit.prevent="checkForm" id="register-form" method="POST">
         <!--=================================STUDENT==============================-->
          <div v-if="party == 'Student'">
          <div class="form-row">
          <!--============================= GENDER ======================================= -->
          <div class="form-group col-md-6" id="gender_div">
           <label for="gender" class="control-label">
           Gender:
         </label>
          
             <select class="form-control form-control-sm" id="gender" name="gender" v-model="gender">
              <option value="Male">
                Male
              </option>
              <option value="Female" selected="selected">
                Female
              </option>
            </select>
          
        </div>
        <!--============================= BIRTHDATE ======================================= -->
        <div class="form-group col-md-6" id="birthdate_div">
          <label for="birthdate" class="control-label">
            birthdate
          </label>

          
            <input id="birthdate" v-model="birthdate" type="date" class="form-control form-control-sm" name="birthdate" value=" old('birthdate') ">
            <!--===========BIRTHDATE INPUT ERROR MESSAGE=============-->
            <span v-if="errors.hasOwnProperty('birthdate')" class="help-block" >
            	<strong>
               {{errors['birthdate']}} 
              </strong>
            </span>
         
        </div>
        </div>

        <div class="form-row">
          <!--===========================LINK ACCOUNT WITH SCHOOL=================================-->
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="link_school" v-model="link_school">
            <label class="form-check-label" for="defaultCheck1">
              Link account with school?
            </label>
          </div>
        </div>

        <div class="form-row" >
        <!--============================= INSTITUTION ======================================= -->
         <div  class="form-group col-md-6" id="institution_div">
           <label for="institution" class="col-md-6 control-label" style="display:block;">
            Institution:
           </label>
           
            <input id="institution" v-model="institution" type="text" list="institution_list" class="form-control form-control-sm" name="institution" value=" old('institution') " >
            <!--===========INSTITUTION INPUT ERROR MESSAGE=============-->
            <span v-if="errors.hasOwnProperty('institution')" class="help-block" >
            	<strong>
               {{errors['institution']}} 
              </strong>
            </span>
           <datalist id="institution_list">
              <option value="default"></option>
            @foreach($schools as $school)
            <option value="$school->name"></option>
              @endforeach 
            </datalist>
          
          </div> 

           <!--============================= ID NUMBER ======================================= -->
         <div class="form-group col-md-6" id="id_number_div" v-if="link_school_comp">
           <label for="sector" class="col-md-4 control-label">
            Id number:
           </label>
           
           <input type="text" class="form-control form-control-sm" id="id_number" v-model="id_number" name="id_number" value="old('id_number')">
           <!--===========ID NUMBER INPUT ERROR MESSAGE=============-->
           <span v-if="errors.hasOwnProperty('id_number')" class="help-block" >
            <strong>
             {{errors['id_number']}} 
            </strong>
           </span>
         </div>

        </div>
        <div class="form-row">
          <!--============================= SECTOR ======================================= -->
         <div class="form-group col-md-6" id="sector_div">
           <label for="sector" class="col-md-4 control-label">
            Sector:
           </label>
           
           <select class="form-control form-control-sm" id="sector" v-model="sector" name="sector">
              <option value="information technology">
                Information Technology
              </option>
              <option value="engineering" selected="selected">
                Engineering
              </option>
              <option value="finance">
                Finance
              </option>
              <option value="insurance">
                Insurance
              </option>
           </select>
       
         </div>
        
           <!--============================= BIRTHDATE ======================================= -->
        <div class="form-group col-md-6" id="grade_div">
          <label for="grade" class="control-label">
            Grade
          </label>

          
            <input id="grade" v-model="grade" type="number" min="0" max="12" class="form-control form-control-sm" name="grade">
            <!--===========GRADE INPUT ERROR MESSAGE=============-->
            <span v-if="errors.hasOwnProperty('grade')" class="help-block" >
              <strong>
               {{errors['grade']}} 
              </strong>
            </span>
        </div>

       </div>
         </div>

         </div><!--end student-->
         

          <!--=======================================SCHOOL============================================-->
          <div v-else-if="party == 'School'">
            <!--============================= PROVINCE ======================================= -->
          <div class="form-row">
         <div class="form-group col-md-6 " id="province_div">
           <label for="province" class="control-label">
            Province:
           </label>
           <select class="form-control form-control-sm" id="province" v-model="province" name="province">
              <option value="eastern-cape">
                Eastern Cape
              </option>
              <option value="free-state" >
                Free State
              </option>
              <option value="gauteng"  selected="selected">
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
         <!--============================= DISTRICT ======================================= -->
         <div class="form-group col-md-6" id="district_div">
                <label for="district" class="control-label">
                  district
                </label>
                  <input id="district" type="district" v-model="district" class="form-control form-control-sm" name="district" value=" old('district') " >
                  <!--===========DISTRICT INPUT ERROR MESSAGE=============-->
                  <span v-if="errors.hasOwnProperty('district')" class="help-block" >
                  	<strong>
                     {{errors['district']}} 
                    </strong>
                  </span>
              </div>
          </div>
          <div class="form-row">
         <!--============================= SUBURB ======================================= -->
         <div class="form-group col-md-6" id="suburb_div">
                <label for="suburb" class="control-label">
                  suburb
                </label>
                  <input id="suburb" v-model="suburb" type="text" class="form-control form-control-sm" name="suburb" value=" old('suburb') " >
                  <!--===========SUBURB INPUT ERROR MESSAGE=============-->
                  <span v-if="errors.hasOwnProperty('suburb')" class="help-block" >
                  	<strong>
                     {{errors['suburb']}} 
                    </strong>
                  </span>
              </div>
         <!--============================= COUNTRY ======================================= -->
         <div class="form-group col-md-6" id="country_div">
                <label for="country" class="control-label">
                  country
                </label>
                
                  <input id="country" type="country" v-model="country" class="form-control form-control-sm" name="country" value=" old('country') ">
                  <!--===========COUNTRY INPUT ERROR MESSAGE=============-->
                  <span v-if="errors.hasOwnProperty('country')" class="help-block" >
                  	<strong>
                     {{errors['country']}} 
                    </strong>
                  </span>
              </div>
            </div>

            <div class="form-row">
         <!--============================= K12 ======================================= -->
         <div class="form-group col-md-6" id="k_12_div">
                <label for="k_12" class="control-label">
                  k_12
                </label>
               
                  <select v-model="k_12" class="form-control form-control-sm" id="k_12" name="k_12">
                    <option value="Primary">
                      Primary School
                    </option>
                    <option value="Secondary" selected="selected">
                      Secondary School
                    </option>
                    <option value="Middle">
                      Middle School
                    </option>
                    <option value="High">
                      High School
                    </option>
                  </select>
                
              </div>
         <!--============================= COEDUCATIONAL ======================================= -->
         <div class="form-group col-md-6" id="coeducational_div">
                <label for="coeducational" class="control-label">
                  coeducational
                </label>
               
                  <select v-model="coeducational" class="form-control form-control-sm" id="coeducational" name="coeducational">
                    <option value="girls only">
                      Girls only
                    </option>
                    <option value="boys only">
                      Boys only
                    </option>
                    <option value="mixed gender" selected="selected">
                      Mixed gender
                    </option>
                  </select>
               
              </div>
            </div>

            <div class="form-row">
         <!--============================= FUNDING ======================================= -->
         <div class="form-group col-md-6" id="funding_div">
                <label for="funding" class="control-label">
                  funding
                </label>
                
                  <select v-model="funding" class="form-control form-control-sm" id="funding" name="funding">
                    <option value="private">
                      private
                    </option>
                    <option value="public" selected="selected">
                      public
                    </option>
                  </select>
                
              </div>
         <!--============================= PASS RATE ======================================= -->
         <div class="form-group col-md-6" id="pass_rate_div">
                <label for="pass_rate" class="control-label">
                  pass_rate
                </label>
                
                  <input v-model="pass_rate" id="pass_rate" type="number" class="form-control form-control-sm" name="pass_rate" value=" old('pass_rate') " >
                  <!--===========PASS RATE INPUT ERROR MESSAGE=============-->
                  <span v-if="errors.hasOwnProperty('pass_rate')" class="help-block" >
                  	<strong>
                     {{errors['pass_rate']}} 
                    </strong>
                  </span>
              </div>
            </div>
           <!-- <script type="text/javascript">
              $(document).ready(function() {
                updateRegProgressBar(0,16)
              });
            </script>-->
        </div><!--end school-->
 


        	<!--=================================================COMPANY==========================================-->
            <div v-else-if="party == 'Company'">
              <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= REGISTRATION NUMBER ======================================= -->
               <div class="form-group col-md-6" id="registration_number_div">
                <label for="registration_number" class="control-label">
                  Registration number
                </label>
                <input id="registration_number" v-model="registration_number" type="text" class="form-control form-control-sm" name="registration_number" value=" old('registration_number') " >
                <!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registration_number')" class="help-block" >
                	<strong>
                   {{errors['registration_number']}} 
                  </strong>
                </span>
              </div>
              <!--============================= COUNTRY oF REGISTRATION======================================= -->
              <div class="form-group col-md-6" id="country_div">
                <label for="registration_country" class="control-label">
                  Country of Registration
                </label>
                
                <input id="country" type="text" class="form-control form-control-sm" name="registration_country" v-model="registration_country" value=" old('registration_country') ">
                <!--===========REGISTRATION COUNTRY INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registration_country')" class="help-block" >
                	<strong>
                   {{errors['registration_country']}} 
                  </strong>
                </span>

              </div>
            </div>

            <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= REGISTERED ADDRESS COUNTRY ======================================= -->
               <div class="form-group col-md-6" id="registration_number_div">
                <label for="registered_address_country" class="control-label">
                  Registered Address Country
                </label>
                <input id="registered_address_country" type="text" class="form-control form-control-sm" name="registered_address_country" value=" old('registered_address_country') " v-model="registered_address_country" >
                <!--===========REGISTERED ADDRESS COUNTRY INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registered_address_country')" class="help-block" >
                	<strong>
                   {{errors['registered_address_country']}} 
                  </strong>
                </span>
            </div>
              <!--============================= REGISTERED ADDRESS PROVINCE======================================= -->
              <div class="form-group col-md-6" id="registered_address_province_div">
                <label for="registered_address_province" class="control-label">
                  Registered Address Province
                </label>
                
                <input id="registered_address_province" type="text" class="form-control form-control-sm" name="registered_address_province" value=" old('registered_address_province') " v-model="registered_address_province">
                <!--===========REGISTERED ADDRESS PROVINCE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registered_address_province')" class="help-block" >
                	<strong>
                   {{errors['registered_address_province']}} 
                  </strong>
                </span>
              </div>
            </div>

            <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= REGISTERED ADDRESS TOWN ======================================= -->
               <div class="form-group col-md-6" id="registered_address_town_div">
                <label for="registration_number" class="control-label">
                  Registered Address Town
                </label>
                <input id="registered_address_town" type="text" class="form-control form-control-sm" name="registered_address_town" value=" old('registered_address_town') " v-model="registered_address_town">
                <!--===========REGISTERED ADDRESS INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registered_address_town')" class="help-block" >
                	<strong>
                   {{errors['registered_address_town']}} 
                  </strong>
                </span>
              </div>
              <!--============================= REGISTERED ADDRESS ADDRESS======================================= -->
              <div class="form-group col-md-6" id="registered_address_address_div">
                <label for="registered_address_address" class="control-label">
                  Registered street address
                </label>
                
                <input id="registered_address_address" type="text" class="form-control form-control-sm" name="registered_address_address" value=" old('registered_address_address') " v-model="registered_address_address">
                <!--===========REGISTERED ADDRESS ADDRESS INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registered_address_address')" class="help-block" >
                	<strong>
                   {{errors['registered_address_address']}} 
                  </strong>
                </span>
              </div>
            </div>

            <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= REGISTRATION NUMBER ======================================= -->
               <div class="form-group col-md-6" id="registered_address_area_code_div">
                <label for="registered_address_area_code" class="control-label">
                  Registered Area code
                </label>
                <input id="registered_address_area_code" type="text" v-model="registered_address_area_code" class="form-control form-control-sm" name="registered_address_area_code" value=" old('registered_address_area_code') " >
                <!--===========REGISTERED ADDRESS AREA CODE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registered_address_area_code')" class="help-block" >
                	<strong>
                   {{errors['registered_address_area_code']}} 
                  </strong>
                </span>
              </div>


              <div class="form-group col-md-6" id="registered_address_area_code_div">

                <label for="party" class="control-label">
                  Business Entity:
                </label>

                <select class="form-control form-control-sm col-md-4 control-label" v-model="business_entity" id="business_entity" name="business_entity">
                 <option value="sole propeitor">
                  Sole Propietor
                 </option>
                 <option value="private" >
                  Private Company - Ltd
                 </option>
                 <option value="personal liability">
                  Personal Liability Company - Inc
                 </option>
                 <option value="public">
                  Public Company - Ltd
                 </option>
                 <option value="external">
                  Foreign/External Company 
                 </option>
                 <option value="domesticated">
                  Domesticated Company 
                 </option>
                 <option value="state owned">
                  State Owned Company - Soc
                 </option>
               </select>
             </div>
            </div>
       
        </div><!--end company-->
            
            <div v-else-if="party == 'Organization'">
              <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= REGISTRATION NUMBER ======================================= -->
               <div class="form-group col-md-6" id="registration_number_div">
                <label for="registration_number" class="control-label">
                  Registration number
                </label>
                <input id="registration_number" v-model="registration_number" type="text" class="form-control form-control-sm" name="registration_number" value=" old('registration_number') " >
                <!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registration_number')" class="help-block" >
                	<strong>
                   {{errors['registration_number']}} 
                  </strong>
                </span>
              </div>
              <!--============================= COUNTRY OF Origin======================================= -->
              <div class="form-group col-md-6" id="origin_country_div">
                <label for="origin_country" class="control-label">
                  Country of Origin
                </label>
                
                <input id="origin_country" type="text" class="form-control form-control-sm" v-model="origin_country" name="origin_country" value=" old('origin_country') ">
                <!--===========ORIGIN COUNTRY INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('origin_country')" class="help-block" >
                	<strong>
                   {{errors['origin_country']}} 
                  </strong>
                </span>

              </div>
            </div>

            
              <div class="form-row">
               <!--============================= AREA OF OPERATION COUNTRY ======================================= -->
               <div class="form-group col-md-6" id="operation_area_country_div">
                <label for="operation_area_country" class="control-label">
                  Area Of Operation Country
                </label>
                <input id="operation_area_country" type="text" class="form-control form-control-sm" name="operation_area_country" value=" old('operation_area_country') " v-model="operation_area_country">
                <!--===========OPERATION AREA COUNTRY INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('operation_area_country')" class="help-block" >
                	<strong>
                   {{errors['operation_area_country']}} 
                  </strong>
                </span>
              </div>
              <!--============================= AREA OF OPERATION PROVINCE======================================= -->
              <div class="form-group col-md-6" id="operation_area_province_div">
                <label for="operation_area_province" class="control-label">
                  Area Of Operation Province
                </label>
                
                <input id="operation_area_province" type="text" class="form-control form-control-sm" name="operation_area_province" value=" old('operation_area_province') " v-model="operation_area_province">
                <!--===========OPERATION AREA PROVINCE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('operation_area_province')" class="help-block" >
                	<strong>
                   {{errors['operation_area_province']}} 
                  </strong>
                </span>

              </div>
            </div>

              <div class="form-row">
               <!--============================= AREA OF OPERATION TOWN ======================================= -->
               <div class="form-group col-md-6" id="operation_area_town_div">
                <label for="operation_area_town" class="control-label">
                  Area Of Operation Town
                </label>
                <input id="operation_area_town" v-model="operation_area_town" type="text" class="form-control form-control-sm" name="operation_area_town" value=" old('operation_area_town') " >
                <!--===========OPERATION AREA TOWN INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('operation_area_town')" class="help-block" >
                	<strong>
                   {{errors['operation_area_town']}} 
                  </strong>
                </span>
              </div>

              <!--============================= REGISTRATION NUMBER ======================================= -->
               <div class="form-group col-md-6" id="operation_area_area_code_div">
                <label for="operation_area_area_code" class="control-label">
                  Area Of Operation Area Code
                </label>
                <input id="operation_area_code" type="text" class="form-control form-control-sm" name="operation_area_area_code" value=" old('operation_area_area_code') " v-model="operation_area_area_code">
                <!--===========OPERATION AREA AREA CODE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('operation_area_area_code')" class="help-block" >
                	<strong>
                   {{errors['operation_area_area_code']}} 
                  </strong>
                </span>
              </div>

            </div>


            <div class="form-row">
                <!--=========================================ORGANIZATION TYPE=========================================-->
                <div class="form-group col-md-6" id="registered_address_area_code_div">

                <label for="organization_type" class="control-label">
                  Organization type:
                </label>

                <select class="form-control form-control-sm col-md-4 control-label" v-model="organization_type" id="organization_type" name="organization_type">
                 <option value="non profit">
                  Non profit
                 </option>
                 <option value="private foundation" >
                  Private foundation
                 </option>
                 <option value="public charitable">
                  Public charitable
                 </option>
                 <option value="quasi non profit">
                  Quasi non profit
                 </option>
               </select>
             </div>
              <!--=========================================FOCUS=========================================-->
             <div class="form-group col-md-6" id="registered_address_area_code_div">

                <label for="focus" class="control-label">
                  Focus:
                </label>

                <select class="form-control form-control-sm col-md-4 control-label" v-model="focus" id="focus" name="focus">
                 <option value="education">
                  Education
                 </option>
                 <option value="literacy" >
                  Literacy
                 </option>
                 <option value="religion">
                  Religion
                 </option>
                 <option value="science">
                  Science
                 </option>
                 <option value="public safety">
                  Public safety
                 </option>
                 <option value="sports">
                  Sports
                 </option>
                 <option value="human and animal rights">
                  Human and animal rights
                 </option>
               </select>
             </div>
            </div>

                 <!--============================= REGISTRATION NUMBER ======================================= -->
               <div class="form-group col-md-6" id="registration_number_div">
                <label for="registration_number" class="control-label">
                  Registration number
                </label>
                <input id="registration_number" v-model="registration_number" type="text" class="form-control form-control-sm" name="registration_number" value=" old('registration_number') " >
                <!--===========REGISTRATION NUMBER INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('registration_number')" class="help-block" >
                  <strong>
                   {{errors['registration_number']}} 
                  </strong>
                </span>
              </div>
			</div>
        
         
     <div class="form-group col-md-6" style="text-align: center;">
            
              <!-- Navigation buttons -->
        <div class="btn-group" role="group" aria-label="Basic example">
          <a class="btn btn-sm btn-orange" href="url()->previous()" role="button">
            <i class="fas fa-chevron-left"></i>
            Back
          </a>
          <button type="submit" class="btn btn-sm btn-orange" name="" id="submit-register">
            Next
            <i class="fas fa-chevron-right"></i></button>
        </div>
              <input type="hidden" name="_token" value="Session::token()">
            
          </div>

      </form>  
 
</template>
<script >
  import {Post} from '../../../Post.ts';
	export default
	{
		data:function()
		{
			return {
				errors:{},
        link_school:false,
        response_errors:[],
				party:this.$store.state.registerParty,
				//
				gender:'Male',
				birthdate:'',
				institution:'',
				grade:'7',
				sector:'engineering',
				id_number:'',
				//
				province:'gauteng',
				district:'',
				suburb:'',
				country:'South Africa',
				k_12:'High',
				coeducational:'mixed gender',
				funding:'public',
				pass_rate:'',
				//
				registration_number:'',
        business_entity:'public',
				registration_country:'South Africa',
				registered_address_country:'South Africa',
				registered_address_province:'Gauteng',
				registered_address_town:'',
				registered_address_address:'',
				registered_address_area_code:'',
				//
        organization_type:'non profit',
        focus:'education',
				origin_country:'South Africa',
				operation_area_country:'South Africa',
				operation_area_province:'',
				operation_area_town:'',
				operation_area_area_code:'',

        current_progress: 25,
        final_progress:100,
			}
		},
		methods:
		{
			checkForm:function(e)
			{
				this.errors = {};
				var that = this;

				var keys = this.getParty(); //function returns input names corresponding to party
				//validate all of the inputs
				keys.forEach(function(key){
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
      ///=============================================abstract this method for all register components ==================================
			submit:function()
			{
				var keys = this.getParty();//which values from data are inputs
				var currentObj = this;
      			var formObj = {};
       			keys.forEach(function(key){
       				if(currentObj.$data[key] != '')//ignore empty inputs
                formObj[key] = currentObj.$data[key];
       			});
            	
            	//
            	/*this.$swal({
                	text: "processing step 2",
                	icon:currentObj.image_url,
                	buttons: false,
            	});*/
              
            	const next_page = (this.party == 'Student')?'register-final':'register-3';
            	//set next page
            	currentObj.$store.commit('set',{property_name:'currentComponent',property_values:next_page});
                   let post_helper = new Post();
                  //save the user information in store
                  
                      post_helper.update_value(currentObj,formObj,this.party);
                  
			},
			getParty:function()
			{
				var that = this;
				var keys = null; 
				switch(that.party)
				{
					case 'Student':
						keys =[
            'gender',
            'birthdate',
            'grade',
            'sector',
            'institution',
            ];
            if (this.link_school_comp) 
            {
              keys.push('id_number');
            }
					break; 

					case 'School':
						keys = [
            'province',
            'district',
            'suburb',
            'country',
            'k_12',
            'coeducational',
            'funding',
            'pass_rate'
            ];
					break;

					case 'Company':
						keys = [
            'registration_number',
            'business_entity',
            'registration_country',
            'registered_address_country',
            'registered_address_province',
            'registered_address_town',
            'registered_address_address',
            'registered_address_area_code'
            ];
					break;

					case 'Organization':
						keys = [
            'origin_country',
            'registration_number',
            'operation_area_country',
            'operation_area_province',
            'operation_area_town',
            'operation_area_area_code',
            'organization_type',
            'focus',
            ];
					break;

					default:
				}

				return keys;
			},
		},

    computed:
    {
      link_school_comp:function(){
        return this.link_school;
      }
    }

	}
</script>