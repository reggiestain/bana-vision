<template>
  <div class="col-12">
    <div class="fadeMe"></div>
    <div
      class="d-flex row m-auto  col-12 align-items-center"
      style="padding: 1.25rem;z-index: 2000;position: absolute"
      id="container-div"
    >
      <!--Buttons-->

      <div
        class="card mx-auto my-auto register rounded col-12 col-md-9 align-self-center"
        style="vertical-align: middle"
      >
        <div class="card-body row m-0 p-0">
          <div class="col-md-3 d-none d-md-block register-left p-1">
            <router-link :to="{ name: 'home' }">
              <img
                class="wrap"
                id="banner"
                src="/assets/img/bana1.png"
                style="height:4.4rem"
              /><!-- fix image -->
              <h5>
                Bana
              </h5>
            </router-link>

            <p>
              You are a few steps away from connecting with other academics!
            </p>

            <!-- ================================= PROGRESS BAR =================================-->
            <div v-if="$route.name == 'register'" class="progress">
              <div
                class="progress-bar"
                id="register-progress"
                role="progressbar"
                aria-valuenow="0"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>

            <br />
          </div>
          <div class="col-12 col-md-9 register-right">
            <h4 class="register-heading mt-2">
              {{ $route.name }}
            </h4>
            <div class="col-12 register-form ">
              <div>
                <keep-alive>
                <component :is="current"></component>
                </keep-alive>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Register1Component from "./Register1Component";
import Register2Component from "./Register2Component";
import Register3Component from "./Register3Component";
import Register4Component from "./Register4Component";
import RegisterFinalComponent from "./RegisterFinalComponent";
import LoginComponent from "../LoginComponent";
//import RegisterFinalComponent from './RegisterFinalComponent';

export default {
  props: [],
  data: function() {
    return {};
  },
  components: {
    "register-1": Register1Component,
    "register-2": Register2Component,
    "register-3": Register3Component,
    "register-4": Register4Component,
    login: LoginComponent,
    "register-final": RegisterFinalComponent,
  },
  computed: {
    current: function() {
      switch (this.$store.state.currentComponent) {
        case "register-2":
          this.updateRegProgressBar(0, 35);
          break;

        case "register-3":
          this.updateRegProgressBar(35, 70);
          break;

        case "register-4":
          break;

        case "register-final":
          this.updateRegProgressBar(70, 100);
          break;

        default:
          this.updateRegProgressBar(0, 0);
      }

      return this.$store.state.currentComponent;
    },
  },
  methods: {
    updateRegProgressBar: function(current_progress, final_progress) {
      var interval = setInterval(function() {
        current_progress += 1;
        $("#register-progress")
          .css("width", current_progress + "%")
          .attr("aria-valuenow", current_progress)
          .text(current_progress + "% Complete");
        if (current_progress >= final_progress) clearInterval(interval);
      }, 100);
    },
  },
  mounted() {
    const that = this;
    this.$store.commit("setScroll", false);
    if (this.$route.name == "login")
      that.$store.commit("set", {
        property_name: "currentComponent",
        property_values: "login",
      });
  },
};
</script>
<style scoped>
@import "/assets/css/registration.css";
</style>
