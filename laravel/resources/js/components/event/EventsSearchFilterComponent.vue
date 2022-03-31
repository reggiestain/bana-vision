<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0">
		<form @submit.prevent="">
  
                <!--===========================SEARCH events BY VENUE=========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <h6 class="mr-auto ml-auto"><strong>Search Event By Venue</strong></h6>
            <div class="form-check p-0">
    
              
              <input list="venues" v-model="venue" v-on:input="onChangeVenue" class="form-control form-control-sm" placeholder="Venue">
              <datalist id="venues">
                <option  v-for="venue in venues" v-bind:value="venue"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->

        <!--===========================SEARCH events BY NAME=========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <h6 class="mr-auto ml-auto"><strong>Search Event By Name</strong></h6>
            <div class="form-check p-0">
    
              
              <input list="events-names" v-model="events_name" v-on:input="onChangeEventsName" class="form-control form-control-sm" placeholder="Event name">
              <datalist id="events-names">
                <option  v-for="nd_name in events_names" v-bind:value="nd_name"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->



                <!--===========================SEARCH Event BY DATE===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <h6 class="mr-auto ml-auto"><strong>Search Event By Date</strong></h6>
            <div class="form-check p-0">
    
              
            <input class="form-control form-control-sm" type="date" v-model="date" @change="onChangeDate">
            </div>
            
          </div>
        </div><!--end search by date-->


        <!--===========================SEARCH Event BY USER NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <h6 class="mr-auto ml-auto"><strong>Search Event By User</strong></h6>
            <div class="form-check p-0">
    
              
              <input list="user-names" v-model="user_name" v-on:input="onChangeUserName" class="form-control form-control-sm" placeholder="school name">
              <datalist id="user-names">
                <option v-for="user_name in user_names" v-bind:value="user_name"></option>
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
        errors_array:'',
				events_names:[],
				events_name:'',
				user_names:[],
				user_name:'',
        date:'',
				venues:[],
				venue:''
			}
		},
		methods:
		{
		  onChangeVenue:function(event)
      {
          /*this function has errors when selecting on the dropdown */
          filter.onInputChange(event,this,'events',this.venues,'venue',this.venue,'events');
      },
      //
			onChangeEventsName:function(event)
			{
        filter.onInputChange(event,this,'events',this.events_names,'events_name',this.events_name,'events');
      },
      //
			onChangeUserName:function(event)
			{
        filter.onInputChange(event,this,'events',this.user_names,'user_name',this.user_name,'events');
      },
      onChangeDate:function(event)
      {
        filter.onInputChange(event,this,'events',null,'date',this.date,'events');
      }
		},
		computed:
		{

		}
	}
  /*
  
filter.onInputChange(event,this,'bursaries',this.titles,'title',this.title,'bursaries');
   */
</script>