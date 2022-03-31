<template>
	<div>
	<div class="row m-0 p-0">
    <!-- ************************************************************** -->
    <div class="col-md-4 rounded p-2 border">
      <a style="width: 6rem;height:6rem"><i class="fas fa-user-cicle" ></i></a>
       <ul>
  <li>
    <strong>
     
            session('k_12 school
       </strong>
     </li>
<!--
*
*
*
*
* 
 -->

          <!--==============================student================================-->
          <div v-if="party == 'Student'">
            <address>
            <strong>
              email:
            </strong>
            {{session.email}}
          </address>
      </div><!--end student-->
          <!--==============================school================================-->
          <div v-if="party == 'School'">
          <address>
            <strong>
              website:
            </strong>
            {{session.web_url}}
            <strong>
              email:
            </strong>
            {{session.email}}<br>
            {{session.address}},
            {{session.suburb}}<br>
            <strong>
              tel:
            </strong>
            {{session.telephone}}
          </address>
      </div><!--end school-->
		<!--==============================company================================-->
      <div v-if="party == 'Company'">
          <address>
            <strong>
              website:
            </strong>
            {{session.web_url}}
            <strong>
              email:
            </strong>
            {{session.email}}<br>
            {{session.address}},
            {{session.suburb}}<br>
            <strong>
              tel:
            </strong>
            {{session.telephone}}
          </address>
      </div><!--end company-->
		<!--==============================organization================================-->
      <div v-if="party == 'Organization'">
          <address>
            <strong>
              website:
            </strong>
            {{session.web_url}}
            <strong>
              email:
            </strong>
            {{session.email}}
            <br>
            {{session.address}},
            {{session.town}}<br>
            <strong>
              tel:
            </strong>
            {{session.telephone}}
          </address>
      </div><!--end organization-->

</ul>
    </div>
    <!-- ************************************************************** -->
    <div class="col-md-8 rounded p-2 border">
      <div class="row" style="margin: 0;">

        <div class="col-md-6">
          <!--==============================student================================-->
          <div v-if="party == 'Student'">
            <strong>
              institution : 
            </strong>
            {{session.institution}}
            <br>
            <strong>
              sector : 
            </strong>
            {{session.sector}}
            <br>
            <strong>
              grade : 
            </strong>
            {{session.grade}}<br>
            </div><!--end student-->

          <!--==============================school================================-->
          <div v-if="party == 'School'">
            <strong>
              coeducational : 
            </strong>
            {{session.coeducational}}
            <br>
            <strong>
              funding : 
            </strong>
            {{session.funding}}<br>
            <strong>
              special needs : 
            </strong>
            {{session.special_needs}}<br>
            <strong>
              k-12 : 
            </strong>
            {{session.k_12}}<br>
            <strong>
              principal : 
            </strong>
            {{session.principal}}<br>
            <strong>
              No. teachers : 
            </strong>
            {{session.number_teachers}}<br>
            <strong>
              No. students : 
            </strong>
            {{session.number_students}}<br>
            <strong>
              pass rate : 
            </strong>
            {{session.pass_rate}}%<br>
        </div><!--end school-->

        <!--==============================company================================-->
          <div v-if="party == 'Company'">
            <strong>
              registration number : 
            </strong>
            {{session.registration_number}}<br>
            <strong>
              registration country : 
            </strong>
            {{session.registration_country}}<br>
            <strong>
              registered address country : 
            </strong>
            {{session.registered_address_country}}<br>
            <strong>
              registered address province : 
            </strong>
            {{session.registered_address_province}}<br>
            <strong>
              registered address town : 
            </strong>
            {{session.registered_address_town}}<br>
            <strong>
              registered address address : 
            </strong>
            {{session.registered_address_address}}<br>
            <strong>
              registered address area code : 
            </strong>
            {{session.registered_address_area_code}}<br>
            <strong>
              business place country : 
            </strong>
            {{session.business_place_country}}
            <br>
            <strong>
              business place province : 
            </strong>
            {{session.business_place_province}}<br>
            <strong>
              business place town : 
            </strong>
            {{session.business_place_town}}<br>
            <strong>
              business place address : 
            </strong>
            {{session.business_place_address}}<br>
            <strong>
              business place area code : 
            </strong>
            {{session.business_place_area_code}}<br>
            
          </div>
        
        <!--==============================school================================-->
          <div v-if="party == 'Organization'">
          	 <strong>
              origin country : 
             </strong>
             {{session.origin_country}}<br>
            <strong>
              operation area country : 
            </strong>
            {{session.coperation_area_country}}<br>
            <strong>
              operation area province : 
            </strong>
            {{session.operation_area_province}}<br>
            <strong>
              operation area town : 
            </strong>
            {{session.operation_area_town}}<br>
            <strong>
              operation area area code : 
            </strong>
            {{session.operation_area_area_code}}<br>
            
          </div>
            
        </div>
        <div class="col-md-6 border-left">
          <!--==============================student================================-->
          <div v-if="party == 'Student'">
            <strong>
              birthdate : 
            </strong>
            {{session.birthdate}}<br>
            <strong>
              gender : 
            </strong>
            {{session.gender}}<br>
        </div><!--end student-->

          <!--==============================school================================-->
          <div v-if="party == 'School'">
            <strong>
              About us:
            </strong><br>
            <p style="word-wrap: break-word;">
              {{session.about}}
            </p>
            <br>
            <strong>
              Our history:
            </strong>
            <br>
            <p style="word-wrap: break-word;">
              {{session.history}}
            </p>
        </div><!--end school-->

        <!--==============================company================================-->
          <div v-if="party == 'Company'">
          	<strong>
              values : 
            </strong>
            {{session.values}}<br>
           <strong>
            services : 
           </strong>
           {{session.services}}<br>
            <strong>
              sector : 
            </strong>
            {{session.sector}}
            <br>
            <strong>year established : 
            </strong>
            {{session.year_established}}<br>
           <strong>
            mission : 
           </strong>
           {{session.mission}}
           <br>
          </div>

        <!--==============================school================================-->
          <div v-if="party == 'Organization'">
          	<strong>
              headquarters country : 
            </strong>
            {{session.headquarters_country}}<br>
            <strong>
              headquarters province : 
            </strong>
            {{session.headquarters_province}}<br>
            <strong>
              headquarters town : 
            </strong>
            {{session.headquarters_town}}<br>
            <strong>
              headquarters area code : 
            </strong>
            {{session.headquarters_area_code}}<br>
            <strong>
              headquarters address : 
            </strong>
            {{session.headquarters_address}}<br>
          </div>
          
          
        </div>
      </div>
    </div>
  </div>
  <form @submit.prevent="submit">
          <input type="submit" name="submit" id="submit-register" style="display: none">
          <input type="hidden" name="_token" value="Session::token()">
        </form>
  <!-- Navigation buttons -->
      <div class="col-12" style="text-align: center;margin-top: 1rem ">
        <div class="btn-group" role="group" aria-label="Basic example">
          <a class="btn btn-sm btn-orange" href="url()->previous()" role="button">
            <i class="fas fa-chevron-left"></i>
            Back
          </a>
          <button class="btn btn-sm btn-orange" name="" id="submit-final" @click="show_agreement_modal">
            Next
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
        </div>
        <div style="position: absolute;
  z-index: 1060;">
  <agreement-modal></agreement-modal>
</div>
	</div>

</template>
<script>
import AgreementModal from './AgreementModalComponent';
	export default
	{
    components:{
      'agreement-modal':AgreementModal,
    },
		data: function()
		{
			return {
				party:this.$store.state.registerParty,
			}
		},
		methods:
		{
			submit:function()
			{
            var currentObj = this;
            $('#agreement-modal').modal('hide');
                      //
              this.$swal({
                  text: "completing registration",
                  icon:currentObj.image_url,
                  buttons: false,
              });
				//
            	axios.post('../api/register/step-final',currentObj.$store.state.form_data)
            	.then(function (response) {
                	currentObj.$store.commit('set',{property_name:'currentComponent',property_values:response.data['next-step']});
                  currentObj.$store.commit('set',{property_name:'post',property_values:response.data.session});//send the session data to next component using posts in store

                	currentObj.$swal({
                    	text: response.data['message'],
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
            		Object.keys(errors_).forEach(function(err){
            			errors_[err].forEach(function(msg){
            				currentObj[err]= null;
                    currentObj.errors[err] = msg;
            			});
            		});
            	});
			},

        show_agreement_modal:function(){
          $('#agreement-modal').modal();
        }
		},
		computed:
		{
			 session: function() {
      			return this.$store.state.form_data;
    		},

		},
	}
</script>
