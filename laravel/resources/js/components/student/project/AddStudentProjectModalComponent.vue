<template>
	<!-- Add Featured Student Modal -->
	<div class="modal fade" id="studentProjectModal" tabindex="-1" role="dialog" aria-labelledby="studentProjectModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="m-0">
						<form method="POST" enctype="multipart/form-data">
							


               <div class="form-row border-bottom">
          <div class="col-12">
            <h6><strong>Basic details</strong></h6>
          </div>
          <p class="text-muted " style="padding-right: 1rem">what is the project about</p>
          <div class="col-12 form-group row" id="name_div">
            <label class="col-sm-2 col-form-label-sm float-right" for="name">Name</label>
            <div class="col-sm-10">
              <input class="form-control form-control-sm" type="text" v-model="name" id="name" placeholder="name">
              <!--===========NAME INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('name')" class="help-block">
                  <strong> {{errors['name']}} </strong>
                </span>  
            </div>
          </div>

          <div class="col-12 form-group row" id="description_div">
            <label class="col-sm-2 col-form-label-sm" for="description">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control form-control-sm" v-model="description" id="description" rows="3">
              </textarea>
              <!--===========DESCRIPTION INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('description')" class="help-block">
                  <strong> {{errors['description']}} </strong>
                </span>
          </div>
          </div>

          <div class="col-12 form-group row" id="name_div">
            <label class="col-sm-2 col-form-label-sm float-right" for="name">Category</label>
            <div class="col-sm-10">
              <select class="custom-select" id="inputGroupSelect04" v-model="category">
                <option selected>Select Category</option>
                <option value="Science & Technology">Science & Technology</option>
                <option value="Humanitaries">Humanitaries</option>
                <option value="Life Orientation">Life Orientation</option>
              </select> 
              <!--===========CATEGORY INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('category')" class="help-block">
                  <strong> {{errors['category']}} </strong>
                </span>
            </div>
          </div>
        </div>

          
            <h6 >
              <strong>Participants</strong>
            </h6>
            <p class="text-muted">who participated in this project</p>
          
            <div class="form-group  border-bottom p-2" id="added-participants">

              <multiselect v-model="participants" id="ajax" label="name" track-by="name" placeholder="Type to search" open-direction="bottom" :options="school_students" :multiple="true" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="false" :options-limit="300" :limit="3" :limit-text="limitText" :max-height="600" :show-no-results="false" :hide-selected="true" @search-change="asyncFind" autocomplete="off">
                <template slot="tag" slot-scope="{ option, remove }">
                  <span class="custom__tag">
                    <span>{{ option.name }}</span>
                    <span class="custom__remove" @click="remove(option)">❌</span>
                  </span>
                </template>

                <template slot="clear" slot-scope="props">
                  <div class="multiselect__clear" v-if="participants.length" @mousedown.prevent.stop="clearAll(props.search)">
                    
                  </div>
                </template>
                  <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
              </multiselect>


               <!--===========DESCRIPTION INPUT ERROR MESSAGE=============-->
                <span v-if="errors.hasOwnProperty('participants')" class="help-block">
                  <strong> {{errors['participants']}} </strong>
                </span>
            </div>

            <h6><strong>Picture</strong></h6>
              <p class="text-muted">Add picture for your project</p>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label-sm" for="picture">Picture</label>
            <div class="col-sm-10"> 
              <input type="file"  name="project-image" class="form-control form-control-sm" id="event-image" v-on:change="imguploaded">
            </div>
            </div>
          
          


						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="save-featured-student" v-on:click="checkForm">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
  import Multiselect from 'vue-multiselect';
	export default
	{
      components: {
    Multiselect
  },
		props:['students','user'],
		data: function()
		{
			return {
					groupPosts:this.students,
					name:'',
          description:'',
          category:'',
          school_student_id:'',
          'project-image':'',
          school_students:[],
					errors:{},
					keys:[
						'name',
            'description',
            'category',
            'project-image'
					],
          participants: [],
          isLoading: false
			}
		},
		methods:
		{
			checkForm: function (e) {
        var that = this;
        this.errors = {};
        //validate inputs
        that.keys.forEach(function(key){
          if(!that.$data[key])
          {
            that.errors[key] = key.replace('_',' ') +' required';
            console.error(that.errors[key]);
          }
        });

        console.log(Object.keys(that.errors));
        if (Object.keys(that.errors).length === 0 && that.errors.constructor === Object) {
          console.log("no errors");
          this.submit();
        }   
      },
    submit: function(){
      var currentObj = this;
      var formObj = new FormData();
      currentObj.keys.forEach(function(key){
        if(currentObj.$data[key] != '')//ignore empty inputs
        {
          console.log(currentObj.$data[key]);
          formObj.append(key,currentObj.$data[key]);
        }
                              
      });

      for (let i = 0; i < currentObj.participants.length; i++) {
            for (let key of Object.keys(currentObj.participants[i])) {
              console.log('hello...', currentObj.participants[i][key]);
              formObj.append(`participants[${i}][${key}]`, currentObj.participants[i][key]);
            }
          }
                  
      formObj.append('_token',this.$store.state.token);//add a token to the form
    
      //
      this.$swal({
        text: "processing step 1",
        icon:currentObj.image_url,
        buttons: false,
      });
      console.error(this.participants);
      console.error(formObj);
      axios.post('/create-students-project',formObj)
      .then(function (response) {
        currentObj.$store.commit('increment1',[response.data['post']]);
        //show success alert
        currentObj.$swal({
           text: 'step 1 complete',
          icon: "success",
          buttons:false,
          timer: 3000,
        });
        $('#studentProjectModal').modal('hide');//hide the student modal
      })
      .catch(function (error) {
      /*  //show error alert
        currentObj.$swal({
          text: 'An error has occured',
          icon: "error",
          buttons:false,
          timer: 3000,
        });

        var errors_ = error.response.data.errors;
        //iterate errors and display on appropriate input field
        Object.keys(errors_).forEach(function(err){
          errors_[err].forEach(function(msg){
            currentObj[err]= null;
            currentObj.errors[err] = msg;
          });
        });
        currentObj.output = error;*/
      });
                  
    },
    imguploaded:function(e)
    {
      this['project-image'] = event.target.files[0];
    },
    clearAll () {
      //this.participants = []
    },
    //get students from server
    asyncFind (query) {
      this.isLoading = true;
      var that= this;

      if(query !== '' && query != null)
      {
        axios.get('search/'+query+'/schoolStudents/name/true').then(resp => {
          var obj_array = resp.data.posts;
          obj_array = Object.keys(obj_array).map(i => obj_array[i]);
          console.log(obj_array);
        that.school_students = obj_array;
        that.isLoading = false;
        console.log(that.school_students);
        });
      }
      
    },
     limitText (count) {
      return `and ${count} other entries`
    },
		},
		computed:
		{
			chunkedPosts () 
      {
        var that = this;
        this.$store.state.posts1.forEach(function(post){
          post.forEach(function(pst){
            if(!that.groupPosts.includes(pst)) //doesn't include this post already
            {
              that.groupPosts.push(pst);
            }
          });
        });
        console.log(_.chunk(this.groupPosts,3));

        return _.chunk(this.groupPosts,3);
      }
		}
	}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>