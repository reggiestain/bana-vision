<template>
<span>
    <a class="d-none d-sm-none d-md-block" href="#" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="notif">
        {{notificationsa.length}}
        <i class="fa fa-bell" style="padding-right:3px"></i>
    </a>
    <div class="dropdown-menu" aria-labelledby="notif"  style="position:absolute;margin-left:-12rem;font-size: 0.75rem;width:20rem;">
    <div class="container-fluid border-bottom d-flex mb-2">
        <strong>
            Notifications
        </strong>

        <a class="ml-auto">
            <i class="fas fa-ellipsis-v"></i>
        </a>
    </div>
        <div style="padding:0;margin:0;max-height:35rem;overflow-y:scroll">
        <div class="media p-2 border-bottom" v-for="item in notificationsa">
            <img class="mr-1 rounded-circle" :src=item.src alt="Generic placeholder image" style="width:3rem;height:3rem">
            <div class="media-body">
            <a :href=item.href >
                {{item.message}}
            </a>
            </div>
        </div >
        </div>
        <div class="border-top p-2 d-flex">
            <a href="#">
            Mark all as read
            </a>
            <a href="#" class="ml-auto">
                settings
            </a>
        </div>
    </div>
</span>
</template>
<script>
    import { mapGetters } from 'vuex';
     export default {
        data(){
            return {
                notificationsa: [],
                notificationa: {},
                imgSrc : ""
            }
        },

       /* methods: {
            send() {
                axios.post('/message', {message: this.message})
                    .then((response) => {
                        this.message = '';
                    });
            }
        }, */

        mounted() {
            Echo.private('user.'+this.$store.state.auth_user)
                .listen('PostCommentedEvent', (e) => {
                this.imgSrc ="{route('getProfilePic',['filename'=>"+e.user+"-profile"+e.id+".jpg])}";
                this.notificationsa.push({
              user: e.user,
              "message":e.message,
              "id":e.id,
              "src":"/profile-picture/"+e.user+"-profile"+e.id+".jpg",
              "href":"post/"+e.interacted_type+"/"+e.post.id
            });
            
                });
        },
        computed:
        {
            //get the auth status and user
          ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        }),
        }
    }
</script>