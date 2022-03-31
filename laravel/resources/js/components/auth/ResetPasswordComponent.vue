<template>
  <form action="#" @submit.prevent="checkForm">
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
          v-on:change="post_helper.update_value($root,$event.target.value,'password')"
        />

        <span v-if="errors.hasOwnProperty('password')" class="help-block">
          <strong> {{ errors["password"] }} </strong>
        </span>
      </div>
    </div>

    <div class="form-group row">
      <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">
        Confirm Password
      </label>

      <div class="col-md-6">
        <input
          id="password_confirmation"
          type="password"
          class="form-control  form-control-sm"
          name="password_confirmation"
          v-model="form.password_confirmation"
          v-on:change="post_helper.update_value($root,$event.target.value,'password_confirmation')"
        />

        <span v-if="errors.hasOwnProperty('password_confirmation')" class="help-block">
          <strong> {{ errors["password_confirmation"] }} </strong>
        </span>
      </div>
    </div>

    <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary btn-sm">
          Reset
        </button>
      </div>
    </div>
  </form>
</template>

<script>

  import axios from 'axios'
  import { mapGetters , mapActions } from 'vuex'
  import {Post} from '../../Post.ts';

  export default {
    name: 'SignIn',

    data () {
      return {
        post_helper:new Post(),
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
        console.log("this is ");
        console.log(that);
        //redirect to feed if authenticate succesful
        function redirectToLogin(){
          that.$router.replace({ 
          name: 'login', 
        });
        }
        that.post_helper.post(that,'/api/reset-password',redirectToLogin);
        /*await this.signIn(this.form)
        //redirect to feed if authenticate succesful
        this.$router.replace({ 
          name: 'feed', 
          params: { 
            slug : that.user.slug
          }
        });*/
        
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

        if (Object.keys(this.errors).length === 0 && this.errors.constructor === Object) {
          this.submit();
          //return true;
        }

  
      },
    },
    mounted()
    {
      this.post_helper.update_value(this,this.$route.query.email,'email');

      this.post_helper.update_value(this,this.$route.params.token,'token');
      //do not show any component between header and posts
      this.$store.commit('set',{
        property_name:'current_component',
        property_values:''
      });
      

    }
  }
</script>
