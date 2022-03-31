<template>
	<div>
	<component :is="current" v-bind="newProps"></component>
	</div>
</template>
<script>
	export default
	{
		props:['type','posts'],
		data:function() {
			return{
			
			}
		},
		components:{
			'announcements':require('../bana/AnnouncementsComponent.vue'),
			'news':require('../bana/NewsComponent.vue'),
		},
		computed:
		{
			//sets current component from the store
			 current: function() {
      			return this.$store.state.currentComponent;
    		},
    		//sets props for the new component
    		newProps:function(){
    			return {
    				'post':this.posts,
    				'previousComponent':this.current,
    			}
    		}
		},
		mounted()
		{
			console.log(this.currentComponent);
		},
		created() {
    		this.$store.commit('setCurrentComponent',this.type);
		},

	}
</script>