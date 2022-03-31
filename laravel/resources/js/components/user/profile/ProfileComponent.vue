<template
  ><!--cover profile-->
  <div class="mt-5 container">
    <div class="card top-curve jumbotron-spacer" id="cover-profile">
      <!--=========================FORM FOR CHANGING IMAGE==============================-->
      <form
        @submit.prevent="setImage"
        method="post"
        enctype="multipart/form-data"
      >
        <input
          type="file"
          id="imgupload"
          v-on:change="imguploaded"
          name="image"
          style="display:none"
          accept=".jpg,.jpeg,.png,gif."
        />
        <input
          id="picture_type"
          type="hidden"
          name="picture_type"
          value="cover"
        />
        <button
          type="submit"
          id="submit-cover"
          class="btn btn-primary btn-xs"
          style="display:none"
        >
          Submit
        </button>
        <input type="hidden" name="_token" value="Session::token()" />
      </form>

      <a v-if="auth.auth_owner_of_post(auth_user, user)">
        <span>
          <i
            data-picture-type="cover"
            @click="OpenImgUpload('cover')"
            class=" fa fa-camera fa-2x change-image OpenImgUpload coverprofile_pos"
            aria-hidden="true"
          ></i>
        </span>
      </a>

      <!-- ====================COVER  AREA====================-->
      <div class="card-body bod" style="">
        <!-- Tab panes -->
        <div class="tab-content">
          <div id="cover">
            <!--=====================COVER PICTURE========================== :data-src="getCoverPic" -->
            <img
              class="show-fullscreen"
              :src="getCoverPic"
              @error="
                $event.target.scr =
                  'https://github.com/NtsikeleloBana/imagesbox/blob/main/default_profile_cover.jpeg?raw=true'
              "
              width="100%"
              alt="Schools brand picture"
              style="height:315px;width:100%;padding:0;"
            />
          </div>

          <!--======================PROFILE PICTURE============================-->
          <span id="profilepic" :data-username="username">
            <a v-if="auth.auth_owner_of_post(auth_user, user)">
              <i
                data-picture-type="profile"
                @click="OpenImgUpload('profile')"
                class="edit-profilepic-btn fa fa-camera fa-1x change-image OpenImgUpload"
                aria-hidden="true"
              ></i>
            </a>

            <img
              :src="getProfilePic"
              @error="
                $event.target.scr =
                  'https://github.com/NtsikeleloBana/imagesbox/blob/main/default_profile_pic.jpeg?raw=true'
              "
              class="show-fullscreen bg-white profile-ppic"
            />
          </span>
          <!-- UNDECIDED BUTTONS -->
          <!--  <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="position: absolute;left: 40rem;bottom: 2.25rem;">
  <button type="button" class="btn btn-secondary">1</button>
  <button type="button" class="btn btn-secondary">2</button>

  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="#">Dropdown link</a>
      <a class="dropdown-item" href="#">Dropdown link</a>
    </div>
  </div>
</div> -->
          <!--END UNDECIDED BUTTONS-->

          <div class="card col-6 col-md-2 p-0 m-0 " id="sponsored-card">
            <img
              class="card-img-top"
              :src="'../assets/img/Telkom.png'"
              alt="Card image cap"
            />
            <div class="card-body border-top row p-0 m-0 pt-2 pb-2">
              <div class="col-7 pl-2 spon-tab">
                <span class="sponsor">
                  Sponsored by : Telkom
                </span>
              </div>
              <div class="col-3 spon-link-btn">
                <a
                  href="http://investec.com"
                  target="_blank"
                  class="btn btn-light btn btn-outline-dark btn-sm"
                  ><i class="n-icons fas fa-external-link-square-alt"></i>
                  <span class="ml-1">
                    visit
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END COVER AREA -->
    </div>
    <!--end cover profile-->
    <div class="container bg-white box bottom-curve">
      <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
      />
      <!-- ==================================== NAVIGATION TABS ==================================== -->
      <ul class="nav nav-tabs  " id="tab-menu" role="tablist">
        <!--==================OVERVIEW TAB==================-->
        <li
          role="presentation"
          class=" nav-item active border-right profile-nav"
        >
          <a
            class=" d-flex nav-link  active d-flex"
            href="#overview"
            aria-controls="home"
            role="tab"
            data-toggle="tab"
          >
            <i class="bx bx-user-circle mr-2"></i>
            <span class="d-none d-md-flex">Overview</span>
          </a>
        </li>

        <!--==================DETAILS TAB==================-->
        <li role="presentation" class="nav-item  border-right">
          <a
            class=" d-flex nav-link "
            href="#details"
            aria-controls="details"
            role="tab"
            data-toggle="tab"
          >
            <i class="bx bx-collection mr-2"></i>
            <span class="d-none d-md-flex">Details</span>
          </a>
        </li>
        <!--==================GALLERY TAB==================-->
        <li role="presentation" class="nav-item  border-right">
          <a
            class=" d-flex nav-link "
            href="#gallery"
            aria-controls="gallery"
            role="tab"
            data-toggle="tab"
          >
            <i class="bx bx-movie-play mr-2"></i>
            <span class="d-none d-md-flex">Gallery</span>
          </a>
        </li>

        <!--if school-->
        <!--==================ACTIVITIES TAB==================-->
        <li v-if="school" role="presentation" class="nav-item  border-right">
          <a
            class=" d-flex nav-link "
            href="#activities"
            aria-controls="activities"
            role="tab"
            data-toggle="tab"
          >
            <i class="bx bx-swim mr-2"></i>
            <span class="d-none d-md-flex">Activities</span>
          </a>
        </li>
        <!--==================FACILITITES TAB==================-->
        <div v-if="school">
          <li role="presentation" class="nav-item  border-right">
            <a
              class=" d-flex nav-link "
              href="#facilities"
              aria-controls="facilities"
              role="tab"
              data-toggle="tab"
            >
              <i class="bx bx-filter mr-2"></i>
              <span class="d-none d-md-flex">Facilities</span>
            </a>
          </li>
        </div>
        <!--end if school-->

        <!--==================USER SETTINGS TAB==================-->
        <div
          v-if="auth.auth_owner_of_post(auth_user, user) && authenticated"
          class="border-right"
        >
          <li role="presentation" class="nav-item">
            <a
              class=" d-flex nav-link "
              href="#settings"
              aria-controls="settings"
              role="tab"
              data-toggle="tab"
            >
              <i class="bx bx-cog mr-2"></i>
              <span class="d-none d-md-flex">Settings</span>
            </a>
          </li>
        </div>
        <!--end if auth owner of post-->

        <!--==================USER SPONSORED TAB==================-->
        <div v-if="school">
          <li role="presentation" class="nav-item">
            <a
              class=" d-flex nav-link "
              href="#sponsored-users"
              aria-controls="settings"
              role="tab"
              data-toggle="tab"
            >
              <i class="bx bx-store mr-2"></i>
              <span class="d-none d-md-flex">Sponsored</span>
            </a>
          </li>
        </div>
        <!--end if auth owner of post-->

        <!--==================TEACHERS TABS==================-->
        <div
          v-if="
            auth.auth_owner_of_post(auth_user, user) &&
              auth.user_is_of_type(auth_user.usable_type, [
                'staff_member',
                'teacher',
              ])
          "
        >
          <li role="presentation" class="nav-item">
            <a
              class=" d-flex nav-link "
              href="#attendance"
              aria-controls="attendance"
              role="tab"
              data-toggle="tab"
            >
              <i class="n-icons fa fa-cog fa-nav-tab"></i>
              <span class="d-none d-md-flex">Attendance</span>
            </a>
          </li>
        </div>
        <!--end if auth owner of post and staff member or teacher-->

        <div
          v-if="
            auth.auth_owner_of_post(auth_user, user) &&
              auth.user_is_of_type(auth_user.usable_type, ['student'])
          "
        >
          <li role="presentation" class="nav-item">
            <a
              class=" d-flex nav-link "
              href="#timetable"
              aria-controls="attendance"
              role="tab"
              data-toggle="tab"
            >
              <i class="n-icons fa fa-cog fa-nav-tab"></i>
              <span class="d-none d-md-flex">Timetable</span>
            </a>
          </li>
        </div>
        <!--end if auth student-->
      </ul>
    </div>
    <!--END NAVIGATION TABS-->
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { Post } from "../../../Post.ts";
import { Auth } from "../../../Auth.ts";
export default {
  props: ["useridno", "auth_id", "username"],
  data: function() {
    return {
      picture_type: "",
      image: "",
      //'user':null,
      errors_array: [],
      auth: new Auth(),
    };
  },
  methods: {
    setImage(e) {
      var formObj = new FormData();
      var currentObj = this;
      this.$swal({
        text: "Setting profile photo",
        icon: currentObj.image_url,
        buttons: false,
      });
      formObj.append("picture_type", this.picture_type);
      formObj.append("_token", this.$store.state.token);
      formObj.append("image", this.image);
      //submit posts using axios
      axios
        .post("../setImage", formObj)
        .then(function(response) {
          //console.error(response.data[1]);
          //update vuex store with new post

          console.log(response.data.post);

          console.log(currentObj.picture_type);
          if (currentObj.picture_type == "cover") {
            currentObj.$store.commit("increment", [response.data.post]);
            //cause picture to refresh
            currentObj.$store.commit("setcoverpic", response.data.img);
          } else {
            currentObj.$store.commit("increment1", [response.data.post]);
            //cause picture to refresh
            currentObj.$store.commit("setprofilepic", response.data.img);
          }
          //Displax success modal
          currentObj.$swal({
            text: "post added",
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
        });
    },
    OpenImgUpload(picture_type) {
      this.picture_type = picture_type;
      $("#imgupload").trigger("click");
    },
    imguploaded(e) {
      this.image = event.target.files[0];
      $("#submit-cover").trigger("click");
      $("#submit-cover").trigger("touchstart");
    },
  },
  computed: {
    //get the auth status and user
    ...mapGetters({
      authenticated: "auth/authenticated",
      auth_user: "auth/user",
      user: "user",
    }),
    getCoverPic: function() {
      //return '../cover-picture/'+this.useridno;

      return this.$store.state.coverpic
        ? this.$store.state.coverpic
        : "https://github.com/NtsikeleloBana/imagesbox/blob/main/default_profile_cover.jpeg?raw=true";
    },
    getProfilePic: function() {
      return this.$store.state.profilepic
        ? this.$store.state.profilepic
        : "https://github.com/NtsikeleloBana/imagesbox/blob/main/default_profile_pic.jpeg?raw=true";
    },
    auth_owner_of_post: function() {
      return true;
    },
    school: function() {
      return true;
    },
  },
  mounted() {
    //initialise the profile and cover photos on vuex store
    this.post = new Post();
    this.post.get(
      this,
      "/api/" + this.$route.params.slug,
      1,
      "user_id",
      "user"
    );
    this.$store.commit("setcoverpic", "../cover-picture/" + this.useridno);
    this.$store.commit("setprofilepic", "../profile-picture/" + this.useridno);
  },
};
</script>
<style scoped>
.spon-tab {
  text-align: center;
  align-items: center;
  display: flex;
}
.spon-link-btn {
  padding-left: 0px;
}
.sponsor {
  font-size: 0.6rem;
  color: #888 !important;
  font-weight: 500;
}
.n-icons {
  margin-right: 5px;
  color: #478ac9;
  margin-top: 2px;
}
.box {
  border-radius: 10px;
}
.bod {
  padding: 0;
  min-height: 300px;
  max-height: 400px;
  overflow: hidden;
}
@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
  .profile-ppic {
    width: 8rem;
    border: 1px solid transparent;
    height: 8rem;
    position: absolute;
    bottom: 1rem !important;
    left: 2rem;
    /* padding: 0.35rem; */
    border-radius: 50%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
  .coverprofile_pos {
    position: absolute;
    left: 1rem;
    bottom: 1rem;
  }
  .edit-profilepic-btn {
    margin: 12px;
    color: rgb(195, 195, 195);
    opacity: 0.57;
    position: absolute;
    z-index: 3;
    bottom: -4.4rem;
    left: 4rem;
  }
}
@media only screen and (min-width: 1224px) {
  .edit-profilepic-btn {
    margin: 12px;
    color: rgb(195, 195, 195);
    opacity: 0.57;
    position: absolute;
    z-index: 3;
    bottom: -4.4rem;
    left: 4rem;
  }
  .coverprofile_pos {
    position: absolute;
    left: 11rem;
    bottom: 1rem;
  }
  .profile-ppic {
    width: 8rem;
    border: 1px solid transparent;
    height: 8rem;
    position: absolute;
    bottom: -5rem;
    border-radius: 50%;
    left: 2rem;
    /* padding: 0.35rem; */
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
}
</style>
