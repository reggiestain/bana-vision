<template><!--cover profile-->
	<div class="mt-5">
<div class="card" id="cover-profile">
<!--=========================FORM FOR CHANGING IMAGE==============================-->
  <form @submit.prevent="setImage" method="post" enctype="multipart/form-data">
    <input type="file" id="imgupload"  v-on:change="imguploaded" name="image" style="display:none" accept=".jpg,.jpeg,.png,gif."/>
    <input id="picture_type" type="hidden" name="picture_type" value="cover">
    <button type="submit" id="submit-cover" class="btn btn-primary btn-xs" style="display:none">
      Submit
    </button> 
    <input type="hidden" name="_token" value="Session::token()">
 </form>
 <!--@if (Auth::user())
 @if(Auth::user()->name == $userIdNo->name)-->
 <a v-if="useridno == auth_id">
  <span>
    <i data-picture-type="cover" @click="OpenImgUpload('cover')" class="fa fa-camera fa-2x change-image OpenImgUpload" aria-hidden="true" style="margin:12px;color:#c3c3c3;opacity:0.65;position:absolute;z-index:3"></i>
 </span>
 </a>
 <!--@endif
 @endif-->
<!-- ====================COVER  AREA====================-->
 <div class="card-body bod" style="">
  <!-- Tab panes -->
  <div class="tab-content" >
    <div id="cover">
     <!--=====================COVER PICTURE==========================-->
     <img  class="show-fullscreen" :data-src="getCoverPic" :src="getCoverPic" @error= "$event.target.scr='https://github.com/NtsikeleloBana/imagesbox/blob/main/default_profile_cover.jpeg?raw=true'" width="100%" alt="Schools brand picture" style="height:315px;width:100%;padding:0;">
   </div>
   
   <!--======================PROFILE PICTURE============================-->
    <span id="profilepic" :data-username="username">
       <!--@if (Auth::user())
 @if(Auth::user()->name == $userIdNo->name)-->
      <a v-if="useridno == auth_id">
        <i data-picture-type="profile" @click="OpenImgUpload('profile')" class="fa fa-camera fa-1x change-image OpenImgUpload" aria-hidden="true" style="margin:12px;color:#c3c3c3;opacity:0.65;position:absolute;z-index:3;    bottom: 4.75rem;
    left: 1.95rem;"></i>
  </a>
    <!--@endif
    @endif-->
      <img :data-src="getProfilePic"  :src="getProfilePic" @error= "$event.target.scr='https://github.com/NtsikeleloBana/imagesbox/blob/main/default_profile_pic.jpeg?raw=true'" class="show-fullscreen bg-white profile-ppic">
    </span>
    <!-- UNDECIDED BUTTONS -->
   <!--  <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="position: absolute;left: 40rem;bottom: 2.25rem;">
  <button type="button" class="btn btn-secondary">1</button>
  <button type="button" class="btn btn-secondary">2</button>

  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="#">Dropdown link</a>
      <a class="dropdown-item" href="#">Dropdown link</a>
    </div>
  </div>
</div> -->
<!--END UNDECIDED BUTTONS-->
    <!-- =============================== SPONSORED TAB ===============================-->
     <div class="card col-6 col-md-3 p-0 m-0" id="sponsored-card">
      <a href="http://rusco.co.za" target="_blank">
        <img class="card-img-top" :src="'../assets/img/Rusco-Favicon.png'" alt="Card image cap" style="max-height: 11rem;">
      </a>
      <div class="card-body border-top row m-0 p-2 pb-3" style="max-height: 7rem;overflow: hidden;">
        <h6 class="card-title" style="color:black">
          <strong>
            <a href="http://rusco.co.za" target="_blank">Sponsored by : Rusco <i class="fas fa-external-link-square-alt" ></i></a>
          </strong>
        </h6>

        <p class="card-text">RUSCO is a Johannesburg / Durban based company that has, since its inception in 2003, distinguished itself as a strong below the line agency specialising in events, hospitality, entertainment and promotional services.</p>

          <!-- <a href="http://investec.com" target="_blank" class="btn btn-light btn btn-outline-dark btn-sm"><i class="fas fa-external-link-square-alt"></i>
            <span class="ml-1">
              visit
          </span>
          </a> -->
    
      </div>
    </div> 
 



 </div>
</div>
<!-- END COVER AREA -->
</div> <!--end cover profile-->
</div>
</template>
<script>
	export default
	{
		props:['useridno','auth_id','username'],
		data:function()
		{
			return {
        'picture_type':'',
        'image':'',
        errors_array:[],
			}
		},
		methods:
		{
			setImage(e)
			{
				var formObj = new FormData();
        var currentObj = this;
        this.$swal({
                text: "Setting profile photo",
                icon:currentObj.image_url,
                buttons: false,
            });
        formObj.append('picture_type',this.picture_type);
        formObj.append('_token',this.$store.state.token);
        formObj.append('image',this.image);
        //submit posts using axios
        axios.post('../setImage',formObj)
        .then(function (response) {
          //console.error(response.data[1]);
          //update vuex store with new post

          console.log(response.data.post);

          console.log(currentObj.picture_type);
          if(currentObj.picture_type == 'cover')
          {
            currentObj.$store.commit('increment',[response.data.post]);
           //cause picture to refresh
               currentObj.$store.commit('setcoverpic', response.data.img);
          }
          else
          {
            currentObj.$store.commit('increment1',[response.data.post]);
            //cause picture to refresh
               currentObj.$store.commit('setprofilepic', response.data.img);
          }
        //Displax success modal
        currentObj.$swal({
          text: 'post added',
          icon: "success",
          buttons:false,
          timer: 3000,
          });
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
      OpenImgUpload(picture_type)
      {
          this.picture_type = picture_type;
          $('#imgupload').trigger('click'); 
      },
      imguploaded(e)
      {
          this.image = event.target.files[0];
          $('#submit-cover').trigger('click');
          $('#submit-cover').trigger('touchstart'); 
      }
		},
		computed:
		{
			getCoverPic:function()
			{
				//return '../cover-picture/'+this.useridno;
				return this.$store.state.coverpic
			},
			getProfilePic:function()
			{

				return this.$store.state.profilepic
			},
		},
		mounted()
    	{
    		//initialise the profile and cover photos on vuex store
        	this.$store.commit('setcoverpic', '../cover-picture/'+this.useridno);
        	this.$store.commit('setprofilepic', '../profile-picture/'+this.useridno);
        	
    	}
	}
</script>
<style scoped>
.bod
{
  padding:0;
  min-height:300px;
  max-height:400px;
  overflow: hidden;
}
</style>