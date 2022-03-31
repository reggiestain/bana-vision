<template>
	<div class="col-12 p-1 border-top  image-interaction-div" style="position: absolute;margin-top: -1.75rem;background-color:rgba(0, 0, 0, 0.4); ">
	<a class="ml-1"><i class="fas fa-thumbs-up text-light"></i></a>
	<a class="ml-2"><i class="fas fa-comment text-light"></i></a>
	<a class="ml-2 " id="interactionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen edit-image text-light"></i></a>
  <a class="ml-2"><i class="fas fa-expand text-light" v-on:click="showfullscreen"></i></a>
	<!--@auth
	 @if(Auth::id() == $userIdNo->id)-->
	<div class="dropdown-menu" aria-labelledby="interactionDropdown">
	
		<form @submit.prevent="setCoverPhoto" enctype="multipart/form-data">
			<!--<input type="hidden" id="filename" v-model="cover_filename" :value="img_name">-->
			<button type="submit" id="submit-photo" class=" dropdown-item btn btn-link btn-xs " >make cover</button> 
			<!--<input type="hidden"  v-model="cover_token" value="csrf_token()">-->
		</form>
		<form @submit.prevent="setProfilePhoto" enctype="multipart/form-data">
			<!--<input type="hidden" id="filename" v-model="profile_filename" :value="img_name">-->
			<button type="submit" id="submit-photo" class=" dropdown-item btn btn-link btn-xs " >make profile</button> 
			<!--<input type="hidden"  v-model="profile_token" value="csrf_token()">-->
		</form>
		<a class="dropdown-item deleteFile"  data-post-id="$post->id">delete</a>
	</div>
	<!--@endif
	@endauth-->

  <!-- show fullscreen Modal -->
<div class="modal fade" id="show-fullscreen-modal" tabindex="-1" role="dialog" aria-labelledby="show-fullscreen" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="margin-left: auto !important;margin-right: auto !important">
    <div class="modal-content" style="min-height: 85vh">
      
      <div class="modal-body p-0 bg-dark">
        <img id="fullscreen-image" class="figure-img img-fluid d-block mx-auto" alt="" style=" ">
      </div>
      
    </div>
  </div>
</div>

</div>

</template>
<script>
	export default
	{
		props:['img_name'],
		data: function() {
          return {
          	errors_array:[],
          }
      },
      methods: 
      {
      	setCoverPhoto(e)
      	{
      		var formObj = new FormData();
       
            formObj.append('filename',this.img_name);
            formObj.append('_token',this.$store.state.token);
            var currentObj = this;
            this.$swal({
                text: "Setting cover photo",
                icon:currentObj.image_url,
                buttons: false,
            });
             axios.post('../setCoverPhoto',formObj)
            .then(function (response) {
                console.error(response.data);
                //currentObj.$store.commit('increment',response.data[1]);
                currentObj.$swal({
                    text: 'Cover photo set',
                    icon: "success",
                    buttons:false,
                    timer: 3000,
                });
                //cause picture to refresh
               currentObj.$store.commit('setcoverpic', response.data[1]);
            })
            .catch(function (error) {
                if( error.response )
                {
                  var errors = error.response.data.errors; // => the response payload 
                  var error_string = '';
                    Object.entries(errors).forEach(([key, value]) => {
                        value.forEach(function(errormsg){
                            currentObj.errors_array.push(errormsg);
                            error_string = error_string + '\n ' + errormsg;
                        });
                    });

                    currentObj.$swal({
                        text: error_string,
                        icon:that.image_url,
                 
                   
                    });

                }
            })
            .finally(function(){
               //reset the forms
               
            });
      	},
        showfullscreen(e)
        {
          $('#show-fullscreen-modal').modal();
        },
      	setProfilePhoto(e)
      	{
      		var formObj = new FormData();
       
            formObj.append('filename',this.img_name);
            formObj.append('_token',this.$store.state.token);
            var currentObj = this;
            this.$swal({
                text: "Setting profile photo",
                icon:currentObj.image_url,
                buttons: false,
            });
             axios.post('../setProfilePhoto',formObj)
            .then(function (response) {
                console.error(response.data[1]);
                currentObj.$store.commit('setprofilepic',response.data[1]);
                currentObj.$swal({
                    text: 'Profile photo set',
                    icon: "success",
                    buttons:false,
                    timer: 3000,
                });
            })
            .catch(function (error) {
                currentObj.output = error;
            })
            .finally(function(){
               //reset the forms
            });
      	}
      }
	}
</script>