<template>
  <form action="#" @submit.prevent="checkForm">
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
          v-on:change="post_helper.update_value($root,$event.target.value,'email')"
          value=" old('email') "
          autofocus
        />

        <span  class="help-block">
          <strong> {{ errors["email"] }} </strong>
        </span>
      </div>
    </div>


    <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary btn-sm">
          Login
        </button>

      </div>
    </div>
  </form>
</template>

<script>

  import axios from 'axios';
  import { mapGetters , mapActions } from 'vuex';
  import {Post} from '../../Post.ts';



  export default {
    name: 'SignIn',

    data () {
      return {
        post_helper:new Post(),
        form: {
          email: '',
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

        that.post_helper.post(that,'/api/forgot-password');
       /* await this.signIn(this.form)
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
