<template>
  <div>
    <!-- ==========================MAK POSTS  ==========================-->
    <div v-if="auth.auth_owner_of_post(auth_user, user) && authenticated">
      <make-post
        :user="auth_user"
        :usable_type="auth_user.usable_type"
        :included_posts="included_posts"
      ></make-post>
    </div>
    <div class="card container mt-4" style="padding: 0">
      <div class="card-header card-header-main">
        <strong>Donation</strong>

        <div v-if="auth_user != '' && auth_user != null">
          <a
            class="p-1 float-right"
            href="#"
            role="button"
            id="dropdownMenuLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fas fa-cog" style="color:#c5c7cb"></i>
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a
              class="dropdown-item"
              href="#"
              data-toggle="collapse"
              data-target="#collapseExample"
              aria-expanded="false"
              aria-controls="collapseExample"
            >
              Add need
            </a>
          </div>
        </div>
        <!--end auth-->
        <a class="p-1 float-right">
          <i class="fas fa-wrench" style="color:#c5c7cb"></i>
        </a>
        <a class="p-1 float-right">
          <i class="fas fa-chevron-up" style="color:#c5c7cb"></i>
        </a>
      </div>
      
    </div>

    <!--auth-->
    <div v-if="auth.auth_owner_of_post(auth_user, user) && authenticated">
      <!--if owner of this post-->
      <button type="button" class="btn btn-primary btn-sm" id="add-gratitude">
        <i class="fas fa-plus"></i>
        gratitude
      </button>
    </div>
    <!--end auth-->

    <!-- gratitudes carousel -->


    <!-- CONTENT -->
    <div class="card mt-3">
     <!-- wrapper -->
      <!-- <div class="card-body p-0"> -->
      <div
        class="tab-content card-body p-0"
        id="nav-tabContent"
        style="background-color: #f0f0f0;"
      >
       <div
          class="tab-pane fade show active col-12 p-0"
          id="tab-1"
          role="tabpanel"
          aria-labelledby="donate-tab"
        >
 <form
            @submit.prevent="donatenow"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="form-group row">
                <label for="caption" class="col-sm-4 col-form-label">
                  Donatation Amount
                </label>
                <div class="col-sm-8 $errors->has('body') ? 'has-error':''">
                  <input
                    type="number"
                    class="form-control form-control-sm"
                    v-model="caption"
                    id="caption"
                    placeholder="R200"
                  />
                </div>
              </div>

              <!-- <div class="form-group row">
                <label for="body" class="col-sm-4 col-form-label">
                  Body
                </label>
                <div class="col-sm-8 $errors->has('body') ? 'has-error':''">
                  <textarea
                    class="form-control form-control-sm"
                    v-model="overview_body"
                    id="overview_body"
                    placeholder="Tell the audience how their donation can help you"
                  ></textarea>
                </div>
              </div> -->

            
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm">
                Donate Now
              </button>
            
            </div>
          </form>

       </div>
      </div>
      <!-- end tab-content -->
      <!-- </div> --><!-- end wrapper -->
    </div>
    <!-- end content -->

 
  </div>
</template>
<script>
import posts_helper from "../post/PostsComponent.vue";
import ImagePostComponent from "../post/ImagePostComponent";
import { Auth } from "../../Auth.ts";
import { Post } from "../../Post.ts";
import { mapGetters } from "vuex";
export default {
  components: {
    "image-post": ImagePostComponent,
  },
  data: function() {
    return {
      post: null,
      auth: new Auth(),
      groupPosts: {},
      graces: null, //this.useridno.usable.needs_gratitude,
      title: "",
      description: "",
      errors_array: "",
      quantity: "",
      due_date: "",
      category: "",
      urgency: "",
      school_id: null, //this.useridno.usable.id,
      image: "",
      caption: "",
      overview_body: "",
      message: "",
      needs_count: 0, //this.needscount,
      delete_id: 0,
      needs_options: { show_carousel: false, caption: "title" },
      included_posts: ["needs", "bursaries", "events"],
    };
  },
  methods: {
    getGratitudePic(filename) {
      var flnm = "random";
      var flpath = "";
      if (filename) {
        if (filename.hasOwnProperty("images")) {
          flnm = filename.images[0].name;
          flpath = filename.images[0].path;
        }
      }

      return "/post-picture/" + flpath + flnm + "/null/null";
    },
    getCarouselClass(index) {
      return index == 0 ? "carousel-item active" : "carousel-item";
    },
    createNeed() {
      var keys = [
        "title",
        "description",
        "quantity",
        "due_date",
        "category",
        "urgency",
        "school_id",
        "image",
      ]; //which values from data are

      var currentObj = this;
      var formObj = new FormData();

      keys.forEach(function(key) {
        if (currentObj.$data[key] != "")
          formObj.append(key, currentObj.$data[key]);
      });

      formObj.append("_token", this.$store.state.token);
      $("#collapseExample").collapse("hide");
      var currentObj = this;
      //
      this.$swal({
        text: "Creating need",
        icon: currentObj.image_url,
        buttons: false,
      });
      //
      axios
        .post("../createNeed", formObj)
        .then(function(response) {
          console.error(response.data["need"]);
          //currentObj.$store.commit('setprofilepic',response.data[1]);
          //currentObj.$store.commit('setUserIdNo',response.data['user']);
          currentObj.$store.commit("increment1", [response.data["need"]]);
          ++currentObj.needs_count;
          currentObj.$swal({
            text: "Contact details successfully updated",
            icon: "success",
            buttons: false,
            timer: 3000,
          });
        })
        .catch(function(error) {
          if (error.response) {
            var errors = error.response.data.errors; // => the response payload
            var error_string = "";
            Object.entries(errors).forEach(([key, value]) => {
              value.forEach(function(errormsg) {
                currentObj.errors_array.push(errormsg);
                error_string = error_string + "\n " + errormsg;
              });
            });

            currentObj.$swal({
              text: error_string,
              icon: that.image_url,
            });
          }
        })
        .finally(function() {
          //reset the forms
          /*for (var key in currentObj.$data) 
               			{
               				if (currentObj.$data.hasOwnProperty(key))
               				{
               					currentObj.$data[key] = '';
               				}
               			}*/
        });
    },
    getPostPic(need) {
      console.log(need.images);
      if (need.images.length > 0) {
        return "/post-picture/" + need.images[0].name + "/our_need";
      } else {
        return "/post-picture/random/our_need";
      }
    },
    createNeedsGratitude() {
      var keys = ["message", "school_id", "image"]; //which values from data are inputs
      var currentObj = this;
      var formObj = new FormData();
      keys.forEach(function(key) {
        if (currentObj.$data[key] != "")
          formObj.append(key, currentObj.$data[key]);
      });

      formObj.append("_token", this.$store.state.token);
      $(".modal").modal("hide");
      var currentObj = this;
      //
      this.$swal({
        text: "Creating need",
        icon: currentObj.image_url,
        buttons: false,
      });
      //
      axios
        .post("../create-needs-gratitude", formObj)
        .then(function(response) {
          console.error(response.data["needs_gratitude"]);
          //currentObj.$store.commit('setprofilepic',response.data[1]);
          //currentObj.$store.commit('setUserIdNo',response.data['user']);
          currentObj.graces.push(response.data["needs_gratitude"]);
          currentObj.$swal({
            text: "Need gratitude successfully updated",
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
          /*for (var key in currentObj.$data) 
               		{
               			if (currentObj.$data.hasOwnProperty(key))
               			{
               				currentObj.$data[key] = '';
               			}
               		}*/
        });
    },
    donatenow() {
      var keys = ["caption", "overview_body", "school_id", "image"]; //which values from data are inputs
      var currentObj = this;
      console.error(currentObj.$data["school_id"]);
      var formObj = new FormData();
      keys.forEach(function(key) {
        if (currentObj.$data[key] != "")
          formObj.append(key, currentObj.$data[key]);
      });

      formObj.append("_token", this.$store.state.token);
      $(".modal").modal("hide");
      var currentObj = this;
     
      axios
        .post("../create-needs-overview", formObj)
        .then(function(response) {
          //currentObj.$store.commit('setprofilepic',response.data[1]);
          //currentObj.$store.commit('setUserIdNo',response.data['user']);
          currentObj.needs_overview = response.data["needs_overview"];
          currentObj.$swal({
            text: "Thank you for your donation",
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
          /*for (var key in currentObj.$data) 
               		{
               			if (currentObj.$data.hasOwnProperty(key))
               			{
               				currentObj.$data[key] = '';
               			}
               		}*/
        });
    },
  
  },
  computed: {
    //get the auth status and user
    ...mapGetters({
      authenticated: "auth/authenticated",
      auth_user: "auth/user",
      user: "user",
      needs_overview: "needs_overview",
    }),
    chunkedPosts() {
      var that = this;
      var entries = Object.entries(this.$store.state[that.$route.name]);

      for (const [_id, post] of entries) {
        if (!that.groupPosts.hasOwnProperty(_id)) {
          Object.assign(that.groupPosts, { [_id]: post });
        }
      }
      const chunksize = 3;
      const array_from_object = Object.values(this.groupPosts);
      return _.chunk(array_from_object, chunksize);
    },
  },
  mounted() {
    var urlEditEvent = "route(editEvent)";
    var urlAddComment = "route(createComment)";
    var urlAddReply = "route(createReply)";

    this.post = new Post();
    /*this.post.get(this,'/api/'+this.$route.params.slug+'/needs',1,'user_id','needs');*/
    this.post.get(
      this,
      "/api/" + this.$route.params.slug + "/needs-gratitudes",
      2,
      "user_id",
      "needs-gratitude"
    );

    this.post.get(
      this,
      "/api/" + this.$route.params.slug + "/needs-overviews",
      3,
      "user_id",
      "needs-overview"
    );

    var page = 1;
    $(document).ready(function() {
      var no_gratitude = 0;
      //Increment the no of events
      $(".gratitude").each(function() {
        ++no_gratitude;
      });
      if (no_gratitude > 0) {
        $("#hw-u-cn-help").append(
          '<span class="badge badge-pill badge-info ml-1 p-1">' +
            no_gratitude +
            "</span>"
        );
      }
      var no_needs = 0;
      //Increment the no of events
      $(".need").each(function() {
        ++no_needs;
      });
      if (no_needs > 0) {
        $("#needs-nav").append(
          '<span class="badge badge-pill badge-info ml-1 p-1">' +
            no_needs +
            "</span>"
        );
      }
    });

    $(document).on("click", ".show-photo", function(event) {
      $("#PostPicCarousel-modal").modal();
    });
  },
};
</script>
<style>
.fas1 {
  font-size: 12px !important;
}
.card-body .col {
  padding: 0;
  border-top: none !important;
  border-bottom: none !important;
  border-radius: 0;
}

blockquote {
  position: relative;
  /*= background: #ddd; =*/
  font-size: 0.68rem !important;
  font-style: italic;
  font-family: Georgia, serif;
}

blockquote:before {
  position: absolute;
  content: open-quote;
  font-size: 2em;
  margin-left: -0.3em;
  margin-top: -0.4em;
}
blockquote:after {
  position: absolute;
  content: close-quote;
  font-size: 2em;
  bottom: 0;
  right: 0;
  margin-right: -0.3em;
  margin-bottom: -0.31em;
}
blockquote p {
  display: inline;
}

.image-wrap::after {
  font-weight: 900;
  font-family: "Font Awesome\ 5 Free", "Open Sans", "Verdana", "sans-serif";
  content: "\f0d8";
  display: block;
  width: 0;
  height: 0;

  margin-left: auto;
  margin-right: auto;

  color: #ffffff;
  font-size: 2rem;
  margin-top: -0.98rem;
}

.image-wrap-b::before {
  font-weight: 900;
  font-family: "Font Awesome\ 5 Free", "Open Sans", "Verdana", "sans-serif";
  content: "\f0d7";
  display: block;
  width: 0;
  height: 0;

  margin-left: auto;
  margin-right: auto;

  color: #ffffff;
  font-size: 2rem;
  margin-top: -0.98rem;
}
#needs figure img {
  height: 8rem;
  width: 13rem;
}

.icons {
  display: none;
  position: relative;
  background-color: transparent;
  margin-top: -6rem;
  margin-left: 1.25rem;
}

.need-wrap:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  /*=border: solid 1px;
	    border-radius: 3px;=*/
}

.need-wrap:hover .icons {
  display: block;
}

</style>
