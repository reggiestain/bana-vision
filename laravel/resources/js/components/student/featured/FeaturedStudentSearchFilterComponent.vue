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

        <!--===========================SEARCH FEATURED STUDENT BY GENDER===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Student By Gender</label>
            <div class="form-check mr-1">
              <input class="form-check-input" type="radio" id="all-gender" @change="onChangeGender" value="all" v-model="gender_picked" checked>
              <label class="form-check-label" for="all-gender">
                All
              </label>
            </div>
            <div class="form-check mr-1">
              <input class="form-check-input" type="radio" @change="onChangeGender"  id="male" value="male" v-model="gender_picked">
              <label class="form-check-label" for="male">
                Male
              </label>
            </div>
            <div class="form-check disabled mr-1">
              <input class="form-check-input" type="radio" @change="onChangeGender"  id="female" value="female" v-model="gender_picked">
              <label class="form-check-label" for="female">
                Female
              </label>
            </div>

          </div>
        </div><!--end search by location-->

        <!--===========================SEARCH STUDENT BY MAJOR===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Student By Major</label>
            <div class="form-check p-0">
    
              
              <input list="majors" v-model="major" v-on:input="onChangeMajor" class="form-control form-control-sm" placeholder="student major">
              <datalist id="majors">
                <option v-for="major in majors" v-bind:value="major" ></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by name-->

        <!--===========================SEARCH FEATURED STUDENT BY STUDENT NAME=========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Student By Name</label>
            <div class="form-check p-0">
    
              
              <input list="featured-student-names" v-model="featured_student_name" v-on:input="onChangeFeaturedStudentName" class="form-control form-control-sm" placeholder="featured student name">
              <datalist id="featured-student-names">
                <option  v-for="fs_name in featured_student_names" v-bind:value="fs_name"></option>
              </datalist>
            </div>
            
          </div>
        </div><!--end search by participant-->

        <!--===========================SEARCH featured BY K_12===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search Student By K_12</label>
            <div class="form-check p-0">
              <select class="form-control form-control-sm" id="k_12" v-model="k_12" placeholder="select k12" v-on:input="onChangeK12">
                <option value="primary">primary school</option>
                <option value="middle">middle school</option>
                <option value="high">high school</option>
              </select>
            </div>


            
          </div>
        </div><!--end search by name-->


        <!--===========================SEARCH featured BY SCHOOL NAME===========================-->
        <div class="card col-12" style="padding:0.5rem;background-color: transparent;border: none;" >

          <div class="card-body" style="padding: 0 0.25rem">
            <label>Search featured By School</label>
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
        gender_picked:'male',
				majors:[],
        errors_array:[],
				major:'',
				featured_student_names:[],
				featured_student_name:'',
				school_names:[],
				school_name:'',
				k_12s:[],
				k_12:'high',
				locations:[],
				location:''
			}
		},
		methods:
		{
			//
			onChangeLocation:function(event)
			{
          filter.onInputChange(event,this,'student-featured',this.locations,this.picked,this.location,'featuredstudent',true);
      },
        //
      onChangeGender:function(event)
      {
        filter.onInputChange(event,this,'student-featured',null,'gender',this.gender_picked,'featuredstudent');
      },
          	//
			onChangeFeaturedStudentName:function(event)
			{
        filter.onInputChange(event,this,'student-featured',this.featured_student_names,'featured_student_name',this.featured_student_name,'featuredstudent');
      },
          	//
			onChangeK12:function(event)
			{
        filter.onInputChange(event,this,'student-featured',null,'k_12',this.k_12,'featuredstudent');
      },
          	//
			onChangeMajor:function(event)
			{
        filter.onInputChange(event,this,'student-featured',this.majors,'major',this.major,'featuredstudent');
      },
      //
			onChangeSchoolName:function(event)
			{
        filter.onInputChange(event,this,'student-featured',this.school_names,'school_name',this.school_name,'featuredstudent');
      },
		},
		computed:
		{

		}
	}
</script>