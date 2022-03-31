<template>
    <div class="col-4 border p-0 ">
        showing parent data {{getParent}}
    </div>
</template>

<script>
import Vuex from 'vuex';
Vue.use(Vuex);
    export default {
        inheritAttrs: false,
        mounted() {
            console.log('why :'+this.$store.state.count);
        },
        computed:
        {
          getParent:function()
          {
            return this.$parent.song
          }
        }
    }
</script>
