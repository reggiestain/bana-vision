<template>
	<div class = "card lefty ">
		<div class= "card-header">
			<p>Welcome </p>
			<a class = "btn btn-leftbar">Explore</a>
		</div>
		<div class= "card-body">
		</div>
	</div>
</template>
<script>
	export default
	{
		/**
		 * [onInputChange description]
		 * @param  {[type]} event          [description]
		 * @param  {[type]} that           [description]
		 * @param  {[type]} model          [model in which filter is applied i.e Company]
		 * @param  {[type]} filtered_array [array containing filtered values i.e industries]
		 * @param  {[type]} filter_type    [description]
		 * @param  {[type]} filter_value   [description]
		 * @param  {[type]} model_ref      [the reference of the model component ]
		 * @return {[type]}                [description]
		 */
			onInputChange:function(event,that,model,filtered_array,filter_type,filter_value,model_ref,general_locations = false)
			{
				if(filtered_array!== null ) //value requires autosuggest not from select tag
				{
        			if(!filtered_array.includes(event.target.value)) //inputed value not already in array
        			{
          				//gets autosuggest  
          				var auto_suggest_url = '';
          				console.log(general_locations);
          				if (general_locations === true) 
          				{
          					auto_suggest_url = 'locations/';
          				} 
          				else 
          				{
          					auto_suggest_url = model + '-auto-suggest/';
          				}
          				axios.get('../'+auto_suggest_url+filter_type+'/'+filter_value)
          				.then(response => {
          					//filtered_array = response.data.posts;
          					response.data.posts.forEach(function(rv)
          					{
          						if (!filtered_array.includes(rv)) //prevent duplicates
          						{
          							filtered_array.push(rv);
          						}
          					});
          				
          				})
          			.catch(function(error) 
          			{
          				console.log('an error occured ' + error);
          			});
          			}	
      			}
      			that.$store.commit('setSearchLoading',true);
              	//gets companies with the applied filters
              	axios.get('../filter-'+model+'/'+filter_type+'/'+filter_value)
              	.then(response => {
                  	that.$root.$refs[model_ref].groupPosts = [];//clears the current posts by reference
                  	that.$store.commit('changePosts',response.data.posts);
                  	that.$store.commit('setScroll',false);
                  	//display appropriate msg if the response is empty
          			if (!response.data.posts.length) 
          			{
          				that.$store.commit('setResultsEmpty',true);
          			}
          			else
          			{
          				that.$store.commit('setResultsEmpty',false);
          			}
              	})
              	.catch(function(error) {
              		console.log('an error occured ' + error);
              	})
              	.finally(() => that.$store.commit('setSearchLoading',false));


          },
		
	}
</script>
<style scoped>
.btn-leftbar
{
	background: #fd5211;
	color:#fff;
	border-radius: 30px;
}
.lefty{
	width: 100%;
}
</style>