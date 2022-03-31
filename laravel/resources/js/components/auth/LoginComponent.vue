<template :key="login">
  <form action="#" @submit.prevent="checkForm" :key="login_form">
    <div class="form-group row">
      <label for="email" class="col-sm-4 col-form-label text-md-right"
        >E-Mail Address</label
      >

      <div class="col-md-6">
        <input
          id="email"
          type="email"
          class="form-control  form-control-sm"
          v-model="form.email"
          value=" old('email') "
          autofocus
        />

        <span v-if="errors.hasOwnProperty('email')" class="help-block">
          <strong> {{ errors["email"] }} </strong>
        </span>
      </div>
    </div>

    <div class="form-group row">
      <label for="password" class="col-md-4 col-form-label text-md-right">
        Password
      </label>

      <div class="col-md-6">
        <input
          id="password"
          type="password"
          class="form-control  form-control-sm"
          name="password"
          v-model="form.password"
        />

        <span v-if="errors.hasOwnProperty('password')" class="help-block">
          <strong> {{ errors["password"] }} </strong>
        </span>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-6 offset-md-4">
        <div class="checkbox">
          <label> <input type="checkbox" name="remember" /> Remember Me </label>
        </div>
      </div>
    </div>

    <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary btn-sm">
          Login
        </button>

          <router-link
                :to="{ name: 'forgot-password' }"
                class="btn btn-link"
              >
          Forgot Your Password?
        </router-link>

        <router-link
                :to="{ name: 'register' }"
                class="btn btn-link"
              >
          Register
        </router-link>
      </div>
    </div>
  </form>
</template>

<script>

  import axios from 'axios'
  import { mapGetters , mapActions } from 'vuex'

  export default {
    name: 'SignIn',

    data () {
      return {
        form: {
          email: '',
          password: '',
        },
        errors:{},
      };
    },
    computed: 
    {
      ...mapGetters({
        authenticated: 'auth/authenticated',
        user: 'auth/user',
      })
    },
    methods: 
    {
      ...mapActions({
        signIn: 'auth/signIn'
      }),

      async submit () {
        var that = this ;
        await this.signIn(this.form)
        //redirect to feed if authenticate succesful
        this.$router.replace({ 
          name: 'feed', 
          params: { 
            slug : that.user.slug
          }
        });
      },
       //check the form for invalid inputs
      //**********************please abstract this method *******************************
      checkForm: function (e) {
        this.errors = {};

        if (!this.form.password) 
        {
          //this.errors.push("Name required.");
          this.errors['password'] = 'Password required';
        }

        if (!this.form.email) 
        {
          //this.errors.push('Email required.');
          this.errors['email'] = 'Email required';
        } 
        else if (!this.validEmail(this.form.email)) 
        {
          //this.errors.push('Valid email required.');
          this.errors['email_validation'] ="not valid email";
        }

        if (Object.keys(this.errors).length === 0 && this.errors.constructor === Object) {
          this.submit();
          //return true;
        }

  
      },
      validEmail: function (email) 
      {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
      }
    },
    mounted()
    {
      //do not show any component between header and posts
      this.$store.commit('set',{
        property_name:'current_component',
        property_values:''
      });
    }
  }
</script>
