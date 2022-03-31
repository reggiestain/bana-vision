<template>
  <!--==================================BURSARY INFORMATION==================================-->
  <div
    class="col-12 row bursary-information h-400x"
    style="padding: 0;margin: 0;overflow: hidden;max-height: 8rem;"
  >
    <div class="col-12  bursary-description h-300x" id="container-$post->id">
      <div class="col-12 mt-2 ">
        <h5 class="description bursary-name">
          <!-- <strong> -->
          {{ post.title }}
          <!-- </strong> -->
        </h5>
      </div>
      <p class="info bursary-description">{{ post.description }}</p>
      <div class="col-12 p-0 pos-btn">
        <a class="ml-auto follow-btn adj-btn " href="#">
          <!-- <i class="fas fa-plus ">  -->
          Apply
          <!-- </i> -->
        </a>
      </div>
    </div>

    <!--==================================CHECKLIST==================================-->
    <div class="col-12 p-0 mt-3">
      <!-- style="    text-align: center;"> -->

      <!--==================================CLOSING DATE==================================-->
      <div class="col-12 pl-0">
        <h6 class="mb-0 ">
          <!-- <strong class="d-flex"> -->
          Closing date
          <!-- </strong> -->
        </h6>
        <span class=" mr-auto align-items-center d-flex">
          <i
            class="fas fa-check-circle follow-btnn align-items-center text-cen"
          ></i>
          <!-- <span class="ml-1 date align-items-center text-cen"> -->
          <p class="info ml-1 date align-items-center text-cen">
            {{ post.closing_date != [] ? post.closing_date : 2022 }}
          </p>
          <!-- </span> -->
        </span>
      </div>

      <!--==================================SECTOR==================================-->
      <div class="col-12 mt-2 pl-0">
        <h6 class="mb-0">
          <!-- <strong class="d-flex"> -->
          Sector
          <!-- </strong> -->
        </h6>
        <span class="mr-auto align-items-center d-flex">
          <i
            class="fas fa-check-circle follow-btnn align-items-center text-cen "
          ></i>
          <!-- <span class="ml-1 align-items-center text-cen"> -->
          <p class="info ml-1 date align-items-center text-cen">
            {{ post.sector }}
          </p>
          <!-- </span> -->
        </span>
      </div>

      <!--==================================POSITIONS AVAILABLE==================================-->
      <div class="col-12 mt-2 pl-0">
        <h6 class="mb-0">
          <!-- <strong class="d-flex"> -->
          Positions available
          <!-- </strong> -->
        </h6>
        <span
          style="display: flex;"
          class="mr-auto align-items-center text-cen"
        >
          <i
            class="fas fa-check-circle follow-btnn align-items-center text-cen"
          ></i>
          <!-- <span class="ml-1 align-items-center text-cen"> -->
          <p class="info ml-1 date align-items-center text-cen">
            {{ post.positions_available }}
          </p>
          <!-- </span> -->
        </span>
      </div>

      <!--==================================REQUIREMENTS==================================-->
      <!-- <strong class="d-flex"> -->
      <!-- <div class="col-12 mt-2 pl-0">
          <h6 class="mb-0 ">
              Requirements
            </h6>
          <ul class="list-group align-items-center text-cen" v-for="requirement in post.requirements">
            
              <li class="list-group-item mr-auto p-0 align-items-center text-cen" style="border:none">
                <i class="fas fa-check-circle follow-btnn align-items-center text-cen" ></i>  
                <p class = "info align-items-center text-cen">{{requirement.requirement}}</p>
              </li>
        </ul>
        </div> -->
    </div>
    <!--@include('includes.viewPostPicModal')-->
  </div>
</template>
<script>
export default {
  props: ["post"],
  data: function() {
    return {
      //
    };
  },
  methods: {
    //
  },
  mounted() {
    //
  },
  computed: {
    //
  },

watch: { //*************************************PLEASE ABSTRACT THIS
  'post': {
    handler (newVal) {
      if (newVal) { // check if userid is available
        this.$store.commit("set", {
      property_name: "resultsEmpty",
      property_values: false,
    });
      }
    },
    immediate: true // make this watch function is called when component created
  }
},
};
</script>
<style>
.burs-det {
  display: flex;
  flex-direction: row-reverse;
}
.text-cen {
  /* justify-content: center; */
  align-content: center;
}
span {
  color: #666 !important;
}
.bursary-body-det {
  text-align: center;
}

.bursary-details {
  margin: 0;
  padding: 0;
}
.bursary-name {
  color: #444 !important;
  font-weight: 400;
  font-size: 1.2rem;
}
.bursary-description {
  color: #888 !important;
  font-weight: 400;
  font-size: 0.8rem;
  padding: 0 16px;
}
.info {
  color: #999;
}
.date {
  margin-top: 0.85rem;
  color: #888 !important;
}
.follow-btn {
  border-radius: 6px !important;
  padding: 5px 10px !important;
  box-shadow: 2px 3px 8px 3px rgb(0 0 0 / 10%);
  background-color: #478ac0 !important;
  color: #fff !important;
}
.d-flex {
  display: flex;
}
.follow-btnn {
  border-radius: 10px !important;
  padding: 5px 10px;
  box-shadow: 2px 22px 22px 2px rgba(0, 0, 0, 0.1);
  color: #478ac0 !important;
}
.h-400x {
  min-height: 200px;
}
.h-300x {
  overflow: hidden;
  min-height: 200px;
}
.pos-btn {
  margin-left: 16px;
}
.adj-btn {
  padding: 5px 10px;
  border-radius: 7px !important;
  box-shadow: 2px 22px 22px 2px rgba(0, 0, 0, 0.1);
}
</style>
