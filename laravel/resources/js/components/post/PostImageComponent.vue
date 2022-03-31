<template>
      <!-- ==============================EVENT IMAGE============================== -->
     <div >
    <!--================first image row================-->
    <div class="row m-0 p-0 d-flex" >
      <div class="col " style="padding-left:0rem;padding-right:0.1rem;max-height:19rem;overflow:hidden">
        <img class="card-img-top show-photo d-block mx-auto w-100"  :src="getEventPic(chunk,0)" alt="Schools brand picture" style="background-color:beige;max-height: 30rem;text-align:center ;height:100%" data-bursary="$post" data-requirements="$post->requirements" v-on:click="showphoto(chunk,0)" :data-event="chunk">
      </div>
      <!--================second column================-->
      <div class="col" style="padding-left:0.1rem;padding-right:0rem;max-height:19rem;overflow:hidden" v-if="showpic(chunk,1)">
          <img class="card-img-top show-photo d-block mx-auto w-100 "  :src="getEventPic(chunk,1)" alt="Schools brand picture" style="background-color:beige;max-height: 30rem;text-align:center;height:100% " data-bursary="$post" data-requirements="$post->requirements" v-on:click="showphoto(chunk,1)" :data-event="chunk">
      </div>
    </div><!--end first div row-->


    <!--================second div row================-->
    <div class="row m-0 p-0 d-flex" style="padding-top:0.2rem">
      <div class="col " style="padding-right:0.1rem;padding-top:0.2rem;padding-left:0rem;max-height:15rem;overflow:hidden" v-if="showpic(chunk,2)">
        <img class="card-img-top show-photo mx-auto d-block w-100"  :src="getEventPic(chunk,2)" alt="Schools brand picture" style="background-color:beige;max-height:20rem;height: 100%; text-align:center" v-on:click="showphoto(chunk,2)" :data-event="chunk">
      </div>

      <div class="col " style="padding-left:0.1rem;padding-right:0.1rem;padding-top:0.2rem;max-height:15rem;overflow:hidden" v-if="showpic(chunk,3)">
        <img class="card-img-top show-photo mx-auto d-block w-100"  :src="getEventPic(chunk,3)" alt="Schools brand picture" style="background-color:beige;max-height:20rem;height: 100%;text-align:center " v-on:click="showphoto(chunk,3)" :data-event="chunk">
      </div>

      <div class="col " style="padding-right:0rem;padding-left:0.1rem;padding-top:0.2rem;max-height:15rem;overflow:hidden" v-if="showpic(chunk,4)">
        <img class="card-img-top show-photo mx-auto d-block w-100"  :src="getEventPic(chunk,4)" alt="Schools brand picture" style="background-color:beige;height: 100%;max-height:20rem; text-align:center" v-on:click="showphoto(chunk,4)" :data-event="chunk">
      </div>
    </div>
  </div><!--end event image -->
</template>
<script>
export default {
  props:['shared','auth_id'],
  data: function() {
    return {
      groupPosts:this.$store.state.events,
        //groupPosts:null,
        //user:null,
        isRouteOurEventsPage:true,
        isEvent:true,
        ref_:'',
        post:null,
        test:null,
      }
    },
    
    methods:
    {
    /******************************************
    *
    *******************************************
    *
    *
    */
    getEventPic:function(filename,pic_index)
    {
      var flnm;
      var flpath ;
      if(filename.images[pic_index])
      {
        flnm = filename.images[pic_index].name;
        flpath = filename.images[pic_index].path;
      }
      else
      {
        flnm = 'random';
        flpath ='';
      }
      return '/api/post-picture/'+flpath + flnm + '/null/null';
    },

    /******************************************
    *toggles number of pics to be shown
    *******************************************
    *
    *
    *
    */
    showpic:function(image,img_index)
    {
      console.log()
        //check if theres a url for the image
        if(this.getEventPic(image,img_index) == '/post-picture/random/null/null')
        {
          return false;
        }
        else
        {
          return true;
        }
      },
    }
  }
</script>