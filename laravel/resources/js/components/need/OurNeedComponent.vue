<template>
  <div>
    <div class="col-12 row" style="background-color: #eff1f3;padding: 0;margin: 0">
      <!--==============================EVENT CALENDAR==============================-->
      <div class="col-3 p-3" style="    text-align: center;">
        <span class="fa-stack fa-2x">
          <i class="fas fa-hand-holding-usd fa-stack-2x" style="color:#4169e1"></i>
        </span>
      </div>
      <!--==============================EVENT DETAILS==============================-->
      <div class="col-9 p-3 row m-0" id="container-$post->id">
        <h6>
          <strong>
            {{post.title}}
          </strong>
        </h6>
        <br><br>
        <p>
          {{post.description}}
        </p>
      </div>
    </div>
    <div class="col-12 row m-0 "  style="background-color: #eff1f3;padding: 0.2rem;margin: 0">
      <div class=" col-3 text-muted  d-flex p-0">
        <span class="badge badge-pill badge-info p-2 ml-auto mr-auto  badge-need " >
          quantity : {{post.quantity}}
        </span>
      </div>
      <div class="col-3  d-flex p-0" >
        <span  class="badge badge-pill badge-info p-2 ml-auto mr-auto  badge-need">
          due : {{post.due_date}}
        </span>
      </div>
      <div class="col-3 d-flex p-0" >
        <span  class="badge badge-pill badge-info p-2 ml-auto mr-auto  badge-need  ">
          category : {{post.category}}
        </span>
      </div>
      <div class="col-3 d-flex p-0" >
        <span  class="badge badge-pill badge-info p-2 ml-auto mr-auto  badge-need  ">
          urgency : {{post.urgency}}
        </span>
      </div>
    </div>

    <span class="p-2 pb-0">
      <!--include('includes.postInteractions')-->

    </span>
  </div>
</template>
<script>
export default {
	props:['post'],
	data: function() {
	 		return {
	 		}
		},
	methods:
	{
       showphoto:function(our_need,active)
    {
      console.log('%c'+'im clicked','font-size:140px');
      console.log(our_need);
      //console.log($(event.target).attr('data-event'));
      //var our_need = $(event.target).attr('data-event');
      //our_need.images
      var imgsrc = $(event.target).attr('src');
      //var studentsImages = document.getElementById("student-pictures");
      var mrkup='';
      for (var i = 1; i < our_need.images.length; i++) 
      {
        mrkup += '<div class="carousel-item">'+
      '<img class="img-fluid d-block mx-auto modal-img"  src="/post-picture/'+our_need.images[i].name+'/events" alt="Third slide">'+
    '</div>';
      }
      //studentsImages.innerHTML = '';

     var innerHTML = '<div class="carousel-item active"><img class="img-fluid d-block mx-auto" src="'+this.getNeedPic(our_need)+'" id="first-slide-'+our_need.id+'" alt="First slide" ></div>'+mrkup;
      //$('#first-slide').prop('src',$(event.target).attr('src'));
      var posttext='<h4>'+our_need.title+'</h4><p>'+
      our_need.description+'</p><ul>'+
      '<li ><strong>Quantity :</strong> '+our_need.quantity+'</li>'+
      '<li ><strong>Category :</strong> '+our_need.category+'</li>'+
      '<li ><strong>Due date :</strong> '+our_need.due_date+'</li>'+
      '<li ><strong>Urgency :</strong> '+our_need.urgency+'</li>'+
      '</ul>';
      var modal_object = 
      {
        'id':our_need.id,
        'auth_id':this.auth_id,
        'post_type':"OurNeed",
        'innerhtml':innerHTML,
        //'posttext':posttext,
        //'posterimg':this.profile_pic(our_need.school.user[0].id),
        //'postername':our_need.school.user[0].name
      };
      var reff = 'postpic'+our_need.id;
      this.ref_=reff;
      this.$store.commit('setpicid',our_need.id);
      console.log(this.$store.state.pic_post_id);
      //$('#PostPicCarousel-modal-'+our_need.id).modal();
      this.$root.$refs['getpostpic'].launchModal(modal_object); //calls launchmodal method from postpic component
    },
	},
	computed:
	{
	},
  mounted()
  {

  }
}
</script>
<style type="text/css">
  .badge-need
  {
    white-space: pre-wrap !important;
  }
</style>