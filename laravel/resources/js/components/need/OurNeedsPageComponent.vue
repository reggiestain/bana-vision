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
        <strong>our needs</strong>

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
      <div class="card-body row text-center" style="margin: 0;padding: 0">
        <div class="card col">
          <div class="card-body counter">
            <i class="fa fa-code fa-2x"></i>
            <h2
              class="timer count-title count-number"
              data-to="100"
              data-speed="1500"
            >
              100
            </h2>
            <p class="count-text ">
              Target
            </p>
          </div>
        </div>
        <div class="card col">
          <div class="card-body counter">
            <i class="fas fa-piggy-bank fa-2x"></i>
            <h2
              class="timer count-title count-number"
              data-to="1700"
              data-speed="1500"
            >
              12,098
            </h2>
            <p class="count-text ">
              Raised
            </p>
          </div>
        </div>
        <div class="card col">
          <div class="card-body counter">
            <i class="fas fa-hand-holding-usd fa-2x"></i>
            <h2
              class="timer count-title count-number"
              data-to="11900"
              data-speed="1500"
            >
              65,534
            </h2>
            <p class="count-text ">
              Donations
            </p>
          </div>
        </div>
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
    <div
      id="carouselGratitudeControls"
      class="carousel slide"
      data-ride="carousel"
    >
      <div class="carousel-inner">
        <div v-for="(grace, index) in graces">
          <div :class="getCarouselClass(index)">
            <img
              class="d-block w-100"
              :src="getGratitudePic(grace)"
              alt="First slide"
            />
            <div class="carousel-caption d-none d-md-block">
              <h6>"{{ grace.message }}"</h6>
            </div>
          </div>
        </div>
      </div>
      <a
        class="carousel-control-prev"
        href="#carouselGratitudeControls"
        role="button"
        data-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a
        class="carousel-control-next"
        href="#carouselGratitudeControls"
        role="button"
        data-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <!-- CONTENT -->
    <div class="card mt-3">
      <nav>
        <div class="card-header nav nav-tabs p-0" id="nav-tab" role="tablist">
          <a
            class="nav-item nav-link active "
            id="1"
            data-toggle="tab"
            href="#tab-1"
            role="tab"
            aria-controls="how-you-can-help"
            aria-selected="true"
          >
            <i class="fas fas1 fa-hands-helping"> </i>
            <span id="hw-u-cn-help" class=" d-none d-md-inline">
              Help
            </span>
          </a>

          <a
            class="nav-item nav-link "
            id="2"
            data-toggle="tab"
            href="#tab-2"
            role="tab"
            aria-controls="needs"
            aria-selected="false"
          >
            <i class="fas fas1 fa-hand-holding"></i>
            <span id="needs-nav" class=" d-none d-md-inline">
              Needs
              <div v-if="needs_count > 0" style="display:inline">
                <span class="badge badge-pill badge-info ml-1 p-1">
                  {{ needs_count }}
                </span>
              </div>
            </span>
          </a>

          <a
            class="nav-item nav-link "
            id="3"
            data-toggle="tab"
            href="#tab-3"
            role="tab"
            aria-controls="programmes"
            aria-selected="false"
          >
            <i class="fas fas1 fa-hand-holding-heart "></i>
            <span class="d-none d-md-inline">Programmes</span>
          </a>

          <a
            class="nav-item nav-link border"
            id="4"
            href="#tab-4"
            data-toggle="tab"
            ria-controls="sponsor"
            aria-selected="false"
          >
            <i class="fas fas1 fa-hand-holding-usd"></i>
            <span class="d-none d-md-inline">Sponsor</span>
          </a>
        </div>
      </nav>
      <!-- wrapper -->
      <!-- <div class="card-body p-0"> -->
      <div
        class="tab-content card-body p-0"
        id="nav-tabContent"
        style="background-color: #f0f0f0;"
      >
        <!-- ===================================HOW YOU CAN HELP US PANE============================================= -->
        <div
          class="tab-pane fade show active col-12 p-0"
          id="tab-1"
          role="tabpanel"
          aria-labelledby="how-you-can-help-tab"
        >
          <div class="row m-0 p-0" id="tab-1-data">
            <!-- how you can help article -->
            <div class="col-12 p-0 border-right pt-2 bg-white">
              <!--pleaase change this later-->
              <div v-if="needs_overview && needs_overview != null">
                <div class="container">
                  <article class="single-post  no-gutters">
                    <div class="col-12">
                      <div
                        v-if="
                          auth.auth_owner_of_post(auth_user, user) &&
                            authenticated
                        "
                      >
                        <!--if owner of this post-->
                        <button
                          type="button"
                          class="btn btn-primary btn-sm"
                          id="add-overview"
                        >
                          <i class="fas fa-plus"></i>
                          overview
                        </button>
                      </div>
                      <!--end auth-->
                      <h5 style="color: #000000">
                        What your donation can do for us
                      </h5>
                      <figure class="figure image-wrapper float-left pr-3">
                        <img
                          :src="getGratitudePic(needs_overview)"
                          alt=""
                          style="width: 100%"
                        />
                        <!--Need overview caption-->
                        <figcaption class="figure-caption">
                          {{ needs_overview.caption }}
                        </figcaption>
                      </figure>

                      <!--need overview body-->
                      <div class="single-post-content-wrapper p-1">
                        {{ needs_overview.body }}
                      </div>
                    </div>
                  </article>
                  <button
                    type="button"
                    class="btn btn-primary btn-sm btn-block"
                  >
                    <i class="fas fa-donate"></i>
                    Donate
                  </button>
                </div>
              </div>
              <!--end overview-->
              <div v-else>
                <div
                  v-if="
                    auth.auth_owner_of_post(auth_user, user) && authenticated
                  "
                >
                  <!--if owner of this post-->
                  <button
                    type="button"
                    class="btn btn-primary btn-sm"
                    id="add-overview"
                  >
                    <i class="fas fa-plus"></i>
                    overview
                  </button>
                </div>
                <!--end auth-->
              </div>
            </div>
          </div>
        </div>
        <!-- end tab pane -->
        <!-- ===================================NEEDS PANE============================================= -->
        <div
          class="tab-pane fade  m-0 p-1 bg-white"
          id="tab-2"
          role="tabpanel"
          aria-labelledby="needs-tab"
        >
          <!--Needs get added here-->
          <div class="col-12 p-1" id="tab-2-data">
            <image-post
              :key="3"
              :key_="3"
              tab_number="3"
              url="needs"
              returnVal="needs"
              :options="needs_options"
            ></image-post>
          </div>
        </div>
        <!--END NEEDS PANE  -->
        <!-- ===================================PROGRAMMES PANE============================================= -->
        <div
          class="tab-pane fade"
          id="ptab-3"
          role="tabpanel"
          aria-labelledby="programmes-tab"
        >
          <div id="tab-3-data"></div>
        </div>
        <!-- END NEEDS PANE -->
        <!-- ==================================SPONSORS PANE============================================= -->
        <div
          class="tab-pane fade"
          id="tab-4"
          role="tabpanel"
          aria-labelledby="sponsor-tab"
        >
          <div id="tab-4-data"></div>
        </div>
        <!-- END SPONSORS PANE -->
      </div>
      <!-- end tab-content -->
      <!-- </div> --><!-- end wrapper -->
    </div>
    <!-- end content -->

    <!--===========================================NEEDS OVERVIEW===========================================-->
    <div class="modal" tabindex="-1" role="dialog" id="needs-overview-modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              Modal title
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">
                &times;
              </span>
            </button>
          </div>
          <!--===========================================NEEDS OVERVIEW FORM===========================================-->
          <form
            @submit.prevent="createNeedsOverview"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="form-group row">
                <label for="caption" class="col-sm-2 col-form-label">
                  Caption
                </label>
                <div class="col-sm-10 $errors->has('body') ? 'has-error':''">
                  <input
                    type="text"
                    class="form-control form-control-sm"
                    v-model="caption"
                    id="caption"
                    placeholder="Tell the audience how their donation can help you"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="body" class="col-sm-2 col-form-label">
                  Body
                </label>
                <div class="col-sm-10 $errors->has('body') ? 'has-error':''">
                  <textarea
                    class="form-control form-control-sm"
                    v-model="overview_body"
                    id="overview_body"
                    placeholder="Tell the audience how their donation can help you"
                  ></textarea>
                </div>
              </div>

              <input
                type="file"
                class="form-control form-control-sm"
                v-on:change="imguploaded"
                name="needs-overview-image"
                placeholder="select image for the gratitude"
              />
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm">
                Save changes
              </button>
              <button
                type="button"
                class="btn btn-secondary btn-sm"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </form>
          <!--END NEEDS OVERVIEW FORM-->
        </div>
      </div>
    </div>
    <!--===========================================NEEDS GRATITUDE===========================================-->
    <div class="modal" tabindex="-1" role="dialog" id="needs-gratitude-modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              Modal title
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">
                &times;
              </span>
            </button>
          </div>
          <!--===========================================NEEDS GRATITUDE FORM===========================================-->
          <form
            @submit.prevent="createNeedsGratitude"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="form-group row">
                <label for="message" class="col-sm-2 col-form-label">
                  Message
                </label>
                <div class="col-sm-10 $errors->has('message') ? 'has-error':''">
                  <textarea
                    class="form-control form-control-sm"
                    v-model="message"
                    id="message"
                    placeholder="Type the gratitutde message you would like displayed"
                  ></textarea>
                </div>
              </div>

              <input
                type="file"
                class="form-control form-control-sm"
                v-on:change="imguploaded"
                name="needs-gratitude-image"
                placeholder="select image for the gratitude"
              />
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-sm">
                Save changes
              </button>
              <button
                type="button"
                class="btn btn-secondary btn-sm"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </form>
          <!--END NEEDS GRATITUDE FORM-->
        </div>
      </div>
    </div>
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
    createNeedsOverview() {
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
      //
      this.$swal({
        text: "Creating need",
        icon: currentObj.image_url,
        buttons: false,
      });
      //
      axios
        .post("../create-needs-overview", formObj)
        .then(function(response) {
          //currentObj.$store.commit('setprofilepic',response.data[1]);
          //currentObj.$store.commit('setUserIdNo',response.data['user']);
          currentObj.needs_overview = response.data["needs_overview"];
          currentObj.$swal({
            text: "Need overview successfully updated",
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
    imguploaded(e) {
      this.image = event.target.files[0];
    },
    showDetails(need, keya) {
      $("#collapseNeedBody" + keya).html(
        "<h6><strong>" +
          need.title +
          "</strong></h6>" +
          '<dl class="row"><dt class="col-sm-4">Description :</dt><dd class="col-sm-8">' +
          need.description +
          "</dd>" +
          '<dt class="col-sm-4">Quantity :</dt><dd class="col-sm-8">' +
          need.quantity +
          "</dd>" +
          '<dt class="col-sm-4">Due date :</dt><dd class="col-sm-8">' +
          need.due_date +
          "</dd>" +
          '<dt class="col-sm-4">Urgency :</dt><dd class="col-sm-8">' +
          need.urgency +
          "</dd></dl><hr>"
      );
      this.delete_id = need.id;
    },
    morePosts(slug, post_type) {
      posts_helper.morePosts(slug, post_type);
    },

    deletePost(post_id, user_slug, delete_route) {
      posts_helper.deletePost(this, post_id, user_slug, delete_route);
      $(".collapse").collapse("hide");
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
