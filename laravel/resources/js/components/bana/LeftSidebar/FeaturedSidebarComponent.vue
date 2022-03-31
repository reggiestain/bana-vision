<template>
	<div class="card col-12" style="padding:0.5rem;min-height:3rem">
      
          <div v-if="!is_empty" class="card-body" style="padding: 0 0.25rem">
           <div >
            <p  style="float:left;">
              <strong>
              {{options.name}}
              </strong>
            </p >
            <p style="float: right;">
              <a href="route('studentAwards',['user'=>$userIdNo->slug])">
               <i class="fas fa-ellipsis-v " aria-hidden="true"></i>
             </a>
           </p>
         </div>
         <!-- FEATURED STUDENTS CAROUSEL -->
         <div id="carouselFeaturedControls" class="carousel slide " data-ride="carousel">
          
          <div class="carousel-inner">
          

           <div v-for="(chunk,chunkIndex,index) in chunkedPosts" class="carousel-item " v-bind:class="{active:index===0}">
            <figure class="figure" style="padding-left: 0rem;padding-right: 0.1rem;max-height: 6rem;overflow: hidden;">
              <img class="d-block w-100 figure-img  " :src="getEventPic(chunk, 0)" alt="First slide" style="height: 100%">
            </figure>
            <figcaption class="figure-caption">
                {{chunk[options.caption]}}
              </figcaption>
          </div>
          

        </div>
        <a class="carousel-control-prev" href="#carouselFeaturedControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">
            Previous
          </span>
        </a>
        <a class="carousel-control-next" href="#carouselFeaturedControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">
            Next
          </span>
        </a>
      </div>
      <!-- END FEATURED STUDENTS CAROUSEL -->
      <!-- INTERACTIONS -->
      <div class="row m-0 border-top " >
        <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
          <a href="#">
            <span style="display: block;">
              <i class="fas fa-share-alt"></i>
            </span>
          </a>
        

        </div>
        <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
          <a href="#">
            <span style="display: block;">
              <i class="fas fa-eye"></i>
            </span>
          </a>
        

        </div>
        <div class="col-md-4" style="padding: 0.55rem 0rem 0.1rem 0.1rem;text-align: center; ">
          <a href="#">
            <span style="display: block;">
              <i class="fas fa-rss"></i>
            </span>
          </a>
         

        </div>
      </div>
      <!-- END INTERACTIONS -->
    </div>

  
    <div v-if="is_empty">
            <h1 class="lead">Nothing to display at the moment</h1>
    </div>
       
  </div>
</template>
<script>
  import { Post } from "../../../Post.ts";
  export default {
    props:['options'],
    data: function() {
          return {
            groupPosts:{},
          }
        },
    computed:
      {
        
        chunkedPosts () 
          {
            var that = this; 
            var entries = Object.entries(this.$store.state[that.options.type]);

            for (const [_id, post] of entries) 
            {
              if(!that.groupPosts.hasOwnProperty(_id))
              {
                Object.assign(that.groupPosts, { [_id] : post});

              }
            }

            return that.groupPosts;
          },
          is_empty:function(){
          console.log((Object.keys(this.groupPosts).length === 0)?true:false);
              return (Object.keys(this.chunkedPosts).length === 0)?true:false;
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
    getEventPic: function(filename, pic_index) {
      var flnm;
      var flpath;
      console.log("***********************FILENAME**********************");
      console.log(this.options.type);
      console.log(filename);
      if (filename.hasOwnProperty("images")) {
        if (filename.images[pic_index]) {
          flnm = filename.images[pic_index].name;
          flpath = filename.images[pic_index].path;
        } else {
          flnm = "random";
          flpath = "";
        }
      }
      return "/api/post-picture/" + flpath + flnm + "/null/null";
    },

      },
    mounted()
    {
      this.post = new Post();
        this.post.get(this,'/api/'+this.$route.params.slug+'/'+this.options.url,1,'user_id',this.options.type);
    }
  }
</script>
