<template>
  <!--
=
=
=  LEFT SIDEBAR
=
=
=
=
-->
  <div class="col-12 row m-0 pl-0 pr-0" id="navigation-sidebar">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />
    <header class="head">
      <div class="head-container">
        <img
          src="/assets/img/bana1.png"
          alt=""
          class="head-img"
          width="10"
          height="10"
        />

        <a href="#" class="head-logo">Bana</a>

        <div class="head-search">
          <input type="search" placeholder="Search" class="head-input" />
          <i class="bx bx-search head-icon"></i>
        </div>
      </div>
    </header>

    <div class="nav" id="navbar">
      <nav class="nav-container">
        <div>
          <div class="nav-list">
            <div class="nav-items">
              <h3 class="nav-subtitle">Profile</h3>

              <router-link :to="{ name: 'feed', params: { slug: url_slug } }" href="#" class="nav-link active">
                <i class="bx bx-home nav-icon"></i>
                <span class="nav-name">Home</span>
              </router-link>

              <router-link :to="{ name: 'profile', params: { slug: url_slug } }" class="nav-link">
                <i class="bx bx-user nav-icon"></i>
                <span class="nav-name">Profile</span>
                <i class="bx bx-chevron-down nav-icon nav-dropdown-icon"></i>
              </router-link>

              <router-link :to="{ name: 'messages', params: { slug: url_slug } }" class="nav-link">
                <i class="bx bx-message-rounded nav-icon"></i>
                <span class="nav-name">Messages</span>
              </router-link>
            </div>

            <div class="nav-items">
              <h3 class="nav-subtitle">Menu</h3>

              <a href="#" class="nav-link">
                <i class="bx bx-bell nav-icon"></i>
                <span class="nav-name">Notifications</span>
                <i class="bx bx-chevron-down nav-icon nav-dropdown-icon"></i>
              </a>

              <a href="#" class="nav-link">
                <i class="bx bx-compass nav-icon"></i>
                <span class="nav-name">Explore</span>
              </a>
              <a href="#" class="nav-link">
                <i class="bx bx-bookmark nav-icon"></i>
                <span class="nav-name">Saved</span>
              </a>
              
              <router-link :to="{ name: 'donate', params: { slug: url_slug } }" class="nav-link">
                <i class='bx bx-money-withdraw nav-icon'></i>
                <span class="nav-name">Donate</span>
              </router-link>
            </div>
          </div>
        </div>

        <a href="#" class="nav-link nav-logout">
          <i class="bx bx-log-out nav-icon"></i>
          <span class="nav-name">Log Out</span>
        </a>
      </nav>
    </div>

    <!-- ================================== SPONSORED ADDS ==================================  -->
    <!-- <div class="card col p-1 d-none" style="max-height: 21rem" >
    <div class="card-body p-1" style="text-align: center;">    
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <span class="text-muted d-flex mr-auto">
            Sponsored
          </span>
          <div class="carousel-item active">
            <img class="d-block w-100 figure-img" src='/assets/img/add_1.jpg' alt="First slide" style="width:12rem;height:12rem">
            <div class="btn-group mt-1" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Left
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Middle
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem" >
                Right
              </button>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 figure-img" src='/assets/img/add_2.jpg' alt="Second slide" style="width:12rem;height:12rem">
            <div class="btn-group mt-1" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Left
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Middle
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem" >
                Right
              </button>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100 figure-img" src='/assets/img/add_3.jpg' alt="Third slide" style="width:12rem;height:12rem">
            <div class="btn-group mt-1" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Left
              </button>
              <button type="button" class="btn btn-secondary btn-sm" style="font-size:0.6rem">
                Middle
              </button>
              <button type="button" class="btn btn-secondary btn-sm"  style="font-size:0.6rem">
                Right
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>

    </div>  -->

    <!-- ================================== LEFT SIDEBAR FOOTER ==================================  -->
    <div class="mt-5">
      <router-link :to="{ name: 'home' }">
        <small class="text-muted feature-unavailable" style="font-size: 86% ">
          About us &bull;
        </small>
      </router-link>
      <a href="#">
        <small
          class="text-muted feature-unavailable"
          style="font-size: 86% ,color:#888; "
        >
          Get involved &bull;
        </small>
      </a>
      <br />
      <a href="#">
        <small
          class="text-muted feature-unavailable"
          style="font-size: 86%;color:#888; "
        >
          Things to know &bull;
        </small>
      </a>
      <a href="#" data-toggle="modal" data-target="#student-support">
        <small class="text-muted" style="font-size: 86%;color:#888;">
          Student support &bull;
        </small>
      </a>
      <br />
      <img
        class="wrap"
        src="/assets/img/bana1.png"
        style="height:1.8rem; width:1.8rem;"
      />
      <small
        class="text-muted feature-unavailable"
        style="font-size: 86%;font-weight:600;color:#AAA;"
      >
        bana &#169; {{ year }}
      </small>
    </div>

    <!-- row col-md-6 -->

    <!-- <div class=" col-12" style="margin-left: 0.5rem;padding: 0">
        <component 
    v-bind:is="current_side_component"></component>
		</div> -->
  </div>
</template>
<script>
import StudentSidebarComponent from "./LeftSidebar/StudentSidebarComponent";
export default {
  components: {
    "student-sidebar": StudentSidebarComponent,
  },
  computed: {
    current_side_component: function() {
      let route_sidebar = {
        events: "student-sidebar",
        bursaries: "student-sidebar",
        needs: "student-sidebar",
        profile: "student-sidebar",
        /*search-results-side
student-award-filter
schools-search-filter
featured-student-filter
student-search-filter
bursaries-search-filter
needs-search-filter
events-search-filter>
announcements-sidebar-left
admin-sidebar
companies-search-filter
organizations-search-filter
featured-student-side
student-project-side*/
      };
      let component = "";
      for (const [key, value] of Object.entries(route_sidebar)) {
        component = this.$route.name == key ? value : component;
      }
      return component;
    },
    year: function() {
      var d = new Date();
      var n = d.getFullYear();
      return n;
    },
    //get the user url slug
    url_slug() {
      return this.$route.params.slug;
    },
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

.head {
  font-family: "Poppins", sans-serif;
  background-color: #fff !important;
  border-radius: 6px;
  width: 100%;
  /* box-shadow: 0 1px 0 rgba(22, 8, 43, 0.1); */
  padding: 1rem 1rem;
  z-index: 100;
}

.head-container {
  display: flex;
  align-items: center;
  height: 3.5rem;
  justify-content: space-between;
}

.head-img {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  margin-right: 7px;
}

.head-logo {
  color: #19181b;
  font-weight: 500;
  display: none;
}

.head-search {
  display: flex;
  padding: 0.4rem 0.75rem;
  background-color: #fbfbfb;
  border-radius: 0.25rem;
}

.head-input {
  width: 100%;
  border: none;
  outline: none;
  background-color: #fbfbfb;
}

.head-input::placeholder {
  font-family: "Poppins", sans-serif;
  color: #58555e;
}

.head-icon,
.head-toggle {
  font-size: 1.2rem;
  margin-top: 3px;
}

.head-toggle {
  color: #19181b;
  cursor: pointer;
}

.nav {
  font-family: "Poppins", sans-serif;
  color: #fff !important;
  border-radius: 6px;
  width: 100%;
  padding: 1rem 1rem 0;
  background-color: #fff;
  /* box-shadow: 1px 0 0 rgba(22, 8, 43, 0.1); */
  z-index: var(--z-fixed);
  transition: 0.4s;
}

.nav-container {
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding-bottom: 3rem;
  overflow: auto;
  scrollbar-width: none;
}

.nav-container::-webkit-scrollbar {
  display: none;
}

.nav-list,
.nav-items {
  display: grid;
}

.nav-list {
  row-gap: 1.5rem;
}

.nav-items {
  row-gap: 0.6rem;
}

.nav-subtitle {
  font-size: 0.938rem;
  text-transform: uppercase;
  letter-spacing: 0.1rem;
  color: #a5a1aa;
}

.nav-link {
  display: flex;
  align-items: center;
  color: #58555e;
}

.nav-link:hover {
  color: #478ac9;
}

.nav-icon {
  font-size: 1.2rem;
  margin-right: 0.5rem;
}

.nav-name {
  font-size: 0.75rem;
  font-weight: 500;
  white-space: nowrap;
}

.nav-logout {
  margin-top: 1rem;
}

.nav-dropdown {
  overflow: hidden;
  max-height: 21px;
  transition: 0.4s ease-in-out;
}

.nav-dropdown-collapse {
  background-color: #f4f0fa;
  border-radius: 0.25rem;
  margin-top: 1rem;
}

.nav-dropdown-content {
  display: grid;
  row-gap: 0.5rem;
  padding: 0.75rem 2.5rem 0.75rem 1.8rem;
}

.nav-dropdown-item {
  font-size: 0.75rem;
  font-weight: 500;
  color: #58555e;
}

.nav-dropdown-item:hover {
  color: #478ac9;
}

.nav-dropdown-icon {
  margin-left: auto;
  transition: 0.4s;
}

.nav-dropdown:hover {
  max-height: 100rem;
}

.nav-dropdown:hover .nav-dropdown-icon {
  transform: rotate(180deg);
}

.show-menu {
  left: 0;
}

.active {
  color: #478ac9;
  border-left: 1px solid #478ac9;
}
</style>
