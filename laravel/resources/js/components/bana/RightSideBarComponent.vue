<template>
  <!-- 
 =
 =
 =
 =  RIGHT SIDEBAR
 =
 =
 =
  -->
  <div>
    <div
      class="card col-12  collapse navbar-collapse right-side"
      id="navigation-sidebar"
    >
      <div class="card-body  col-12" style="padding: 1.25rem 0.75rem;">
        <h6 class="right-sidebar-header">STUDENTS</h6>
        <div class="list-group list-group-flush">
          <!--====================STUDENT CENTER============================================-->
          <router-link
            v-if="url_slug"
            :to="{ name: 'student-center', params: { slug: url_slug } }"
            class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center"
          >
            <!--<object type="image/svg+xml" class="img-circle svg-icons" data='/assets/icons/student-projects-01.svg' >
                        </object>-->
            <i class="right-sidebar-icons  fas fa-chalkboard-teacher"></i>
            <span class="right-sidebar-lable">
              Student Center
            </span>
          </router-link>
        </div>
        <hr />
        <h6 class="right-sidebar-header">HELP</h6>
        <div class="list-group list-group-flush">
          <!--====================OUR NEEDS============================================-->
          <router-link
            v-if="url_slug"
            :to="{ name: 'needs', params: { slug: url_slug } }"
            class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center"
          >
            <!--<object  type="image/svg+xml" class="img-circle svg-icons" data='/assets/icons/our-needs-01.svg' style="width: 20px">
                        </object>-->
            <i class="right-sidebar-icons  far fa-heart"></i>
            <span class="right-sidebar-lable">
              Needs
            </span>
          </router-link>

          <!--===================OUTREACH PROGRAMME============================================-->
          <a
            class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center"
          >
            <!--<object type="image/svg+xml" class="img-circle svg-icons" data='/assets/icons/outreach-01.svg' style="width: 20px">
                        </object>-->
            <i class="right-sidebar-icons  fas fa-hands-helping"></i>
            <span class="right-sidebar-lable">
              Outreach
              <!--Programme-->
            </span>
          </a>
        </div>
        <hr />
        <h6 class="right-sidebar-header">ANNOUNCEMENTS</h6>
        <div class="list-group list-group-flush">
          <!--====================EVENTS============================================-->
          <router-link
            v-if="url_slug"
            :to="{ name: 'events', params: { slug: url_slug } }"
            class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center"
          >
            <!-- <object type="image/svg+xml" class="img-circle svg-icons" data='/assets/icons/events-01.svg' style="width: 20px">
                        </object> -->
            <i class="right-sidebar-icons  far fa-calendar-alt"></i>
            <span class="right-sidebar-lable">
              Events
            </span>
          </router-link>

          <!-- ============================================ BURSARIES AVAILABLE ============================================ -->
          <router-link
            :to="{ name: 'bursaries', params: { slug: url_slug } }"
            class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center"
          >
            <!-- <object type="image/svg+xml" class="img-circle svg-icons" data='/assets/icons/bursaries-01.svg' style="width: 20px">
                         </object> -->
            <i class="right-sidebar-icons  fab fa-buromobelexperte"></i>
            <span class="right-sidebar-lable">
              Bursaries<!-- Available-->
            </span>
          </router-link>
        </div>
        <hr />
        <h6 class="right-sidebar-header">TOOLS</h6>
        <div class="list-group list-group-flush">
          <div v-if="auth.auth_owner_of_post(auth_user, user) && authenticated">
            <div
              v-if="
                auth.user_is_of_type(auth_user.usable_type, [
                  'App\School',
                  'App\Staff',
                ])
              "
            >
              <a
                class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center"
              >
                <i
                  class="fas fa-cogs "
                  style="font-size: 1.046rem;color: #a9a9a9;"
                ></i>
                <span class="right-sidebar-lable">
                  Admin
                </span>
              </a>
            </div>
            <!--end auth user school or staff-->

            <div
              v-if="auth.user_is_of_type(auth_user.usable_type, ['App\School'])"
            >
              <!-- check if school-->
              <a
                class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center"
              >
                <i
                  class="right-sidebar-icons  fas fa-book-open "
                  style="font-size: 1.046rem;"
                ></i>
                <span class="right-sidebar-lable">
                  Library
                </span>
              </a>
            </div>
            <!-- end if school-->
            <a
              class="list-group-item list-group-item-sdbr list-group-item-action d-flex align-items-center"
            >
              <i
                class="right-sidebar-icons  fas fa-file-alt "
                style="font-size: 1.046rem;"
              ></i>
              <span class="right-sidebar-lable">
                My notes
              </span>
            </a>
          </div>
          <!--end auth-->
        </div>
      </div>
    </div>
    <!--END SIDEBAR-->

    <!-- ============================================ ZLTO EASY ACCESS ============================================-->
    <div v-if="auth.auth_owner_of_post(auth_user, user) && authenticated && auth.user_is_of_type(user.usable_type, ['App\\Student'])">
      <zlto-easy-access></zlto-easy-access>
    </div>
  </div>
</template>
<script>
import { Auth } from "../../Auth.ts";
import ZltoEasyAccessComponent from '../zlto/ZltoEasyAccessComponent' ;
import { mapGetters } from "vuex";
export default {
  components:{
      'zlto-easy-access':ZltoEasyAccessComponent,
    },
  data: function() {
    return {
      auth: new Auth(),
    };
  },
  methods: {},
  computed: {
    //get the auth status and user
    ...mapGetters({
      authenticated: "auth/authenticated",
      auth_user: "auth/user",
      user: "user",
    }),
    url_slug() {
      return this.$route.params.slug;
    },
    /*  //exclude rigtsidebar on login and register pages
          show_sidebar:function()
          {
            return !['login','register'].includes(this.$route.name);
          }*/
  },
};
</script>
<style>
.right-side {
  background-color: #fff !important;
  border-radius: 6px;
}
hr {
  border-color: #ccc;
}

.right-sidebar-icons {
  color: #478ac9 !important;
  font-size: 0.8rem;
}

.right-sidebar-header {
  font-size: 1.1rem !important;
  font-weight: 600;
  color: #f0f0fa !important;
}

.right-sidebar-lable {
  font-size: 0.8rem;
  color: #999 !important;
  margin-left: 0.6rem;
  margin-bottom: 0.4rem;
}

.card-zlto {
  width: 350px;
  border-radius: 6px;

  width: 100%;
  position: relative;
}

.heading,
.zl {
  color: #f0f0fa;
  font-weight: 700;
}

.hour {
  margin-top: 1px;
  color: #fdb417;
  font-size: 12px;
}

.ratings i {
  color: #010323;
}

.side-btn {
  border-radius: 8px !important;
  border: 1px solid rgb(70, 66, 66);
  padding: 7px 10px;
  margin-top: 15px;
}
.btn-suc {
  background-color: #478ac9 !important;
  color: #fff !important;
  border-radius: 8px;
}
.line-color {
  color: #010323;
  height: 3px;
}
@media only screen and (min-device-width: 320px) and (max-device-width: 970px) {
  .card-zlto,
  .m-off {
    display: none !important;
  }
  .m-off {
    display: none !important;
  }
}
</style>
