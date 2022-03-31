<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0">
		<form @submit.prevent="">
        <!--===========================SEARCH FEATURED STUDENT BY LOCATION===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Student By Location</label>
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

       

        <!--===========================SEARCH BURSARY BY SECTOR===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Bursary By Sector</label>
            <div class="form-check p-0">
    
              
              <input list="sectors" v-model="sector" v-on:input="onChangeSector" class="form-control form-control-sm" placeholder="bursary sector">
              <datalist id="sectors">
                <option v-for="sector in sectors" v-bind:value="sector" ></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH BURSARIES BY TITLE=========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Bursary By Title</label>
            <div class="form-check p-0">
    
              
              <input list="titles" v-model="title" v-on:input="onChangeTitle" class="form-control form-control-sm" placeholder="bursary title">
              <datalist id="titles">
                <option  v-for="title in titles" v-bind:value="title"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->

        <!--===========================SEARCH BURSARIES BY REQUIREMENTS=========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Bursary By Requirement</label>
            <div class="form-check p-0">
    
              
              <input list="requirements" v-model="requirement" v-on:input="onChangeRequirement" class="form-control form-control-sm" placeholder="need name">
              <datalist id="requirements">
                <option  v-for="requirement in requirements" v-bind:value="requirement"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->


                <!--===========================SEARCH BURSARY BY CLOSING closing_date===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Bursary By Closing Date</label>
            <div class="form-check p-0">
    
              
            <input class="form-control form-control-sm" type="closing_date" v-model="closing_date" @change="onChangeClosingDate">
            </div>
            
          </div>
        </div><!--end search by closing_date-->


        <!--===========================SEARCH BURSARY BY POSTER===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Bursary By Poster</label>
            <div class="form-check p-0">
    
              
              <input list="school-names" v-model="school_name" v-on:input="onChangeSchoolName" class="form-control form-control-sm" placeholder="bursay poster">
              <datalist id="school-names">
                <option v-for="school_name in school_names" v-bind:value="school_name"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->
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
        errors_array:[],
				picked:'all',
				sectors:[],
				sector:'',
				titles:[],
				title:'',
        requirements:[],
        requirement:'',
				school_names:[],
				school_name:'',
        closing_date:'',
				urgency:'very urgent',
				locations:[],
				location:''
			}
		},
		methods:
		{
			//
			onChangeLocation:function(event)
			{
        filter.onInputChange(event,this,'bursaries',this.locations,this.picked,this.location,'bursaries',true);
      },
			onChangeTitle:function(event)
			{
        filter.onInputChange(event,this,'bursaries',this.titles,'title',this.title,'bursaries');
      },
          	//
			onChangeSector:function(event)
			{
        filter.onInputChange(event,this,'bursaries',this.sectors,'sector',this.sector,'bursaries');
      },
          	//
			onChangeSchoolName:function(event)
			{
        filter.onInputChange(event,this,'bursaries',this.school_names,'school_name',this.school_name,'bursaries');
      },
      onChangeRequirement:function(event)
      {
        filter.onInputChange(event,this,'bursaries',this.requirements,'requirement',this.requirement,'bursaries');
      },
      onChangeClosingDate:function(event)
      {
        filter.onInputChange(event,this,'bursaries',null,'closing_date',this.closing_date,'bursaries');
      }
		},
		computed:
		{

		}
	}
</script>