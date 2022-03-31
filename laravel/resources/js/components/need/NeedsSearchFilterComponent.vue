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

       

        <!--===========================SEARCH NEEDS BY CATEGORY===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Needs By Category</label>
            <div class="form-check p-0">
    
              
              <input list="categories" v-model="category" v-on:input="onChangeCategory" class="form-control form-control-sm" placeholder="need category">
              <datalist id="categories">
                <option v-for="category in categories" v-bind:value="category" ></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH NEEDS BY NAME=========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
           <label>Search Need By Name</label>
            <div class="form-check p-0">
    
              
              <input list="needs-names" v-model="needs_name" v-on:input="onChangeNeedsName" class="form-control form-control-sm" placeholder="need name">
              <datalist id="needs-names">
                <option  v-for="nd_name in needs_names" v-bind:value="nd_name"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->

        <!--===========================SEARCH NEEDS BY URGENCY===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <lablel>Search Need By Urgency</lablel>
            <div class="form-check p-0">
              <select class="form-control form-control-sm" id="urgency" v-model="urgency" placeholder="select urgency" v-on:input="onChangeUrgency">
                <option value="not urgent">not urgent</option>
                <option value="urgent">urgent</option>
                <option value="very urgent">very urgent</option>
              </select>
            </div>


            
          </div>
        </div><!--end search by name-->

                <!--===========================SEARCH NEED BY DATE===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Need By Date</label>
            <div class="form-check p-0">
    
              
            <input class="form-control form-control-sm" type="date" v-model="date" @change="onChangeDate">
            </div>
            
          </div>
        </div><!--end search by date-->


        <!--===========================SEARCH NEED BY SCHOOL NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Need By School</label>
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
				categories:[],
				category:'',
				needs_names:[],
        errors_array:[],
				needs_name:'',
				school_names:[],
				school_name:'',
        date:'',
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
        filter.onInputChange(event,this,'needs',this.locations,this.picked,this.location,'needs',true);
      },
			onChangeNeedsName:function(event)
			{
        filter.onInputChange(event,this,'needs',this.needs_names,'needs_name',this.needs_name,'needs');
      },
      //
			onChangeUrgency:function(event)
	   {
      filter.onInputChange(event,this,'needs',null,'urgency',event.target.value,'needs');
    },
    //
		onChangeCategory:function(event)
		{
      filter.onInputChange(event,this,'needs',this.categories,'category',this.category,'needs');
    },
    //
		onChangeSchoolName:function(event)
		{
      filter.onInputChange(event,this,'needs',this.school_names,'school_name',this.school_name,'needs');
    },
    onChangeDate:function(event)
    {
      filter.onInputChange(event,this,'needs',null,'date',this.date,'needs');
    }
		},
		computed:
		{

		}
	}

</script>