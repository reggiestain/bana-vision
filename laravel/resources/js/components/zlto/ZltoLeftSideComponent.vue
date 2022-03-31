<template>
  <section class="app-sidebar">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item nav-profile">
          <a href="javascript:void(0);" class="nav-link">
            <div class="nav-profile-image">
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU"
                alt="profile"
              />
              <span class="login-status online"></span>
            </div>
            <div class="nav-profile-text d-flex flex-column">
              <span class="font-weight-bold mb-2">Ntokozo Mthokozi</span>
              <span class="text-secondary text-small">Student</span>
            </div>
            <i
              class="mdi mdi-bookmark-check text-success nav-profile-badge"
            ></i>
          </a>
        </li>
        <li class="nav-item" v-on:click="collapseAll">
          <router-link
            class="nav-link"
            :to="{ name: 'profile', params: { slug: url_slug } }"
          >
            <span class="menu-title"> return to Bana</span>
            <i class="mdi mdi-home menu-icon"></i>
          </router-link>
        </li>
        <li class="nav-item">
          <span class="nav-link" v-b-toggle="'earn-dropdown'">
            <span class="menu-title">Earn</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
          </span>
          <b-collapse accordion="sidebar-accordion" id="earn-dropdown">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  :to="{ name: 'zlto_earn', params: { slug: url_slug } }"
                  >Tasks</router-link
                >
              </li>
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  :to="{ name: 'zlto_earn', params: { slug: url_slug } }"
                  >Continue..</router-link
                >
              </li>
            </ul>
          </b-collapse>
        </li>
        <li class="nav-item">
          <span class="nav-link" v-b-toggle="'spend-dropdown'">
            <span class="menu-title">Spend</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-chart-bar menu-icon"></i>
          </span>
          <b-collapse accordion="sidebar-accordion" id="spend-dropdown">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  :to="{ name: 'zlto_spend', params: { slug: url_slug } }"
                  >Store</router-link
                >
              </li>
            </ul>
          </b-collapse>
        </li>
        <li class="nav-item">
          <span class="nav-link" v-b-toggle="'learning-dropdown'">
            <span class="menu-title">Learning</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-table-large menu-icon"></i>
          </span>
          <b-collapse accordion="sidebar-accordion" id="learning-dropdown">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  :to="{ name: 'zlto_learning', params: { slug: url_slug } }"
                  >Learning</router-link
                >
              </li>
            </ul>
          </b-collapse>
        </li>
        <li class="nav-item">
          <span class="nav-link" v-b-toggle="'message-dropdown'">
            <span class="menu-title">Messages</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-lock menu-icon"></i>
          </span>
          <b-collapse accordion="sidebar-accordion" id="message-dropdown">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <router-link class="nav-link" :to="inbox">Inbox</router-link>
              </li>
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  :to="{
                    name: 'zlto_notifications',
                    params: { slug: url_slug },
                  }"
                >
                  Notifications</router-link
                >
              </li>
            </ul>
          </b-collapse>
        </li>
        <li class="nav-item">
          <span class="nav-link" v-b-toggle="'task-dropdown'">
            <span class="menu-title">Tasks</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-security menu-icon"></i>
          </span>
          <b-collapse accordion="sidebar-accordion" id="task-dropdown">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <router-link
                  class="nav-link"
                  :to="{ name: 'zlto_catagories', params: { slug: url_slug } }"
                  >Catagories</router-link
                >
              </li>
            </ul>
          </b-collapse>
        </li>
      </ul>
    </nav>
  </section>
</template>

<script>
// import { zltoPageComponet} from ' ZltoPageComponet.vue';

export default {
  name: "zltoLeftbar",
  data: () => {
    return {
      id: "",
    };
  },
  computed: {
    /* get the route slugs */
    url_slug() {
      return this.$route.params.slug;
    },
  },
  mounted: {
    function(event) {
      const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
          nav = document.getElementById(navId),
          bodypd = document.getElementById(bodyId),
          headerpd = document.getElementById(headerId);

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
          toggle.addEventListener("click", () => {
            // show navbar
            nav.classList.toggle("show");
            // change icon
            toggle.classList.toggle("bx-x");
            // add padding to body
            bodypd.classList.toggle("zltoleft");
            // add padding to header
            headerpd.classList.toggle("zltoleft");
          });
        }
      };

      showNavbar("header-toggle", "nav-bar", "zltoleft", "header");

      const linkColor = document.querySelectorAll(".nav_link");

      function colorLink() {
        if (linkColor) {
          linkColor.forEach((l) => l.classList.remove("active"));
          this.classList.add("active");
        }
      }
      linkColor.forEach((l) => l.addEventListener("click", colorLink));
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

:root {
  --body-font: "Nunito", sans-serif;
  --normal-font-size: 1rem;
  --z-fixed: 100;
}

.header {
  width: 100%;
  height: 3rem;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1rem;
  background-color: #f7f6fb;
  z-index: 100;
  transition: 0.5s;
}

.header_toggle {
  color: #478ac9;
  font-size: 1.5rem;
  cursor: pointer;
}

.header_img {
  width: 35px;
  height: 35px;
  display: flex;
  justify-content: center;
  border-radius: 50%;
  overflow: hidden;
}

.header_img img {
  width: 40px;
}

.l-navbar {
  position: fixed;
  top: 0;
  box-shadow: 2px 22px 22px 2px rgba;
  left: -30%;
  width: 220px;
  height: 100vh;
  box-shadow: 2px 22px 22px 2px rgba(0, 0, 0, 0.1);
  /* background-color: #478ac9; */
  padding: 0.5rem 1rem 0 0;
  transition: 0.5s;
  z-index: 100;
  margin-top: 100px;
}

.nav {
  height: 70%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow: hidden;
}

.nav_logo,
.nav_link {
  display: grid;
  grid-template-columns: max-content max-content;
  align-items: center;
  column-gap: 1rem;
  padding: 0.5rem 0 0.5rem 1.5rem;
}

.nav_logo {
  margin-bottom: 2rem;
}

.nav_logo-icon {
  font-size: 1.25rem;
  color: #f7f6fb !important;
}

.nav_logo-name {
  color: #f7f6fb !important;
  font-size: 40px;
  font-weight: 700;
}

.nav_link {
  position: relative;
  color: #afa5d9;
  margin-bottom: 1.5rem;
  transition: 0.3s;
}

.nav_link:hover {
  color: #f7f6fb !important;
}

.nav_icon {
  font-size: 1.25rem;
}

.show {
  left: 0;
}

.zltoleft {
  padding-left: calc(68px + 1rem);
}

.active {
  color: #f7f6fb;
}

.active::before {
  content: "";
  position: absolute;
  left: 0;
  width: 2px;
  height: 32px;
  background-color: #f7f6fb;
}

.height-100 {
  height: 100vh;
}

@media screen and (min-width: 768px) {
  body {
    margin: calc(3rem + 1rem) 0 0 0;
    padding-left: calc(68px + 2rem);
  }

  .header {
    height: calc(3rem + 1rem);
    padding: 0 2rem 0 calc(68px + 2rem);
  }

  .header_img {
    width: 40px;
    height: 40px;
  }

  .header_img img {
    width: 45px;
  }

  .l-navbar {
    left: 0;
    padding: 1rem 1rem 0 0;
  }

  .show {
    width: calc(68px + 156px);
  }

  .zltoleft {
    padding-left: calc(68px + 188px);
  }
}
</style>
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

.nav {
  margin-top: 0px !important;
}
</style>
