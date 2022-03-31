<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0">
		<form @submit.prevent="">
        <!--===========================SEARCH award BY LOCATION===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search award By Location</label>
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

        <!--===========================SEARCH AWARDER BY NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Award By Awarder</label>
            <div class="form-check p-0">
    
              
              <input list="awarder-names" v-model="awarder_name" v-on:input="onChangeAwarderName" class="form-control form-control-sm" placeholder="awarder name">
              <datalist id="awarder-names">
                <option v-for="awarder_name in awarder_names" v-bind:value="awarder_name" ></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH AWARD BY PARTICIPANTS===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Award By Awardee</label>
            <div class="form-check p-0">
    
              
              <input list="award-awardee" v-model="award_awardee" v-on:input="onChangeAwardee" class="form-control form-control-sm" placeholder="student name">
              <datalist id="award-awardee">
                <option  v-for="award_awardee in award_awardees" v-bind:value="award_awardee"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->

        <!--===========================SEARCH AWARD BY FIELD===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search award By Fied</label>
            <div class="form-check p-0">
    
              <input list="fields" v-model="field" v-on:input="onChangeField" class="form-control form-control-sm" placeholder="field">
              <datalist id="fields">
                <option v-for="field in fields" v-bind:value="field"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH award BY DATE===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search award By Date</label>
            <div class="form-check p-0">
    
              
            <input class="form-control form-control-sm" type="number" v-model="year" @change="onChangeYear">
            </div>
            
          </div>
        </div><!--end search by date-->

        <!--===========================SEARCH award BY SCHOOL NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <h6 class="mr-auto ml-auto"><strong>Search award By School</strong></h6>
            <div class="form-check p-0">
    
              
              <input list="school-names" v-model="school_name" v-on:input="onChangeSchoolName" class="form-control form-control-sm" placeholder="school name">
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
  import filter from '../../bana/LeftSidebarFilterComponent.vue';
	export default
	{
		data:function()
		{
			return {
				area:'',
				picked:'all',
				awarder_names:[],
				awarder_name:'',
				award_awardees:[],
				award_awardee:'',
				school_names:[],
				school_name:'',
				fields:[],
				field:'',
				year:'',
				locations:[],
				location:''
			}
		},
		methods:
		{
			//
			onChangeLocation:function(event)
			{
        filter.onInputChange(event,this,'student-award',this.locations,this.picked,this.location,'studentaward',true);
      },
          	//
			onChangeAwarderName:function(event)
			{
        filter.onInputChange(event,this,'student-award',this.awarder_names,'awarder_name',this.awarder_name,'studentaward');

      },
      //
			onChangeAwardee:function(event)
			{
        filter.onInputChange(event,this,'student-award',this.award_awardees,'award_awardee',this.award_awardee,'studentaward');
      },
      //
			onChangeField:function(event)
			{
        filter.onInputChange(event,this,'student-award',this.fields,'field',this.field,'studentaward');
      },
          	//
			onChangeSchoolName:function(event)
			{
        filter.onInputChange(event,this,'student-award',this.school_names,'school_name',this.school_name,'studentaward');
      },
      onChangeYear:function(event)
      {
        filter.onInputChange(event,this,'student-award',null,'year',this.year,'studentaward');
      }
		},
		computed:
		{

		}
	}
</script>