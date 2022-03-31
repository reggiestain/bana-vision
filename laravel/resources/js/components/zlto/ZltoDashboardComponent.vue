<template>
  <section class="dashboard">
    <div class="page-header">
      <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Overview </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="https://raw.githubusercontent.com/NtsikeleloBana/imagesbox/main/circle.png" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Zlto Account<i class="mdi mdi-chart-line mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">Z {{balance}}</h2>
            <h6 class="card-text">Current Balance: Z{{balance}}</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="https://raw.githubusercontent.com/NtsikeleloBana/imagesbox/main/circle.png" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Tasks Completed <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{tasks_completed}}</h2>
            <h6 class="card-text">Current Pending : {{tasks_completed}}</h6>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger   card-img-holder text-white">
          <div class="card-body">
            <img src="https://raw.githubusercontent.com/NtsikeleloBana/imagesbox/main/circle.png" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Spend<i class="mdi mdi-diamond mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">Z {{amount_spent}}</h2>
            <h6 class="card-text">Current : Z{{amount_spent}}</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="clearfix">
              <h4 class="card-title float-left">Annual Task And Earn Report 2021 </h4>
              <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right">
                <ul>
                  <li>
                    <span class="legend-dots bg-gradient-primary"></span>Task
                  </li> 
                  <li>
                      <span class="legend-dots bg-gradient-danger"></span>Spend
                  </li> 
                  <li>
                        <span class="legend-dots bg-gradient-info"></span>Earn
                  </li>
                </ul>
              </div>
            </div>
              <visitAndSalesStatitics class='mt-5' :height='170'></visitAndSalesStatitics>
          </div>
        </div>
      </div>
      <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Tasks</h4>
            <trafficSourceChart :height='200'></trafficSourceChart>
            <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4">
              <ul>
                <li>
                  <span class="legend-dots bg-gradient-info"></span>Task Completed
                  <span class="float-right">37%</span>
                </li> 
                <li>
                  <span class="legend-dots bg-gradient-success"></span>Task Incompleted
                  <span class="float-right">61%</span>
                </li> 
                <li>
                  <span class="legend-dots bg-gradient-danger"></span>Task Pending
                  <span class="float-right">12%</span>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Recent Tasks</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th> Profile </th>
                    <th> Task </th>
                    <th> Status </th>
                    <th> Last Update </th>
                    <th> Zltos </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU" class="mr-2" alt="image">Ntokozo Mthokozi </td>
                    <td> Book Review (Report)</td>
                    <td>
                      <label class="badge badge-gradient-success">DONE</label>
                    </td>
                    <td> Feb 5, 2021 </td>
                    <td> Zlto 235 </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU" class="mr-2" alt="image"> Ntokozo Mthokozi</td>
                    <td> Questionnaire</td>
                    <td>
                      <label class="badge badge-gradient-warning">PROGRESS</label>
                    </td>
                    <td> May 12, 2021 </td>
                    <td> Zlto 120 </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU" class="mr-2" alt="image"> Ntokozo Mthokozi </td>
                    <td>Book Review (Skill)</td>
                    <td>
                      <label class="badge badge-gradient-info">ON HOLD</label>
                    </td>
                    <td> Jun 16, 2021 </td>
                    <td> Zlto 400 </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Q_RiUXj3WIyBcoDfqm0gdotM-mi4dkrdUQ&usqp=CAU" class="mr-2" alt="image">Ntokozo Mthokozi</td>
                    <td>Poll (10 Questions)</td>
                    <td>
                      <label class="badge badge-gradient-danger">REJECTED</label>
                    </td>
                    <td> Apr 3, 2021 </td>
                    <td> Zlto 10 </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Recent Updates</h4>
            <div class="d-flex">
              <div class="d-flex align-items-center mr-4 text-muted font-weight-light">
                <i class="mdi mdi-account-outline icon-sm mr-2"></i>
                <span>Thabo Masha</span>
              </div>
              <div class="d-flex align-items-center text-muted font-weight-light">
                <i class="mdi mdi-clock icon-sm mr-2"></i>
                <span>Mar 3rd, 2021</span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-6 pr-1">
                <img src="https://taleaway.com/wp-content/uploads/2017/10/zakes-mda-the-heart-of-redness-books-set-in-south-africa.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                <!-- <img src="https://images-na.ssl-images-amazon.com/images/I/61FTja7B7lL.jpg" class="mw-100 w-100 rounded" alt="image"> -->
              </div>
              <div class="col-6 pl-1">
                <img src="https://www.dut.ac.za/wp-content/uploads/2018/08/Zakse-Mda1.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                <img src="https://www.dailymaverick.co.za/wp-content/uploads/MC-CSW23Nov-Shani_1-1600x888.jpg" class="mw-100 w-100 rounded" alt="image">
              </div>
            </div>
            <div class="d-flex mt-5 align-items-top">
              <img src="https://raw.githubusercontent.com/NtsikeleloBana/imagesbox/main/face3.jpg" class="img-sm rounded-circle mr-3" alt="image">
              <div class="mb-0 flex-grow">
                <h5 class="mr-2 mb-2">Book Review - Report</h5>
                <p class="mb-0 font-weight-light">It is a long established fact that a reader will impove and the level of critic was very important</p>
              </div>
              <div class="ml-auto">
                <i class="mdi mdi-heart-outline text-muted"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 stretch-card grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-white">Todo</h4>
            <todo-list />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import visitAndSalesStatitics from './charts/widgets/visitAndSalesStatitics'
import trafficSourceChart from './charts/widgets/trafficSourceChart'
import todoList from './apps/todoList'
import DatePicker from 'vue2-datepicker';
import { Post } from "../../Post.ts"; 
import { mapGetters } from "vuex";


export default {
  name: 'dashboard',
  components: {
    DatePicker,
    trafficSourceChart,
    visitAndSalesStatitics,
    todoList
  },
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
    //this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/',1,"user_id",that.$route.name);
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/get-profile-profile',1,"user_id","zlto_user");
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/stores',1,"user_id","zlto_user");
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/earn/microtasks-list',1,"user_id","zlto_microtasks_list");//not working no user found
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/earn/user-microtasks-list',1,"user_id","zlto_microtasks_list");//not working no user found
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/partner/partner-microtasks-list',1,"user_id","zlto_microtasks_list");
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/deed/categories',1,"user_id","zlto_microtasks_list");
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/partner/user-transaction-logs',1,"user_id","zlto_microtasks_list");
    this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/partner/user-earn-list',1,"user_id","zlto_microtasks_list");
    //this.post.get(this,"/api/" + this.$route.params.slug + '/zlto/partner/create-verified-task',1,"user_id","zlto_microtasks_list");
    //console.log(this.zlto_user);
   // 
  }
}
</script>

<style lang="scss">
@import "../../../assets/scss/style.scss";
</style>
