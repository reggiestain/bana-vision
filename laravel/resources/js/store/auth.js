import axios from 'axios'

export default {
  namespaced: true,

  state: {
    authenticated: false,
    auth_user: null
  },

  getters: {
    authenticated (state) {
      return state.authenticated
    },

    user (state) {
      return state.auth_user
    },
  },

  mutations: {
    SET_AUTHENTICATED (state, value) {
      state.authenticated = value
    },

    SET_USER (state, value) {
      state.auth_user = value
    }
  },

  actions: {
    async signIn ({ dispatch }, credentials) {

    /*  credentials.this.$swal({
                text: "Authenticating",
                icon:credentials.this.image_url,
                buttons: false,
            });*/
  
      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/login', credentials)
     

      return dispatch('me')
    },

    async signOut ({ dispatch }) {
      await axios.post('/logout')

      return dispatch('me')
    },

    me ({ commit }) {
      return axios.get('/api/user').then((response) => {
        commit('SET_AUTHENTICATED', true)
        commit('SET_USER', response.data)
      }).catch(() => {
        commit('SET_AUTHENTICATED', false)
        commit('SET_USER', null)
      })
    }

  }
}