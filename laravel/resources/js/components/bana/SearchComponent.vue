<template>
  <!--=================== SEARCH ========================================================-->
  <div class="col-xl-4 col-sm-4 col-md-4 col-lg-4 col-xs-12" id="top-navbar">
    <!--============================= search form =============================-->
    <div v-if="!register_page" class>
      <!--make proper route-->

      <div class="input-group input-group-sm" style="padding-bottom: 10px;">
        <input
          type="text"
          class="form-control search-neumorphism search-form form-control-sm"
          autocomplete="off"
          placeholder="Search"
          id="search"
          name="search"
          @focus="focus"
          v-on:change="autosuggest($event.target.value)"
        />
        <button
          class="btn btn-default search-btn btn-sm"
          type="submit"
          style="position: absolute;right: 0.28rem;border-radius: 7px;height: 1.25rem; width: 1.25rem; /= Safari 3-4, iOS 1-3.2, Android 1.6- =/
            -webkit-border-radius: 7px; 
            /= Firefox 1-3.6 =/
            -moz-border-radius: 7px; padding: 0;bottom: 0.87rem;"
        >
          <i
            class="fa fa-search"
            style="color:#fff ;line-height: 1.25rem;font-size: 0.7rem;text-align: center;"
          ></i>
        </button>
      </div>

      <!-- SEARCH DROPDOWN -->
      <div
        class="col-12 dropdown-menu content-list dont-close searcher"
        id="list"
      >
        <link
          href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
          rel="stylesheet"
        />
        <div class="searched-list">
          <ul
            v-for="result in search_results"
            class="drop-list dont-close search-lister"
          >
            <router-link :to="`/${result.slug}`" class="">
              <li>
                <span class="item dont-close">
                  <span class="icon people dont-close">
                    <i class="bx bxs-user-rectangle dont-close ics"></i>
                  </span>
                  <span class="text dont-close searched-name">
                    <p class="searched-mr">{{ result.name }}</p>
                    <p class="searched-ml">
                      {{ result.usable_type.substring(4) }}
                    </p>
                  </span>
                </span>
              </li>
            </router-link>
          </ul>
        </div>
        <div class="p-2 border-top">
          <button type="submit" name="" class="search-button">
            <h6>
              See all results
              <span id="search-for"></span>
            </h6>
          </button>
        </div>
      </div>
    </div>
    <!--end search form-->
  </div>
</template>
<script>
import { Post } from "../../Post.ts";
import { Auth } from "../../Auth.ts";
import { mapGetters } from "vuex";
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
      search_results: this.$store.state["search_results"],
    };
  },
  methods: {
    autosuggest(query) {
      this.post = new Post();
      var query_type = "School";
      this.post.get(
        this,
        `/api/search/${query}`,
        1,
        "user_id",
        "search_results"
      );
    },
    focus() {
      $("#list").dropdown("toggle");
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
  computed: {},
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

<style scoped>
.ics {
  color: #333 !important;
}
.searcher {
  border-radius: 7px;
}
.search-button {
  border: none;
  background: transparent;
  margin-left: 30px;
}
.searched-list {
  display: flex;
  flex-direction: column;
  height: 200px;
  overflow-y: scroll;
}

.searched-name {
  display: flex;
  margin: 0;
}

.searched-mr {
  margin: 0;
  margin-right: 10px;
  /* font-size: 20px; */
  font-weight: 400;
  color: #333;
}

.searched-ml {
  margin: 0;
  /* font-size: 16px; */
  font-weight: 400;
  color: #999;
}

.search-item {
  justify-content: center;
  display: flex;
  align-items: center;
  padding: 10px 20px;
}

.search-item:hover {
  background-color: #ddd;
}

.search-item:focus {
  background-color: #ddd;
}

.search-lister {
  padding: 10px 10px;
  border-bottom: 2x solid rgb(117, 111, 111);
}
.search-lister:hover {
  background-color: rgb(245, 238, 238);
}

.searched-list::-webkit-scrollbar {
  width: 12px;
  background-color: #f5f5f5;
}

.searched-list::-webkit-scrollbar-thumb {
  border-radius: 10px;
  background-color: #fb9975;
  background-image: -webkit-linear-gradient(
    90deg,
    transparent,
    rgba(0, 0, 0, 0.2) 50%,
    transparent,
    transparent
  );
}
</style>
