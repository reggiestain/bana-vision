<template>
	<div>
		<!--============================= FORM ======================================= -->   
     <form @submit.prevent="checkForm"  id="register-form" method="POST">
			<!--==============================COMPANY==================================-->
            <div v-if="party == 'Company'">
                <!--====================================GENERAL DETAILS====================================-->
                
              <div class="form-row">
               <!--============================= VALUES ======================================= -->
               <div class="form-group col-md-6" id="values_div">
                <label for="values" class="control-label">
                  Values
                </label>

                <textarea class="form-control form-control-sm" id="values" rows="3" name="values" v-model="values" >
              
                </textarea>
				<!--===========VALUES INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('values')" class="help-block" >
                	<strong> {{errors['values']}} </strong>
                </span>
              </div>
              <!--============================= SERVICES /PRODUCTS OFFERED ======================================= -->
              <div class="form-group col-md-6" id="services_div">
                <label for="services" class="control-label">Services / Products Offred</label>
                
                <textarea class="form-control form-control-sm" id="services" rows="3" name="services" v-model="services" ></textarea>
				<!--===========SERVICES INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('services')" class="help-block" >
                	<strong> {{errors['services']}} </strong>
                </span>
              </div>
            </div>

     
              <div class="form-row">
               <!--============================= SECTOR======================================= -->
               <div class="form-group col-md-6" id="sector_div">
                <label for="sector" class="control-label">Sector</label>
                <input id="sector" type="text" class="form-control form-control-sm" name="sector" v-model="sector" >
                <!--===========SECTOR INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('sector')" class="help-block" >
                	<strong> {{errors['sector']}} </strong>
                </span>
              </div>
              <!--=============================YEAR ESTABLISHED======================================= -->
              <div class="form-group col-md-6" id="year_established_div">
                <label for="year_established" class="control-label">Years Established</label>
                <input id="year_established" type="number" class="form-control form-control-sm" name="year_established" v-model="year_established">
				<!--===========YEAR ESTABLISHED INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('year_established')" class="help-block" >
                	<strong> {{errors['year_established']}} </strong>
                </span>
              </div>
            </div>


              <div class="form-row">
               <!--============================= COMPANY MISSION ======================================= -->
               <div class="form-group col-md-6" id="mission_div">
                <label for="mission" class="control-label">Mission</label>
                <textarea class="form-control form-control-sm" id="mission" rows="3" name="mission" v-model="mission" ></textarea>
                <!--===========MISSION INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('mission')" class="help-block" >
                	<strong> {{errors['mission']}} </strong>
                </span>
              </div>
            </div>

          </div><!--end company-->

     <div class="form-group col-md-6" style="text-align: center;">
        <!-- Navigation buttons -->
        <div class="btn-group" role="group" aria-label="Basic example">
          <a class="btn btn-sm btn-orange" href="url()->previous()" role="button"><i class="fas fa-chevron-left"></i>Back</a>
          <button type="submit" class="btn btn-sm btn-orange" name="" id="submit-register">Next<i class="fas fa-chevron-right"></i></button>
        </div>
              <input type="hidden" name="_token" value="Session::token()">
          </div>

      </form>  
	</div>
</template>
<script>
	export default
	{
		data:function()
		{
			return {
				errors:{},
				party:this.$store.state.registerParty,
				//
				values:'',
				services:'',
				sector:'',
				year_established:'',
				mission:'',
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
				console.log('we are here');
				if (Object.keys(this.errors).length === 0 && this.errors.constructor === Object) {
					console.log(this.$parent.$options.components);
					this.submit();
					//return true;
				}
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
              
              const next_page = 'register-final';
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
					case 'Company':
						keys = [
            'values',
            'services',
            'sector',
            'year_established',
            'mission'
            ];
					break;

					default:
				}

				return keys;
			}
		}
	}
</script>