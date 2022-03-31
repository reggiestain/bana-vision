<template>
  <div class="container">
    <div
      class="row ml-0 mr-0"
      style="align-items: flex-start;margin-top: 5rem; width=100%;"
    >
      <!--========================= Left Sidebar =========================-->
      <template v-if="show_sidebars">
        <div
          class="col-12 d-md-flex stickyEl  collapse navbar-collapse left-sidebar col-xl-3 col-lg-3 col-md-3"
        >
          <left-sidebar></left-sidebar>
        </div>
      </template>

      <div
        v-bind:class="[
          show_sidebars ? 'col-12 ml-auto mr-auto col-xl-6 col-lg-6' : 'w-100',
        ]"
        id="page_content_"
      >
        <app-component></app-component>
      </div>

      <!--========================= Right Sidebar =========================-->
      <template v-if="show_sidebars">
        <div
          class="col-12 p-0 stickyEl left-sidebar col-xl-3 col-lg-3 col-md-3"
        >
          <right-sidebar><!-- component found at resources/js/components/bana/RightSideBarComponent--></right-sidebar>
        </div>
      </template>
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    show_sidebars: function() {
      /*if not on the user profile profile page and not on the register page*/
      return ![
        "register",
        "login",
        "home",
        "forgot-password",
        "reset-password",
        "zlto",
        "zlto_message",
        "zlto_spend",
        "zlto_earn",
        "zlto_dashboard",
        "zlto_Editprofile",
      ].includes(this.$route.name);
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
* {
  font-family: "Poppins", sans-serif !important;
}
</style>
