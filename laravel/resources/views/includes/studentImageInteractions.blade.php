<div class="col-12 p-1 border-top d-sm-none image-interaction-div" style="position: absolute;margin-top: -1.75rem;background-color:rgba(0, 0, 0, 0.4); ">
	<a class="ml-1"><i class="fas fa-thumbs-up text-light"></i></a>
	<a class="ml-2"><i class="fas fa-comment text-light"></i></a>
	<a class="ml-2 " id="interactionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pen edit-image text-light"></i></a>
	@auth
	 @if(Auth::id() == $userIdNo->id)
	<div class="dropdown-menu" aria-labelledby="interactionDropdown">
		<a class="dropdown-item" href="#">delete</a>
	</div>
	@endif
	@endauth
</div>


	