<template >
    <!--STUDENT PAGE COMPONENT-->
    <div>
  <!--Loop through all the posts in chunks-->
    <div v-for="(chunk,chunkIndex) in chunkedPosts">
      <div class="row m-0 mt-3" style="height:10rem;margin-top: 3.25rem">
        <!--Loop through the individual chunks-->
        <div class="col-4 border p-0 " v-for="n in chunk" >
          <!--==========================================POST IMAGE==========================================-->
           <figure class="figure">
            <img class="show-project-photo"  :src="getPostImg(n)"  style="max-width:100%;height: 100%;width:100%;z-index: 5000 !important" data-toggle="collapse" :href="getCollapseRef(chunkIndex)" role="button" aria-expanded="false" :aria-controls="getCollapseId(chunkIndex)" :data-key_c="key_" data-post="post" data-postAdditionalInfo="postAdditionalInfo" v-on:click="getBody(n,chunkIndex)">
            <figcaption class="figure-caption">
              {{n[options.caption]}}
            </figcaption>
          </figure>
            <!-- <image-interactions :img_name="img_name(n)"></image-interactions> -->
            
        </div>
      </div>
      <div class="collapse" :id="getCollapseId(chunkIndex)" style="margin-top: 3.5rem">
        
        <div class="card card-body mb-4">
            <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position:relative;top:0">
              <i class="fas fa-ellipsis-v "></i>
            </a>
            <!--content gets inserted here dynamically-->
            <div  :id="getCollapseBody(chunkIndex)"></div>

            <!--====================================show the dropdown menu====================================-->
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <div v-if="auth_id == user.id ">
                <a v-on:click="deletePost(delete_id,null,delete_type)" class="dropdown-item" href="#" style="color:red">
                  <i class="fas fa-trash"></i>
                  <span class="ml-1">
                    delete {{post_type}}
                  </span>
                </a>
              </div>

              <a class="dropdown-item" href="#"><i class="fas fa-ban"></i>
                <span class="ml-1">
                  Report
                </span>
              </a>
            </div>
        </div>
        
      </div>
    </div>
</div>
</template>

<script>
    import  './ImageInteractionsComponent.vue';
    import posts_helper from './PostsComponent.vue';
    import {Post} from '../../Post.ts';
    export default 
    {
      props: ['key_','url','returnVal','options'],
      data: function() {
          return {
            groupPosts:[],
            newkey_:this.key_,
            delete_id:0,
            delete_type:'',
            post:null,
            post_type:this.returnVal,
          }
        },
      methods: 
      {
        // a computed getter
        getPostImg: function(name,xtra_info = null) 
        {
          console.log(name);
          name = name.images[0].name;
          return '/api/post-picture/'+this.user_name_slug+'/'+this.post_type+'/'+name+'/null/null';
          
        },

        img_name:function(n)
        {

          if(n.images)
          {
              return n.images[0].name;
          }
          else
          {
            return n.school_student.images[0].name;
          }
        },
        getBody:function(post,itrtr)
        {
          var markup ='';
          var carousel = '';
          var excludes =['_id','images','created_at','updated_at','_token','participants'];

           var entries = Object.entries(post);
              var details='';
              for (const [key, value] of entries) 
              {
                //show the key value properties of the post
                if(!excludes.includes(key))
                  markup=markup+'<dt class="col-sm-4"><strong>'+key +':</strong></dt><dd class="col-sm-8">'+value+'</dd>';
                //show the carousel
                if(key ==this.options.show_carousel_on)
                {
                  var that = this;
                  post[key].forEach(function(ele){
                      carousel = carousel + '<div class="carousel-item active">'+
                      '<figure class="figure"><img class="d-block img-fluid rounded-circle" src="'+'/'+that.user_name_slug+'/school-picture/'+ele._id+'" alt="First slide"style="max-width: 100%;width:7rem"></figure>'+
                      '<p>'+ele.name+'</p>'+
                      '</div>';

                  });  
                }
              }
          
          var n = this.newkey_ + itrtr;
          var carouselSection = '<h5>Participants</h5>'+
            // <!--==============CAROUSEL=============-->
            '<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">'+
            '<div class="carousel-inner" id="carouselParent'+n+'">'+
                
            '</div>'+
            '</div>';
            markup += (this.options.show_carousel)?carouselSection:'';
          //<!--End carousel-->
          var markup_final = '</dl>'+markup+'</dl>';
          this.delete_id = post.id;
          
          $(document.getElementById('collapse'+this.post_type+'Body'+n)).html(markup_final);

          document.getElementById('carouselParent'+n).innerHTML = carousel;
        },
        getCollapseId:function(itrtr)
        {
          //console.log(itrtr);
          var n = this.newkey_ + itrtr;
           if(this.key_ != undefined) //allow collapse
           {
          return 'collapse'+this.post_type+n
        }
        },
        getCollapseRef:function(itrtr)
        {
          var n = this.newkey_ + itrtr;
          return '#collapse'+this.post_type+n
        },
        getCarouselParent:function(itrtr)
        {
          var n = this.newkey_ + itrtr;
          return 'carouselParent'+n
        },
        getCollapseBody:function(itrtr)
        {
          var n = this.newkey_ + itrtr;
         
      
            return 'collapse'+this.post_type+'Body'+n
        },
        morePosts(slug,post_type)
        {
            posts_helper.morePosts(slug,post_type);
        },


        deletePost(post_id,user_slug,delete_route)
        {
            posts_helper.deletePost(this,post_id,user_slug,delete_route);
            $('.collapse').collapse('hide');
        }
      },
      computed:
      {
        
        chunkedPosts () 
          {
            var that = this; 
            var entries = Object.entries(this.$store.state[this.returnVal]);

            for (const [_id, post] of entries) 
            {
              if(!that.groupPosts.hasOwnProperty(_id))
              {
                Object.assign(that.groupPosts, { [_id] : post});

              }
            }
            const chunksize = 3;
            const array_from_object = Object.values(this.groupPosts);
            return  _.chunk(array_from_object,chunksize);
          }

      },
      mounted() 
      {
        this.post = new Post();
        this.post.get(this,'/api/'+this.$route.params.slug+'/'+this.url,1,'user_id',this.returnVal);
      }
    }
</script>
