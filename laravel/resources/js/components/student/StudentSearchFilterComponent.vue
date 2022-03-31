<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0">
		<form @submit.prevent="">
        <!--===========================SEARCH PROJECT BY LOCATION===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Project By Location</label>
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

        <!--===========================SEARCH PROJECT BY NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Project By Name</label>
            <div class="form-check p-0">
    
              
              <input list="project-names" v-model="project_name" v-on:input="onChangeProjectName" class="form-control form-control-sm" placeholder="project name">
              <datalist id="project-names">
                <option v-for="project_name in project_names" v-bind:value="project_name" ></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH PROJECT BY PARTICIPANTS===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
          <label>Search Project By Participants</label>
            <div class="form-check p-0">
    
              
              <input list="project-participants" v-model="project_participant" v-on:input="onChangeParticipants" class="form-control form-control-sm" placeholder="student name">
              <datalist id="project-participants">
                <option  v-for="project_participant in project_participants" v-bind:value="project_participant"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->

        <!--===========================SEARCH PROJECT BY CATEGORY===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Project By Category</label>
    
              <input list="categories" v-model="category" v-on:input="onChangeCategory" class="form-control form-control-sm" placeholder="category">
              <datalist id="categories">
                <option v-for="category in categories" v-bind:value="category"></option>
              </datalist>
            </div>
            
          </div>

        <!--===========================SEARCH PROJECT BY DATE===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Project By Date</label>
            <div class="form-check p-0">
    
              
            <input class="form-control form-control-sm" type="date" v-model="date" @change="onChangeDate">
            </div>
            
          </div>
        </div><!--end search by date-->

        <!--===========================SEARCH PROJECT BY SCHOOL NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Project By School</label>
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
  import filter from '../bana/LeftSidebarFilterComponent.vue';
	export default
	{
		data:function()
		{
			return {
				area:'',
				picked:'all',
				project_names:[],
				project_name:'',
				project_participants:[],
				project_participant:'',
				school_names:[],
				school_name:'',
				categories:[],
				category:'',
				date:'',
				locations:[],
				location:''
			}
		},
		methods:
		{
			//
			onChangeLocation:function(event)
			{
        filter.onInputChange(event,this,'student-project',this.locations,this.picked,this.location,'studentproject',true);
      },
      //
			onChangeProjectName:function(event)
			{
        filter.onInputChange(event,this,'student-project',this.project_names,'project_name',this.project_name,'studentproject');
      },
      //
			onChangeParticipants:function(event)
			{
        filter.onInputChange(event,this,'student-project',this.project_participants,'project_participant',this.project_participant,'studentproject');
      },
      //
			onChangeCategory:function(event)
			{
        filter.onInputChange(event,this,'student-project',this.categories,'category',this.category,'studentproject');
      },
      //
			onChangeSchoolName:function(event)
			{
        filter.onInputChange(event,this,'student-project',this.school_names,'school_name',this.school_name,'studentproject');
      },
      onChangeDate:function(event)
      {
        filter.onInputChange(event,this,'student-project',null,'date',this.date,'studentproject');
      }
		},
		computed:
		{

		}
	}
</script>