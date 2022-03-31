<template>
      <!-- Add Student Award Modal -->
      <div class="modal fade" id="studentAwardModal" tabindex="-1" role="dialog" aria-labelledby="studentAwardModalTitle" aria-hidden="true">
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
           <h4 class="text-muted"><strong>select featured student</strong></h4>

           <multiselect v-model="school_student_id" id="ajax" label="name" track-by="name" placeholder="Type to search" open-direction="bottom" :options="school_students" :multiple="false" :searchable="true" :loading="isLoading" :internal-search="false" :clear-on-select="false" :close-on-select="false" :options-limit="300" :limit="3" :limit-text="limitText" :max-height="600" :show-no-results="false" :hide-selected="true" @search-change="asyncFind" autocomplete="off">
            <template slot="tag" slot-scope="{ option, remove }">
              <span class="custom__tag">
                <span>{{ option.name }}</span>
                <span class="custom__remove" @click="remove(option)">❌</span>
              </span>
            </template>

            <template slot="clear" slot-scope="props">
              <div class="multiselect__clear" v-if="school_student_id.length" @mousedown.prevent.stop="clearAll(props.search)">

              </div>
            </template>
            <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
          </multiselect>
          

          <div class="form-group">
           <label for="exampleFormControlTextarea1">description</label>
           <textarea class="form-control" v-model="description" id="exampleFormControlTextarea1" rows="3"></textarea>
         </div>

         <div class="form-group">
           <label class="form-check-label" for="inlineCheckbox1">Field</label>
           <input class="form-control form-control-sm" type="text" v-model="field" placeholder=".form-control-sm">
         </div>

         <div class="form-group">
           <label class="form-check-label" for="inlineCheckbox1">Awarded by</label>
           <input class="form-control form-control-sm" type="text" v-model="awarded_by" placeholder=".form-control-sm">
         </div>

         <div class="form-group">
           <label class="form-check-label" for="inlineCheckbox1">Year</label>
           <input class="form-control form-control-sm" type="text" v-model="year" placeholder="year">
         </div>


         <div class="form-group">
           <label class="form-check-label" for="inlineCheckbox1">Award photo</label>
           <input class="form-control form-control-sm" type="file" v-on:change="imguploaded" placeholder="year">
         </div>


       </form>
     </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
    <button type="submit" class="btn btn-primary" id="save-student-award" v-on:click="checkForm">Save changes</button>
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
        props :['students'],
        data: function()
        {
          return {
            groupPosts:this.students,
            school_student_id:[],
            school_students:[],
            description:'',
            field:'',
            year:'',
            awarded_by:'',
            student_award_photo:'',
            keys: [
            'description',
            'field',
            'year',
            'awarded_by',
            'student_award_photo',
            ],
            errors : {}
          }
        },
        methods:
        {
          checkForm: function (e) {
            var that = this;

            //validate inputs
            that.keys.forEach(function(key){
              if(!that.$data[key])
              {
                errors[key] = key+' required';
              }
            });

            // console.log(Object.keys(errors));
            if (Object.keys(that.errors).length === 0 && that.errors.constructor === Object) {
              this.submit();
            }   
          },
          submit: function(){
            var currentObj = this;
            var formObj = new FormData();
            currentObj.keys.forEach(function(key){
              if(currentObj.$data[key] != '')//ignore empty inputs
              {
                formObj.append(key,currentObj.$data[key]);
              }
              formObj.append('school_student_id',currentObj.school_student_id._id);
            });



            formObj.append('_token',this.$store.state.token);//add a token to the form

                  //
            this.$swal({
              text: "processing step 1",
              icon:currentObj.image_url,
              buttons: false,
            });
            console.error("im about to submit this");
            axios.post('/create-student-award',formObj)
            .then(function (response) {
              currentObj.$store.commit('increment1',[response.data['post']]);
                  //show success alert
              currentObj.$swal({
                text: 'step 1 complete',
                icon: "success",
                buttons:false,
                timer: 3000,
              });
              $('#add-student-modal').modal('hide');//hide the student modal
            })
            .catch(function (error) {
              //show error alert
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
              currentObj.output = error;
            });
                  
          },
          imguploaded:function(e)
          {
            this['student_award_photo'] = event.target.files[0];
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
            }
      }
</script>