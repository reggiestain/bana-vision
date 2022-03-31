<div class="col-12 p-1 border-top d-sm-none image-interaction-div" style="position: absolute;margin-top: -1.75rem;background-color:rgba(0, 0, 0, 0.4); ">
	<a class="ml-1"><i class="fas fa-thumbs-up text-light"></i></a>
	<a class="ml-2"><i class="fas fa-comment text-light"></i></a>
	<a class="ml-2 " id="interactionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen edit-image text-light"></i></a>
	@auth
	 @if(Auth::id() == $userIdNo->id)
	<div class="dropdown-menu" aria-labelledby="interactionDropdown">
	
		<form action="{{route('setCoverPhoto')}}" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="filename" name="filename" value="{{$post->images->first()->name}}">
			<button type="submit" id="submit-photo" class=" dropdown-item btn btn-link btn-xs " >make cover</button> 
			<input type="hidden"  name="_token" value="{{{csrf_token()}}}">
		</form>
		<form action="{{route('setProfilePhoto')}}" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="filename" name="filename" value="{{$post->images->first()->name}}">
			<button type="submit" id="submit-photo" class=" dropdown-item btn btn-link btn-xs " >make profile</button> 
			<input type="hidden"  name="_token" value="{{{csrf_token()}}}">
		</form>
		<a class="dropdown-item deleteFile" data-post-id="{{$post->id}}">delete</a>
	</div>
	@endif
	@endauth

</div>


	