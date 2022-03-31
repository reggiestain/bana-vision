/*
 * login and register use the same component @RegisterComponent by changing the currentComponent login on mounting
 * posts ,busrsary,event use the same component @PostComponent and only change the card body content
 *
 */
import VueRouter from "vue-router";
import Vue from "vue";
import HomeComponent from "./components/bana/HomeComponent";
import SchoolComponent from "./components/school/SchoolComponent";
import OurNeedsPageComponent from "./components/need/OurNeedsPageComponent";
import DonatePageComponent from "./components/donate/DonatePageComponent";
//import EventsComponent from './components/event/EventsComponent';
import BursariesComponent from "./components/bursary/BursariesComponent";
import ProfilePageComponent from "./components/user/profile/ProfilePageComponent";
import PostsComponent from "./components/post/PostsComponent";
import LoginComponent from "./components/auth/LoginComponent";
import ForgotPasswordComponent from "./components/auth/ForgotPasswordComponent";
import ResetPasswordComponent from "./components/auth/ResetPasswordComponent";
import StudentPageComponent from "./components/student/StudentPageComponent";
import RegisterComponent from "./components/auth/register/RegisterComponent";
import ZltoComponent from "./components/zlto/ZltoPageComponent";

Vue.use(VueRouter);
export default new VueRouter({
  linkExactActiveClass: "active",
  scrollBehavior: () => ({ y: 0 }),
  mode: "history",

  routes: [
    {
      path: "/",
      name: "home",
      component: HomeComponent,
    },
    {
      path: "/register",
      name: "register",
      component: RegisterComponent,
    },{
      path: "/donate",
      name: "donate",
      component: DonatePageComponent,
    },
    {
      path: "/forgot-password",
      name: "forgot-password",
      component: ForgotPasswordComponent,
    },
    {
      path: "/reset-password/:token",
      name: "reset-password",
      component: ResetPasswordComponent,
    },
    {
      path: "/login",
      name: "login",
      component: RegisterComponent,
    },
    {
      path: "/schools",
      name: "schools",
      component: PostsComponent,
    },
    {
      path: "/:slug/needs",
      name: "needs",
      component: OurNeedsPageComponent,
    },
    {
      name: "zlto",
      path: "/:slug/zlto",
      component: ZltoComponent,
      meta: { requiresComponentBeforeContent: true },
      children: [
        {
          path: "/:slug/zlto",
          name: "zlto_dashboard",
          component: () => import("./components/zlto/ZltoDashboardComponent"),
        },
      ],
    },
    {
      path: "/:slug/zlto/earn",
      component: ZltoComponent,
      children: [
        {
          path: "/:slug/zlto/earn",
          name: "zlto_earn",
          component: () => import("./components/zlto/ZltoEarnComponent"),
        },
      ],
    },
    {
      path: "/:slug/zlto/editprofile",
      component: ZltoComponent,
      children: [
        {
          path: "/:slug/zlto/editprofile",
          name: "zlto_Editprofile",
          component: () => import("./components/zlto/ZltoEditProfile"),
        },
      ],
    },
    {
      path: "/:slug/zlto/spend",
      component: ZltoComponent,
      children: [
        {
          path: "/:slug/zlto/spend",
          name: "zlto_spend",
          component: () => import("./components/zlto/ZltoSpendComponent"),
        },
      ],
    },
    {
      path: "/:slug/zlto/message",
      component: ZltoComponent,
      children: [
        {
          path: "/:slug/zlto/message",
          name: "zlto_message",
          component: () => import("./components/zlto/ZltoMessageComponent"),
        },
      ],
    },
    {
      path: "/:slug/events",
      name: "events",
      component: PostsComponent,
    },
    {
      path: "/:slug/bursaries",
      name: "bursaries",
      component: PostsComponent,
    },
    {
      path: "/:slug",
      name: "profile",
      component: ProfilePageComponent,
      meta: { requiresComponentBeforeContent: true },
    },
    {
      path: "/:slug/student-center",
      name: "student-center",
      component: StudentPageComponent,
    },

    {
      path: "/:slug/feed",
      name: "feed",
      component: PostsComponent,
      meta: { requiresAuth: true },
    },
    {
      path: "/error-404",
      name: "error-component",
      component: () => import("./components/bana/ErrorPageComponent"),
    },
    {
      path: "*",
      redirect: "/error-404",
      name: "error",
      component: () => import("./components/bana/ErrorPageComponent"),
    },
  ],
  //base: process.env.MIX_APP_URL,
});
