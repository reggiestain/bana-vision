<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0">
		<form @submit.prevent="">
        <!--===========================SEARCH COMPANY BY NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>
                Search Company By Name
            </label>
            <div class="form-check p-0">
    
              
              <input list="company-names" v-model="company_name" v-on:input="onChangeCompanyName" class="form-control form-control-sm" placeholder="company name">
              <datalist id="company-names">
                <option v-for="company_name in company_names" v-bind:value="company_name" ></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH COMPANY BY REGISTRATION NUMBER===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>
                Search Company By Reg Number
            </label>
            <div class="form-check p-0">
    
              
              <input list="registration-numbers" v-model="registration_number" v-on:input="onChangeRegNumber" class="form-control form-control-sm" placeholder="registration number">
              <datalist id="registration-numbers">
                <option  v-for="registration_number in registration_numbers" v-bind:value="registration_number"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by reg number->

        <!--===========================SEARCH company BY INDUSTRY===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>
                Search Company By Industry
            </label>
            </h6>
            <div class="form-check p-0">
    
              <input list="industries" v-model="industry" v-on:input="onChangeIndustry" class="form-control form-control-sm" placeholder="industry">
              <datalist id="industries">
                <option v-for="industry in industries" v-bind:value="industry"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by industry-->
          <!--==========================================SEARCH COMPANY BY BUSINESS ENTITY==========================================-->
         <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label for="exampleFormControlSelect2">
              Search Company By Business Entity
            </label>
              <select  class="form-control form-control-sm" id="business_entity" name="business_entity" v-model="business_entity" v-on:input="onChangeBusinessEntity">
                <option value="sole propietor">
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
				company_names:[],
				company_name:'',
        registration_number:'',
        registration_numbers:[],
        industry:'',
        industries:[],
        business_entity:'',
			}
		},
		methods:
		{
			onChangeCompanyName:function(event)
			{
        filter.onInputChange(event,this,'company',this.company_names,'company_name',this.company_name,'companiespage');
      },
      onChangeRegNumber:function(event)
      {
        filter.onInputChange(event,this,'company',this.registration_numbers,'registration_number',this.registration_number,'companiespage');
      },
      onChangeIndustry:function(event)
      {
         filter.onInputChange(event,this,'company',this.industries,'industry',this.industry,'companiespage');
      },
      onChangeBusinessEntity:function(event)
      {
        filter.onInputChange(event,this,'company',null,'business_entity',event.target.value,'companiespage');
      }

		},
		computed:
		{

		}
	}
</script>