<template>

<div class="modal fade" id="edit_post_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit_post_modalLabel" aria-hidden="true">
<!-- Vertically centered modal -->
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit {{post.post_type}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
     <make-post :user="user" :edit_post="post"></make-post>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
</template>
<script>

	export default{
		props:['post','user'],
		/*components:{
			'make-post':MakePostComponent,
		},*/
		mounted()
		{







		}
	}
</script>