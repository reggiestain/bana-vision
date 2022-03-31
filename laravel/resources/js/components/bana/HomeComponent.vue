<template>                
  <div class="u-body">
 
  </div>

</template>
<script>
            import { mapGetters } from 'vuex';
	export default
	{
		props:['announcements','news'],
         metaInfo() {
        return { 
            title: "Bana run with your vision",
            meta: [
                { name: 'description', content:  'Our mission is to have people, locally as well as from across the globe, interact more easily within the education space, whether it be through ideas, tools or aid. We believe that the closer online and offline communication behaviors and standards align, the more effectively you can mobilize energy between worlds, specifically the education world.'},
                { property: 'og:description', content: "Our mission is to have people, locally as well as from across the globe, interact more easily within the education space, whether it be through ideas, tools or aid. We believe that the closer online and offline communication behaviors and standards align, the more effectively you can mobilize energy between worlds, specifically the education world."},
                { property: 'og:title', content: "Bana is an educational social media platform"},
                { property: 'og:site_name', content: 'BANA'},
                {property:'og:url' , content:'https://bana.vision'},
                {property: 'og:image', content: 'https://bana.vision/assets/img/bana_hires.png'},
                {property: 'og:type', content: 'website'},  
                {name:'keywords', content:'edtech, bana, education,platform,kage,tshepo,afrotech,online,marketplace'},  
                {name: 'robots', content: 'index,follow'} 
            ]
        }
    },
        methods:{
            announcement_href:function(id)
            {
                return '/info-center/announcements/#announcement'+id;
            },
            news_href:function(id)
            {
                return '/info-center/news/#news'+id;
            },
        },
        mounted()
        {
            //what to show after the header
            this.$store.commit('set',{property_name:'current_component',property_values:'banner'});
        },
        computed:
        {

 //get the auth status and user
          ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        })
        }
	}
</script>
