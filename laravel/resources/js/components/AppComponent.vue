<template>
	<div>
		<router-view :key="$route.path"></router-view>
	</div>
</template>
<script>
	import { mapGetters, mapActions } from 'vuex'

	export default{
		name :'App',
		computed: {
      ...mapGetters({
        authenticated: 'auth/authenticated',
        user: 'auth/user',
      })
    },

    methods: {
      ...mapActions({
        signOutAction: 'auth/signOut'
      }),

      async signOut () {
        await this.signOutAction()

        this.$router.replace({ name: 'home' })
      }
    }
	}
</script>