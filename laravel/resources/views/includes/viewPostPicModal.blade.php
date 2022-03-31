@inject('student','App\Student')


<!--PARTICIPANTS  Modal -->
<div class="modal fade PostPicCarousel-modal-cl" id="PostPicCarousel-modal-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="col-12 modal-dialog modal-lg" role="document" style="overflow: visible;overflow-y: visible;height:fit-content;position: fixed;top:0;">
		<div class="col-12 modal-content" style="border: none;background: transparent;flex-direction: row;">


			<!--MODAL BODY-->
			<div class="col-12 modal-body p-0 d-md-flex">
				<!-- carousel -->
				<div class="col-12 d-sm-none p-3" style="background-color: #ff5500;"><h5 class="text-light"><a href="#" class="close text-light" data-dismiss="modal" aria-label="Close" style="    float: none;opacity:1"><i class="fas fa-arrow-circle-left "></i> Back</a></h5></div>
				<div id="carouselExampleIndicators" class="col-12 col-md-8 carousel slide d-flex align-items-center p-0" data-interval="false" data-ride="carousel" style="background-color: #000000">
				
					<div class="carousel-inner" id="student-pictures-{{$post->id}}">	
					</div>
					<!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
					data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
				data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
							</a>-->
						</div><!-- end carousel -->

		<div class="col-12 col-md-4 p-2" id="post-pic-modal-content" >
			<!-- poster profile -->
			<div class="media col-12 d-flex align-items-center p-0">
				<img class="rounded-circle mr-3 post-avatar"   src="{{route('getProfilePic',['filename'=>$userIdNo->id])}}" >
				<div class="media-body">
					<a class="mt-0" href="#"><strong>{{$userIdNo->name}}</strong></a>
				</div>
			</div>
			<!-- end poster profile -->
			<!-- post text -->
			<div class="col-12 p-2  mt-3" id="post-text-{{$post->id}}">
			</div>
			<!--Like,Comment,Delete,Share buttons plus comments and replies-->
			@if(!empty($post) && ($post->comments != null))
			@include('includes.postInteractions')
			@endif
		</div>

	</div><!--END OF MODAL BODY-->

</div>
</div>
</div>


 