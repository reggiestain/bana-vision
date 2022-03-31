<template>
	<div>
		<!--============================= FORM ======================================= -->   
     <form @submit.prevent="checkForm" id="register-form" method="POST">
         <!--======================================SCHOOL================================-->
          <div v-if="party == 'School'">
          <div class="form-row">
         <!--============================= SPECIAL NEEDS ======================================= -->
         <div class="form-group col-md-6" id="special_needs_div">
                <label for="special_needs" class="control-label">special needs</label>
               
                <select class="form-control form-control-sm" id="special_needs" name="special_needs" v-model="special_needs">
                    <option value="disable">disabled</option>
                    <option value="non-disabled" selected="selected">non-disabled</option>
                  </select>
                
              </div>
        
         <!--============================= PRINCIPAL ======================================= -->
         <div class="form-group col-md-6" id="principal_div">
                <label for="principal" class="control-label">principal</label>
                
                  <input id="principal" type="text" class="form-control form-control-sm" name="principal"  v-model="principal" >
               <!--===========PRINCIPAL INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('principal')" class="help-block" >
                	<strong> {{errors['principal']}} </strong>
                </span>
              </div>
            </div>

            <div class="form-row">
         <!--============================= NUMBER STUDENTS ======================================= -->
         <div class="form-group col-md-6" id="number_students_div">
                <label for="number_students" class="control-label">number_students</label>
               
                  <input class="form-control form-control-sm" type="number" min="100" name="number_students" id="number_students"  v-model="number_students"> 
               <!--===========NUMBER STUDENTS INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('number_students')" class="help-block" >
                	<strong> {{errors['number_students']}} </strong>
                </span>
              </div>
         <!--============================= NUMBER TEACHERS ======================================= -->
         <div class="form-group col-md-6" id="number_teachers_div">
                <label for="number_teachers" class="control-label">number_teachers</label>
                
                  <input class="form-control form-control-sm" type="number" min="1" name="number_teachers" id="number_teachers"  v-model="number_teachers">
                <!--===========NUMBER TEACHERS INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('number_teachers')" class="help-block" >
                	<strong> {{errors['number_teachers']}} </strong>
                </span>
              </div>
            </div>
            <div class="form-row">
         <!--============================= ADDRESS ======================================= -->
         <div class="form-group col-md-6" id="address_div">
                <label for="address" class="control-label">address</label>
                
                  <input id="address" type="text" class="form-control form-control-sm" name="address"  v-model="address"> 
                <!--===========ADDRESS INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('address')" class="help-block" >
                	<strong> {{errors['address']}} </strong>
                </span>
              </div>
         <!--============================= WEBSITE ======================================= -->
         <div class="form-group col-md-6" id="web_url_div">
                <label for="web_url" class="control-label">website</label>
                
                  <input id="web_url" type="url" class="form-control form-control-sm" name="web_url"  v-model="web_url">
                <!--===========web_url INPUT ERROR MESSAGE=============-->
                <!--<span v-if="errors.hasOwnProperty('web_url')" class="help-block" >
                	<strong> {{errors['web_url']}} </strong>
                </span>-->
              </div>
            </div>


         <!--============================= TELEPHONE ======================================= -->
         <div class="form-group col-md-6" id="telephone_div">
                <label for="telephone" class="control-label">telephone</label>
                
                  <input id="telephone" type="text" class="form-control form-control-sm" name="telephone" v-model="telephone">

                  <!--===========TELEPHONE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('telephone')" class="help-block" >
                	<strong> {{errors['telephone']}} </strong>
                </span>
              
              </div>
              <div class="form-row">
         <!--============================= ABOUT ======================================= -->
         <div class="form-group col-md-6" id="about_div">
                <label for="about" class="control-label">about</label>
  
                  <textarea class="form-control form-control-sm" name="about" id="about"  v-model="about"> </textarea>
              	<!--===========ABOUT INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('about')" class="help-block" >
                	<strong> {{errors['about']}} </strong>
                </span>
              </div>
         <!--============================= HISTORY ======================================= -->
         <div class="form-group col-md-6" id="history_div">
                <label for="history" class="control-label">history</label>
               
                  <textarea class="form-control form-control-sm"  name="history" id="history"  v-model="history"> </textarea>
            	<!--===========HISTORY INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('history')" class="help-block" >
                	<strong> {{errors['history']}} </strong>
                </span>
              </div>
            </div>
            <!--<script type="text/javascript">
              $(document).ready(function() {
                updateRegProgressBar(16,32);
              });
            </script>-->
            </div><!--end school-->

			<!--==========================================COMPANY=========================================-->
            <div v-else-if="party =='Company'">
                <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= PLACE  OF BUSINESS COUNTRY ======================================= -->
               <div class="form-group col-md-6" id="business_place_country_div">
                <label for="business_place_country" class="control-label">Place Of Business Country</label>
                <input id="business_place_country" type="text" class="form-control form-control-sm" name="business_place_country"  v-model="business_place_country">
                <!--===========BUSINESS PLACE COUNTRY INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('business_place_country')" class="help-block" >
                	<strong> {{errors['business_place_country']}} </strong>
                </span>
              </div>
              <!--============================= PLACE OF BUSINESS PROVINCE======================================= -->
              <div class="form-group col-md-6" id="business_place_province_div">
                <label for="business_place_province" class="control-label">Place Of Business Province</label>
                
                <input id="country" type="text" class="form-control form-control-sm" name="business_place_province"  v-model="business_place_province">
				<!--===========BUSINESS PLACE PROVINCE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('business_place_province')" class="help-block" >
                	<strong> {{errors['business_place_province']}} </strong>
                </span>	
              </div>
            </div>

            <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= PLACE OF BUSINESS TOWN ======================================= -->
               <div class="form-group col-md-6" id="business_place_town_div">
                <label for="business_place_town" class="control-label">Place of Business Town</label>
                <input id="business_place_town" type="text" class="form-control form-control-sm" name="business_place_town" v-model="business_place_town">
                <!--===========BUSINESS PLACE TOWN INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('business_place_town')" class="help-block" >
                	<strong> {{errors['business_place_town']}} </strong>
                </span>
              </div>
              <!--============================= PLACE OF BUSINESS STREET ADDRESS======================================= -->
              <div class="form-group col-md-6" id="business_place_address_div">
                <label for="business_place_address" class="control-label">Place of Business Address</label>
                
                <input id="business_place_address" type="text" class="form-control form-control-sm" name="business_place_address"  v-model="business_place_address">
				<!--===========BUSINESS PLACE ADDRESS INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('business_place_address')" class="help-block" >
                	<strong> {{errors['business_place_address']}} </strong>
                </span>
              </div>
            </div>


          <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= PLACE OF BUSINESS AREA CODE ======================================= -->
               <div class="form-group col-md-6" id="business_place_area_code_div">
                <label for="business_place_area_code" class="control-label">Place Of Business Area Code</label>
                <input id="business_place_area_code" type="text" class="form-control form-control-sm" name="business_place_area_code" v-model="business_place_area_code">
                <!--===========BUSINESS PLACE AREACODE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('business_place_area_code')" class="help-block" >
                	<strong> {{errors['business_place_area_code']}} </strong>
                </span>
              </div>
              <!--=============================WEB URL======================================= -->
              <div class="form-group col-md-6" id="web_url_div">
                <label for="web_url" class="control-label">web_url</label>
                
                <input id="web_url" type="url" class="form-control form-control-sm" name="web_url" v-model="web_url">
				<!--===========WEB URL INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('web_url')" class="help-block" >
                	<strong> {{errors['web_url']}} </strong>
                </span>
              </div>
            </div>

            <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= REGISTRATION NUMBER ======================================= -->
               <div class="form-group col-md-6" id="telephone_div">
                <label for="telephone" class="control-label">Telephone</label>
                <input id="telephone" type="tel" class="form-control form-control-sm" name="telephone" v-model="telephone"  >
                <!--===========TELEPHONE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('telephone')" class="help-block" >
                	<strong> {{errors['telephone']}} </strong>
                </span>
              </div>
            </div>
            </div> <!--end company-->



                <div v-else-if="party == 'Organization'">
                <!--====================================REGISTRATION DETAILS====================================-->
              <div class="form-row">
               <!--============================= HEADQUARTERS COUNTRY ======================================= -->
               <div class="form-group col-md-6" id="business_place_country_div">
                <label for="headquarters_country" class="control-label">Headquarters Country</label>
                <input id="headquarters_country" type="text" class="form-control form-control-sm" name="headquarters_country" v-model="headquarters_country" >
                <!--===========HEADQUARTERS COUNTRY INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('headquarters_country')" class="help-block" >
                	<strong> {{errors['headquarters_country']}} </strong>
                </span>
              </div>
              <!--============================= HEADQUARTERS PROVINCE======================================= -->
              <div class="form-group col-md-6" id="business_place_province_div">
                <label for="headquarters_province" class="control-label">Headquarters Province</label>
                
                <input id="headquarters_province" type="text" class="form-control form-control-sm" name="headquarters_province" v-model="headquarters_province">
				<!--===========HEADQUARTERS PROVINCE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('headquarters_province')" class="help-block" >
                	<strong> {{errors['headquarters_province']}} </strong>
                </span>
              </div>
            </div>

              <div class="form-row">
               <!--============================= HEADQUARTERS TOWN ======================================= -->
               <div class="form-group col-md-6" id="headquarters_town_div">
                <label for="headquarters_town" class="control-label">Headquarters Town</label>
                <input id="headquarters_town" type="text" class="form-control form-control-sm" name="headquarters_town" v-model="headquarters_town" >
                <!--===========HEADQUARTERS TOWN INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('headquarters_town')" class="help-block" >
                	<strong> {{errors['headquarters_town']}} </strong>
                </span>
              </div>
              <!--============================= HEADQUARTERS STREET ADDRESS======================================= -->
              <div class="form-group col-md-6" id="headquarters_address_div">
                <label for="headquarters_address" class="control-label">Headquarters Address</label>
                
                <input id="headquarters_address" type="text" class="form-control form-control-sm" name="headquarters_address" v-model="headquarters_address">
				<!--===========HEADQUARTERS ADDRESS INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('headquarters_address')" class="help-block" >
                	<strong> {{errors['headquarters_address']}} </strong>
                </span>
              </div>
            </div>


      
              <div class="form-row">
               <!--============================= HEADQUARTERS AREA CODE ======================================= -->
               <div class="form-group col-md-6" id="business_place_area_code_div">
                <label for="headquarters_area_code" class="control-label">Headquarters Area Code</label>
                <input id="headquarters_area_code" type="text" class="form-control form-control-sm" name="headquarters_area_code" v-model="headquarters_area_code">
                <!--===========HEADQUARTERS AREA CODE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('headquarters_area_code')" class="help-block" >
                	<strong> {{errors['headquarters_area_code']}} </strong>
                </span>
              </div>
              <!--=============================WEB URL======================================= -->
              <div class="form-group col-md-6" id="web_url_div">
                <label for="web_url" class="control-label">web_url</label>
                
                <input id="web_url" type="url" class="form-control form-control-sm" name="web_url" v-model="web_url">
				<!--===========WEB URL INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('web_url')" class="help-block" >
                	<strong> {{errors['web_url']}} </strong>
                </span>
              </div>
            </div>


              <div class="form-row">
               <!--============================= REGISTRATION NUMBER ======================================= -->
               <div class="form-group col-md-6" id="telephone_div">
                <label for="telephone" class="control-label">Telephone</label>
                <input id="telephone" type="tel" class="form-control form-control-sm" name="telephone" v-model="telephone" >
                <!--===========TELEPHONE INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('telephone')" class="help-block" >
                	<strong> {{errors['telephone']}} </strong>
                </span>
              </div>
            </div>
            </div><!--end organization-->

        

     <div class="form-group col-md-6" style="text-align: center;">
        <!-- Navigation buttons -->
        <div class="btn-group" role="group" aria-label="Basic example">
          <a class="btn btn-sm btn-orange" href="url()->previous()" role="button"><i class="fas fa-chevron-left"></i>Back</a>
          <button type="submit" class="btn btn-sm btn-orange" name="" id="submit-register" formnovalidate>Next<i class="fas fa-chevron-right"></i></button>
        </div>
              <input type="hidden" name="_token" value="Session::token()">
          </div>

      </form>  
	</div>
</template>
<script>
  import {Post} from '../../../Post.ts';
	export default
	{
		data:function()
		{
			return{
				errors:{},
				party:this.$store.state.registerParty,
				//
				special_needs:'non-disabled',
				principal:'',
				number_students:'',
				number_teachers:'',
				address:'',
				//web_url:'',
				telephone:'',
				about:'',
				history:'',
				//
				business_place_country:'South Africa',
				business_place_province:'Gauteng',
				business_place_town:'',
				business_place_address:'',
				business_place_area_code:'',
				web_url:'',
				//
				headquarters_country:'South Africa',
				headquarters_province:'Gauteng',
				headquarters_town:'',
				headquarters_area_code:'',
				headquarters_address:'',
				web_url:'',
			}
		},
		methods:
		{
			checkForm:function(e)
			{
				this.errors = {};
				var that = this;

				var keys = this.getParty().filter(function(key){
          return key !== 'web_url';
        }); //function returns input names corresponding to party
        console.log(keys);
				//validate all of the inputs
				keys.forEach(function(key){
					if(!that.$data[key])
					{
						that.errors[key] = key+' required';
					}
				});

        if ((!this.validUrl(this.web_url)) ) 
        {
          this.errors['email_validation'];
        }

				if (Object.keys(this.errors).length === 0 && this.errors.constructor === Object) {
					console.log(this.$parent.$options.components);
					this.submit();
					//return true;
				}
			},
       validUrl:function(value) 
       {
        return /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(value);
      },
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
              
              const next_page = (this.party !== 'Company')?'register-final':'register-4';
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
					case 'School':
						keys = [
            'special_needs',
            'principal',
            'number_students',
            'number_teachers',
            'address',
            'web_url',
            'telephone',
            'about',
            'history'
            ];
					break;

					case 'Company':
						keys = [
            'business_place_country',
            'business_place_province',
            'business_place_town',
            'business_place_address',
            'business_place_area_code',
            'web_url',
            'telephone'
            ];
					break;

					case 'Organization':
						keys = [
            'headquarters_country',
            'headquarters_province',
            'headquarters_town',
            'headquarters_area_code',
            'headquarters_address',
            'web_url',
            'telephone'
            ];
					break;

					default:
				}

				return keys;
			}
		}
	}
</script>