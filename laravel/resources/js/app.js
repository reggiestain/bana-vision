/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;
import router from "./router";
//import Vue from 'vue';
import VueMeta from "vue-meta";


import BootstrapVue from "bootstrap-vue";
import VueSweetalert2 from "vue-sweetalert2";

Vue.use(BootstrapVue);
Vue.use(VueSweetalert2);

Vue.use(VueMeta);
import { store } from "./store/store.js";
import AppComponent from "./components/AppComponent";
import { Post } from "./Post.ts";
import axios from "axios";
axios.defaults.withCredentials = true;
//axios.defaults.baseURL = 'http://localhost:8000/';
axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
  'meta[name="csrf-token"]'
).attr("content");
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*Vue.component('example-component', require('./components/ExampleComponent.vue'));*/
//********************************uncomment later please*******************************
Vue.component(
  "site-header",
  require("./components/bana/HeaderComponent.vue").default
);
Vue.component(
  "right-sidebar",
  require("./components/bana/RightSideBarComponent.vue").default
);
Vue.component(
  "left-sidebar",
  require("./components/bana/LeftSideBarComponent.vue").default
);
Vue.component(
  "profile-area",
  require("./components/user/profile/ProfileComponent.vue").default
);
Vue.component(
  "banner",
  require("./components/bana/BannerComponent.vue").default
);
Vue.component(
  "page-content",
  require("./components/bana/PageContentComponent.vue").default
);
Vue.component(
  "app-component",
  require("./components/AppComponent.vue").default
);
Vue.component(
  "make-post",
  require("./components/post/MakePostComponent.vue").default
);
Vue.component(
  "comments",
  require("./components/post/CommentsComponent.vue").default
);
Vue.component(
  "zlto",
  require("./components/zlto/ZltoPageComponent.vue").default
);


window.onload = function() {
  var routes;
  //get the token before loading any route
  store.dispatch("auth/me").then(() => {
    const app = new Vue({
      el: "#app",
      components: {
        // 'app-component':AppComponent
      },
      router,
      store,
      data: function() {
        return {
          token: $('meta[name="csrf-token"]').attr("content"),
          pages: {},
          otherpicture: null,
          isLoading: true,
          tabs: [],
          posts: [],
          posts1: [],
          posts2: [],
        };
      },
      methods: {
        /*****************************************************************************
         * load more data for lazy loading
         ***************************************************************************
         *
         *
         */
        loadMoreData: function(page, tab_number, place_id) {
          var that = this;
          var post_url =
            window.location.origin +
            "/api" +
            that.$route.path +
            "?page=" +
            page +
            "&tab_number=" +
            tab_number;
          this.post = new Post();

          this.post.get(this, post_url, 1, "user_id", that.$route.name);
        },
        //when scrolling to the bottom
        scroll: function(that) {
          console.log("scroll is being called");
          window.onscroll = () => {
  let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;

  if (bottomOfWindow) {
    console.log('gawo iwe');
  }
};
         
          $(window).scroll(function() {
            console.log("#################### scroll is working####################");
            if (
              $(window).scrollTop() + $(window).height() >=
              $(document).height()
            ) {
              console.log(
                "************************scrolling******************************"
              );
              var tab_number = 1;

              if ($(".nav-item.active.show").attr("id") != undefined) {
                tab_number = $(".nav-item.active.show").attr("id");
              }

              if (that.$store.state.scroll) {
                //check if scroll is allowed
                that.pages["page" + tab_number] =
                  that.pages["page" + tab_number] + 1; //increment the page number
                //use function to load pages
                that.loadMoreData(
                  that.pages["page" + tab_number],
                  tab_number,
                  "#" + that.tabs[tab_number]
                );
              }
            }
          });
        },
        //
        addpicture: function(e) {
          this.otherpicture = event.target.files[0];
          $("#submit-photo").trigger("click");
          $("#submit-photo").trigger("touchstart");
        },
        /********************************************************************
         *   CREATE POST / UPLOAD AN IMAGE
         *********************************************************************
         *this method  uploads an image
         *
         */
        createPost: function(e) {
          let currentObj = this;
          var formObj = new FormData();
          //display loading modal
          this.$swal({
            text: "Adding Post",
            icon: currentObj.image_url,
            buttons: false,
          });

          formObj.append("addPicture", this.otherpicture);
          formObj.append("_token", this.token);
          //submit posts using axios
          axios
            .post("../createPost", formObj)
            .then(function(response) {
              //update vuex store with new post
              currentObj.$store.commit("increment2", [response.data[1]]);
              //Displax success modal
              currentObj.$swal({
                text: "post added",
                icon: "success",
                buttons: false,
                timer: 3000,
              });
            })
            .catch(function(error) {
              currentObj.output = error;
            })
            .finally(function() {
              //reset the forms
            });
        },
      },
      computed: {},
      mounted() {
        //set the current componet page to homepage
        //this.$store.commit('setCurrentComponent','profile-area');
        //populate the pages and tabs with the number of tabs
        if ($(".nav-item.nav-link").length == 0) {
          //theres only one tab
          this.pages["page1"] = 1;

          this.tabs[1] = "tab-1-data";
        }
        for (var i = 1; i <= $(".nav-item.nav-link").length; i++) {
          this.pages["page" + i] = 1;
          this.tabs[i] = "tab-" + i + "-data";
        }
        var that = this;
        this.routes = this.$route;
        //this.scroll(that);
        this.isLoading = false;
      },
      created(){
        var that = this;
        this.scroll(that);
      }
    });
  });
  //check if the route requires user to be logged in
  router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
      if (!store.state.auth.authenticated) {
        next("/login");
      } else {
        if (store.state.auth.auth_user.slug === to.params.slug) {
          //console.log(store.state.auth.user);
          store.commit("set", {
            property_name: "user",
            property_values: store.state.auth.auth_user,
          });
          next();
        }
      }
    } else {
      next();
    }
    //check if requires component placed before the content like profile area
    if (to.meta.requiresComponentBeforeContent)
      store.commit("set", {
        property_name: "current_component",
        property_values: "profile-area",
      });
    else
      store.commit("set", {
        property_name: "current_component",
        property_values: "",
      });
  });
};
