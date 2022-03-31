<template>
	<div>
		<!--@if ($post->comments->count()!=0 || $post->likes->count()!=0)-->
		<div>
			<div class=" d-flex align-self-center pl-3" style="padding-top: 0.5rem;">
				<!--COMMENTS COUNT-->
				<div v-if="commentsCount > 0">
					<a data-toggle="collapse" :href="getCommentsCollapse(post_id)" role="button" aria-expanded="false" :aria-controls="getCollapseControl(post_id)">
						<span style="margin: 0 0.5rem">{{commentsCount}} Comments</span>
					</a>
				</div>
				<!--LIKES COUNT-->
				<div v-if="likesCount > 0">
					<span style="margin: 0 0.5rem">{{likesCount}} Likes</span>
				</div>
				<!--SHARES COUNT-->
				<div v-if="sharesCount > 0">
					<span style="margin: 0 0.5rem">{{sharesCount}} Shares</span>
				</div>


			</div>
		</div>

		<!--==========================ICONS FOR EDITNG post==========================-->
		<div class=" d-flex align-self-center border-top border-bottom p-0" style="margin-bottom: -1.25rem;">
			<!--@if (Auth::user())--> 
			<!-- COMMENT post -->
			<!--if user logged in allow to interact-->
			<div class="col-12  p-0   row m-0" v-if="auth_id != undefined">
				<a  class="col p-2 pl-4 pr-4 hvr" style="display:inline;padding-left : 15px;text-align: center;" :data-commentableid="post_id" data-toggle="collapse" :href="getCommentsCollapse(post_id)" role="button" aria-expanded="false" :aria-controls="getCollapseControl(post_id)">

					<i class="fa fa-comment comment edit_pen">
					</i>
					<span class="ml-1">
						Comment
					</span>
				</a>
				
				<!-- LIKE post -->
				
				<a  class="col p-2 pl-4 hvr" href="route('createLike',['likeableId'=>$post->id])" style="display:inline;padding-left : 15px;text-align: center;" >
					<i class="fa  fa-thumbs-up ">
					</i>
					<span class="ml-1">
						Like
					</span>
				</a>

				<!-- SHARE post -->
				<a  class="col p-2 pl-4 hvr" href="route('sharePost',['shareable_id'=>$post->id,'shareable_type'=>get_class($post)])" style="display:inline;padding-left : 15px;text-align: center;" :data-commentableid="post_id">
					<i class="fa fa-share comment edit_pen">
					</i>
					<span class="ml-1">
						Share
					</span>
				</a> 

			</div>
			
			<!--else do not allow interaction-->
			<div class="col-12 row m-0" v-else>
				<!-- COMMENT post -->
				<a  class="col p-2 pl-4 hvr" style="display:inline;padding-left : 15px;text-align: center;" data-toggle="collapse" :href="getCommentsCollapse(post_id)" role="button" aria-expanded="false" :aria-controls="getCollapseControl(post_id)" v-on:click="loadMoreComments(post_id)" >
					<i class="fas fa-comment">
					</i>
					<span class="ml-1">
						Comment
					</span>
				</a>


				<!-- LIKE post -->
				<a  class="col p-2 pl-4 hvr" href="#" style="display:inline;padding-left : 15px;text-align: center;">
					<i class="fa fa-thumbs-up ">
					</i>
					<span class="ml-1">
						Like
					</span>
				</a>

				<!-- SHARE post -->
				<a  class="col p-2 pl-4 hvr" href="#" style="display:inline;padding-left : 15px;text-align: center;" :data-commentableid="post_id">
					<i class="fa fa-share comment edit_pen">
					</i>
					<span class="ml-1">
						Share
					</span>
				</a> 
			</div>



		</div>
		<!--====================================COMMENTS====================================-->
		<div class="collapse" :id="getCollapseControl(post_id)"  style="padding: 0.75rem">
			<div v-for="post in comments" v-if="!loading"><!--iterate the comments -->
				<div class="media mt-4" >
					<img class="mr-3 image-fluid rounded-circle " :src="profile_pic(post.user_id)" alt="image" style="max-width: 2.35rem;max-height: 2.35rem" >
					<!--media body-->
					<div class="media-body">
						<a href="user_link(post.user_id.slug)"><!--fix href later-->
							<span >
								<h6 class="mt-0">
									{post.user.name}<!--fix later -->
								</h6>
							</span>
						</a>
						<!--post body-->
						<div class="badge badge-pill p-2" style="white-space: normal;background-color: #f0f0f0;min-width:3rem;font-size:90% !important">
							{{post.body}}
						</div><!--end post body-->
						<!--ICONS FOR EDITNG post-->
						<div class=" d-flex align-self-center align-items-center"  >
							<!-- EDIT COMMENT -->

							<a href="#" v-if="post.user_id == auth_id " data-postid="post.id">
								<i class="fas fa-pen edit_pen  myclass">
								</i>
							</a>

							<!-- DELETE COMMENT -->

							<a class="ml-2" v-if=" post.user_id == auth_id " style="display:inline" :data-link="delete_comment_link(post.id)" >
								<i class="fas fa-trash edit_pen">
								</i>
							</a>

							<!-- REPLY COMMENT -->
							<a class="ml-2" style="display:inline" :data-commentid="post.id">


								<!--reply count to be added here-->

								<i class="fas fa-reply edit_pen reply">
								</i>
							</a>
							<!-- LIKE COMMENT-->
							<a class="ml-2" href="" >
								<i class="fas fa-thumbs-up ">
								</i>
							</a>
						</div><!--end icons-->
						<!--COMMENT REPLY INPUT-->
        <!--  <div :id="reply_id(post.id)" style="display: none" v-if="auth_id">
            
            <form  @submit.prevent="replySubmit($event,post.id)" enctype="multipart/form-data">
              <img class="mr-3 image-fluid rounded-circle " :src="profile_pic(auth_id)" alt="image" style="max-width: 2.35rem;max-height: 2.35rem" >

              <input class="form-control form-control-sm col-10" style="display: inline;border-radius: 2rem;"  type="text" v-model="reply_body" placeholder="reply ..." autocomplete="off">
              <a style="position: absolute;margin-top: 0.5rem;margin-left: -3rem;"><i :data-commentId="post.id" class="fas fa-smile"></i></a>
              <a class="input-add-image"  style="position: absolute;margin-top: 0.5rem;margin-left: -2rem;"><i :data-commentId="post.id" class="fas fa-image"></i></a>
              <input type="hidden"  v-model.number="commentId" value="post.id"> 
              <input type="file" id="reply-picture$comment->id" v-on:change="reply_picture" accept="image/=" style="display:none" autocomplete="off">
              <input type="submit" value="Submit" style="display: none">
            </form>

            <div class="uploaded-image"></div>
          
            
        </div>-->
        <!--<replies :auth_id="auth_id" :commentId="post.id" :replies_count="post.replies_count"></replies>-->
    </div>


</div>


</div> <!-- end comments foreach -->
<!--LOADING GIF-->
<div  class="d-flex col-12" v-if="loadingComment">
	<img class="ml-auto mr-auto" src="/assets/img/loader.gif">
</div>
<div v-if="creatingComment"><h3>im creating a comment</h3></div>
<a class="btn btn-sm " v-if="commentsCount > 0" v-on:click="loadMoreComments"><em>comments ...</em></a>
<div v-if="auth_id" class="mt-3"><!--if authenticated-->

	<form  @submit.prevent="commentSubmit" enctype="multipart/form-data">
		<img class="mr-3 image-fluid rounded-circle " :src="profile_pic(auth_id)" alt="image" style="max-width: 2.35rem;max-height: 2.35rem" >
		<input type="text" class="form-control form-control-sm col-10" style="display: inline;border-radius: 2rem;"   v-model="comment_body" placeholder="make opinion ...">
		<input type="submit" style="display:none">
	</form>

</div><!--endif-->
</div>






</div>

</div>
</template>

<script>
import VueSwal from 'vue-swal';
import {Post} from '../../Post.ts';
export default {
	inheritAttrs: false,
	props:['post_id','post_type','auth_id','key_','user_id'/*id of post owner */],
	data:function() {
		return {
			page:0,
			likesCount:0,
			commentsCount:0,
			sharesCount:0,
			errors_array:[],
			loading:false,
			loadingComment:false,
			creatingComment:false,
			comments:this.$store.state.comments,
			token:"",
			commentId:0,
			commentable_id:this.post_id,
			commentable_type:'',
			_token:this.$store.state.token,
			comment_body:'',
			image_url:"/assets/img/loader.gif",
			post:null,
			comment_post_id:'',
		}
	},
	updated: function () {


		this.token = this.$store.state.token;

	},
	mounted() 
	{
		this.post = new Post();
		//this.$store.commit('set',{property_name:'comments',property_values:[]});
		
	},
	methods:
	{
		user_link:function(slug)
		{
			return '/'+slug
		},
		profile_pic:function(user_id)
		{
			return '/profile-picture/'+user_id
		},
		delete_comment_link:function(comment_id)
		{
			return '/deleteComment/'+comment_id
		},
		loadMoreComments: function()
		{
			this.loadingComment = true;
			this.page  = this.page + 1;
			
			var url = '/api/'+this.$route.params.slug+'/'+this.post_type+'/'+this.post_id+'/comments';
			if(this.page > 1)//if not the first batches of comments
			{
				url = '/api/'+this.$route.params.slug+'/'+this.post_type+'/'+this.post_id+'/comments'+'?page'+this.page;
			}
			this.post.get(this,url,1,'comments');
			console.log('post_id:'+this.post_id+' ; comment_post_id:'+this.comment_post_id);
			console.log(this.comment_post_id);
		},
		commentSubmit(e) 
		{
			var that=this;
			this.creatingComment=true;
			this.$swal({
				text: "Adding Comment",
				icon:that.image_url,
				buttons: false,
			});
							//$.jGrowl("comment added!", { position: 'center' });
							
							//e.preventDefault();
			let currentObj = this;
			axios.post('../createComment', {
								body: this.comment_body,
								commentable_id: this.commentable_id,
								commentable_type:this.get_post_type,
								_token:this._token
			})
			.then(function (response) {
								currentObj.output = response.data;
								currentObj.$swal({
									text: 'comment added',
									icon: "success",
									buttons:false,
									timer: 3000,
								});
			})
			.catch(function (error) {
				currentObj.output = error;
			})
			.finally(function(){
				currentObj.comment_body = '';
								
				setTimeout(function(){ currentObj.creatingComment = false; }, 1500);
			});
		},

		getCommentsCollapse:function(id)
		{
			return '#comments-collapse-'+this.key_+id
		},
		getCollapseControl:function(id)
		{
			return 'comments-collapse-'+this.key_+id
		},
	},
	computed:
	{
		getParent:function()
		{
			return this.$parent.song
		},

		get_post_type:function()
		{
			return 'App\\'+this.post_type;
		},
		commentable_post_id:function()
		{
			return this.post_id;
		}
	}
				}
</script>
<style>
	.badge {
		font-weight:normal !important;
		}
</style>