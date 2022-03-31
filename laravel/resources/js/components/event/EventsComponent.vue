<template>
  <div
    class="col-12 row event-details"

  >
    <!--==============================EVENT CALENDAR==============================-->
    <div class="col-3 p-3 event-body-det">
      <span class="fa-stack fa-3x">
        <i class=" event-icons far fa-calendar fa-stack-2x" style="color:#4169e1"></i>
        <span class="fa-stack-1x " style="margin-top: 0">
          <strong style="display: block;font-size: 1rem">
            <!--$post->created_at->format('M')-->JUN
          </strong>
        </span>
        <span class="fa-stack-1x date" >
        <!--   <strong style="font-size:1.5rem"> -->
            {{ post.date | getDay }}
          <!--</strong>-->
        </span>
      </span>
    </div>
    <!--==============================EVENT DETAILS==============================-->
    <div class="col-9 p-3" id="container-$post->id">
      <p class = "event-name">
        
          {{ post.name }}
        
      </p class = "event-description">
      {{ post.description }}
      <span class="text-muted">
        {{ post.venue }}
      </span>
      {{ post.timeslot }}
    </div>
  </div>
</template>
<script>
export default {
  props: ["post"],
  data: function() {
    return {
      //
    };
  },
  methods: {
    //
  },

  filters: {
    getYMonth: function(date) {
      var res;
      res = date.slice(4, 6);
      return res;
    },
    getDay: function(date) {
      var res;
      //res = date.slice(6,9);
      return res;
    },
    removeTime: function(date) {
      var res;
      res = date.split(" ");
      return res[0];
    },
  },
  computed: {
    //
  },
  mounted() {
    //
  },
  watch: { //*************************************PLEASE ABSTRACT THIS
  'post': {
    handler (newVal) {
      if (newVal != null && newVal != "") { // check if userid is available
        this.$store.commit("set", {
      property_name: "resultsEmpty",
      property_values: false,
    });
      }
    },
    immediate: true // make this watch function is called when component created
  }
},
};
</script>
<style>

span {
  color: #666 !important;
}
.event-body-det{
 text-align: center;
}

.event-icons {
  color: #999 !important;
}
.event-details
{
  	margin:0;
    padding: 0;
    /* background-color:#478ac9 ; */
}
.event-name
{
	color : #444 !important;
	font-weight:400;
  font-size:1.2rem;
}
.event-description
{
	color : #888 !important;
	font-weight:400;
  font-size:0.8rem;	
}
.date{
	margin-top: 0.85rem;
	color:#888 !important;
}
</style>
