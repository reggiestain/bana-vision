<template >
<!-- ===================================NEEDS PANE============================================= -->
            <div class="tab-pane fade  m-0 p-1 bg-white" id="tab-2" role="tabpanel" aria-labelledby="needs-tab">
              <!--Needs get added here-->
              <div class="col-12 p-1" id="tab-2-data">
                <!-- ===================================NEEDS MAIN LOOP===================================-->
                <div v-for="(chunk,keya) in chunkedPosts">

                <div class="row m-0">

                      <div class=" col-4 need p-1" v-for="post in chunk" >
                        <figure class="figure">
                          <img :src="getGratitudePic(post)" class="figure-img img-fluid  mx-auto w-100" alt="A generic square placeholder image with rounded corners in a figure." data-need="$post" style="max-width: 100%;max-height: 7rem; overflow: hidden;" data-toggle="collapse" :href="'#collapseNeed'+keya" @click="showDetails(post,keya)" role="button" aria-expanded="false" :aria-controls="'collapseNeed'+keya" :data-keya="keya">
                          <figcaption class="figure-caption">
                            {{post.title}}
                          </figcaption>
                        </figure>
                      </div>


                  </div>

                  <div class="collapse" :id="'collapseNeed'+keya">
                    <div class="card card-body mb-4">
                      <a class="ml-auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position:relative;top:19px"><i class="fas fa-ellipsis-v "></i></a>

                      <!--Body gets inserted here dynamically-->
                      <div :id="'collapseNeedBody'+keya"></div>

                    <!--============================EVENT MORE OPTIONS DROPDOWN========================================-->
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <div v-if="auth.auth_owner_of_post(auth_user,user) && authenticated">
                        <a v-on:click="deletePost(delete_id,null,'deleteNeed')" class="dropdown-item" href="#" style="color:red">
                          <i class="fas fa-trash"></i>
                          <span class="ml-1">
                            delete need
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
                  </div><!--end outer loop-->
              </div>

            </div><!--END NEEDS PANE  -->
</template>

<script>
    import  './ImageInteractionsComponent.vue';
    import posts_helper from './PostsComponent.vue';
    import {Post} from '../../Post.ts';
    import {Auth} from '../../Auth.ts';
    import { mapGetters } from 'vuex';
    export default 
    {
      props: ['key_','url','returnVal'],
      data: function() {
          return {
            auth: new Auth(),
            groupPosts:[],
            newkey:this.key_,
            delete_id:0,
            delete_type:'',
            post:null,
            post_type:"featured-student",
          }
        },
      methods: 
      {
        getGratitudePic(filename)
        {
          var flnm = 'random';
          var flpath ='';
          if(filename)
          {
            if(filename.hasOwnProperty('images'))
            {
              flnm = filename.images[0].name;
              flpath = filename.images[0].path;
            }
          }
        

           return '/api/post-picture/'+flpath + flnm + '/null/null';
        },
         showDetails(post,keya)
            {
              var entries = Object.entries(post);
              var details='';
              for (const [key, value] of entries) 
              {
                if(!['_id','images','created_at'].includes(key))
                  details=details+'<dt class="col-sm-4">'+key +':</dt><dd class="col-sm-8">'+value+'</dd>';
              }
              $('#collapseNeedBody'+keya).html('<h6><strong>'+post.title+'</strong></h6>'+
              '<dl class="row">'+details+'</dl><hr>');
              this.delete_id = need.id;
            },
      },
      computed:
      {
        //get the auth status and user
          ...mapGetters({
            authenticated: 'auth/authenticated',
            auth_user: 'auth/user',
            user:'user',
        }),
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
