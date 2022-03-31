<template>
  <!--============================================= ZLATO EASY ACCESS =============================================-->
    <div class="mt-3 d-flex justify-content-center m-off">
      <div class="card p-4 mt-3 card-zlto">
        <div class="first">
          <h6 class="heading">Zlto</h6>
          <div
            class="d-flex flex-row align-items-center justify-content-between mt-3"
          >
            <div class="d-flex align-items-center">
              <i class="fa fa-clock-o clock"></i>
              <span class="hour ml-1">21 Tasks</span>
            </div>
            <div>
              <span class="font-weight-bold"
                ><span class="zl">Z</span> {{balance}} Zlto</span
              >
            </div>
          </div>
        </div>
        <div class="second d-flex flex-row mt-2">
          <div class="logo_image mr-3">
            <img
              src="https://assets.website-files.com/5eea0c8c85f84ab4284fd88e/5eeb6764998770c5b6629f88_banner-14-13.png"
              class="rounded-circle"
              width="60"
            />
          </div>
          <div class="">
            <div>
              <button class="btn side-btn btn-sm px-2">Earn</button>
              <button
                class="btn side-btn 
               btn-sm"
              >
                Spend
              </button>
            </div>
          </div>
        </div>
        <hr class="line-color" />
        <div class="third mt-2">
          <button class="btn btn-suc btn-block">OPEN ZLTO</button>
        </div>
      </div>
    </div><!-- end zlto c -->
</template>

<script>
import { Post } from "../../Post.ts"; 
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      time1: null,
      post:null,
      balance:0,
      tasks_completed:70,
      amount_spent:0,
    };
  },
  computed:{
    //get the auth status and user
    ...mapGetters({
      authenticated: "auth/authenticated",
      auth_user: "auth/user",
      user: "user",
      zlto_user: "zlto_user",
      //groupPosts : "getPosts({property_name:'events'})",
    }),
  },
  watch: {
  'zlto_user': {
    handler (newVal) {
      if (newVal) { // check if userid is available
        this.set_zlto_balances();
      }
    },
    immediate: true // make this watch function is called when component created
  }
},
methods:{
  set_zlto_balances(){
    console.log(this.zlto_user);
    this.balance= this.zlto_user.bank_account.balance_amount;
    this.amount_spent= this.zlto_user.bank_account.total_spent;
  }
},
mounted(){
    var that = this;
    this.post = new Post();
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/get-profile-profile',1,"user_id","zlto_user");//Get the student zlto profile
    //console.log(this.zlto_user);
   // 
  }

};
</script>

