<template>
 <div class="col-12 row" style="background-color: #eff1f3;padding: 0;margin: 0">
  <!--==============================SCHOOL CALENDAR==============================-->
  <div class="col-3 p-3" style="    text-align: center;">
    <span class="fa-stack fa-2x">
      <i class="fas fa-school  fa-stack-2x" style="color:white"></i>
    </span>
  </div>

  <!--==============================SCHOOL DETAILS==============================-->
  <div class="col-9 p-3" id="container-$post->id">
    <ul class="list-group">
      <li class="list-group-item" style="border: none;padding:0.25rem;background-color:inherit">
        <strong>
          <i class="fas fa-map-marker-alt" style="color:green"></i>
          <span class="ml-2">
            Province : {{post.province}}
          </span>
        </strong>
      </li>
      <li class="list-group-item" style="border: none;padding:0.25rem;background-color:inherit">
        <strong>
          <i class="fas fa-map-marked-alt" ></i>
          <span class="ml-2">
            District : {{post.district_municipality_name}}
          </span>
        </strong>
      </li>
      <li class="list-group-item" style="border: none;padding:0.25rem;background-color:inherit">
        <strong>
          <i class="fas fa-venus-mars" ></i>
          <span class="ml-2">
            Coeducational : {{post.coeducational}}
          </span>
        </strong>
      </li>
      <li class="list-group-item" style="border: none;padding:0.25rem;background-color:inherit">
        <strong>
          <i class="fas fa-universal-access" style="color:red"></i>
          <span class="ml-2">

            Special Needs : {{ post.special_needs ? 'Yes' : 'No'}}
          </span>
        </strong>
      </li>
      <li class="list-group-item" style="border: none;padding:0.25rem;background-color:inherit">
        <strong>
          <i class="fas fa-wallet" style="color:brown"></i>
          <span class="ml-2">
            Funding : {{post.funding ? 'Public school' : 'Private school'}}
          </span>
        </strong>
      </li>
    </ul>
  </div>
</div>
</template>
<script>
export default
{
	props:['post'],
		data: function() {
	 		return {
	 		}
		},
		methods:
		{
		},
		computed:
		{
		},
    mounted()
    {
      //initialis
    },
       watch: { //*************************************PLEASE ABSTRACT THIS
  'post': {
    handler (newVal) {
      if (newVal) { // check if userid is available
        this.$store.commit("set", {
      property_name: "resultsEmpty",
      property_values: false,
    });
      }
    },
    immediate: true // make this watch function is called when component created
  }
},
}

</script>