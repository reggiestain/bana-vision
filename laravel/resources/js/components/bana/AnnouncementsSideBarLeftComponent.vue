<template>
	<div class="row col-md-6 col-12" style="margin-left: 0.5rem;padding: 0">
    <ul>
      <li class="feature-unavailable">
        <a>
          <i class="fas fa-book"  style="color: darkgoldenrod;"></i>
          <span class="ml-1">
          Books
        </span>
      </a>
    </li>
      <li class="mt-2">
        <a>
          <i class="fas fa-1x fa-sort-numeric-up"  style="color: blue;"></i>
          <span class="ml-1">
          Rankings
        </span>
      </a>
    </li>
      <li class="mt-2" v-on:click="setCurrentComponent('announcements')">
        <a>
          <i class="fas fa-bullhorn" style="color: darkgrey;"></i>
          <span class="ml-1">
          Announcements
        </span>
      </a>
    </li>
      <li class="mt-2"  v-on:click="setCurrentComponent('news')">
        <a>
          <i class="fas fa-rss-square" style="color:orange"></i>
          <span class="ml-1">
          News
        </span>
      </a>
    </li>
  
      <li class="mt-2">
        <a>
          <i class="fas fa-school"  style="color: tan;"></i>
          <span class="ml-1">
          Schools
        </span>
      </a>
    </li>
      <li class="mt-2">
        <a>
          <i class="fas fa-university" style="color:tan;"></i>
          <span class="ml-1">
          Colleges
        </span>
      </a>
    </li>
      <li class="mt-2">
        <a>
          <i class="fas fa-university"  style="color: tan;"></i>
          <span class="ml-1">
          Universities
        </span>
      </a>
    </li>
      <li class="mt-2">
        <a>
          <i class="fas fa-store" style="color:green"></i>
          <span class="ml-1">
          Businesses
        </span>
        </a>
      </li>
      <li class="mt-2">
        <a>
          <i class="fas fa-warehouse"  style="color: tan;"></i>
          <span class="ml-1">
          Organizations
        </span>
      </a>
    </li>
    </ul>
      </div>
</template>

<script>
	export default
	{
		data:function()
		{
			return {
				picked:'all',
			}
		},
		methods:
		{
		  setCurrentComponent:function(type)
      {
        this.$store.commit('setCurrentComponent',type);
      }
		},
		computed:
		{

		}
	}
</script>