<template>
	<div>
	<div :id="reply_id(commentId)" style="display: none" v-if="auth_id">
            
            <form  @submit.prevent="replySubmit()" enctype="multipart/form-data">
              <img class="mr-3 image-fluid rounded-circle " :src="profile_pic(auth_id)" alt="image" style="max-width: 2.35rem;max-height: 2.35rem" >

              <input class="form-control form-control-sm col-10" style="display: inline;border-radius: 2rem;"  type="text" v-model="reply_body" placeholder="reply ..." autocomplete="off">
              <a style="position: absolute;margin-top: 0.5rem;margin-left: -3rem;"><i :data-commentId="commentId" class="fas fa-smile"></i></a>
              <a class="input-add-image"  style="position: absolute;margin-top: 0.5rem;margin-left: -2rem;"><i :data-commentId="commentId" class="fas fa-image"></i></a>
              <input type="hidden"  v-model.number="commentId" value="commentId"> 
              <input type="file" id="reply-picture$comment->id" v-on:change="reply_picture" accept="image/=" style="display:none" autocomplete="off">
              <input type="submit" value="Submit" style="display: none">
            </form>

            <div class="uploaded-image"></div>
          
            
          </div>
	<!--============================COMMENT REPLIES============================-->
					
					<div class="media mt-3" v-for="reply in repliesArray" v-if="commentId == repliesArray.comment_id">
					<div class="media mt-3">
						 <img class="mr-3 image-fluid rounded-circle "
							:src="profile_pic(reply.user_id)" alt="image" style="max-width: 2.35rem;max-height: 2.35rem" >

					 <div class="media-body">
						<a href="">
							<span >
								<h6 class="mt-0">
									{{reply.user.name}}
								</h6>
							</span>
						</a>
						
						<div class="badge badge-pill p-2" style="white-space: normal;background-color: #f0f0f0;min-width: 3rem;font-size:90% !important">
						 {{reply.body}}
					 </div>
					 <!--ICONS FOR EDITNG post-->
					 <div class=" d-flex align-self-center align-items-center"  >
						<!-- EDIT REPLY-->
						<!--vif-->
						<a href="#" data-postid="">
							<i class="fas fa-pen edit_pen  myclass">
							</i>
						</a>
						
						<!-- DELETE REPLY -->
						<!--vif-->
						<a class="ml-2" style="display:inline;" data-link="" >
							<i class="fas fa-trash edit_pen">
							</i>
						</a>
					 
						<!-- LIKE REPLY-->
						<a class="ml-2" href="route('createLike',['likeableId'=>$reply->id])" >
							<i class="fas fa-thumbs-up ">
							</i>
						</a>
					</div>
					 </div>
				 </div>

				 
				<!--  END REPLIES  -->
				 <!-- end replies forech -->
					</div><!--end media body-->
					<!--LOADING GIF-->
					<div class="d-flex col-12" v-if="loadingReply">
						<img class="ml-auto mr-auto" src="/assets/img/loader.gif">
					</div>
					<div v-if="replies_count > 0"><a class="ml-3" v-on:click="loadMoreReplies(commentId)"><em>replies</em></a></div>
					</div>
				</template>
</template>
<script>
	export default{
		props:['commentId','auth_id','replies_count'],
		data:function(){
			return{
				r_page:0,
				loadingReply:false,
				repliesArray:[],
				reply_body:'',
				reply_picture:'',
			}
		},
		methods:
		{
			loadMoreReplies: function(comment_id)
			{
				this.loadingReply = true;
				console.log('%c r_page:'+this.r_page,'color:green');
				this.r_page  = this.r_page + 1;
				var that = this;
				axios.get('../replies/'+comment_id+'/?page=' +this.r_page )
				.then(response => {

					console.log(this.repliesArray);
					this.repliesArray = this.repliesArray.concat(response.data[1].data);
					this.repliesArray['comment_id'] = comment_id;
					console.log(this.repliesArray); 

				})
				.catch(error => {
					console.log(error)
					this.errored = true
				})
				.finally(function(){
									//this.loading = false;
									setTimeout(function(){ that.loadingReply = false; }, 1500);
									
								});
			},
			replySubmit(e) {
				//e.preventDefault();
				let currentObj = this;
				axios.post('../createReply', {
					body: this.reply_body,
					commentId: this.commentId,
					commentable_type:this.get_post_type,
					reply_picture:this.reply_picture,
					_token:this._token
				})
				.then(function (response) {
					currentObj.output = response.data;
					$.jGrowl("comment added!", { position: 'center' });
				})
				.catch(function (error) {
					currentObj.output = error;
				})
				.finally(function(){
					currentObj.reply_body = '';
					setTimeout(function(){ currentObj.creatingComment = false; }, 1500);
				});
			},
			reply_id:function(id)
						{
							return 'comment-reply'+id
						},
			profile_pic:function(user_id)
						{
								return '/profile-picture/'+user_id
						},
		}
	}
</script>