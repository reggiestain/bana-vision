<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0;max-height:80vh;overflow-y:scroll">
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

                <!--===========================SEARCH SCHOOL BY NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search School By Name</label>
            <div class="form-check p-0">
    
              
              <input list="school-names" v-model="school_name" v-on:input="onChangeSchoolName" class="form-control form-control-sm" placeholder="school name">
              <datalist id="school-names">
                <option v-for="school_name in school_names" v-bind:value="school_name"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

       <!--===========================SEARCH SCHOOL BY COEDUCATIONAL===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search School By Gender Type</label>
            <div class="form-check p-0">
              <select class="form-control form-control-sm" id="coeducational" v-model="coeducational" placeholder="select gender" v-on:input="onChangeCoeducational">
                <option value="all">all</option>
                <option value="boys only">boys</option>
                <option value="girls only">girls</option>
                <option value="mixed gender">mixed</option>
              </select>
            </div>


            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH SCHOOL BY K_12===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search School By K_12</label>
            <div class="form-check p-0">
              <select class="form-control form-control-sm" id="k_12" v-model="k_12" placeholder="select k12" v-on:input="onChangeK12">
                <option value="all">all</option>
                <option value="primary">primary school</option>
                <option value="middle">middle school</option>
                <option value="high">high school</option>
                <option value="secondary">secondary school</option>
              </select>
            </div>


            
          </div>
        </div><!--end search by name-->


        <!--===========================SEARCH SCHOOL BY FUNDING===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search School By Funding</label>
            <div class="form-check p-0">
              <select class="form-control form-control-sm" id="funding" v-model="funding" placeholder="select funding" v-on:input="onChangeFunding">
                <option value="all">all</option>
                <option value="0">public</option>
                <option value="1">private</option>
              </select>
            </div>


            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH SCHOOL BY SPECIAL NEEDS===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search School By Special Needs</label>
            <div class="form-check p-0">
              <select class="form-control form-control-sm" id="special_needs" v-model="special_needs" placeholder="select special needs" v-on:input="onChangeSpecialNeeds">
                <option value="all">all</option>
                <option value="1">For the special needs</option>
                <option value="0">Not for the special needs</option>
              </select>
            </div>


            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH SCHOOL BY CURRICULUMN TYPE==========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search School By Curriculumn Type</label>
            <div class="form-check p-0">
              <select class="form-control form-control-sm" id="curriculumn_type" v-model="curriculumn_type" placeholder="select curriculumn type" v-on:input="onChangeCurriculumnType">
                <option value="all">all</option>
                <option value="technical">Technical school</option>
                <option value="commercial">Commercial school</option>
                <option value="montessori">Montessori school</option>
                <option value="waldorf">Waldorf school</option>
              </select>
            </div>


            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH SCHOOL BY FACILITIES===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Schools By Facilities</label>
            <div class="form-check p-0">
    
              
              <input list="facilities" v-model="facility" v-on:input="onChangeFacility" class="form-control form-control-sm" placeholder="school facility">
              <datalist id="facilities">
                <option v-for="facility in facilities" v-bind:value="facility" ></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH SCHOOL BY ACTIVITIES=========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search School By Activities</label>
            <div class="form-check p-0">
    
              
              <input list="activities" v-model="activity" v-on:input="onChangeActivity" class="form-control form-control-sm" placeholder="need name">
              <datalist id="activities">
                <option  v-for="activity in activities" v-bind:value="activity"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->



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
        picked:'all',
				school_names:[],
				school_name:'',
				locations:[],
				location:'',
        coeducational:'all',//gender
        funding:'all',
        k_12:'all',
        special_needs:'all',
        curriculumn_type:'all',
        facilities:[],
        facility:'',
        activity:'',
        activities:'',
			}
		},
		methods:
		{
			//
			onChangeLocation:function(event)
			{
        filter.onInputChange(event,this,'schools',this.locations,this.picked,this.location,'schools',true);
      },
      //
      onChangeCoeducational:function(event)
      {
        filter.onInputChange(event,this,'schools',null,'coeducational',event.target.value,'schoolspage');
      },
      //
      onChangeFunding:function(event)
      {
        filter.onInputChange(event,this,'schools',null,'funding',event.target.value,'schoolspage');
      },
      //
      onChangeK12:function(event)
      {
        filter.onInputChange(event,this,'schools',null,'k_12',event.target.value,'schoolspage');
      },
      //
      onChangeSpecialNeeds:function(event)
      {
        filter.onInputChange(event,this,'schools',null,'special_needs',event.target.value,'schoolspage');
      },
			
                    //
      onChangeCurriculumnType:function(event)
      {
        filter.onInputChange(event,this,'schools',null,'curriculumn_type',event.target.value,'schoolspage');
      },
                  //
      onChangeFacility:function(event)
      {
        filter.onInputChange(event,this,'schools',this.facilities,'facility',this.facility,'schoolspage');

      },
      //
      onChangeActivity:function(event)
      {
        filter.onInputChange(event,this,'schools',this.activities,'activity',this.activity,'schoolspage');

      },
      //
			onChangeSchoolName:function(event)
			{
        filter.onInputChange(event,this,'schools',this.school_names,'school_name',this.school_name,'schoolspage');
      },
		},
		computed:
		{

		}
	}
</script>