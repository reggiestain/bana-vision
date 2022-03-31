<template>
  <b-navbar
    id="template-header"
    class="navbar default-layout-navbar col-lg-12 col-12 p-0  d-flex flex-row"
    toggleable="lg"
  >
    <div
      class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center"
    >
      <router-link
        class="navbar-brand brand-logo"
        to="https://zlto.datafree.co.za/en/login/?next=/en/"
      >
        <img
          src="https://zltoexchange-s3-amazonaws-com-zlto.datafree.co.za:443/static/base/imgs/zlto_v2_black_logo.png"
          alt="logo"
          style="
    height: 60px;
    width :60px;"
        />
      </router-link>
      <router-link
        class="navbar-brand brand-logo-mini"
        to="https://zlto.datafree.co.za/en/login/?next=/en/"
      >
        <img
          src="https://zltoexchange-s3-amazonaws-com-zlto.datafree.co.za:443/static/base/imgs/zlto_v2_black_logo.png"
          alt="logo"
          style="
    height: 30px;
    width :30px;"
        />
      </router-link>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center ml-auto ml-lg-0">
      <button
        class="navbar-toggler navbar-toggler align-self-center d-lg-block"
        type="button"
        @click="toggleSidebar()"
      >
        <span class="mdi mdi-menu"></span>
      </button>
      <div class="search-field search-neumorphism d-none d-md-block">
        <form action="#">
          <div class="d-flex align-items-center input-group">
            <div class="input-group-prepend bg-transparent">
              <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input
              type="text"
              class="form-control bg-transparent border-0"
              placeholder="Search...."
            />
          </div>
        </form>
      </div>
      <b-navbar-nav class="navbar-nav-right ml-auto">
        <b-nav-item-dropdown right class="nav-profile">
          <template slot="button-content">
            <span
              class="nav-link dropdown-toggle"
              id="profileDropdown"
              href="javascript:void(0);"
              data-toggle="dropdown"
              aria-expanded="false"
            >
              <div class="nav-profile-img">
                <img
                  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU"
                  alt="image"
                />
                <span class="availability-status online"></span>
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black">Ntokozo Mthokozi</p>
              </div>
            </span>
          </template>
          <b-dropdown-item class="preview-item">
            <router-link
              class="nav-link"
              :to="{ name: 'zlto_Editprofile', params: { slug: url_slug } }"
            >
              <i class="mdi mdi-cached mr-2 text-success"></i> Edit
              Profile</router-link
            >
          </b-dropdown-item>
          <b-dropdown-item class="preview-item">
            <i class="mdi mdi-logout mr-2 text-primary"></i> Return
          </b-dropdown-item>
        </b-nav-item-dropdown>
        <b-nav-item-dropdown right class="preview-list">
          <template slot="button-content">
            <div class="nav-link count-indicator dropdown-toggle">
              <i class="mdi mdi-email-outline"></i>
              <span class="count-symbol bg-warning"></span>
            </div>
          </template>
          <h6 class="p-3 mb-0">Messages</h6>
          <b-dropdown-item class="preview-item">
            <div class="preview-thumbnail">
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU"
                alt="image"
                class="profile-pic"
              />
            </div>
            <div
              class="preview-item-content d-flex align-items-start flex-column justify-content-center"
            >
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">
                David Mathews
              </h6>
              <p class="text-gray mb-0">15 Minutes ago</p>
            </div>
          </b-dropdown-item>
          <b-dropdown-item class="preview-item">
            <div class="preview-thumbnail">
              <img
                src="https://zltoexchange-s3-amazonaws-com-zlto.datafree.co.za:443/static/base/imgs/zlto_v2_black_logo.png"
                alt="image"
                class="profile-pic"
              />
            </div>
            <div
              class="preview-item-content d-flex align-items-start flex-column justify-content-center"
            >
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">
                Zlto Updates
              </h6>
              <p class="text-gray mb-0">18 Minutes ago</p>
            </div>
          </b-dropdown-item>
          <b-dropdown-item class="preview-item">
            <div class="preview-thumbnail">
              <img
                src="https://zltoexchange-s3-amazonaws-com-zlto.datafree.co.za:443/static/base/imgs/zlto_v2_black_logo.png"
                alt="image"
                class="profile-pic"
              />
            </div>
            <div
              class="preview-item-content d-flex align-items-start flex-column justify-content-center"
            >
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">
                Zlto Task
              </h6>
              <p class="text-gray mb-0">1 Minutes ago</p>
            </div>
          </b-dropdown-item>
          <h6 class="p-3 mb-0 text-center border-top">3 new messages</h6>
        </b-nav-item-dropdown>
        <b-nav-item-dropdown right class="preview-list">
          <template slot="button-content">
            <div class="nav-link count-indicator dropdown-toggle">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count-symbol bg-danger"></span>
            </div>
          </template>
          <h6 class="p-3 mb-0">Notifications</h6>
          <b-dropdown-item class="preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="mdi mdi-calendar"></i>
              </div>
            </div>
            <div
              class="preview-item-content d-flex align-items-start flex-column justify-content-center"
            >
              <h6 class="preview-subject font-weight-normal mb-1">
                Task Completed
              </h6>
              <p class="text-gray ellipsis mb-0">
                Book Review
              </p>
            </div>
          </b-dropdown-item>
          <b-dropdown-item class="preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="mdi mdi-settings"></i>
              </div>
            </div>
            <div
              class="preview-item-content d-flex align-items-start flex-column justify-content-center"
            >
              <h6 class="preview-subject font-weight-normal mb-1">
                Profile Update
              </h6>
              <p class="text-gray ellipsis mb-0">
                Profile Updated
              </p>
            </div>
          </b-dropdown-item>
          <b-dropdown-item class="preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="mdi mdi-link-variant"></i>
              </div>
            </div>
            <div
              class="preview-item-content d-flex align-items-start flex-column justify-content-center"
            >
              <h6 class="preview-subject font-weight-normal mb-1">
                New Tasks
              </h6>
              <p class="text-gray ellipsis mb-0">
                New tasks have been added!
              </p>
            </div>
          </b-dropdown-item>
          <h6 class="p-3 mb-0 text-center border-top">3 Notifications</h6>
        </b-nav-item-dropdown>
        <b-nav-item class="nav-logout d-none d-lg-block">
          <i class="mdi mdi-power"></i>
        </b-nav-item>
      </b-navbar-nav>
      <button
        class="navbar-toggler navbar-toggler-right align-self-center"
        type="button"
        @click="toggleMobileSidebar()"
      >
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </b-navbar>
</template>

<script>
export default {
  name: "app-header",
  methods: {
    toggleSidebar: () => {
      document.querySelector("body").classList.toggle("sidebar-icon-only");
    },
    toggleMobileSidebar: () => {
      document.querySelector("#sidebar").classList.toggle("active");
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../../../node_modules/@mdi/font/css/materialdesignicons.min.css";
@import "../../../../node_modules/flag-icon-css/css/flag-icon.min.css";
@import "../../../../node_modules/font-awesome/css/font-awesome.min.css";
@import "../../../../node_modules/simple-line-icons/css/simple-line-icons.css";
@import "../../../../node_modules/ti-icons/css/themify-icons.css";
@import "../../../../node_modules/sweetalert2/dist/sweetalert2.min.css";
@import "../../../../node_modules/vue-snotify/styles/material.css";
@import "../../../../node_modules/codemirror/lib/codemirror.css";
//@import "../../../../node_modules/fullcalendar/dist/fullcalendar.css";
@import "../../../../node_modules/c3/c3.min.css";
@import "../../../../node_modules/chartist/dist/chartist.min.css";

@import "../../../assets/scss/style.scss";
//@import "../../../assets/css/zltodash.css";
.search-neumorphism {
  border-radius: 5px !important;
  border: none !important;
  background: #ffffff;
  box-shadow: 1px 1px 2px #d9d9d9, -1px -1px 2px #ffffff;
}
</style>
