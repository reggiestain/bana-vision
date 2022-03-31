<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0">
		<form @submit.prevent="">
        <!--===========================SEARCH organization BY LOCATION===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>
              Search organization By Location
            </label>
            <div class="form-check mr-1">
              <input class="form-check-input" type="radio" id="all" value="all" v-model="picked" checked>
              <label class="form-check-label" for="all">
                All
              </label>
            </div>
            <div class="form-check mr-1">
              <input class="form-check-input" type="radio"  id="country" value="country" v-model="picked">
              <label class="form-check-label" for="country">
                Country
              </label>
            </div>
            <div class="form-check disabled mr-1">
              <input class="form-check-input" type="radio"  id="province" value="province" v-model="picked">
              <label class="form-check-label" for="province">
                Province
              </label>
            </div>
            <div class="form-check disabled mr-1">
              <input class="form-check-input" type="radio" id="town" value="town" v-model="picked">
              <label class="form-check-label" for="town">
                Town
              </label>
            </div>
            <div class="form-check p-0 mt-2">
    
              
              <input list="locations" v-model="location" v-on:input="onChangeLocation" class="form-control form-control-sm" placeholder="location">
              <datalist id="locations">
                <option v-for="location in locations" v-bind:value="location" ></option>
              </datalist>
            </div>
          </div>
        </div><!--end search by location-->

        <!--===========================SEARCH ORGANIZATION BY NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>
              Search Organization By Name
            </label>
            <div class="form-check p-0">
    
              
              <input list="organization-names" v-model="organization_name" v-on:input="onChangeOrganizationName" class="form-control form-control-sm" placeholder="organization name">
              <datalist id="organization-names">
                <option v-for="organization_name in organization_names" v-bind:value="organization_name" ></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH organization BY REGISTRATION NUMBER===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>
              Search Organization By Registration Number
            </label>
            <div class="form-check p-0">
    
              
              <input list="registration-numbers" v-model="registration_number" v-on:input="onChangeRegistrationNumber" class="form-control form-control-sm" placeholder="registration number">
              <datalist id="registration-numbers">
                <option  v-for="registration_number in registration_numbers" v-bind:value="registration_number"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->

        <!--==========================================SEARCH ORGANIZATION BY     TYPE==========================================-->
         <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label for="organization_type">
              Search Organization By Type
            </label>
              <select  class="form-control form-control-sm" id="organization_type" name="organization_type" v-model="organization_type" v-on:input="onChangeOrganizationType">
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
          </div><!--end search by -->

          <!--==========================================SEARCH ORGANIZATION BY FOCUS==========================================-->
         <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label for="focus">
              Search Company By Focus
            </label>
              <select  class="form-control form-control-sm" id="focus" name="focus" v-model="focus" v-on:input="onChangeFocus">
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
          </div><!--end search by -->
    </form>
      </div>
</template>

<script>
  import filter from '../bana/LeftSidebarFilterComponent.vue';
	export default
	{
		data:function()
		{
			return {
				area:'',
				picked:'all',
				organization_names:[],
				organization_name:'',
				registration_numbers:[],
				registration_number:'',

				organization_type:'non profit',
				focus:'education',

				locations:[],
				location:''
			}
		},
		methods:
		{
			//
			onChangeLocation:function(event)
			{
        filter.onInputChange(event,this,'organization',this.locations,this.picked,this.location,'organizationspage',true);
      },
      /**
       * [onChangeOrganizationName description]
       * @param  {[type]} event [description]
       * @return {[type]}       [description]
       */
      onChangeOrganizationName:function(event)
      {
        filter.onInputChange(event,this,'organization',this.organization_names,'organization_name',this.organization_name,'organizationspage');
      },
      /**
       * [onChangeRegistrationNumber description]
       * @param  {[type]} event [description]
       * @return {[type]}       [description]
       */
      onChangeRegistrationNumber:function(event)
      {
        filter.onInputChange(event,this,'organization',this.registration_numbers,'registration_number',this.registration_number,'organizationspage');
      },
      /**
       * [onChangeOrganizationType description]
       * @param  {[type]} event [description]
       * @return {[type]}       [description]
       */
      onChangeOrganizationType:function(event)
      {
        filter.onInputChange(event,this,'organization',null,'organization_type',event.target.value,'organizationspage');
      },
      /**
       * [onChangeFocus description]
       * @param  {[type]} event [description]
       * @return {[type]}       [description]
       */
      onChangeFocus:function(event)
      {
        filter.onInputChange(event,this,'organization',null,'focus',event.target.value,'organizationspage');
      },

  
     		},
		computed:
		{

		}
	}
</script>