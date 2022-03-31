<template>
  <nav
    class="navbar navbar-default fixed-top bg-white d-flex flex-row justify-content-between p-0  darknavmenu"
  >
    <div
      class="navbar-header col-xl-4 col-lg-4 col-md-4  col-sm-4 col-12 d-flex"
    >
      <!--==================SIDEBAR LEFT=========================-->
      <div
        class="d-md-none align-self-center"
        style="z-index:10400 !important;"
      >
        <!-- <button
          class="navbar-toggler"
          data-target="#left-sidebar"
          data-toggle="collapse"
          type="button"
          aria-controls="left-sidebar"
          aria-expanded="false"
        >
          <i class="fa fa-ellipsis-v fa-1x" style="color:#ff5500"></i>
        </button> -->
      </div>

      <router-link
        :to="{ name: 'home' }"
        class="align-self-center navbar-brand"
      >
        <img
          class="wrap"
          id="banner"
          src="/assets/img/bana1.png"
          style="height:2.4rem;width:2.4rem;"
        />
      </router-link>

      <!--===================Mobile Device========================================================-->
      <div
        class="dropdown dropleft show align-self-center ml-auto"
        style="margin-top: 20px;"
      >
        <!--============================= auth icons =============================-->
        <div v-if="authenticated">
          <!--============================= auth messages =============================-->
          <a
            class="align-self-center ml-auto d-xl-none d-lg-none d-md-none d-sm-none feature-unavailable"
            hef-del="route('messages',['user'=>Auth::user()->slug])"
          >
            <span>
              {{ number_messages }}
              <i class="fa fa-envelope" style="padding-right:3px"></i>
            </span> </a
          ><!--end auth messages-->

          <!--============================= auth notifications =============================-->
          <a
            class="align-self-center ml-auto d-xl-none d-lg-none d-md-none d-sm-none"
            href="route('notifications',['user'=>Auth::user()->slug])"
          >
            <span>
              {{ number_notifications }}
              <i class="fa fa-bell" style="padding-right:3px"></i>
            </span>
          </a>
        </div>
        <!--end auth icons-->

        <a
          href="#"
          role="button"
          id="dropdown-content"
          data-toggle="dropdown"
          aria-haspopup="true"
          ariaexpanded="false"
          class=" align-self-center ml-auto d-xl-none d-lg-none d-md-none d-sm-none mr-1"
          title=""
        >
          <span class="mr-1 align-self-center">
            <div v-if="authenticated">
              <strong>
                {{ auth_user.name }}
              </strong>
            </div>

            <div v-else>
              <router-link
                :to="{ name: 'login' }"
                class="login-btn horizontalOverlay"
              >
                <i class="fa fa-lock nav-icons" style="padding-right:2px"></i>
                Login
              </router-link>
            </div>
          </span>
        </a>

        <!--@include('includes.dropdownMenu')-->
      </div>
      <router-link
        :to="{ name: 'register' }"
        class="align-self-center d-xl-none d-lg-none d-md-none d-sm-none"
        role="button"
        ><!--use router push for href to register page-->
        <span>
          <div v-if="!authenticated">
            <a class="login-btn horizontalOverlay">
              <i class="fas fa-pen nav-icons"></i> Sign up</a
            >
          </div>
        </span>
      </router-link>

      <!--====================== MENU TOGGLE BUTTON ======================-->

      <div
        class="d-md-none align-self-center"
        style="z-index:10400 !important;"
      >
        <button
          class="navbar-toggler"
          data-target="#navigation-sidebar"
          data-toggle="collapse"
          type="button"
          aria-controls="navigation-sidebar"
          aria-expanded="false"
        >
          <i class="fa fa-bars fa-1x" style="color:#ff5500"></i>
        </button>
      </div>

      <!--=================== END Mobile Device========================================================-->
    </div>
    <!-- ==================================== SEARCH ==================================== -->
    <search></search>

    <!--===================Desktops Device========================================================-->

    <!--<div class="col-xl-4 col-lg-4 col-md-4 col-xs-12 collapse navbar-collapse navbar-ex1-collapse d-sm-none d-xs-none" id="navbar"  >-->
    <div
      class="col-xl-4 col-sm-4 col-md-4 col-lg-4 col-xs-12 d-flex align-items-center "
    >
      <!--============================= auth icons =============================-->
      <div v-if="authenticated">
        <a
          class="d-none d-sm-none d-md-block ml-auto feature-unavailable"
          href-del="route('messages',['user'=>Auth::user()->slug]"
        >
          <span>
            {{ number_messages }}
            <i class="fa fa-envelope" style="padding-right:3px"></i>
          </span>
        </a>

        <div class="dropdown show">
          <!--****************************************uncomment please**********************************************-->
          <!--<notifications></notifications>-->
        </div>

        <!-- <notifications-dropdown></notifications-dropdown> -->
      </div>
      <!--end auth icons-->

      <div
        class="dropdown dropleft show align-self-center @if(!Auth::user()) ml-auto "
      >
        <!-- <a class="dropdown-toggle d-none d-sm-none d-md-block ml-auto" href="#" role="button" id="dropdown-content" data-toggle="dropdown" aria-haspopup="true" ariaexpanded="false"  title="" >
          <span>
            <div v-if="authenticated">
              {{auth_user.name}} 
            </div>

            <div v-else>
              <i class="fa fa-lock" style="color: #ffd700"></i>
              login 
            </div>
            

          </span>
        </a> -->

        <router-link
          :to="{ name: 'login' }"
          class=" d-none d-sm-none d-md-block ml-auto"
          href="#"
          role="button"
          id="dropdown-content"
          data-toggle="dropdown"
          aria-haspopup="true"
          ariaexpanded="false"
          title=""
        >
          <span>
            <div v-if="authenticated">
              {{ auth_user.name }}
            </div>

            <div v-else>
              <a class="login-btn horizontalOverlay">
                <i class="fa fa-lock nav-icons"></i>
                Login
              </a>
            </div>
          </span>
        </router-link>
        <!--@include('includes.dropdownMenu')-->
      </div>
      <router-link
        :to="{ name: 'register' }"
        class="d-none d-sm-none d-md-block  ml-1 hidden-sm hidden-xs"
        role="button"
      >
        <span>
          <div v-if="authenticated"></div>

          <div v-else="!user.name">
            <a class="login-btn horizontalOverlay">
              <i class="fas fa-pen nav-icons"></i>
              Sign up
            </a>
          </div>
        </span>
      </router-link>

      <!--===================END DESKop Device========================================================-->
    </div>
    <!--=============================JUMBOTRON==============================-->

    <div v-if="!show_jumbotron"></div>

    <div
      v-if="show_jumbotron"
      class="jumbotron col-lg-12 col-sm-12 col-12 d-flex align-items-center"
    >
      <div class="media d-flex align-items-center p-2">
        <img
          class="rounded-circle mr-3 bg-white post-avatar img-circle"
          :src="profile_pic(user._id)"
          @error="
            $event.target.scr =
              'https://github.com/NtsikeleloBana/imagesbox/blob/main/default_profile_pic.jpeg?raw=true'
          "
          id="jumbotron-image"
        />
        <div class="media-body">
          <h5 class="text-light" style="font-size: 0.755rem">
            <router-link
              :to="{ name: 'profile', params: { slug: url_slug } }"
              class="navbar-logo  ml-auto text-light"
              style="padding-right:6px"
            >
              {{ user.name }}
            </router-link>
          </h5>
          <!--============================= follow badge =============================-->
          <div
            v-if="!auth.auth_owner_of_post(auth_user, user) && authenticated"
          >
            <a
              class="badge badge-pill badge-success "
              href="route('followUser',['likeableId'=>$userPassedId->slug])"
            >
              <i class="fa fa-heart">
                Follow us
              </i>
            </a>
          </div>
          <!--end follow badge-->
        </div>
      </div>

      <!--SEND MESSAGE-->
      <span class="ml-auto d-flex">
        <!--============================= interact with us =============================-->
        <div v-if="!auth.auth_owner_of_post(auth_user, user) && authenticated">
          <a class="ml-auto text-light" href="#" data-recipient="slug"
            ><!--turn data recipient to prop for slug-->
            <i class="fas fa-splotch fa-1x rate-us"></i>
          </a>

          <a class="ml-auto text-light" href="#" data-recipient="slug"
            ><!--turn data recipient to prop for slug-->
            <i class="fa fa-envelope fa-1x send-message"></i>
          </a>
        </div>
        <!--end interact with us-->

        <div v-if="get_feed_page">
          <router-link
            :to="{ name: 'feed', params: { slug: url_slug } }"
            class="ml-auto text-light"
            href="Route('getFeed',['user'=>$userIdNo])"
            data-recipient="slug"
            ><!--turn data recipient to prop for slug-->
            <i class="fas fa-rss-square fa-1x"></i>
            <span class="ml-1">
              feed
            </span>
          </router-link>
        </div>
        <!--end get feed-->

        <!--HELP-->
        <router-link
          :to="{ name: 'help', params: { slug: url_slug } }"
          class="align-items-center ml-auto  jumb-a"
          data-recipient="slug"
          ><!--turn data recipient to prop for slug-->
          <i class="fa fa-question-circle fa-1x nav-icon"></i>
          Help
        </router-link>
        <!--ABOUT US-->
        <router-link
          :to="{ name: 'profile', params: { slug: url_slug } }"
          class="align-items-center ml-auto text-light"
        >
          <i class="fa fa-info-circle fa-1x" style="margin-left:10px"></i>
          About us
        </router-link>
      </span>
    </div>
    <!--END JUMBOTRON-->
  </nav>
  <!--include('includes.messagesModal')
include('includes.ratingModal')
include('includes.deleteConfirmationModal')-->
</template>
<script>
import { Post } from "../../Post.ts";
import { Auth } from "../../Auth.ts";
import { mapGetters } from "vuex";
import SearchComponent from "./SearchComponent";
export default {
  data: function() {
    return {
      post_helper: new Post(),
      post: { name: "new school" },
      auth: new Auth(),
      register_page: false, //fix to dynamically not show on register page
      number_messages: 3, //initiate to 0 and change on mount
      number_notifications: 3, //initiate to 0 and change on mount
      messages: false, //messages page
      search: "",
    };
  },
  components:{
    'search':SearchComponent,
  },
  methods: {
    profile_pic: function(user_id) {
      return "/api/profile-picture/" + user_id
        ? "/api/profile-picture/" + user_id
        : "https://github.com/NtsikeleloBana/imagesbox/blob/main/default_profile_pic.jpeg?raw=true";
    },
    /***************************************************
     * show the orange jumbotron part of the navbar
     ****************************************************
     *
     *
     */
    search_query(e) {
      var that = this;
      //var post_uri;
      //check if the post is from the feed or events/bursaries/needs ...etc
      //post_uri = (this.postType!=='')?this.postType:this.$route.name;
      //check if updating if included_posts (buttons to select needs or events) is undefined thenis from update modal
      //if(this.edit_post.hasOwnProperty('post_type'))
      //post_uri = post_uri + this.edit_post._id;
      //submit posts using axios
      that.post_helper.post(that, `/api/search/${post_uri}`);
    },
  },
  computed: {
    //get the auth status and user
    ...mapGetters({
      authenticated: "auth/authenticated",
      auth_user: "auth/user",
      user: "user",
    }),
    /***************************************************
     * show the orange jumbotron part of the navbar
     ****************************************************
     *
     *
     */
    show_jumbotron() {
      return !this.messages && this.$route.params.slug ? true : false; //check if not on user page
    },
    /***************************************************
     * check if on feed page
     ****************************************************
     *
     *
     */
    get_feed_page: function() {
      return this.$route.path == this.$route.params + "/feed" ? true : false;
    },
    /***************************************************
     * get the route slugs
     ****************************************************
     *
     *
     */
    url_slug() {
      return this.$route.params.slug;
    },
  },
  mounted() {
    this.post = new Post(); //add optional post get parameter to indicate where to add the response //get the number of notifications //console.log(this.post.get(this,'/api/'+this.$route.params.slug+'/',1,'user_id','user'));
    //wrap if in slug statement
    //wrap in if slug and auth statement
    /*this.post.get(this, "/api/" + this.$route.params.slug + "/messages", 1); //get the number of messages
    this.post.get(
      this,
      "/api/" + this.$route.params.slug + "/notifications",
      1
    );*/ this.post.get(
      this,
      "/api/" + this.$route.params.slug + "/",
      1,
      "user_id",
      "user"
    );
  },
};
</script>
<style>
/* .horizontalOverlay {
    overflow: hidden;
    padding: 6px 15px;
    border-radius: 30px;
    background-color: #fd5411;
    color: #d4470e;
    position: relative;
    display: inline-block;
}

.horizontalOverlay::before {
    content: '';
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  
    background: #478ac9;
    opacity: 0.5
    ;
    transform: scaleX(0);
    transform-origin: 100% 100%;
    transition: transform 0.6s cubic-bezier(0.53, 0.21, 0, 1);
    will-change: transform;
}

.horizontalOverlay:hover::before  {
    transform-origin: 0 0;
    transform: scaleX(1);
}
 */

.login-btn {
  margin-left: 13px;
  border-radius: 7px;
  padding: 10px 15px;
  background: #fd5211;
  border: 1px solid #fd5211 !important;
  font-weight: bold;
  color: #fff !important;
}
.nav-icons {
  color: #fff;
}
.jumb-a {
  color: #007bff !important;
}
.search-neumorphism {
  border-radius: 7px !important;
  border: none !important;
  background: #ffffff;
  box-shadow: 6px 6px 12px #d9d9d9, -6px -6px 12px #ffffff;
}
</style>
