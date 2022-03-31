<template>
	<div></div>
</template>

<script>
export default 
{
    data:function()
    {
    	return {
    		pages : {},
  			tabs:[],
          	posts:[]
    	}
    },
    methods:
    {
        //load more data for lazy loading
    	loadMoreData:function(page,page_name,place_id)
    	{
         	axios.get('?'+page_name+'=' + page)
          	.then(response => {

            	//console.dir(Vue.options.components['image-post']);
            	//console.log(this.$components);
            	$(place_id).append($('ajax.load'));
            	Vue.options.components['image-post'].options.props.posts.push(response.data);
            	//console.log(Vue.options.components.notifications);
          })
          .catch(error => {
            console.log(error)
            this.errored = true
          })
          .finally(() => this.loading = false)
    	},
        //when scrolling to the bottom
    		scroll:function(that)
    		{
    			$(window).scroll(function(){	

      				if($(window).scrollTop() + $(window).height() >= $(document).height()) 
      				{
        				ww = $(".nav-item.active.show").attr('id');
        				that.pages['page'+ww] = that.pages['page'+ww] + 1;
        				//console.log(that.pages['page'+ww]);
        				//console.log(that.tabs[ww]);
        			that.loadMoreData(that.pages['page'+ww],'page'+ww,'#'+that.tabs[ww]);
      				}
  				});
    		}
    },
    mounted()
    {
        //populate the pages and tabs with the number of tabs
        console.log('this is the state :'+store.state.count);
    	for (var i = 1; i <= $('.nav-item.nav-link').length; i++) 
  		{
      		this.pages['page'+i] = 1;
      		this.tabs[i] = 'tab-'+ i+'-data';

  		}
  		that=this;
    	this.scroll(that);
    }
}
</script>