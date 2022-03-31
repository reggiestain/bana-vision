<template>
  <section class="main-view">
    <div class="container-scroller">
      <Header />
      <div class="container-fluid page-body-wrapper">
        <Sidebar />
        <div class="main-panel">
          <div class="content-wrapper">
           
            <router-view ></router-view>
          </div>
          <!-- content wrapper ends -->
          <Footer />
        </div>
        <!-- main panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
  </section>
</template>

<script>
import Header from "./ZltoHeaderComponent";
import Sidebar from "./ZltoLeftSideComponent";
import Footer from "./ZlatoFooterComponent";
import { mapGetters, mapActions } from "vuex";
import ZltoTasksComponent from "./ZltoTasksComponent.vue";

export default {
  name: "ZltoComponent",
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    ...mapActions({
      signOutAction: "auth/signOut",
    }),

    async signOut() {
      await this.signOutAction();
      this.$router.replace({ name: "home" });
    },
  },
  components: {
    Header,
    Sidebar,
    Footer,
    ZltoTasksComponent,
  },
};
</script>
<style lang="scss">
@import "../../../../node_modules/@mdi/font/css/materialdesignicons.min.css";
@import "../../../../node_modules/flag-icon-css/css/flag-icon.min.css";
@import "../../../../node_modules/font-awesome/css/font-awesome.min.css";
@import "../../../../node_modules/simple-line-icons/css/simple-line-icons.css";
@import "../../../../node_modules/ti-icons/css/themify-icons.css";
@import "../../../../node_modules/sweetalert2/dist/sweetalert2.min.css";
@import "../../../../node_modules/vue-snotify/styles/material.css";
@import "../../../../node_modules/codemirror/lib/codemirror.css";
// @import "../../../../node_modules/fullcalendar/dist/fullcalendar.css";
@import "../../../../node_modules/c3/c3.min.css";
@import "../../../../node_modules/chartist/dist/chartist.min.css";

@import "../../../assets/scss/style.scss";
@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

.main-view
{
  margin-top:50px !important;
}
</style>
