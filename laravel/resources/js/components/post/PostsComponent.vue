<template>
  <div>
    <!--===========================LOADING SPINNER===========================-->
    <div
      class="d-flex col-12 loader-wrap"
      v-if="searchloading"
      style="min-height: 6rem;margin-top: 10rem"
    >
      <div class="loader">
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
        <span class="loader-item"></span>
      </div>
    </div>
    <!-- ==========================MAK POSTS  ==========================-->
    <div v-if="auth.auth_owner_of_post(auth_user, user) && authenticated">
      <make-post
        :user="auth_user"
        :usable_type="auth_user.usable_type"
        :included_posts="included_posts"
      ></make-post>
    </div>

    <!--==========================================no results message==========================================-->
    <div
      class="card card-custom col-12 mt-2  border border-warning"
      v-if="searchResults"
    >
      <div class="card-body">
        <h2>
          <i class="fas fa-search post-icons"></i>
          <span class="ml-2">
            No results to display at the moment!
          </span>
        </h2>
      </div>
    </div>
    <!--end no results message-->

    <div v-if="!searchloading" v-for="(chunk, chunkIndex) in chunkedPosts"><!-- =================================== Beginning of for loop =================================== -->
      <div v-if="isEvent">
        <!--if is of type App\Event-->
        <div class="card card-custom d-flex mt-2 event">
          <!-- @if((Route::currentRouteName() != "searchResults"))@endif-->
          <!--=========================EVENT HEADER=============================-->
          <div class="card-header post-user-top">
            <div v-if="shared">
              <!--this event is shared on a timeline-->
              <div class="media d-flex align-items-center p-0 pb-3">
                <!--===============================SHARER PROFILE IMAGE===============================-->
                <img
                  class="rounded-circle mr-3 img-circle post-avatar bg-white post-image"
                  src="route('getProfilePic',['filename'=>$post->shared_user_id])"
                  id="jumbotron-image"
                />
                <div class="media-body">
                  <h5 class="post-user-name">
                    <a
                      class="navbar-logo  ml-auto"
                      href="route('SchoolProfilePage',['userIdNo'=>$post->share_user_slug])"
                      style="padding-right:6px"
                    >
                      $post->shared_user_name
                      <span style="color:black">
                        shared an event
                      </span>
                    </a>
                  </h5>
                  <a style="color: black">
                    post->created_at->format('j F g:i A')
                  </a>
                </div>
                <!--===========================EVENT MORE OPTIONS BUTTON==============================-->
                <a
                  class="ml-auto"
                  href="#"
                  role="button"
                  id="userMenuLink"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  ><i class="fas fa-ellipsis-v post-icons"></i>
                </a>
                <!--============================EVENT MORE OPTIONS DROPDOWN========================================-->
                <div class="dropdown-menu" aria-labelledby="userMenuLink">
                  <!-- <div v-if="!isRouteOurEventsPage">-->
                  <!--if is not in events page-->
                  <!-- <a class="dropdown-item" href="route('ourEventsPage',['user'=>$post->user])">
          more events from $post->user->name
        </a>
      </div> --><!--end if current route is ourEventsPage-->
                </div>
              </div>
            </div>
            <!--end of shared header-->

            <div class="media d-flex align-items-center p-0">
              <!--if this is shared-->
              <!--==============================USER IMAGE==============================-->
              <img
                class="rounded-circle mr-3 img-circle post-avatar bg-white"
                :src="profile_pic((chunk.user_name?chunk.user[0]._id:user._id))"
                id="jumbotron-image"
              />

              <div class="media-body">
                <p class="post-user-name">
                  <a
                    class="navbar-logo  ml-auto"
                    :href="profileRoute((chunk.user_slug?chunk.user[0].slug:user.slug))"
                    style="padding-right:6px"
                  >
                    {{ (chunk.user_name?chunk.user[0].name:user.name) }}
                  </a>
                </p>
                <p class="post-user-time">
                  <!-- <a >-->
                  {{ chunk.created_at | moment }}
                  <!--</a> -->
                </p>
              </div>
              <div v-if="!shared" class="post-options">
                <!-- if is not shared-->
                <!--===========================EVENT MORE OPTIONS BUTTON==============================-->
                <a
                  class="ml-auto"
                  href="#"
                  role="button"
                  id="dropdownMenuLink"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-ellipsis-v post-icons"></i>
                </a>

                <!--============================EVENT MORE OPTIONS DROPDOWN========================================-->
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <div
                    v-if="
                      auth.auth_owner_of_post(auth_user, user) && authenticated
                    "
                  >
                    <a
                      class="dropdown-item"
                      href="#"
                      v-on:click="edit_post(auth_user, chunk)"
                      ><i class="fas fa-ban post-icons"></i>
                      <span class="ml-1">
                        Edit
                      </span>
                    </a>
                    <a
                      v-on:click="deletePost(chunk.id, null, 'deleteEvent')"
                      class="dropdown-item"
                      href="#"
                      style="color:red"
                    >
                      <i class="fas fa-trash"></i>
                      <span class="ml-1">
                        delete event
                      </span>
                    </a>
                  </div>

                  <div v-if="!isRouteOurEventsPage">
                    <a
                      class="dropdown-item"
                      :href="morePosts(user.slug, 'events')"
                    >
                      more events from {{ (chunk.user_name?chunk.user[0].name:user.name) }}
                    </a>
                  </div>

                  <a class="dropdown-item" href="#"
                    ><i class="fas fa-ban post-icons"></i>
                    <span class="ml-1">
                      Report
                    </span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- ==============================EVENT IMAGE============================== -->
          <div>
            <!--================first image row================-->
            <div class="row m-0 p-0 d-flex">
              <div
                class="col "
                style="padding-left:0rem;padding-right:0.1rem;max-height:19rem;overflow:hidden"
                v-if="showpic(chunk, 0)"
              >
                <img
                  class="card-img-top show-photo d-block mx-auto w-100"
                  :src="getEventPic(chunk, 0)"
                  alt="Schools brand picture"
                  style="background-color:beige;max-height: 30rem;text-align:center ;height:100%"
                  data-bursary="$post"
                  data-requirements="$post->requirements"
                  v-on:click="showphoto(chunk, 0)"
                  :data-event="chunk"
                />
              </div>
              <!--================second column================-->
              <div
                class="col"
                style="padding-left:0.1rem;padding-right:0rem;max-height:19rem;overflow:hidden"
                v-if="showpic(chunk, 1)"
              >
                <img
                  class="card-img-top show-photo d-block mx-auto w-100 "
                  :src="getEventPic(chunk, 1)"
                  alt="Schools brand picture"
                  style="background-color:beige;max-height: 30rem;text-align:center;height:100% "
                  data-bursary="$post"
                  data-requirements="$post->requirements"
                  v-on:click="showphoto(chunk, 1)"
                  :data-event="chunk"
                />
              </div>
            </div>
            <!--end first div row-->

            <!--================second div row================-->
            <div class="row m-0 p-0 d-flex" style="padding-top:0.2rem">
              <div
                class="col "
                style="padding-right:0.1rem;padding-top:0.2rem;padding-left:0rem;max-height:15rem;overflow:hidden"
                v-if="showpic(chunk, 2)"
              >
                <img
                  class="card-img-top show-photo mx-auto d-block w-100"
                  :src="getEventPic(chunk, 2)"
                  alt="Schools brand picture"
                  style="background-color:beige;max-height:20rem;height: 100%; text-align:center"
                  v-on:click="showphoto(chunk, 2)"
                  :data-event="chunk"
                />
              </div>

              <div
                class="col "
                style="padding-left:0.1rem;padding-right:0.1rem;padding-top:0.2rem;max-height:15rem;overflow:hidden"
                v-if="showpic(chunk, 3)"
              >
                <img
                  class="card-img-top show-photo mx-auto d-block w-100"
                  :src="getEventPic(chunk, 3)"
                  alt="Schools brand picture"
                  style="background-color:beige;max-height:20rem;height: 100%;text-align:center "
                  v-on:click="showphoto(chunk, 3)"
                  :data-event="chunk"
                />
              </div>

              <div
                class="col "
                style="padding-right:0rem;padding-left:0.1rem;padding-top:0.2rem;max-height:15rem;overflow:hidden"
                v-if="showpic(chunk, 4)"
              >
                <img
                  class="card-img-top show-photo mx-auto d-block w-100"
                  :src="getEventPic(chunk, 4)"
                  alt="Schools brand picture"
                  style="background-color:beige;height: 100%;max-height:20rem; text-align:center"
                  v-on:click="showphoto(chunk, 4)"
                  :data-event="chunk"
                />
              </div>
            </div>
          </div>
          <!--end event image -->

          <div class="card-body" style="padding: 0">
            <!-- ====================================== ADD POSTS HERE ====================================== -->
            <section>
              <component
                v-bind:is="current_post_component(chunk)"
                :post="chunk"
              ></component>
            </section>

            <span class="p-2 pb-0">
              <comments
                :post_id="chunk._id"
                :key_="chunkIndex"
                post_type="events"
                v-bind:auth_id="auth_id"
              ></comments>
              <!--@include('includes.postInteractions')--></span
            >
          </div>
          <!--php 
    $userIdNo = $post->user;
  -->
          <!--@include('includes.viewPostPicModal')-->
        </div>
      </div>
      <!--end if app is event-->
    </div>
    <edit-post :user="auth_user" :post="post_type"></edit-post>
    <post-pic v-bind:curr_props="current_props" v-bind:img_index="img_index_comp"></post-pic>
  </div>
</template>
<script>
import "../post/CommentsComponent.vue";
import posts_helper from "../post/PostsComponent.vue";
import SchoolComponent from "../school/SchoolComponent";
import OurNeedComponent from "../need/OurNeedComponent";
import EventsComponent from "../event/EventsComponent";
import BursariesComponent from "../bursary/BursariesComponent";
import ViewPostPicModalComponent from "./ViewPostPicModalComponent";
import ProfilePageComponent from "../user/profile/ProfilePageComponent";
import EditPostComponent from "./EditPostComponent";
import { Auth } from "../../Auth.ts";
import { Post } from "../../Post.ts";
import { mapGetters } from "vuex";
import moment from 'moment';
export default {
  props: ["shared", "auth_id"],
  data: function() {
    return {
      groupPosts: {},
      auth: new Auth(),
      //groupPosts:null,
      //user:null,
      isRouteOurEventsPage: true,
      isEvent: true,
      ref_: "",
      post: null,
      test: null,
      post_type: "",
      props:{},
      img_index:0,
      current_post: null,
      //current_post_component:'',
      included_posts: ["needs", "bursaries", "events"],
    };
  },
  components: {
    events: EventsComponent,
    bursaries: BursariesComponent,
    needs: OurNeedComponent,
    schools: SchoolComponent,
    "edit-post": EditPostComponent,
    'post-pic':ViewPostPicModalComponent,
  },
  methods: {
    /******************************************
     *
     *******************************************
     *
     *
     */
    getEventPic: function(filename, pic_index) {
      var flnm = "random";
      var flpath = "";
      if (filename.hasOwnProperty("images") && filename.images[pic_index]) {
          flnm = filename.images[pic_index].name;
          flpath = filename.images[pic_index].path;
        
      }
      return "/api/post-picture/" + flpath + flnm + "/null/null";
    },

    /******************************************
     *toggles number of pics to be shown
     *******************************************
     *
     *
     *
     */
    showpic: function(image, img_index) {
      //check if theres a url for the image
      return this.getEventPic(image, img_index) ==
        "/api/post-picture/random/null/null"
        ? false
        : true;
    },

    profile_pic: function(user_id) {
      return "/api/profile-picture/" + user_id;
    },

    /*******************************************
     *
     ********************************************
     *
     *
     *
     */
    showphoto: function(event_, active) {
     
      this.props = event_;
      this.img_index = active;
      $('#PostPicCarousel-modal').modal();

    },

    morePosts(slug, post_type) {
      posts_helper.morePosts(slug, post_type);
    },

    deletePost(post_id, user_slug, delete_route) {
      posts_helper.deletePost(this, post_id, user_slug, delete_route);
    },
    profileRoute(slug) {
      return "/" + slug;
    },
    current_post_component(post) {
      var current_component;
      current_component = post.hasOwnProperty("post_type")
        ? post.post_type
        : this.$route.name;
      return current_component;
    },
    edit_post(user, post_type) {
      this.post_type = post_type;
      $("#edit_post_modal").modal("show");
    },
  },
  computed: {
    //get the auth status and user
    ...mapGetters({
      authenticated: "auth/authenticated",
      auth_user: "auth/user",
      user: "user",
      //groupPosts : "getPosts({property_name:'events'})",
    }),
    /*getGroupPosts()
    {
      return this.$store.getters.getPosts({property_name:'events'});
    },*/
    /******************************************
     *
     *******************************************
     *
     *
     */
    chunkedPosts: function() {
      var that = this;
      var entries = Object.entries(this.$store.state[that.$route.name]);

      for (const [_id, post] of entries) {
        if (!that.groupPosts.hasOwnProperty(_id)) {
          Object.assign(that.groupPosts, { [_id]: post });
        }
      }
      return this.groupPosts;
    },
    /******************************************
     *
     *******************************************
     *
     *
     */
    getpostpic() {
      return this.ref_;
    },
    /******************************************
     *
     *******************************************
     *
     *
     */
    searchloading() {
      //sets loading state of the filtered results
      return this.$store.state.searchLoading;
    },
    /******************************************
     *
     *******************************************
     *
     *
     */
    searchResults() {
      return this.$store.state.resultsEmpty;
    },
    current_props()
    {
      return this.props;
    },
    img_index_comp()
    {
      return this.img_index;
    }
  },

  mounted() {
    
    //do not show any component between header and posts
    this.$store.commit("set", {
      property_name: "current_component",
      property_values: "",
    });
    //this.current_post_component = that.$route.name;
  },
  beforeMount(){
    var that = this;
    this.post = new Post();
    //check if link is no to general page without user set
    /**************************************************************************88
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * */
    var route_prefix = this.$route.params.slug
      ? this.$route.params.slug + "/"
      : "";
      console.log(route_prefix);
    this.post.get(
      this,
      "/api/" + route_prefix + that.$route.name,
      1,
      "user_id",
      that.$route.name
    );
  },
  filters: {
  moment: function (date) {
    return moment(date).format('MMMM Do YYYY, h:mm:ss a');
  }
}
};
</script>
<style>
.post-icons{
  color: #666 !important;
}
.post-options {
  width: 20px;
  height: 20px;
  padding-left: 7px;
  padding-bottom: 1.3rem;
  border: 1px solid #ccc;
  border-radius: 2px;
  color: #ccc !important;
}
.post-options a i {
  color: #ccc !important;
}
.post-user-time {
  color: #ccc !important;
  font-size: 0.7rem;
  margin-left: 21px;
}
.post-user-top {
  background-color: #fff !important;
}
.post-image {
  position: relative;
  background-position: 50%;
  background-size: cover;
  height: 40px;
  width: 40px;
  border-radius: 50%;
}
.post-image::before {
  content: "";
  display: inline-block;
  border: 3px solid #fd5211;
  border-radius: 50%;
  padding: 24px;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}
</style>
